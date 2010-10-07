<?php

class Site extends MY_Controller
{
  var $_user;

  function __construct() {
    MY_Controller::__construct();

    $segment = $this->uri->segment(1, '');
    if (($segment == 'toc' || $segment == 'newpass') && !$this->session->userdata('logged_in')) {
      redirect('/');
    }
  }

  function index() {
    if ($this->session->userdata('logged_in')) {
      redirect('/toc');
    }

    $this->load->view('pageTemplate', array(
      'title' => 'Your Online Cookbook',
      'content' => $this->load->view('site/callToAction', null, true)));
  }

  function toc() {
    $this->load->model('Recipe');
    $recipes = $this->Recipe->getAllNamesInBook($this->session->userdata('current_book_id'));

    $this->load->view('pageTemplate', array(
      'title' => 'Table of Contents',
      'content' => $this->load->view('book/toc', array('recipes' => $recipes), true)));
  }

  function login() {
    if (!$this->form_validation->run('login')) {
      $this->load->view('pageTemplate', array(
        'title' => 'Your Online Cookbook',
        'content' => $this->load->view('site/login', null, true)));
    }
    else {
      $this->_setLoginSession($this->_user);
      $this->session->set_flashdata('msg', 'Welcome back, '.$this->_user->username);

      $this->load->model('Marketing');
      $this->Marketing->markLogin();

      redirect('/toc');
    }
  }

  function _validate_login($junk) {
    $this->load->model('User');
    if ($user = $this->User->validateLogin($this->input->post('username'), $this->input->post('password'))) {
      $this->_user = $user;
      return true;
    }
    else {
      $this->form_validation->set_message('_validate_login', 'Invalid username or password');
      return false;
    }
  }

  function _setLoginSession($user) {
    $this->load->model('Cookbook');

    $currentBookId = isset($user->owns_book_id) ? $user->owns_book_id : $user->edits_book_id;

    $this->session->set_userdata('userid', $user->id);
    $this->session->set_userdata('logged_in', true);
    $this->session->set_userdata('is_owner', isset($user->owns_book_id));
    $this->session->set_userdata('current_book_id', $currentBookId);
    $this->session->set_userdata('bookname', $this->Cookbook->getNameById($currentBookId));

    $this->session->set_userdata('is_suspended', $user->status == 'suspended');
    if ($user->status == 'suspended') {
      $this->session->set_flashdata('err', "Your editing privileges have been suspended. Please contact this cookbook's owner.");
    }
  }

  function _unsetLoginSession() {
    $this->session->unset_userdata('userid');
    $this->session->unset_userdata('logged_in');
    $this->session->unset_userdata('is_owner');
    $this->session->unset_userdata('current_book_id');
    $this->session->unset_userdata('bookname');
    $this->session->unset_userdata('is_suspended');

    $this->session->unset_flashdata('err');
    $this->session->unset_flashdata('msg');
  }

  function logout() {
    $this->session->sess_destroy();
    redirect('/');
  }

  function random() {
    $this->load->model('Recipe');
    $id = $this->Recipe->getRandomId();
    $this->session->set_flashdata('msg', "This is only one of our users' recipes. Want to create your own cookbook? ".anchor('signup', 'Sign up today!'));
    redirect("recipe/$id");
  }

  function features() {
    $this->load->view('pageTemplate', array(
      'title' => 'More Information',
      'content' => $this->load->view('site/featuresPricing', null, true)));
  }

  function signup() {
    if (!$this->form_validation->run('signup')) {
      $this->load->view('pageTemplate', array(
        'title' => 'Your Online Cookbook',
        'content' => $this->load->view('site/signup', null, true)));
    }
    else {
      $this->load->model('User');
      $this->load->model('Cookbook');
      $this->load->model('Marketing');

      // TODO: detect successful/failed account creation and behave accordingly
      $userId = $this->User->create($this->input->post('username'), $this->input->post('password'), $this->input->post('email'));
      $bookId = $this->Cookbook->create($userId, $this->input->post('plan'));
      $this->Marketing->markSignup($userId);

      $user = $this->User->validateLogin($this->input->post('username'), $this->input->post('password'));
      $this->_setLoginSession($user);
      $this->session->set_flashdata('msg', 'Your account has been created');

      if ($this->input->post('plan') != 'free') {
        $this->config->load('paypal', true);
        $ppcfg = $this->config->item('paypal');
        $redir = $ppcfg['base_url'];

        if ($this->input->post('plan') == 'medium') {
          $redir .= $ppcfg['medium_plan_code'];
        }
        else if ($this->input->post('plan') == 'large') {
          $redir .= $ppcfg['large_plan_code'];
        }
        else {
          echo 'ERROR: invalid plan choice';
          return;
        }
        // TODO: don't finalize plan details until $$ transaction completed
        redirect($redir);
      }

      redirect('/toc');
    }
  }

  function signupCancelled() {
    $this->load->model('User');
    $this->load->model('Cookbook');
    $this->load->model('Marketing');

    $userId = $this->session->userdata('userid');
    $bookId = $this->session->userdata('current_book_id');
    $this->_unsetLoginSession(); // NB: sess_destroy() wasn't doing the trick; did I do it wrong?

//    $this->Cookbook->cancelAtSignup($bookId, $userId);
//    $this->User->cancelAtSignup($userId);
//    $this->Marketing->markCancelAtSignup($userId);

    $this->load->view('pageTemplate', array(
      'title' => 'Your Online Cookbook',
      'content' => $this->load->view('site/secondChance', null, true)));
  }

  function acceptInvitation($token) {
    $this->load->model('User');
    if ($user = $this->User->resetPerishableToken($token)) {
      $this->_setLoginSession($user);
      $this->session->set_flashdata('msg', 'Thanks for visiting, '.$user->username.'. Please set your password before continuing.');
      redirect('/newpass');
    }
    else {
      $this->session->set_flashdata('err', 'That invitation link is invalid or expired.');
      redirect('/');
    }
  }

  function account() {
    $this->load->model('User');
    $account = $this->User->getById($this->session->userdata('userid'));

    $friends = '';
    if ($this->session->userdata('is_owner')) {
      $this->load->model('Cookbook');
      $friends = $this->Cookbook->getEditors($this->session->userdata('current_book_id'));
      $data = array('friends' => $friends, 'hasMore' => false, 'max' => 10);
      $friends = $this->load->view('friends/view', $data, true);
    }

    $this->load->view('pageTemplate', array(
      'title' => 'Manage Your Account',
      'content' =>
        '<div id="ingredientsList">'.$this->load->view('site/userSettings', $account, true).'</div>' .
        '<div id="instructionsList">'.$friends.'</div>' .
        '<div style="clear:both"></div>'));
  }

  function newpass() {
    if (!$this->form_validation->run('update_password')) {
      $this->load->view('pageTemplate', array(
        'title' => 'Reset Password',
        'content' => $this->load->view('site/resetPassword', null, true)));
    }
    else {
      $this->load->model('User');
      $this->User->updatePassword($this->session->userdata('userid'), $this->input->post('password'));
      $this->session->set_flashdata('msg', 'Your password has been saved');
      redirect('/toc');
    }
  }
}


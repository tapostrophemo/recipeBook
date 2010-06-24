<?php

class Site extends Controller
{
  var $_user;

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

      $this->session->set_userdata('logged_in', true);
      $this->session->set_userdata('is_owner', isset($user->owns_book_id));
      $this->session->set_userdata('current_book_id', $currentBookId);
      $this->session->set_userdata('bookname', $this->Cookbook->getNameById($currentBookId));
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
      $userId = $this->User->create(
        $this->input->post('username'),
        $this->input->post('password'),
        $this->input->post('email'));
      $this->load->model('Cookbook');
      $bookId = $this->Cookbook->create($userId, $this->input->post('plan'));

      $user = $this->User->validateLogin($this->input->post('username'), $this->input->post('password'));
      $this->_setLoginSession($user);

      $this->session->set_flashdata('msg', 'Your account has been created');
      redirect('/toc');
    }
  }

  function _username_available($junk) {
    $this->load->model('User');
    if ($this->User->getByUsername($this->input->post('username'))) {
      $this->form_validation->set_message('_username_available', 'That username is already taken');
      return false;
    }
    return true;
  }
}


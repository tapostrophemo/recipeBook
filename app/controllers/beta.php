<?php

class Beta extends Controller
{
  function __construct() {
    parent::__construct();
    log_message('debug', 'Beta class initialized');

    if ($this->session->userdata('logged_in')) {
      redirect('/book');
    }
  }

  function index() {
    $this->session->set_userdata('in_beta', true);
    $this->load->view('pageTemplate', array(
      'title' => 'Your Online Cookbook',
      'content' => $this->load->view('site/callToAction', null, true)));
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
    $this->load->view('pageTemplate', array(
      'title' => 'Create Your Cookbook',
      'content' => $this->load->view('site/signup', null, true)));
  }

  function checkUserAvailability() {
    if (!$this->form_validation->run('signup_check_user_avail')) {
      $this->signup();
    }
    else {
      $this->session->set_userdata('signup_username', $this->input->post('username'));
      $this->session->set_userdata('signup_email', $this->input->post('email'));
      $this->load->view('pageTemplate', array(
        'title' => 'Your Online Cookbook',
        'content' => $this->load->view('site/signup2', null, true)));
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

  function createAccount() {
    if (!$this->form_validation->run('signup_create_account')) {
      $this->load->view('pageTemplate', array(
        'title' => 'Your Online Cookbook',
        'content' => $this->load->view('site/signup2', null, true)));
    }
    else {
      $this->load->model('User');
      $userId = $this->User->create(
        $this->session->userdata('signup_username'),
        $this->input->post('password'),
        $this->session->userdata('signup_email'));
      $this->load->model('Cookbook');
      $bookId = $this->Cookbook->create($userId);
      echo "Your account has been created";
    }
  }
}


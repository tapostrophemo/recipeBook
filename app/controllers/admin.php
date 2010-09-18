<?php

class Admin extends Controller
{
  function __construct() {
    Controller::__construct();;

    if (!$this->session->userdata('admin_logged_in') && $this->uri->uri_string() != '/admin/login') {
      redirect('/admin/login');
    }
  }

  function login() {
    if (!$this->form_validation->run('admin_login')) {
      $this->load->view('admin/pageTemplate', array(
        'title' => 'Login',
        'content' => $this->load->view('admin/login', null, true)));
    }
    else {
      $this->session->set_userdata('admin_logged_in', true);
      $this->index();
    }
  }

  function index() {
    $this->load->view('admin/pageTemplate', array(
      'title' => 'Menu',
      'content' => $this->load->view('admin/menu', null, true)));
  }

  function logout() {
    $this->session->sess_destroy();
    redirect('/admin/login');
  }

  function _validate_admin_login($junk) {
    $this->load->model('AdminUser');
    if ($this->AdminUser->validateLogin($this->input->post('username'), $this->input->post('password'))) {
      return true;
    }
    else {
      $this->form_validation->set_message('_validate_admin_login', 'Authorized Administrators Only!');
      return false;
    }
  }

  function marketingMetrics() {
    $this->load->model('Marketing');
    $data = $this->Marketing->getReport();
    $this->load->view('admin/pageTemplate', array(
      'title' => 'Marketing Metrics',
      'content' => $this->load->view('admin/marketingMetrics', array('data' => $data), true)));
  }

  function userAccounts() {
    $this->load->model('User');
    $data = $this->User->adminReport();
    $this->load->view('admin/pageTemplate', array(
      'title' => 'User Accounts',
      'content' => $this->load->view('admin/userAccounts', array('data' => $data), true)));
  }
}


<?php

class Book extends Controller
{
  var $_user;

  function index() {
    $this->load->model('Recipe');
    $recipes = $this->Recipe->getAllNames();

    $this->load->view('pageTemplate', array(
      'title' => 'Table of Contents',
      'content' => $this->load->view('book/toc', array('recipes' => $recipes), true)));
  }

  function login() {
    if (!$this->form_validation->run('login')) {
      $this->load->view('pageTemplate', array(
        'title' => 'Login',
        'content' => $this->load->view('book/login', null, true)));
    }
    else {
      $this->session->set_userdata('logged_in', true);
      $this->session->set_userdata('username', $this->_user->username);
      $this->session->set_userdata('is_admin', $this->_user->is_admin);
      $this->session->set_flashdata('msg', 'Welcome back, '.$this->_user->username);
      redirect('/book');
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

  function logout() {
    $this->session->sess_destroy();
    redirect('/');
  }
}


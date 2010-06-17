<?php

class Admin extends Controller
{
  function __construct() {
    parent::__construct();

    if (!$this->session->userdata('is_admin')) {
      $this->session->set_flashdata('msg', 'Authorized users only!');
      if ($this->session->userdata('logged_in')) {
        redirect('/book');
      }
      else {
        redirect('/');
      }
    }
  }

  function index() {
    $this->load->view('pageTemplate', array(
      'title' => 'Admin',
      'content' => $this->load->view('admin/menu', null, true)));
  }

  function adduser() {
    if (!$this->form_validation->run('admin_adduser')) {
      if ($this->input->is_ajax()) {
        $this->load->view('admin/addUser');
      }
      else {
        $this->load->view('pageTemplate', array(
          'title' => 'Add User',
          'content' => $this->load->view('admin/addUser', null, true)));
      }
    }
    else {
      $this->load->model('User');
      $newUserId = $this->User->create(
        $this->input->post('username'),
        $this->input->post('password'),
        $this->input->post('email'));
      $this->session->set_flashdata('msg', "User with id=$newUserId created");
      redirect('/admin/userlist');
    }
  }

  function userlist() {
    $this->load->model('User');
    $users = $this->User->getAll();
    $this->load->view('pageTemplate', array(
      'title' => 'Admin',
      'content' => $this->load->view('admin/userlist', array('users' => $users), true)));
  }
}


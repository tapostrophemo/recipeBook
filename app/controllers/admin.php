<?php

class Admin extends Controller
{
  function __construct() {
    parent::__construct();

    if (!$this->session->userdata('is_admin')) {
      $this->session->set_flashdata('msg', 'Authorized users only!');
      redirect('/');
    }
  }

  function index() {
    $this->load->view('pageTemplate', array(
      'title' => 'Admin Menu',
      'content' => $this->load->view('admin/menu', null, true)));
  }
}


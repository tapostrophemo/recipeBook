<?php

class Friends extends Controller
{
  // TODO: disallow non-owner to call this method

  function index() {
    // TODO: lookup this user's friends
    $data = array('friends' => array(), 'hasMore' => false, 'max' => 10);
    $this->load->view('pageTemplate', array(
      'title' => 'Manage Your Cookbook',
      'content' => $this->load->view('friends/view', $data, true)));
  }

  function add() {
    if (!$this->form_validation->run('friend')) {
      if ($this->input->is_ajax()) {
        $this->load->view('friends/add');
      }
      else {
        $this->load->view('pageTemplate', array(
          'title' => 'New Friend',
          'content' => $this->load->view('friends/add', null, true)));
      }
    }
    else {
      echo 'An invitation was sent to ' . $this->input->post('email');
    }
  }
}


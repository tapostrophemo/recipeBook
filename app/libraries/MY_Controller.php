<?php

class MY_Controller extends Controller
{
  function __construct() {
    Controller::__construct();

    $this->load->helper('cookie');
    $data = array('name' => 'mkt', 'expire' => 90 * 24 * 60 * 60); // expire in 90 days
    if (!$cookie = get_cookie('mkt', true)) {
      $this->load->model('Marketing');
      $row = $this->Marketing->newVisitor();
      $data['value'] = $row->cookie_id;
    }
    else {
      $data['value'] = $cookie;
    }
    set_cookie($data);
  }

  function _username_available($junk) {
    $this->load->model('User');
    if ($this->User->getByUsername($this->input->post('username'))) {
      $this->form_validation->set_message('_username_available', 'That username is already taken');
      return false;
    }
    return true;
  }

  function _email_unused($junk) {
    $sql = "
      SELECT Count(*) AS c
      FROM users
      WHERE email = ?";
    $c = $this->db->query($sql, $this->input->post('email'))->row()->c;
    if (0 != $c) {
      $this->form_validation->set_message('_email_unused', 'That email address is already in use.');
      return false;
    }
    return true;
  }
}


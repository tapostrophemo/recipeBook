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
}


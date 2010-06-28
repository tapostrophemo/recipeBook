<?php

class MY_Controller extends Controller
{
  function __construct() {
    Controller::__construct();

    $this->load->helper('cookie');
    $data = array('name' => 'mkt', 'expire' => 90 * 24 * 60 * 60); // expire in 90 days
    if (!$cookie = get_cookie('mkt', true)) {
      $this->load->model('Marketing');
      $row = $this->Marketing->newVisitor($this->input->server('HTTP_REFERER'), current_url());
      $data['value'] = $row->cookie_id;
    }
    else {
      $data['value'] = $cookie;
    }
    set_cookie($data);
  }
}


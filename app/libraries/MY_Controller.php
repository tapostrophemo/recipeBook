<?php

class MY_Controller extends Controller
{
  function __construct() {
    Controller::__construct();

    $this->load->helper('cookie');
    if (!$cookie = get_cookie('mkt', true)) {
      $this->load->model('Marketing');
      $row = $this->Marketing->newVisitor($this->input->server('HTTP_REFERER'), current_url());
      $data = array(
        'name' => 'mkt',
        'value' => $row->cookie_id,
        'expire' => 90 * 24 * 60 * 60); // now (from CI) + 90 days
      set_cookie($data);
    }
    else {
      // TODO: update cookie expiration time, info in DB
    }
  }
}


<?php

class MY_Input extends CI_Input
{
  // thanks, alexsancho! http://codeigniter.com/forums/viewreply/292979/
  function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
  }
}


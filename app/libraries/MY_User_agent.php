<?php

class MY_User_agent extends CI_User_agent
{
  function is_local_mechanize() {
    return $this->agent_string() == 'WWW-Mechanize/1.0.0 (http://rubyforge.org/projects/mechanize/)';
  }
}


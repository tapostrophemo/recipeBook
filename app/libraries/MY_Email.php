<?php

class MY_Email extends CI_Email
{
  var $test_mode = false;

  function send($testRetval = true) {
    if ($this->test_mode) {
      return $testRetval;
    }

    return parent::send();
  }
}


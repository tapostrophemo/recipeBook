<?php

class MY_Form_validation extends CI_Form_validation
{
  function __construct($rules = array()) {
    CI_Form_validation::__construct($rules);
    $this->set_error_delimiters('<div class="err">', '</div>');
  }
}


<?php

class MY_Session extends CI_Session
{
  function unset_flashdata($key) {
    $this->unset_userdata($this->flashdata_key.':new:'.$key);
    $this->unset_userdata($this->flashdata_key.':old:'.$key);
  }
}


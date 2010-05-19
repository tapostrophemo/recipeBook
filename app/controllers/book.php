<?php

class Book extends Controller
{
  function index() {
    $this->load->view('pageTemplate', array(
      'title' => 'Table of Contents',
      'content' => $this->load->view('toc', null, true)));
  }	
}


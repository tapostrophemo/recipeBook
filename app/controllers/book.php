<?php

class Book extends Controller
{
  function index() {
    $this->load->view('pageTemplate', array('content' => 'TODO: add content<br/>' . anchor('recipe/1', 'Eggplant Parmesan')));
  }	
}


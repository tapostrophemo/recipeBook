<?php

class Book extends Controller
{
  function index() {
    $this->load->model('Recipe');
    $recipes = $this->Recipe->getAllNames();

    $this->load->view('pageTemplate', array(
      'title' => 'Table of Contents',
      'content' => $this->load->view('toc', array('recipes' => $recipes), true)));
  }	
}


<?php

class Recipes extends Controller
{
  function __construct() {
    Controller::__construct();
    $this->load->model('Recipe');
  }

  function view($id) {
    $recipe = $this->Recipe->getById($id);
    if ($recipe) {
      $this->load->view('recipes/view', array('recipe' => $recipe));
    }
    else {
      $this->load->view('pageTemplate', array(
        'title' => 'Table of Contents',
        'content' => '<div class="msg">That recipe was not found.</div>' . $this->load->view('toc', null, true)));
    }
  }

  function edit($id) {
    $recipe = $this->Recipe->getById($id);
    $this->load->view('recipes/edit', array('recipe' => $recipe));
  }
}


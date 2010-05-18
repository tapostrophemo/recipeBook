<?php

class Recipes extends Controller
{
  function index() {
    $this->load->model('Recipe');
    $recipe = $this->Recipe->getById(1);
    $this->load->view('pageTemplate', array('recipe' => $recipe));
  }
}


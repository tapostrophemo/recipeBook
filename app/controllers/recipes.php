<?php

class Recipes extends Controller
{
  function recipe($id) {
    $this->load->model('Recipe');
    $recipe = $this->Recipe->getById($id);
    if ($recipe) {
      $this->load->view('recipe', array('recipe' => $recipe));
    }
    else {
      $this->load->view('pageTemplate', array(
        'title' => 'Table of Contents',
        'content' => '<div class="msg">That recipe was not found.</div>' . $this->load->view('toc', null, true)));
    }
  }
}


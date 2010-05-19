<?php

class Recipes extends Controller
{
  function recipe($id) {
    $this->load->model('Recipe');
    $recipe = $this->Recipe->getById($id);
    $this->load->view('recipe', array('recipe' => $recipe));
  }
}


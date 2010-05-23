<?php

class Recipes extends Controller
{
  function __construct() {
    Controller::__construct();
    $this->load->model('Recipe');
  }

  function add() {
    if (!$this->form_validation->run('recipe')) {
      if ($this->input->is_ajax()) {
        $this->load->view('recipes/add');
      }
      else {
        $this->load->view('pageTemplate', array(
          'title' => 'New Recipe',
          'content' => $this->load->view('recipes/add', null, true)));
      }
    }
    else {
      $recipeId = $this->Recipe->create( // TODO: check $recipeId; react if null/0
        $this->input->post('name'),
        $this->input->post('category'),
        $this->input->post('ingredients'),
        $this->input->post('instructions'));
      $this->session->set_flashdata('msg', 'Recipe created');
      redirect("recipe/$recipeId");
    }
  }

  function view($id) {
    $recipe = $this->Recipe->getById($id);
    if ($recipe) {
      $this->load->view('recipes/view', array('recipe' => $recipe));
    }
    else {
      $this->session->set_flashdata('msg', 'That recipe was not found.');
      redirect('/');
    }
  }

  // TODO: verify a recipe w/given id exists for edit, delete functions

  function edit($id) {
    if (!$this->form_validation->run('recipe')) {
      $recipe = $this->Recipe->getById($id);
      if ($this->input->is_ajax()) {
        $this->load->view('recipes/edit', array('recipe' => $recipe));
      }
      else {
        $this->load->view('pageTemplate', array(
          'title' => 'Edit "' . $recipe->name . '"',
          'content' => $this->load->view('recipes/edit', array('recipe' => $recipe), true)));
      }
    }
    else {
      $this->Recipe->update($id,
        $this->input->post('name'),
        $this->input->post('category'),
        $this->input->post('ingredients'),
        $this->input->post('instructions'));
      $this->session->set_flashdata('msg', 'Recipe updated');
      redirect("recipe/$id");
    }
  }

  function delete($id) {
    $this->Recipe->delete($id);
    $this->session->set_flashdata('msg', 'Recipe deleted');
    redirect('/');
  }
}


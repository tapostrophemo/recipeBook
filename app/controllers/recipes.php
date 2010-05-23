<?php

class Recipes extends Controller
{
  function __construct() {
    Controller::__construct();
    $this->load->model('Recipe');
    $this->load->library('user_agent');
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
      $this->load->library('upload');
      $uploaded = $this->upload->do_upload('photo');
      if (!$uploaded && !$this->upload->display_errors() == $this->lang->line('upload_no_file_selected')) {
        $this->session->set_flashdata('msg', $this->upload->display_errors());
        redirect ('/');
      }

      $uploadData = $this->upload->data();
      if ($uploaded && $uploadData['file_name']) {
        $uploadData['file_name'] = 'uploads/'.$uploadData['file_name'];
      }

      $recipeId = $this->Recipe->create( // TODO: check $recipeId; react if null/0
        $this->input->post('name'),
        $this->input->post('category'),
        $uploadData['file_name'],
        $this->input->post('ingredients'),
        $this->input->post('instructions'));
      $this->session->set_flashdata('msg', 'Recipe created');
      redirect("recipe/$recipeId");
    }
  }

  function view($id) {
    $recipe = $this->_findRecipeValidateExists($id);
    $this->load->view('recipes/view', array('recipe' => $recipe));
  }

  function edit($id) {
    $recipe = $this->_findRecipeValidateExists($id);
    if (!$this->form_validation->run('recipe')) {
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
    $recipe = $this->_findRecipeValidateExists($id);
    $this->Recipe->delete($id);

    if (isset($recipe->photo)) {
      @unlink($recipe->photo);
    }

    $this->session->set_flashdata('msg', "Recipe for '$recipe->name' deleted");
    redirect('/');
  }

  function _findRecipeValidateExists($id) {
    $recipe = $this->Recipe->getById($id);
    if (!$recipe) {
      $this->session->set_flashdata('msg', 'That recipe was not found.');
      redirect('/');
    }
    return $recipe;
  }
}


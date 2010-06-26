<?php

class Recipes extends Controller
{
  function __construct() {
    Controller::__construct();
    $this->load->model('Recipe');
    $this->load->library('user_agent');

    $segment = $this->uri->segment(1);
    if (in_array($segment, array('add', 'edit', 'delete')) && !$this->session->userdata('logged_in')) {
      $this->session->set_flashdata('msg', "You must be logged in to $segment recipes");
      redirect('/login');
    }
    if (in_array($segment, array('add', 'edit')) && $this->session->userdata('is_suspended')) {
      $this->session->set_flashdata('err', 'Your account is suspended; you may only view recipes.');
      redirect('/toc');
    }
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
      $noFile = $this->upload->display_errors() == '<p>'.$this->lang->line('upload_no_file_selected').'</p>';
      if (!$uploaded && !$noFile) {
        $this->session->set_flashdata('msg', $this->upload->display_errors());
        redirect ('/');
      }

      if ($uploaded) {
        $uploadData = $this->upload->data();
        $uploadData['file_name'] = 'uploads/'.$uploadData['file_name'];
      }
      else {
        $uploadData['file_name'] = null;
      }

      $recipeId = $this->Recipe->create( // TODO: check $recipeId; react if null/0
        $this->session->userdata('current_book_id'),
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
    $this->load->view('pageTemplate', array(
      'title' => $recipe->name,
      'photo' => $recipe->photo,
      'content' => $this->load->view('recipes/view', array('recipe' => $recipe), true)));
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
    if (!$this->session->userdata('is_owner')) {
      $this->session->set_flashdata('err', 'Only cookbook owners are allowed to delete recipes');
      redirect('/toc');
    }

    $recipe = $this->_findRecipeValidateExists($id);
    $this->Recipe->delete($id);

    if (isset($recipe->photo)) {
      @unlink($recipe->photo);
    }

    $this->session->set_flashdata('msg', "Recipe for '$recipe->name' deleted");
    redirect('/toc');
  }

  function _findRecipeValidateExists($id) {
    $recipe = $this->Recipe->getById($id);
    if (!$recipe) {
      $this->session->set_flashdata('msg', 'That recipe was not found.');
      redirect('/toc');
    }
    return $recipe;
  }
}


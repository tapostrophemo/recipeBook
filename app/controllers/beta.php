<?php

class Beta extends Controller
{
  function index() {
    $this->session->set_userdata('in_beta', true);
    $this->load->view('pageTemplate', array(
      'title' => 'Your Online Cookbook',
      'content' => $this->load->view('callToAction', null, true)));
  }

  function random() {
    $this->load->model('Recipe');
    $id = $this->Recipe->getRandomId();
    $this->session->set_flashdata('msg', "This is only one of our users' recipes. Want to create your own cookbook? ".anchor('', 'Sign up today!'));
    redirect("recipe/$id");
  }

  function features() {
    $this->load->view('pageTemplate', array(
      'title' => 'More Information',
      'content' => $this->load->view('featuresPricing', null, true)));
  }
}


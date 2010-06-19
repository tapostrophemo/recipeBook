<?php

class Beta extends Controller
{
  function __construct() {
    parent::__construct();
    log_message('debug', 'Beta class initialized');

    if ($this->session->userdata('logged_in')) {
      redirect('/book');
    }
  }

  function index() {
    $this->session->set_userdata('in_beta', true);
    $this->load->view('pageTemplate', array(
      'title' => 'Your Online Cookbook',
      'content' => $this->load->view('site/callToAction', null, true)));
  }

  function random() {
    $this->load->model('Recipe');
    $id = $this->Recipe->getRandomId();
    $this->session->set_flashdata('msg', "This is only one of our users' recipes. Want to create your own cookbook? ".anchor('signup', 'Sign up today!'));
    redirect("recipe/$id");
  }

  function features() {
    $this->load->view('pageTemplate', array(
      'title' => 'More Information',
      'content' => $this->load->view('site/featuresPricing', null, true)));
  }

  function signup() {
    $this->load->view('pageTemplate', array(
      'title' => 'Create Your Cookbook',
      'content' => $this->load->view('site/signup', null, true)));
  }
}


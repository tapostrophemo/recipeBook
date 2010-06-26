<?php

class Friends extends Controller
{
  function __construct() {
    Controller::__construct();

    if (!$this->session->userdata('is_owner')) {
      $this->session->set_flashdata('err', 'Only cookbook owners are allowed to view that screen');
      redirect('/toc');
    }
  }

  function index() {
    $this->load->model('Cookbook');
    $friends = $this->Cookbook->getEditors($this->session->userdata('current_book_id'));
    $data = array('friends' => $friends, 'hasMore' => false, 'max' => 10);
    $this->load->view('pageTemplate', array(
      'title' => 'Manage Your Cookbook',
      'content' => $this->load->view('friends/view', $data, true)));
  }

  function add() {
    if (!$this->form_validation->run('friend')) {
      if ($this->input->is_ajax()) {
        $this->load->view('friends/add');
      }
      else {
        $this->load->view('pageTemplate', array(
          'title' => 'New Friend',
          'content' => $this->load->view('friends/add', null, true)));
      }
    }
    else {
      $this->load->model('User');
      $guestData = $this->User->createGuest($this->input->post('username'), $this->input->post('email'));
      $this->load->model('Cookbook');
      $this->Cookbook->addEditorToBook($this->session->userdata('current_book_id'), $guestData['id']);
      echo 'An invitation was sent to ' . $this->input->post('email');
    }
  }

  function suspend($friendId) {
    $this->load->model('Cookbook');
    if (!$this->Cookbook->isEditorOrOwnerOf($this->session->userdata('current_book_id'), $friendId)) {
      $this->session->set_flashdata('msg', 'You may not suspend friends that are not yours');
      redirect('/toc');
    }

    $this->load->model('User');
    $user = $this->User->getById($friendId);
    $this->Cookbook->suspendEditor($this->session->userdata('current_book_id'), $friendId);
    $this->session->set_flashdata('msg', "'".$user->username."' suspended");
    redirect('/manage');
  }

  function reactivate($friendId) {
    $this->load->model('Cookbook');
    if (!$this->Cookbook->isEditorOrOwnerOf($this->session->userdata('current_book_id'), $friendId)) {
      $this->session->set_flashdata('msg', 'You may not re-activate friends that are not yours');
      redirect('/toc');
    }

    $this->load->model('User');
    $user = $this->User->getById($friendId);
    $this->Cookbook->reactivateEditor($this->session->userdata('current_book_id'), $friendId);
    $this->session->set_flashdata('msg', "'".$user->username."' re-activated");
    redirect('/manage');
  }
}


<?php

$config = array(
  'login' => array(
    array('field' => 'username', 'label' => 'Username', 'rules' => 'trim'),
    array('field' => 'password', 'label' => 'Password', 'rules' => 'callback__validate_login')
  ),

  'recipe' => array(
    array('field' => 'name', 'label' => 'recipe name', 'rules' => 'trim|required|max_length[255]|xss_clean'),
    array('field' => 'category', 'label' => 'category', 'rules' => 'trim|required|integer'),
    array('field' => 'ingredients', 'label' => 'ingredients', 'rules' => 'trim|xss_clean'),
    array('field' => 'instructions', 'label' => 'instructions', 'rules' => 'trim|xss_clean')
  ),

  'signup' => array(
    array('field' => 'username', 'label' => 'username', 'rules' => 'trim|required|max_length[255]|callback__username_available|xss_clean'),
    array('field' => 'email', 'label' => 'email', 'rules' => 'trim|required|valid_email'),
    array('field' => 'password', 'label' => 'password', 'rules' => 'required'),
    array('field' => 'plan', 'label' => 'plan', 'rules' => 'required')
  )
);


<?php

$config = array(
  'recipe' => array(
    array('field' => 'name', 'label' => 'recipe name', 'rules' => 'trim|required|max_length[255]|xss_clean'),
    array('field' => 'category', 'label' => 'category', 'rules' => 'trim|required|integer'),
    array('field' => 'ingredients', 'label' => 'ingredients', 'rules' => 'trim|xss_clean'),
    array('field' => 'instructions', 'label' => 'instructions', 'rules' => 'trim|xss_clean')
  )
);


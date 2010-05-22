<?php

$config = array(
  'recipe_add' => array(
    array('field' => 'name', 'label' => 'recipe name', 'rules' => 'trim|required|max_length[255]|xss_clean'),
    array('field' => 'category', 'label' => 'category', 'rules' => 'trim|integer'),
    array('field' => 'ingredients', 'label' => 'ingredients', 'rules' => 'trim|xss_clean'),
    array('field' => 'instructions', 'label' => 'instructions', 'rules' => 'trim|xss_clean')
  )
);


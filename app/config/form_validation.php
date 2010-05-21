<?php

$config = array(
  'recipe_add' => array(
    array('field' => 'name', 'label' => 'recipe name', 'rules' => 'trim|required|max_length[255]|xss_clean')
  )
);


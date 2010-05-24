<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = 'book';
$route['scaffolding_trigger'] = '';

$route['login'] = 'book/login';
$route['logout'] = 'book/logout';

$route['recipe/(:num)'] = 'recipes/view/$1';
$route['add'] = 'recipes/add';
$route['edit/(:num)'] = 'recipes/edit/$1';
$route['delete/(:num)'] = 'recipes/delete/$1';


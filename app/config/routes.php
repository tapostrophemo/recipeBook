<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = 'beta';
$route['scaffolding_trigger'] = '';

$route['random'] = 'beta/random';
$route['features'] = 'beta/features';
$route['signup'] = 'beta/signup';
$route['signup1'] = 'beta/checkUserAvailability';
$route['signup2'] = 'beta/createAccount';

$route['login'] = 'book/login';
$route['logout'] = 'book/logout';

$route['recipe/(:num)'] = 'recipes/view/$1';
$route['add'] = 'recipes/add';
$route['edit/(:num)'] = 'recipes/edit/$1';
$route['delete/(:num)'] = 'recipes/delete/$1';


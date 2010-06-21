<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = 'site';
$route['scaffolding_trigger'] = '';

$route['random'] = 'site/random';
$route['features'] = 'site/features';
$route['signup'] = 'site/signup';
$route['signup1'] = 'site/checkUserAvailability';
$route['signup2'] = 'site/createAccount';

$route['login'] = 'site/login';
$route['logout'] = 'site/logout';

$route['toc'] = 'site/toc';

$route['recipe/(:num)'] = 'recipes/view/$1';
$route['add'] = 'recipes/add';
$route['edit/(:num)'] = 'recipes/edit/$1';
$route['delete/(:num)'] = 'recipes/delete/$1';


<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['posts/create_db']='posts/create_db';
$route['posts/exos_noncomplet'] = '/posts/exos_noncomplet'; 
$route['posts/statistics'] = 'posts/statistics';  
$route['posts/mes_resolu'] = 'posts/mes_resolu';        
$route['posts/resoudre'] = 'posts/resoudre';      
$route['posts/creer_exo'] = 'posts/creer_exo';
$route['posts/index'] = 'posts/index';
$route['posts/nbrligne'] = 'posts/nbrligne';
$route['posts/stitle'] = 'posts/stitle';
$route['posts/create'] = 'posts/create';
$route['posts/(:any)']='posts/view/$1';
$route['posts']='posts/index';
$route['exos/(:any)']='posts/exoindex/$1';
$route['default_controller'] = 'posts';
$route['(:any)']='pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

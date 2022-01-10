<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Paginas';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['empresa'] = 'Paginas/empresa';
$route['servicos'] = 'Paginas/servicos';

$route['faleconosco'] = 'Paginas/faleconosco';
$route['trabalheconosco'] = 'Paginas/trabalheconosco';

//para gerar o página post (que será alimentada pelo banco de dados)
$route['post'] = 'Paginas';     // Requer parámetros 9caso não tenha, carrega a home)
$route['post/(:num)'] = 'Paginas/post/$1';  // carrega a página com parâmetros

//carrega a página de login do sistema
$route['login'] = 'Setup/login';
$route['painel'] = 'Setup/login';
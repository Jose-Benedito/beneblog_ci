<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Paginas';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['empresa'] = 'Paginas/empresa';

$route['video'] = 'Video';     // Requer parámetros 9caso não tenha, carrega a home)
$route['video/(:num)'] = 'Paginas/videoaula/$1'; 
$route['videos'] = 'Video/video';

$route['cadastro_users'] = 'Paginas/cadastro_users';
$route['cadastro_livros'] = 'Paginas/cadastro_livros';

//para gerar o página post (que será alimentada pelo banco de dados)
$route['post'] = 'Post';     // Requer parámetros 9caso não tenha, carrega a home)
$route['post/(:num)'] = 'Paginas/postagem/$1';  // carrega a página com parâmetros

//carrega a página de login do sistema
$route['login'] = 'Setup/login';
$route['painel'] = 'Setup/login';
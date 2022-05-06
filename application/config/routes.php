<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Paginas';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['/'] = 'Paginas';
$route['/'] = 'Pdf';
$route['pdfs'] = 'Pdf/pdfs';

$route['listar'] = 'User/listar';     // Requer parámetros 9caso não tenha, carrega a home)

$route['listar/(:num)'] = 'Livro/listar/$1'; 

$route['pesquisar'] = 'Livro/pesquisar';
$route['pesquisar/(:num)'] = 'Livro/pesquisar/$1';
$route['user'] = 'User/emprestar_Livro'; 
$route['user/'] = 'User/emprestar_Livro/'; 
$route['livro'] = 'Livro';

$route['listar/(:num)'] = 'User/listar/$1';     // Requer parámetros 9caso não tenha, carrega a home)
$route['busca_user'] = 'User/buscar_user';
$route['user/(:num)'] = 'User/editar/$1'; 
$route['user/(:num)'] = 'User/editar_retirada/$1'; 
$router['visitantes'] = 'Visitantes';
$router['editar'] = "Visitantes/editar";
$router['visitantes/(:num)'] = 'Visitantes/$1';
$route['livro'] = 'Livro';

$route['user'] = 'User';  
$route['cadastrar_user'] = 'User/cadastrar_users';
$route['cadastro_livros'] = 'Livro/cadastro_livros';

//para gerar o página post (que será alimentada pelo banco de dados)
$route['controle_livros'] = 'Controle_livros';     // Requer parámetros 9caso não tenha, carrega a home)
$route['controle_livros/(:num)'] = 'Paginas/postagem/$1';  // carrega a página com parâmetros

//carrega a página de login do sistema
$route['login'] = 'Setup/login';
$route['painel'] = 'Setup/login';
$route['admin'] = 'Paginas/admin';
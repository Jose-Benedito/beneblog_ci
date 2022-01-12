<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller{

    function __construct(){
        parent::__construct();
        //imports
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('options_model', 'option');
        $this->load->model('post_model', 'post');
    }

    public function index(){
        redirect('post/listar', 'refresh');
    }
    public function listar(){
        //verifica se o usuário está logado
        verifica_login();

        //carrega a view
        $dados['titulo'] = 'BNTH - Listagem de posts';
        $dados['h2'] = 'Listagem de posts';
        $dados['tela'] = 'litar'; //para carregar qual o tipo da view
        $this->load->view('painel/posts', $dados);
    }
}
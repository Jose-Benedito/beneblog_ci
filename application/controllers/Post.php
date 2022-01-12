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
        $dados['tela'] = 'listar'; //para carregar qual o tipo da view
        $this->load->view('painel/posts', $dados);
    }
    public function cadastrar(){
        //verifica se o usuário está logado
        verifica_login();

        //regras de validação
        $this->form_validation->set_rules('titulo', 'Título', 'trim|required');
        $this->form_validation->set_rules('conteudo', 'Conteúdo', 'trim|required');
        //verifica a validação
        if($this->form_validation->run() == FALSE):
            if(validation_errors()):
                set_msg(validation_errors());
            endif;
        else:
            $this->load->library('upload', config_upload());
            if($this->upload->do_upload('imagem')):
                //upload foi efetuado
                $dados_upload = $this->upload->data();
                $dados_form = $this->input->post();
               //dedug var_dump($dados_upload);
            else:
                //erro no upload
                $msg = $this->upload->display_errors();
                $msg .= '<p>São permitidas arquivos JPG e PNG de até 512KB.</p>';
                set_msg($msg);
            endif;
        endif;



        //carrega a view
        $dados['titulo'] = 'BNTH - Cadastro de posts';
        $dados['h2'] = 'Cadastro de posts';
        $dados['tela'] = 'cadastrar'; //para carregar qual o tipo da view
        $this->load->view('painel/posts', $dados);
    }
}
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
        $dados['posts'] = $this->post->get();
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

                var_dump($dados_upload);
               $dados_insert['titulo'] = to_bd($dados_form['titulo']);
               $dados_insert['conteudo'] = to_bd($dados_form['conteudo']);
               $dados_insert['imagem'] = $dados_upload['file_name'];
               //salvar no banco de dados
               if($id = $this->post->salvar($dados_insert)):
                    set_msg('<p>Post cadastrado com sucesso!</p>');
                    redirect('post/listar', 'refresh');
               else:
                    set_msg('<p> Erro! Post não foi cadastrado.</p>');
               endif;

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
    public function excluir(){
        //verfica se o usuário está logado
        verifica_login();

        //verifica se foi passado o id do post
        $id = $this->uri->segment(3);
        if($id > 0):
            //id informado, continuar com a exclusão
            if($postagem = $this->post->get_single($id)):
                $dados['posts'] = $postagem;
            else:
                set_msg('<p>Post inexistente! Escolha um post para excluir</p>');
                redirect('post/listar', 'refresh');
            endif;
        else:
            set_msg('<p>Você deve escolher um post para excluir</P>');
            redirect('post/listar', 'refresh');
        endif;

        //regras de validação
        $this->form_validation->set_rules('enviar', 'ENVIAR', 'trim|required');

        //verifica a validação
        if($this->form_validation->run() == FALSE):
            if(validation_errors()):
                set_msg(validation_errors());
            endif;
        else:
            $imagem = 'uploads/'.$postagem->imagem; // concactenado com a imagem vinda do banco de dados
            if($this->post->excluir($id)):
                unlink($imagem); // deletar a imagem na pasta
                set_msg('<p>Post excluído com sucesso!</p>');
                redirect('post/listar', 'refresh');
            else:
                set_msg('<p>Erro! Post não excluído!</p>');
            endif;
        endif;


        //carrega a view

        $dados['titulo'] = 'BNTH - Exclusão de posts';
        $dados['h2'] = 'Exclusão de posts';
        $dados['tela'] = 'excluir'; //para carregar qual o tipo da view
        $this->load->view('painel/posts', $dados);

    }
}
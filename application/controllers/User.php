<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

    function __construct(){
        parent::__construct();
        //imports
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('options_model', 'option');
        $this->load->model('Usuario_model', 'user');
    }

    public function index(){
        redirect('livro/listar', 'refresh');
    }
    public function listar(){
        //verifica se o usuário está logado
        verifica_login();

        //carrega a view
        $dados['titulo'] = 'BNTH - Listagem de livros';
        $dados['h2'] = 'Listagem e edição de usuários cadastrados';

        $dados['tela'] = 'listar'; //para carregar qual o tipo da view
        $dados['users'] = $this->user->get();
        $this->load->view('painel/users', $dados);
    }
    public function pesquisar(){
        //verifica se o usuário está logado
        verifica_login();

        //carrega a view
        $dados['titulo'] = 'BNTH - Listagem de livros';
        
        $dados['h2'] = 'Buscar livro';
        $dados['tela'] = 'pesquisar'; //para carregar qual o tipo da view
        $dados['usuarios'] = $this->user->busca();
        $this->load->view('painel/livros', $dados);
    }
    public function cadastrar(){
        //verifica se o usuário está logado
        verifica_login();

        //regras de validação
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        $this->form_validation->set_rules('ra', 'RA', 'trim|required');
        $this->form_validation->set_rules('turma', 'Turma', 'trim|required');
        $this->form_validation->set_rules('telefone', 'Telefone', 'trim|required');
        
     
        //verifica a validação
        if($this->form_validation->run() == FALSE):
            if(validation_errors()):
                set_msg(validation_errors());
            endif;
        else:
            
                $dados_form = $this->input->post();

              //  var_dump($dados_upload);
               $dados_insert['user_nome'] = to_bd($dados_form['nome']);
               $dados_insert['user_ra'] = to_bd($dados_form['ra']);
               $dados_insert['user_turma'] = to_bd($dados_form['turma']);
               $dados_insert['user_telefone'] = to_bd($dados_form['telefone']);
        

               
               //salvar no banco de dados
               if($id = $this->user->salvar($dados_insert)):
                    set_msg('<p>Dados cadastrado com sucesso!</p>');
                    redirect('User/cadastrar/'.$id, 'refresh');
               else:
                    set_msg('<p> Erro! Livro não foi cadastrado.</p>');
               endif;

            
      
        endif;



        //carrega a view

        $dados['titulo'] = 'BNTH - Cadastro de Usuarios';
        $dados['h2'] = 'Cadastro de usuários';
        $dados['tela'] = 'cadastrar'; //para carregar qual o tipo da view
        $this->load->view('painel/users', $dados);
    
    }
    public function excluir(){
        //verfica se o usuário está logado
        verifica_login();

        //verifica se foi passado o id do post
        $id = $this->uri->segment(3);
        if($id > 0):
            //id informado, continuar com a exclusão
            if($postagem = $this->user->get_single($id)): // método do model
                $dados['users'] = $postagem;
            else:
                set_msg('<p>usuário inexistente! Escolha um  para excluir</p>');
                redirect('user/listar', 'refresh');
            endif;
        else:
            set_msg('<p>Você deve escolher um usuário para excluir</P>');
            redirect('user/listar', 'refresh');
        endif;

        //regras de validação
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');

        //verifica a validação
        if($this->form_validation->run() == FALSE):
            if(validation_errors()):
                set_msg(validation_errors());
            endif;
        else:
           
            if($this->user->excluir($id)): //excluido no bd
               
                set_msg('<p>Dados excluídos com sucesso!</p>');
                redirect('user/listar', 'refresh');
            else:
                set_msg('<p>Erro! Dados não excluídos!</p>');
            endif;
        endif;


        //carrega a view

        $dados['titulo'] = 'BNTH - Exclusão de vídeos';
        $dados['h2'] = 'Exclusão de vídeos';
        $dados['tela'] = 'excluir'; //para carregar qual o tipo da view
        $this->load->view('painel/users', $dados);

    }
    public function editar(){
        //verfica se o usuário está logado
        verifica_login();

        //verifica se foi passado o id do post
        $id = $this->uri->segment(3);
        if($id > 0):
            //id informado, continuar com a edição
            if($postagem = $this->user->get_single($id)): // método da model
                $dados['users'] = $postagem;
                $dados_update['id'] = $postagem->id;
            else:
                set_msg('<p>Vídeo inexistente! Escolha um vídeo para editar.</p>');
                redirect('livro/listar', 'refresh');
            endif;
        else:
            set_msg('<p>Você deve escolher um post para editar!</P>');
            redirect('livro/listar', 'refresh');
        endif;

        //regras de validação
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        $this->form_validation->set_rules('ra', 'RA', 'trim|required');
        $this->form_validation->set_rules('turma', 'Turma', 'trim|required');
        $this->form_validation->set_rules('telefone', 'Telefone', 'trim|required');

        //verifica a validação
        if($this->form_validation->run() == FALSE):
            if(validation_errors()):
                set_msg(validation_errors());
            endif;
        else:
            
                    $dados_form = $this->input->post();
                    $dados_insert['user_nome'] = to_bd($dados_form['nome']);
                    $dados_insert['user_ra'] = to_bd($dados_form['ra']);
                    $dados_insert['user_turma'] = to_bd($dados_form['turma']);
                    $dados_insert['user_telefone'] = to_bd($dados_form['telefone']);
                    

                    $this->user->salvar($dados_update); //atualiza no bd

        endif;


        //carrega a view

        $dados['titulo'] = 'BNTH - edição de dados de usuario';
        $dados['h2'] = 'edição de dados de usuario';
        $dados['tela'] = 'editar'; //para carregar qual o tipo da view
        $this->load->view('painel/users', $dados);

    }
    
}
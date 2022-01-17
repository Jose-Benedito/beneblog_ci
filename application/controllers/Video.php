<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller{

    function __construct(){
        parent::__construct();
        //imports
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('options_model', 'option');
        $this->load->model('video_model', 'video');
    }

    public function index(){
        redirect('video/listar', 'refresh');
    }
    public function listar(){
        //verifica se o usuário está logado
        verifica_login();

        //carrega a view
        $dados['titulo'] = 'BNTH - Listagem de vídeos';
        $dados['h2'] = 'Listagem de vídeos';
        $dados['tela'] = 'listar'; //para carregar qual o tipo da view
        $dados['videos'] = $this->video->get();
        $this->load->view('painel/videos', $dados);
    }
    public function cadastrar(){
        //verifica se o usuário está logado
        verifica_login();

        //regras de validação
        $this->form_validation->set_rules('titulo', 'Título', 'trim|required');
        $this->form_validation->set_rules('descricao', 'descricao', 'trim|required');
        $this->form_validation->set_rules('link', 'link', 'trim|required');
        $this->form_validation->set_rules('data', 'data', 'trim|required');
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

              //  var_dump($dados_upload);
               $dados_insert['titulo'] = to_bd($dados_form['titulo']);
               $dados_insert['descricao'] = to_bd($dados_form['descricao']);
               $dados_insert['link'] = to_bd($dados_form['link']);
               $dados_insert['data'] = to_bd($dados_form['data']);

               $dados_insert['imagem'] = $dados_upload['file_name'];
               //salvar no banco de dados
               if($id = $this->video->salvar($dados_insert)):
                    set_msg('<p>Post cadastrado com sucesso!</p>');
                    redirect('video/editar/'.$id, 'refresh');
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

        $dados['titulo'] = 'BNTH - Cadastro de vídeoaulas';
        $dados['h2'] = 'Cadastro de videoaulas';
        $dados['tela'] = 'cadastrar'; //para carregar qual o tipo da view
        $this->load->view('painel/videos', $dados);
    
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
    public function editar(){
        //verfica se o usuário está logado
        verifica_login();

        //verifica se foi passado o id do post
        $id = $this->uri->segment(3);
        if($id > 0):
            //id informado, continuar com a edição
            if($postagem = $this->video->get_single($id)): // método da model
                $dados['videos'] = $postagem;
                $dados_update['id'] = $postagem->id;
            else:
                set_msg('<p>Vídeo inexistente! Escolha um vídeo para editar.</p>');
                redirect('post/listar', 'refresh');
            endif;
        else:
            set_msg('<p>Você deve escolher um post para editar!</P>');
            redirect('video/listar', 'refresh');
        endif;

        //regras de validação
        $this->form_validation->set_rules('titulo', 'Título', 'trim|required');
        $this->form_validation->set_rules('descricao', 'descricao', 'trim|required');
        //$this->form_validation->set_rules('link', 'link', 'trim|required');
        $this->form_validation->set_rules('data', 'data', 'trim|required');

        //verifica a validação
        if($this->form_validation->run() == FALSE):
            if(validation_errors()):
                set_msg(validation_errors());
            endif;
        else:
            //para edição de imagem (alterar)
            $this->load->library('upload', config_upload());
            if(isset($_FILES['imagem']) && $_FILES['imagem']['name'] != ''):
                //foi enviada uma imagem,devo fazer o upload
                if($this->upload->do_upload('imagem')):
                    //upload foi efetuado
                    $imagem_antiga = 'uploads/'.$postagem->imagem;
                    $dados_upload = $this->upload->data();
                    $dados_form = $this->input->post();
                    $dados_update['titulo'] = to_bd($dados_form['titulo']);
                    $dados_update['descricao'] = to_bd($dados_form['descricao']);
                    $dados_update['link'] = to_bd($dados_form['link']);
                    $dados_update['data'] = to_bd($dados_form['data']);
                    $dados_update['imagem'] = $dados_upload['file_name'];

                    if($this->video->salvar($dados_update)): //atualiza no bd
                        unlink($imagem_antiga); //deleta a imagem anterior
                        set_msg('<p>Vídeo alterado com sucesso!</p>');
                        $dados['videos']->imagem = $dados_update['imagem'];
                    else:
                        set_msg('<p>Erro! Nenhuma alteração foi salva.</p>');
                    endif;
                else:
                    //erro no upload
                    $msg = $this->upload->display_errors();
                    $msg .= '<p>São permitidas arquivos JPG e PNG de até 512KB.</p>';
                    set_msg($msg);
                endif;
            else:
                //não foi enviada uma imagem pelo form
                $dados_form = $this->input->post();
                $dados_update['titulo'] = to_bd($dados_form['titulo']);
                $dados_update['descricao'] = to_bd($dados_form['descricao']);
                $dados_update['link'] = to_bd($dados_form['link']);
                $dados_update['data'] = to_bd($dados_form['data']);
                
                if($this->video->salvar($dados_update)):
                    set_msg('<p>Vídeo alterado com sucesso!</p>');
                else:
                    set_msg('<p>Erro! Nenhuma alteração foi salva.</p>');
                endif;
            endif;

        endif;


        //carrega a view

        $dados['titulo'] = 'BNTH - Alteração de vídeos';
        $dados['h2'] = 'Alteração de vídeos';
        $dados['tela'] = 'editar'; //para carregar qual o tipo da view
        $this->load->view('painel/videos', $dados);

    }
}
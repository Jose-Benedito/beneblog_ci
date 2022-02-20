<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf extends CI_Controller{

    function __construct(){
        parent::__construct();
        //imports
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('options_model', 'option');
     //   $this->load->model('Pdf_model', 'post');
    }

    public function index(){
        redirect('painel/pdf', 'refresh');
    }
    public function pdfs(){
        //verifica se o usuário está logado
        verifica_login();

        //carrega a view
        $dados['titulo'] = 'BNTH - controle de livros';
        $dados['h2'] = 'Controle de livros emprestados';
        $dados['tela'] = 'listar'; //para carregar qual o tipo da view
      //  $dados['posts'] = $this->post->get();
        $this->load->view('painel/pdf', $dados);
    }
    public function cadastrar(){
        //verifica se o usuário está logado
        verifica_login();

        //regras de validação
        $this->form_validation->set_rules('titulo', 'Título', 'trim|required');
        $this->form_validation->set_rules('conteudo', 'Conteúdo', 'trim|required');
        $this->form_validation->set_rules('data', 'Data', 'trim|required');
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
               $dados_insert['data'] = to_bd($dados_form['data']);
               //salvar no banco de dados
               if($id = $this->post->salvar($dados_insert)):
                    set_msg('<p>Post cadastrado com sucesso!</p>');
                    redirect('post/editar/'.$id, 'refresh');
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

        $dados['titulo'] = 'BNTH - Retirada de livro';
        $dados['h2'] = 'Nova retirada de livro';
        $dados['tela'] = 'cadastrar'; //para carregar qual o tipo da view
        $this->load->view('painel/controle_livros', $dados);
    
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
                redirect('controle_livros/listar', 'refresh');
            else:
                set_msg('<p>Erro! Post não excluído!</p>');
            endif;
        endif;


        //carrega a view

        $dados['titulo'] = 'BNTH - Exclusão de posts';
        $dados['h2'] = 'Exclusão de posts';
        $dados['tela'] = 'excluir'; //para carregar qual o tipo da view
        $this->load->view('painel/controle_livros', $dados);

    }
    public function editar(){
        //verfica se o usuário está logado
        verifica_login();

        //verifica se foi passado o id do post
        $id = $this->uri->segment(3);
        if($id > 0):
            //id informado, continuar com a edição
            if($postagem = $this->post->get_single($id)):
                $dados['posts'] = $postagem;
                $dados_update['id'] = $postagem->id;
            else:
                set_msg('<p>Post inexistente! Escolha um post para editar.</p>');
                redirect('post/listar', 'refresh');
            endif;
        else:
            set_msg('<p>Você deve escolher um post para editar!</P>');
            redirect('post/listar', 'refresh');
        endif;

        //regras de validação
        $this->form_validation->set_rules('titulo', 'Título', 'trim|required');
        $this->form_validation->set_rules('conteudo', 'Conteúdo', 'trim|required');
        $this->form_validation->set_rules('data', 'Data', 'trim|required');

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
                    $dados_update['conteudo'] = to_bd($dados_form['conteudo']);
                    $dados_update['imagem'] = $dados_upload['file_name'];
                    $dados_update['data'] = to_bd($dados_form['data']);
                    if($this->post->salvar($dados_update)):
                        unlink($imagem_antiga); //deleta a imagem anterior
                        set_msg('<p>Post alterado com sucesso!</p>');
                        $dados['posts']->imagem = $dados_update['imagem'];
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
                $dados_update['conteudo'] = to_bd($dados_form['conteudo']);
                $dados_update['data'] = to_bd($dados_form['data']);
                if($this->post->salvar($dados_update)):
                    set_msg('<p>Post alterado com sucesso!</p>');
                else:
                    set_msg('<p>Erro! Nenhuma alteração foi salva.</p>');
                endif;
            endif;

        endif;


        //carrega a view

        $dados['titulo'] = 'BNTH - Alteração de posts';
        $dados['h2'] = 'Alteração de posts';
        $dados['tela'] = 'editar'; //para carregar qual o tipo da view
        $this->load->view('painel/controle_livros', $dados);

    }
}
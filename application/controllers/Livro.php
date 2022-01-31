<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Livro extends CI_Controller{

    function __construct(){
        parent::__construct();
        //imports
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('options_model', 'option');
        $this->load->model('livros_model', 'livro');
    }

    public function index(){
        redirect('livro/listar', 'refresh');
    }
    public function listar(){
        //verifica se o usuário está logado
        verifica_login();

        //carrega a view
        $dados['titulo'] = 'BNTH - Listagem de livros';
        $dados['h2'] = 'Listagem e edição de livros cadastrados';

        $dados['tela'] = 'listar'; //para carregar qual o tipo da view
        $dados['livros'] = $this->livro->get();
        $this->load->view('painel/livros', $dados);
    }
    public function pesquisar(){
        //verifica se o usuário está logado
        verifica_login();

        //carrega a view
        $dados['titulo'] = 'BNTH - Listagem de livros';
        
        $dados['h2'] = 'Buscar livro';
        $dados['tela'] = 'pesquisar'; //para carregar qual o tipo da view
        $dados['livros'] = $this->livro->busca();
        $this->load->view('painel/livros', $dados);
    }
    public function cadastro_livros(){
        //verifica se o usuário está logado
        verifica_login();

        //regras de validação
        $this->form_validation->set_rules('titulo', 'Título', 'trim|required');
        $this->form_validation->set_rules('autor', 'Autor', 'trim|required');
        $this->form_validation->set_rules('editora', 'Editora', 'trim|required');
        $this->form_validation->set_rules('genero', 'Genero', 'trim|required');
        $this->form_validation->set_rules('descricao', 'descricao', 'trim|required');
        $this->form_validation->set_rules('unidade', 'unidade', 'trim|required');
     
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
               $dados_insert['autor'] = to_bd($dados_form['autor']);
               $dados_insert['editora'] = to_bd($dados_form['editora']);
               $dados_insert['genero'] = to_bd($dados_form['genero']);
               $dados_insert['descricao'] = to_bd($dados_form['descricao']);
               $dados_insert['unidade'] = to_bd($dados_form['unidade']);
            

               $dados_insert['imagem'] = $dados_upload['file_name'];
               //salvar no banco de dados
               if($id = $this->livro->salvar($dados_insert)):
                    set_msg('<p>Livro cadastrado com sucesso!</p>');
                    redirect('livro/editar/'.$id, 'refresh');
               else:
                    set_msg('<p> Erro! Livro não foi cadastrado.</p>');
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
        $this->load->view('/cadastro_livros', $dados);
    
    }
    public function excluir(){
        //verfica se o usuário está logado
        verifica_login();

        //verifica se foi passado o id do post
        $id = $this->uri->segment(3);
        if($id > 0):
            //id informado, continuar com a exclusão
            if($postagem = $this->livro->get_single($id)): // método do model
                $dados['livros'] = $postagem;
            else:
                set_msg('<p>Livro inexistente! Escolha um  para excluir</p>');
                redirect('video/listar', 'refresh');
            endif;
        else:
            set_msg('<p>Você deve escolher um vídeo para excluir</P>');
            redirect('livro/listar', 'refresh');
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
            if($this->livro->excluir($id)): //excluido no bd
                unlink($imagem); // deletar a imagem na pasta
                set_msg('<p>Dados excluídos com sucesso!</p>');
                redirect('livro/listar', 'refresh');
            else:
                set_msg('<p>Erro! Dados não excluídos!</p>');
            endif;
        endif;


        //carrega a view

        $dados['titulo'] = 'BNTH - Exclusão de vídeos';
        $dados['h2'] = 'Exclusão de vídeos';
        $dados['tela'] = 'excluir'; //para carregar qual o tipo da view
        $this->load->view('painel/livros', $dados);

    }
    public function editar(){
        //verfica se o usuário está logado
        verifica_login();

        //verifica se foi passado o id do post
        $id = $this->uri->segment(3);
        if($id > 0):
            //id informado, continuar com a edição
            if($postagem = $this->livro->get_single($id)): // método da model
                $dados['livros'] = $postagem;
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
        $this->form_validation->set_rules('titulo', 'Título', 'trim|required');
        $this->form_validation->set_rules('autor', 'Autor', 'trim|required');
        $this->form_validation->set_rules('editora', 'Editora', 'trim|required');
        $this->form_validation->set_rules('genero', 'Genero', 'trim|required');
        $this->form_validation->set_rules('descricao', 'descricao', 'trim|required');
        $this->form_validation->set_rules('unidade', 'unidade', 'trim|required');
     

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
                    $dados_update['autor'] = to_bd($dados_form['autor']);
                    $dados_update['editora'] = to_bd($dados_form['editora']);
                    $dados_update['genero'] = to_bd($dados_form['genero']);
                    $dados_update['descricao'] = to_bd($dados_form['descricao']);
                    $dados_update['unidade'] = to_bd($dados_form['unidade']);
                    
                    $dados_update['imagem'] = $dados_upload['file_name'];

                    if($this->livro->salvar($dados_update)): //atualiza no bd
                        unlink($imagem_antiga); //deleta a imagem anterior
                        set_msg('<p>Dados alterados com sucesso!</p>');
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
                $dados_update['autor'] = to_bd($dados_form['autor']);
                $dados_update['editora'] = to_bd($dados_form['editora']);
                $dados_update['genero'] = to_bd($dados_form['genero']);
                $dados_update['descricao'] = to_bd($dados_form['descricao']);
                $dados_update['unidade'] = to_bd($dados_form['unidade']);
            
                
                if($this->livro->salvar($dados_update)):
                    set_msg('<p>Dados alterados com sucesso!</p>');
                else:
                    set_msg('<p>Erro! Nenhuma alteração foi salva.</p>');
                endif;
            endif;

        endif;


        //carrega a view

        $dados['titulo'] = 'BNTH - Alteração de vídeos';
        $dados['h2'] = 'Alteração de vídeos';
        $dados['tela'] = 'editar'; //para carregar qual o tipo da view
        $this->load->view('painel/livros', $dados);

    }
    
    public function emprestarLivro(){
        if(($id = $this->uri->segment(2))> 0): //segment(2)= refêre-se a posição da rota chamada pós barra da url  no navegador
            if($descLivro = $this->livro->get_single($id)): //método do model
                $dados['titulo'] =  to_html($descLivro->titulo).' - BNTH';
                $dados['livro_titulo'] = to_html(($descLivro->titulo));
                $dados['livro_autor'] = to_html($descLivro->autor);
                $dados['livro_genero'] = $descLivro->genero;
                $dados['livro_imagem'] = $descLivro->imagem;
            else:
                $dados['titulo'] = 'Página não encontrada - BNTH';
                $dados['livro_titulo'] = 'livro não encontrado';
                $dados['livro_autor'] = '<p>Nenhum livro foi encontrado com base nos parâmetros fornecidos</p>';
                $dados['livro_imagem'] = '';
    
            endif;
        else:
            redirect(base_url(), 'refresh');
    
        endif;
        $this->load->view('emprestar_livro', $dados);
    }
    
    }

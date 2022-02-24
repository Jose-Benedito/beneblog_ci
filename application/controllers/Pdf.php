<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf extends CI_Controller{

    function __construct(){
        parent::__construct();
        //imports
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('options_model', 'option');
       $this->load->model('Pdf_model', 'pdf');
    }

    public function index(){
        redirect('painel/pdf', 'refresh');
    }
    public function pdfs(){
        //verifica se o usuário está logado
        verifica_login();

        //carrega a view
        $dados['titulo'] = 'BNTH - livros em Pdf';
        $dados['h2'] = 'Livros em Pdf';
       $dados['tela'] = 'listar'; //para carregar qual o tipo da view
        $dados['pdfs'] = $this->pdf->get();
        
        $this->load->view('painel/pdf', $dados);
        $this->load->view('/commons/footer');
    }
    public function listagem(){
        //verifica se o usuário está logado
        verifica_login();

        //carrega a view
        $dados['titulo'] = 'BNTH - livros em Pdf';
        $dados['h2'] = 'Livros em Pdf';
       $dados['tela'] = 'listagem'; //para carregar qual o tipo da view
        $dados['pdfs'] = $this->pdf->get();
        
        $this->load->view('painel/pdf', $dados);
        $this->load->view('/commons/footer');
    }
    public function cadastrar(){
        //verifica se o usuário está logado
        verifica_login();

        //regras de validação
        $this->form_validation->set_rules('titulo', 'Título', 'trim|required');
        $this->form_validation->set_rules('autor', 'Autor', 'trim|required');
        $this->form_validation->set_rules('genero', 'Genero', 'trim|required');
        $this->form_validation->set_rules('descricao', 'Descricao', 'trim|required');
        
        //verifica a validação
        if($this->form_validation->run() == FALSE):
            if(validation_errors()):
                set_msg(validation_errors());
            endif;
        else:
            $this->load->library('upload', config_upload_pdf());
            if($this->upload->do_upload('imagem')):
                //upload foi efetuado
                $dados_upload = $this->upload->data();
                $dados_form = $this->input->post();

            //    var_dump($dados_upload);
               $dados_insert['titulo'] = to_bd($dados_form['titulo']);
               $dados_insert['autor'] = to_bd($dados_form['autor']);
               $dados_insert['genero'] = to_bd($dados_form['genero']);
               $dados_insert['imagem'] = $dados_upload['file_name'];
            
               //salvar no banco de dados
               if($id = $this->pdf->salvar($dados_insert)):
                    set_msg('<p>Pdf cadastrado com sucesso!</p>');
                    redirect('pdf/editar/'.$id, 'refresh');
               else:
                    set_msg('<p> Erro! Pdf não foi cadastrado.</p>');
               endif;

            else:
                //erro no upload
                $msg = $this->upload->display_errors();
                $msg .= '<p>São permitidas apenas arquivos em Pdfs de até 4Mb.</p>';
                set_msg($msg);
            endif;
        endif;



        //carrega a view

        $dados['titulo'] = 'BNTH - Cadastro de pdf';
        $dados['h2'] = 'Cadastro de pdf';
        $dados['tela'] = 'cadastrar'; //para carregar qual o tipo da view
        $this->load->view('painel/pdf', $dados);
    
    }
    public function excluir(){
        //verfica se o usuário está logado
        verifica_login();

        //verifica se foi passado o id do post
        $id = $this->uri->segment(3);
        if($id > 0):
            //id informado, continuar com a exclusão
            if($postagem = $this->pdf->get_single($id)):
                $dados['pdfs'] = $postagem;
            else:
                set_msg('<p>Post inexistente! Escolha um post para excluir</p>');
                redirect('pdf/listagem', 'refresh');
            endif;
        else:
            set_msg('<p>Você deve escolher um post para excluir</P>');
            redirect('pdf/listagem', 'refresh');
        endif;

        //regras de validação
        $this->form_validation->set_rules('enviar', 'ENVIAR', 'trim|required');

        //verifica a validação
        if($this->form_validation->run() == FALSE):
            if(validation_errors()):
                set_msg(validation_errors());
            endif;
        else:
            $imagem = 'uploads/pdf'.$postagem->imagem; // concactenado com a imagem vinda do banco de dados
            if($this->pdf->excluir($id)):
                unlink($imagem); // deletar a imagem na pasta
                set_msg('<p>Post excluído com sucesso!</p>');
                redirect('pdf/listagem', 'refresh');
            else:
                set_msg('<p>Erro! Post não excluído!</p>');
            endif;
        endif;


        //carrega a view

        $dados['titulo'] = 'BNTH - Exclusão de pdf';
        $dados['h2'] = 'Excluir de pdf';
        $dados['tela'] = 'excluir'; //para carregar qual o tipo da view
        $this->load->view('painel/pdf', $dados);

    }
    public function editar(){
        //verfica se o usuário está logado
        verifica_login();

        //verifica se foi passado o id do post
        $id = $this->uri->segment(3);
        if($id > 0):
            //id informado, continuar com a edição
            if($postagem = $this->pdf->get_single($id)):
                $dados['pdfs'] = $postagem;
                $dados_update['id'] = $postagem->id;
            else:
                set_msg('<p>Pdf inexistente! Escolha um post para editar.</p>');
                redirect('pdf/listagem', 'refresh');
            endif;
        else:
            set_msg('<p>Você deve escolher um post para editar!</P>');
            redirect('pdf/listagem', 'refresh');
        endif;

        //regras de validação
        $this->form_validation->set_rules('titulo', 'Título', 'trim|required');
        $this->form_validation->set_rules('autor', 'Autor', 'trim|required');
        $this->form_validation->set_rules('genero', 'Genero', 'trim|required');
        $this->form_validation->set_rules('descricao', 'Descricao', 'trim|required');

        //verifica a validação
        if($this->form_validation->run() == FALSE):
            if(validation_errors()):
                set_msg(validation_errors());
            endif;
        else:
            //para edição de imagem (alterar)
            $this->load->library('upload', config_upload_pdf());
            if(isset($_FILES['file']) && $_FILES['file']['name'] != ''):
                //foi enviada uma imagem,devo fazer o upload
                if($this->upload->do_upload('imagem')):
                    //upload foi efetuado
                    $imagem_antiga = 'uploads/'.$postagem->imagem;
                    $dados_upload = $this->upload->data();
                    $dados_form = $this->input->post();
                    $dados_update['titulo'] = to_bd($dados_form['titulo']);
                    $dados_update['autor'] = to_bd($dados_form['autor']);
                    $dados_update['genero'] = to_bd($dados_form['genero']);
                    $dados_update['descricao'] = to_bd($dados_form['descricao']);
                    $dados_update['imagem'] = $dados_upload['file_name'];
                    
                    if($this->pdf->salvar($dados_update)):
                        unlink($imagem_antiga); //deleta a imagem anterior
                        set_msg('<p>Pdf alterado com sucesso!</p>');
                        $dados['pdfs']->imagem = $dados_update['imagem'];
                    else:
                        set_msg('<p>Erro! Nenhuma alteração foi salva.</p>');
                    endif;
                else:
                    //erro no upload
                    $msg = $this->upload->display_errors();
                    $msg .= '<p>São permitidas apenas arquivos em Pdf de até 4Mb.</p>';
                    set_msg($msg);
                endif;
            else:
                //não foi enviada uma imagem pelo form
                $dados_form = $this->input->post();
                $dados_update['titulo'] = to_bd($dados_form['titulo']);
                $dados_update['autor'] = to_bd($dados_form['autor']);
                $dados_update['genero'] = to_bd($dados_form['genero']);
                $dados_update['descricao'] = to_bd($dados_form['descricao']);
                if($this->pdf->salvar($dados_update)):
                    set_msg('<p>Pdf alterado com sucesso!</p>');
                else:
                    set_msg('<p>Erro! Nenhuma alteração do pdf foi salva.</p>');
                endif;
            endif;

        endif;


        //carrega a view

        $dados['titulo'] = 'BNTH - Edição de livros em pdfs';
        $dados['h2'] = 'Edição de livro em pdf';
        $dados['tela'] = 'editar'; //para carregar qual o tipo da view
        $this->load->view('painel/pdf', $dados);

    }
}
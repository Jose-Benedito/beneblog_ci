<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Livro extends CI_Controller{

    function __construct(){
        parent::__construct();
        //imports
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->model('options_model', 'option');
        $this->load->model('livros_model', 'livro');
        $this->load->model('Usuario_model', 'user');
        $this->load->model('Cadastro_model', 'leitor');
    }

    public function index($pages=0){
        redirect('livro/listar', 'refresh');
    }
    public function listar($pages=0){
        //verifica se o usuário está logado
        verifica_login();

    /*   ***** Para a paginação ***** */
      

        //quantidade por pagina
        $limit = 3;

        // pegar o total
        $dados['total'] = count($this->livro->get());

        //livros com paginação
        $dados['livros'] = $this->livro->page_livros($limit, $pages);

     /*   ***** Para a paginação ***** */
       
     //paginação
     $this->load->library('pagination');
     $config['base_url']        =  base_url('index.php/livro/listar');
     $config['total_rows']      =  $dados['total'];
     $config['per_page']        =  $limit;
   /*  $config['full_tag_open']   =  '<div class="">';
     $config['full_tag_close']  =   '</div>';
     $config['first_link']      =  'Inicio';     
     $config['last_link']       =   'Fim';
     $config['next_link']       =   '&gt;';
     $config['prev_link']       =   '&lt;';
    */ 
     $this->pagination->initialize($config);
     

        //carrega a view
        $dados['titulo'] = 'BNTH - Listagem de livros';
        $dados['h2'] = 'Listagem e edição de livros cadastrados';

        $dados['tela'] = 'listar'; //para carregar qual o tipo da view
      //  $dados['livros'] = $this->livro->get();
        $this->load->view('painel/livros', $dados);
    }
    public function pesquisar($pages=0){
        //verifica se o usuário está logado
        verifica_login();
      


     /*   ***** Para a paginação ***** */
      

      /*  /quantidade por pagina
        $limit = 3;

        // pegar o total
        $dados['total'] = count($this->livro->get());

        //livros com paginação
        $dados['livros'] = $this->livro->page_livros($limit, $pages);

     /*   ***** Para a paginação ***** */
       
     /*/paginação
     $this->load->library('pagination');
     $config['base_url']        =  base_url('index.php/livro/pesquisar');
     $config['total_rows']      =  $dados['total'];
     $config['per_page']        =  $limit;
   /*  $config['full_tag_open']   =  '<div class="">';
     $config['full_tag_close']  =   '</div>';
     $config['first_link']      =  'Inicio';     
     $config['last_link']       =   'Fim';
     $config['next_link']       =   '&gt;';
     $config['prev_link']       =   '&lt;';
     
     $this->pagination->initialize($config); */
     
     
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
        $this->form_validation->set_rules('local', 'local', 'trim|required');
     
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
               $dados_insert['local'] = to_bd($dados_form['local']);
            

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

        $dados['titulo'] = 'BNTH - Cadastro de livros';
        $dados['h2'] = 'Cadastro de Livro';
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

        $dados['titulo'] = 'BNTH - Excluir livro';
        $dados['h2'] = 'Excluir livro';
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
        $this->form_validation->set_rules('local', 'local', 'trim|required');
     

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
                    $dados_update['local'] = to_bd($dados_form['local']);
                    
                    $dados_update['imagem'] = $dados_upload['file_name'];

                    if($this->livro->salvar($dados_update)): //atualiza no bd
                        unlink($imagem_antiga); //deleta a imagem anterior
                        set_msg('<p>Dados alterados com sucesso!</p>');
                        $dados['livros']->imagem = $dados_update['imagem'];
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
                $dados_update['local'] = to_bd($dados_form['local']);
                    
                
                if($this->livro->salvar($dados_update)):
                    set_msg('<p>Dados alterados com sucesso!</p>');
                else:
                    set_msg('<p>Erro! Nenhuma alteração foi salva.</p>');
                endif;
            endif;

        endif;


        //carrega a view

        $dados['titulo'] = 'BNTH - Edição de livro';
        $dados['h2'] = 'Edição de livro cadastrado';
        $dados['tela'] = 'editar'; //para carregar qual o tipo da view
        $this->load->view('painel/livros', $dados);

    }
    
    public function emprestarLivro(){
        if(($id = $this->uri->segment(3))> 0): //segment(2)= refêre-se a posição da rota chamada pós barra da url  no navegador
            if($descLivro= $this->livro->get_single($id)): // método da model
                $dados['livros'] = $descLivro;
              //  $dados_update['id'] = $$descLivro->id;
            else:
                set_msg('<p>Livro inexistente! Escolha um vídeo para editar.</p>');
                redirect('livro/listar', 'refresh');
            endif;
        else:
            set_msg('<p>Você deve escolher um Livro para retirar!</P>');
            redirect('livro/listar', 'refresh');
        endif;
     
     //regras de validação
        $this->form_validation->set_rules('nome', 'nome', 'trim|required');
        $this->form_validation->set_rules('ra', 'Ra', 'trim|required');
        $this->form_validation->set_rules('turma', 'Turma', 'trim|required');
        $this->form_validation->set_rules('id', 'id', 'trim|required');
        
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
            $dados_insert['livro_id'] = to_bd($dados_form['id']);
            $dados_insert['titulo_livro'] = to_bd($dados_form['titulo']);
            $dados_insert['data_entrega'] = to_bd($dados_form['data_entrega']);
            
            
            
            if($this->user->salvar($dados_insert)): //atualiza no bd
                
                set_msg('<p>Retirada registrada com sucesso!</p>');
               redirect('user/listar');
                
            else:
                set_msg('<p>Erro! Nenhuma ação foi realizada.</p>');
            endif;
        endif;

         

                $dados['titulo'] =  to_html($descLivro->titulo).' - BNTH';
                $dados['livro_id'] = to_html(($descLivro->id));
                $dados['livro_titulo'] = to_html(($descLivro->titulo));
                $dados['livro_autor'] = to_html($descLivro->autor);
                $dados['livro_genero'] = $descLivro->genero;
                $dados['livro_desc'] = $descLivro->descricao;
                $dados['livro_unidade'] = $descLivro->unidade;
                $dados['livro_imagem'] = $descLivro->imagem;
            
                $dados['titulo'] = 'Página não encontrada - BNTH';
                $dados['livro_titulo'] = 'livro não encontrado';
                $dados['livro_autor'] = '<p>Nenhum livro foi encontrado com base nos parâmetros fornecidos</p>';
                $dados['livro_imagem'] = '';
                
      
        $dados['leitor'] = $this->leitor->busca();
        $dados['titulo'] = 'BNTH - Alteração de vídeos';
        $dados['h2'] = 'Empréstimo de livro';
        $dados['tela'] = 'emprestarLivro'; //para carregar qual o tipo da view
        $this->load->view('painel/livros', $dados);
        
    
   

    
    }
}
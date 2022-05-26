<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

    function __construct(){
        parent::__construct();
        //imports
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');
		
        $this->load->model('options_model', 'option');
        $this->load->model('Usuario_model', 'user');
        $this->load->model('Livros_model', 'livros');
        $this->load->model('Cadastro_model', 'leitor');
        $this->load->model('Registro_acesso_model', 'visitante');
    }

    public function index($pages=0){
        redirect('livro/listar', 'refresh');
    }
    public function listar($pages=0){
        //verifica se o usuário está logado
        verifica_login();


        	/*   ***** Para a paginação ***** */
      

        //quantidade por pagina
        $limit = 5;

        // pegar o total
        $dados['total'] = count($this->user->get());

        //livros com paginação
        $dados['dadosUsuario'] = $this->user->page_users($limit, $pages);


		//paginação
		$this->load->library('pagination');
		$config['base_url']        =  base_url('index.php/User/listar');
		$config['total_rows']      =  $dados['total'];
		$config['per_page']        =  $limit;
		$config['full_tag_open']   =  '<div class="">';
		$config['full_tag_close']  =   '</div>';
		$config['first_link']      =  'Inicio';     
		$config['last_link']       =   'Fim';
		$config['next_link']       =   '&gt;';
		$config['prev_link']       =   '&lt;';
		

		$this->pagination->initialize($config);

     /*   ***** Para a paginação ***** */




        //carrega a view
        $dados['titulo'] = 'BNTH - Listagem de livros';
        $dados['h2'] = 'Controle de empréstimo de livros';

        $dados['tela'] = 'listar'; //para carregar qual o tipo da view
     //   $dados['leitor'] = $this->user->get();
        $this->load->view('/emprestar_livro', $dados);

    }
    public function pesquisar_user(){
        //verifica se o usuário está logado
        verifica_login();
  
     
     
        //carrega a view
        $dados['titulo'] = 'BNTH - Listagem de empréstimo';
     //   $dados['pesquisar'] =   $this->input->get();
     //   $dados['title'] = $this->input->get();
        $dados['h2'] = 'Buscar emprétimo';
   
       $dados['user'] = $this->user->busca();
       $this->load->view('/emprestar_livro', $dados);
    }
 
    public function cadastrar_users(){
        //verifica se o usuário está logado
        verifica_login();

        //regras de validação
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        $this->form_validation->set_rules('ra', 'Ra', 'trim|required');
        $this->form_validation->set_rules('turma', 'Turma', 'trim|required');
        $this->form_validation->set_rules('telefone', 'Telefone', 'trim|required');
       
     
        //verifica a validação
        if($this->form_validation->run() == FALSE):
            if(validation_errors()):
                set_msg(validation_errors());
            endif;
        else:
          
                $dados_form = $this->input->post();

              
               $dados_insert['nome'] = to_bd($dados_form['nome']);
               $dados_insert['ra'] = to_bd($dados_form['ra']);
               $dados_insert['turma'] = to_bd($dados_form['turma']);
               $dados_insert['telefone'] = to_bd($dados_form['telefone']);
               

             // salva  no Banco de dados
               if($id = $this->leitor->salvar($dados_insert)):
                    set_msg('<p>Usuário cadastrado com sucesso!</p>');
                    redirect('user/cadastrar_users/'.$id, 'refresh');
               else:
                    set_msg('<p> Erro! Livro não foi cadastrado.</p>');
               endif;

            
        endif;



        //carrega a view

        $dados['titulo'] = 'BNTH - Cadastro de usuários';
        $dados['h2'] = 'Cadastro de Usuários';
        $dados['tela'] = 'cadastrar_users'; //para carregar qual o tipo da view
        $this->load->view('painel/users', $dados);
    
    }
    public function busca_users(){
        //verifica se o usuário está logado
        verifica_login();

        //carrega a view
        $dados['titulo'] = 'BNTH - Listagem de livros';
        
        $dados['h2'] = 'Buscar livro';
        $dados['tela'] = 'pesquisar'; //para carregar qual o tipo da view
        $dados['usuarios'] = $this->user->busca();
        $this->load->view('painel/livros', $dados);
    }
    
    
    //Faz a listagem de livros emprestados
    
    public function emprestar_Livro(){
 
        $usuarioModel = $this->user->get_single();
        $userModel = $this->user->get();
        
        $dados['dadosUsuario'] = $userModel;
    
        $dados[ 'dadoLivro'] = $this->livros->get_user($usuarioModel);
        
        $dados['titulo'] = 'BNTH - Retirada de livros';
        $dados['h2'] = 'Retirada de livro';
    
        $this->load->view('listar', $dados);
     
    
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

        $dados['titulo'] = 'BNTH - Exclusão de cadastro';
        $dados['h2'] = 'Exclusão de cadastro';
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
                set_msg('<p>Usuário inexistente! Escolha um nome para editar.</p>');
                redirect('user/listar', 'refresh');
            endif;
        else:
            set_msg('<p>Você deve escolher um post para editar!</P>');
            redirect('user/listar', 'refresh');
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
        $dados['h2'] = 'Edição de dados do usuario';
        $dados['tela'] = 'editar'; //para carregar qual o tipo da view
        $this->load->view('painel/users', $dados);

    }

    public function editar_retirada()
	{

		$id = $this->input->post('id');
		//tentativas
		/*  $nome = $this->input->post('nome');
	  $funcao = $this->input->post('funcao');
	  $hora_ent = $this->input->post('hora_ent');
	  $hora_saida = $this->input->post('hora_saida');

	*/ // $dados_update = [$nome, $funcao, $hora_ent, $hora_saida];
    //debug: var_dump($id);
		$this->user->get_single($id);

		if ($id > 0) :
			//id informado, continuar com a edição
			if ($postagem = $this->user->get_single($id)) : // método da model
				$dados['usuario'] = $postagem;
				$dados_update['id'] = $postagem->id;
			else :
				set_msg('<p>Usuário inexistente! Escolha um nome para editar.</p>');
				redirect('/emprestar_livro', 'refresh');
			endif;
		else :
			set_msg('<p>Você deve escolher um post para editar!</P>');
			redirect('/emprestar_livro', 'refresh');
		endif;

		//regras de validação
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required');
		$this->form_validation->set_rules('ra', 'ra', 'trim|required');
        $this->form_validation->set_rules('turma', 'turma', 'trim|required');
		$this->form_validation->set_rules('tlivro', 'tlivro', 'trim|required');
		
        $this->form_validation->set_rules('dataent', 'dataent', 'trim|required');
		$this->form_validation->set_rules('dataret', 'dataret', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
	
		//verifica a validação
		if ($this->form_validation->run() == FALSE) :
			if (validation_errors()) :
				set_msg(validation_errors());
			endif;
		else :

			$dados_form = $this->input->post();
			$dados_insert['user_nome'] = to_bd($dados_form['nome']);
			$dados_insert['user_ra'] = to_bd($dados_form['ra']);
			$dados_insert['user_turma'] = to_bd($dados_form['turma']);
			$dados_insert['titulo_livro'] = to_bd($dados_form['tlivro']);
            $dados_insert['data_entrega'] = to_bd($dados_form['dataent']);
			$dados_insert['user_data'] = to_bd($dados_form['dataret']);
			$dados_insert['user_status'] = to_bd($dados_form['status']);


			$this->user->editar($dados_update); //atualiza no bd
            redirect('user/listar', 'refresh');
		
		endif;


		$usuario = $this->user->get();
		$dados['dadosUsuario'] = $usuario;


		//carrega a view

		$dados['titulo'] = 'BNTH - sala de leitura';
		$dados['h2'] = 'Controle de acesso a sala de  leitura';
		//  $dados['tela'] = 'editar'; //para carregar qual o tipo da view
		$this->load->view('/emprestar_livro', $dados); 
	}

	
}
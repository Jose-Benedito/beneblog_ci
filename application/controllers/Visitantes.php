<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Visitantes extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		//imports
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->model('Registro_acesso_model', 'visitante');
	}



	public function index($pages=0)

	{

		redirect('Visitantes/listar', 'refresh');



	
	}

	public function listar($pages=0)
	{
		//verifica se o usuário está logado
		verifica_login();


			/*   ***** Para a paginação ***** */
      

        //quantidade por pagina
        $limit = 5;

        // pegar o total
        $dados['total'] = count($this->visitante->get());

        //livros com paginação
        $dados['dadosvisita'] = $this->visitante->page_acessos($limit, $pages);


		//paginação
		$this->load->library('pagination');
		$config['base_url']        =  base_url('index.php/Visitantes/listar');
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
		$dados['h2'] = 'Edição de usuários cadastrados';

		$dados['tela'] = 'listar'; //para carregar qual o tipo da view
	//	$dados['visita'] = $this->visitante->get();
		$this->load->view('/visitantes', $dados);
	}


	public function salvar()
	{


		//verifica se o usuário está logado
		verifica_login();

		//regras de validação
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required');
		$this->form_validation->set_rules('funcao', 'Funcao', 'trim|required');
		$this->form_validation->set_rules('hora_ent', 'Hora_ent', 'trim|required');
		//	$this->form_validation->set_rules('hora_saida', 'hora_saida', 'trim|required');

		//verifica a validação
		if ($this->form_validation->run() == FALSE) :
			if (validation_errors()) :
				set_msg(validation_errors());
			endif;
		else :

			$dados_form = $this->input->post();


			$dados_insert['nome'] = to_bd($dados_form['nome']);
			$dados_insert['funcao'] = to_bd($dados_form['funcao']);
			$dados_insert['hora_ent'] = to_bd($dados_form['hora_ent']);
			$dados_insert['hora_saida'] = to_bd($dados_form['hora_saida']);



			// salva  no Banco de dados
			if ($id = $this->visitante->salvar($dados_insert)) :
				set_msg('<p>Vistante cadastrado com sucesso!</p>');
				redirect('/visitantes', 'refresh');
			else :
				set_msg('<p> Erro! Viistante não foi cadastrado.</p>');
			endif;


		endif;



		//$visitante = $this->visitante->get_single();
		$visitante = $this->visitante->get();

		$dados['dadosvisita'] = $visitante;


		//carrega a view

		$dados['titulo'] = 'BNTH - sala de leitura';
		$dados['h2'] = 'Controle de uso da sala de  leitura';
		//  $dados['tela'] = 'editar'; //para carregar qual o tipo da view
		$this->load->view('/visitantes', $dados);
	}
	public function editar()
	{

		$id = $this->input->post('id');
		//tentativas
		/*  $nome = $this->input->post('nome');
	  $funcao = $this->input->post('funcao');
	  $hora_ent = $this->input->post('hora_ent');
	  $hora_saida = $this->input->post('hora_saida');

	*/ // $dados_update = [$nome, $funcao, $hora_ent, $hora_saida];
		$this->visitante->get_single($id);

		if ($id > 0) :
			//id informado, continuar com a edição
			if ($postagem = $this->visitante->get_single($id)) : // método da model
				$dados['usuario'] = $postagem;
				$dados_update['id'] = $postagem->id;
			else :
				set_msg('<p>Usuário inexistente! Escolha um nome para editar.</p>');
				redirect('/visitantes', 'refresh');
			endif;
		else :
			set_msg('<p>Você deve escolher um post para editar!</P>');
			redirect('/visitantes', 'refresh');
		endif;

		//regras de validação
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required');
		$this->form_validation->set_rules('funcao', 'funcao', 'trim|required');
		$this->form_validation->set_rules('hora_ent', 'Hora_ent', 'trim|required');
		$this->form_validation->set_rules('hora_saida', 'Hora_saida', 'trim|required');

		//verifica a validação
		if ($this->form_validation->run() == FALSE) :
			if (validation_errors()) :
				set_msg(validation_errors());
			endif;
		else :

			$dados_form = $this->input->post();
			$dados_insert['nome'] = to_bd($dados_form['nome']);
			$dados_insert['funcao'] = to_bd($dados_form['funcao']);
			$dados_insert['hora_ent'] = to_bd($dados_form['hora_ent']);
			$dados_insert['hora_saida'] = to_bd($dados_form['hora_saida']);



			$this->visitante->editar($dados_update); //atualiza no bd

		endif;

	
		$visitante = $this->visitante->get();
		$dados['dadosvisita'] = $visitante;


		//carrega a view

		$dados['titulo'] = 'BNTH - sala de leitura';
		$dados['h2'] = 'Controle de acesso a sala de  leitura';
		//  $dados['tela'] = 'editar'; //para carregar qual o tipo da view
		$this->load->view('/visitantes', $dados);
	}

	





	//var_dump ($nome);


}

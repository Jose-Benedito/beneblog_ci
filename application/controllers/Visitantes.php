<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitantes extends CI_Controller {
	function __construct(){
        parent::__construct();
        //imports
        $this->load->helper('form');
		$this->load->library('form_validation');
        $this->load->model('Registro_acesso_model', 'visitante');
    }

 

	public function index()

	{
		
		
		$dados['titulo'] = 'BNTH - sala de leitura';
		$dados['h2'] = 'Controle de uso da sala de  leitura';
		$dados['dadosvisita'] = $this->visitante->get();
	  //  $dados['tela'] = 'editar'; //para carregar qual o tipo da view
		$this->load->view('/visitante', $dados);
		
	}
	public function listar(){
        //verifica se o usuário está logado
        verifica_login();

        //carrega a view
        $dados['titulo'] = 'BNTH - Listagem de livros';
        $dados['h2'] = 'Edição de usuários cadastrados';

        $dados['tela'] = 'listar'; //para carregar qual o tipo da view
        $dados['visita'] = $this->visitante->get();
        $this->load->view('/visitante', $dados);

    }


	public function salvar(){

       
		//verifica se o usuário está logado
		verifica_login();

		//regras de validação
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required');
		$this->form_validation->set_rules('funcao', 'Funcao', 'trim|required');
		$this->form_validation->set_rules('hora_ent', 'Hora_ent', 'trim|required');
		$this->form_validation->set_rules('hora_saida', 'hora_saida', 'trim|required');
	   
	   //verifica a validação
	   if($this->form_validation->run() == FALSE):
		   if(validation_errors()):
			   set_msg(validation_errors());
		   endif;
	   else:
		 
			   $dados_form = $this->input->post();

			 
			  $dados_insert['nome'] = to_bd($dados_form['nome']);
			  $dados_insert['funcao'] = to_bd($dados_form['funcao']);
			  $dados_insert['hora_ent'] = to_bd($dados_form['hora_ent']);
			  $dados_insert['hora_saida'] = to_bd($dados_form['hora_saida']);
			  


			// salva  no Banco de dados
			  if($id = $this->visitante->salvar($dados_insert)):
				   set_msg('<p>Vistante cadastrado com sucesso!</p>');
				   redirect('/visitantes', 'refresh');
			  else:
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
	   $this->load->view('/visitante', $dados);
	   

   }
   public function editar(){
   


   }
   

}


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Options_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	//Seleciona os opções na tabela options do banco de dados
	public function get_options($option_name, $default_value=NULL)
	{
		$this->db->where('options_name', $option_name);
		$query = $this->db->get('options', 1);
		if($query->num_rows() == 1):
			$row = $query->row();
			return $row->options_value;
		else:
			return $default_value;
		endif;

	}
	// Update e inserção de dados na tabela option do banco de dado
	public function update_option($option_name, $option_value)
	{
		$this->db->where('options_name', $option_name);
		$query = $this->db->get('options', 1);
		if($query->num_rows() == 1):
			//opção já existe, devo atualizar
			$this->db->set('options_value', $option_value);
			$this->db->where('options_name', $option_name);
			$this->db->update('options');
			return $this->db->affected_rows();
		
		else:
			// opção não existe , devo inserir
			$dados = array(
				'options_name' => $option_name,
				'options_value'=> $option_value
			);
			$this->db->insert('options', $dados);
			return  $this->db->insert_id();
		endif;
	}
	
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Registro_acesso_model extends CI_Model {
   
    public function __construct()
    {
        parent::__construct();
       
        
    }
    public function salvar($dados){
        if(isset($dados['id']) && $dados['id']> 0):
  
            //post já existe, devo editar
          
            $this->db->where('id', $dados['id']);
            unset($dados['id']); //para que o id não seja alterado
            $this->db->set('visitantes', $dados); // atualiza todos os campos
    
            //$this->db->update('visitantes',$dados); 
            return $this->db->affected_rows(); //retorna todos dados alterados

        else:
            //post não existe , devo inserir
            $this->db->insert('visitantes', $dados);
            return $this->db->insert_id();
        endif;
    }
    public function get($limit=0, $offset=0){
        if($limit == 0):
            $this->db->order_by('id', 'desc');
            $query = $this->db->get('visitantes');
            if($query->num_rows() > 0):
                return $query->result();
            else:
                return NULL;
            endif;
        else:
            $this->db->order_by('id', 'desc');
            $query = $this->db->get('visitantes', $limit);
            if($query->num_rows() > 0):
                return $query->result();
            else:
                return NULL;
            endif;
        endif;
    }
    public function get_single($id=0){
        $this->db->where('id', $id);
        $query = $this->db->get('visitantes', 1);
        if($query->num_rows() == 1):
            $row = $query->row();
            return $row;
        else:
            return NULL;
        endif;
    }

    public function excluir($id=0){
        $this->db->where('id', $id);
        $this->db->delete('visitantes');  // nome da tabela
        return $this->db->affected_rows();
    }
    public function editar($dados){


	  $id = $this->input->post('id');
	  $nome = $this->input->post('nome');
	  $funcao = $this->input->post('funcao');
	  $hora_ent = $this->input->post('hora_ent');
	  $hora_saida = $this->input->post('hora_saida');

        $this->db->where('id', $dados['id']);
        $this->db->set('nome', $nome);
        $this->db->set('funcao', $funcao);
        $this->db->set('hora_ent', $hora_ent);
        $this->db->set('hora_saida', $hora_saida);
        $this->db->update('visitantes'); 
        return $this->db->affected_rows();
    }

     // Paginação de acessos

     public function page_acessos($limit, $page){
        $this->db->select('*');
        $this->db->order_by('nome', 'desc');
        $this->db->limit($limit, $page);

        return $this->db->get('visitantes')->result();

    }

}
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
            $this->db->update('posts', $dados); // atualiza todos os campos
            return $this->db->affected_rows(); //retorna todos dados alterados

        else:
            //post não existe , devo inserir
            $this->db->insert('posts', $dados);
            return $this->db->insert_id();
        endif;
    }
    public function get($limit=0, $offset=0){
        if($limit == 0):
            $this->db->order_by('id', 'desc');
            $query = $this->db->get('posts');
            if($query->num_rows() > 0):
                return $query->result();
            else:
                return NULL;
            endif;
        else:
            $this->db->order_by('id', 'desc');
            $query = $this->db->get('posts', $limit);
            if($query->num_rows() > 0):
                return $query->result();
            else:
                return NULL;
            endif;
        endif;
    }
    public function get_single($id=0){
        $this->db->where('id', $id);
        $query = $this->db->get('posts', 1);
        if($query->num_rows() == 1):
            $row = $query->row();
            return $row;
        else:
            return NULL;
        endif;
    }

    public function excluir($id=0){
        $this->db->where('id', $id);
        $this->db->delete('posts');  // nome da tabela
        return $this->db->affected_rows();
    }

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Cadastro_model extends CI_Model {
   
    public function __construct()
    {
        parent::__construct();
       
        
    }
    public function salvar($dados){
        if(isset($dados['id']) && $dados['id'] > 0):
            //post já existe, devo editar
            $this->db->where('id', $dados['id']);
             unset($dados['id']); //para que o id não seja alterado
            $this->db->update('cadastro_user', $dados); // atualiza todos os campos
            return $this->db->affected_rows(); //retorna todos dados alterados

        else:
            //post não existe , devo inserir
            $this->db->insert('cadastro_user', $dados);
            return $this->db->insert_id();
        endif;
    }
    public function get($limit=0, $offset=0){
        if($limit == 0):
            $this->db->order_by('id', 'desc'); //pega os dados em ordem descrecente
            $query = $this->db->get('cadastro_user');
            if($query->num_rows() > 0): //verifica se as linhas foram alteradas
                return $query->result(); //retorna os resultados da consulta
            else:
                return NULL;
            endif;
        else:
            $this->db->order_by('id', 'desc');
            $query = $this->db->get('cadastro_user', $limit);
            if($query->num_rows() > 0):
                return $query->result();
            else:
                return NULL;
            endif;
        endif;
    }

    public function get_single($id=0){
        $this->db->where('id', $id); // retorna dados pelo id escolhido
        $query = $this->db->get('cadastro_user', 1);
        if($query->num_rows() == 1):
            $row = $query->row();
            return $row;
        else:
            return NULL;
        endif;
    }
   

    

   public function busca(){
    
       $termo = $this->input->post('pesquisar');
       $this->db->select('*');
        $this->db->like('nome',$termo);
       $query = $this->db->get('cadastro_user');
   
     return $query->result(); //retorna os resultados da consulta
     
    }

    public function excluir($id=0){
        $this->db->where('id', $id);// retorna dados pelo id escolhido
        $this->db->delete('cadastro_user');  // nome da tabela (deleta o id indicado)
        return $this->db->affected_rows();
    }

}
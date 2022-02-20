<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Pdf_model extends CI_Model {
   
    public function __construct()
    {
        parent::__construct();
       
        
    }
    public function salvar($dados){
        if(isset($dados['id']) && $dados['id'] > 0):
            //post já existe, devo editar
            $this->db->where('id', $dados['id']);
             unset($dados['id']); //para que o id não seja alterado
            $this->db->update('pdf', $dados); // atualiza todos os campos
            return $this->db->affected_rows(); //retorna todos dados alterados

        else:
            //post não existe , devo inserir
            $this->db->insert('pdf', $dados);
            return $this->db->insert_id();
        endif;
    }
    public function get($limit=0, $offset=0){
        if($limit == 0):
            $this->db->order_by('id', 'desc'); //pega os dados em ordem descrecente
            $query = $this->db->get('pdf');
            if($query->num_rows() > 0): //verifica se as linhas foram alteradas
                return $query->result(); //retorna os resultados da consulta
            else:
                return NULL;
            endif;
        else:
            $this->db->order_by('id', 'desc');
            $query = $this->db->get('pdf', $limit);
            if($query->num_rows() > 0):
                return $query->result();
            else:
                return NULL;
            endif;
        endif;
    }

    public function get_single($id=0){
        $this->db->where('id', $id); // retorna dados pelo id escolhido
        $query = $this->db->get('pdf', 1);
        if($query->num_rows() == 1):
            $row = $query->row();
            return $row;
        else:
            return NULL;
        endif;
    }
    public function get_livro($id=0){
        $this->db->where('livro_id', $id); // retorna dados pelo id escolhido
        $query = $this->db->get('pdf', 1);
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
       $query = $this->db->get('pdf');
   
     return $query->result(); //retorna os resultados da consulta
     
    }

    public function excluir($id=0){
        $this->db->where('id', $id);// retorna dados pelo id escolhido
        $this->db->delete('pdf');  // nome da tabela (deleta o id indicado)
        return $this->db->affected_rows();
    }


    // para edição da modal de empréstimo de livro
    public function editar($dados){


        $id = $this->input->post('id');
        $nome = $this->input->post('nome');
        $ra = $this->input->post('ra');
        $turma = $this->input->post('turma');
        $tlivro = $this->input->post('tlivro');
       
        $dataent = $this->input->post('dataent');
        $dataret = $this->input->post('dataret');
        $status = $this->input->post('status');
        
       
  
          $this->db->where('id', $dados['id']);
          $this->db->set('user_nome', $nome);
          $this->db->set('user_ra', $ra);
          $this->db->set('user_turma', $turma);
          $this->db->set('titulo_livro', $tlivro);
          $this->db->set('data_entrega', $dataent);
          $this->db->set('user_data', $dataret);
          $this->db->set('user_status', $status);
          $this->db->update('usuarios'); 
          return $this->db->affected_rows();
      }
        // Paginação de livros

    public function page_users($limit, $page){
        $this->db->select('*');
        $this->db->order_by('user_nome', 'desc');
        $this->db->limit($limit, $page);

        return $this->db->get('pdf')->result();

    }


}
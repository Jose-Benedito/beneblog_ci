<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Livros_model extends CI_Model {
   
    public function __construct()
    {
        parent::__construct();
       
        
    }
    public function salvar($dados){
        if(isset($dados['id']) && $dados['id']> 0):
            //post já existe, devo editar
            $this->db->where('id', $dados['id']);
            unset($dados['id']); //para que o id não seja alterado
            $this->db->update('livros', $dados); // atualiza todos os campos
            return $this->db->affected_rows(); //retorna todos dados alterados

        else:
            //post não existe , devo inserir
            $this->db->insert('livros', $dados);
            return $this->db->insert_id();
        endif;
    }
    public function get($limit=0, $offset=0){
        if($limit == 0):
            $this->db->order_by('id', 'desc'); //pega os dados em ordem descrecente
            $query = $this->db->get('livros');
            if($query->num_rows() > 0): //verifica se as linhas foram alteradas
                return $query->result(); //retorna os resultados da consulta
            else:
                return NULL;
            endif;
        else:
            $this->db->order_by('id', 'desc');
            $query = $this->db->get('livros', $limit);
            if($query->num_rows() > 0):
                return $query->result();
            else:
                return NULL;
            endif;
        endif;
    }

    public function get_single($id=0){
        $this->db->where('id', $id); // retorna dados pelo id escolhido
        $query = $this->db->get('livros', 1);
        if($query->num_rows() == 1):
            $row = $query->row();
            return $row;
        else:
            return NULL;
        endif;
    }
    public function get_user($livro_id=0){
        $this->db->where('id', $livro_id); // retorna dados pelo id escolhido
        $query = $this->db->get('livros', 3);
        if($query->num_rows() == 1):
            $row = $query->row();
            return $row;
        else:
            return NULL;
        endif;
    }

    

   public function busca($limit=0, $offset=0){
     
       if( $termo = $this->input->get('pesquisar')):
           $this->db->like('titulo',$termo);
       elseif( $termo = $this->input->get('autor')):

           $this->db->like('autor', $termo);
       else:
         $termo = $this->input->get('genero');
         $this->db->like('genero',$termo);
      endif; 
       $this->db->select('*');

     // $this->db->like('autor', $termoA);

       //$this->db->like('genero',$termoB);
        $this->db->order_by('id', 'desc');
       $query = $this->db->get('livros', $limit);
   
     return $query->result(); //retorna os resultados da consulta
     
    }

    public function excluir($id=0){
        $this->db->where('id', $id);// retorna dados pelo id escolhido
        $this->db->delete('livros');  // nome da tabela (deleta o id indicado)
        return $this->db->affected_rows();
    }

    // Paginação de livros

    public function page_livros($limit, $page){
        $this->db->select('*');
        $this->db->order_by('titulo', 'desc');
        $this->db->limit($limit, $page);

        return $this->db->get('livros')->result();

    }


}

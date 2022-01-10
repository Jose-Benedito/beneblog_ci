<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Setup extends CI_Controller {
   
    public function __construct()
    {
        parent::__construct();
       $this->load->helper('form');
       $this->load->library('form_validation');
       $this->load->model('Options_model', 'option');
        
    }
    public function index()
    {
        if($this->option->get_options('septup_executado')== 1):
        //setup ok, mostrar tela para editar dados de setup
        redirect('setup/alterar' , 'reflesh');
    else:
        //não instalado, mostrar tela de setup
        redirect('setup/instalar', 'reflesh');
    endif;

    
        
    }
    public function instalar()
    {
        if($this->option->get_options('setup_executado')== 1):
        //setup ok, mostrar tela para editar dados de setup
        redirect('setup/alterar' , 'reflesh');
        endif;

           // Regras de validação do formulário
        $this->form_validation->set_rules('login', 'Nome', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('senha2', 'Repita a Senha', 'trim|required|min_length[6]|matches[senha]');

        //verifica a validação
        if($this->form_validation->run()== FALSE):
            if(validation_errors()):
                set_msg(validation_errors());
            endif;
        else:
            $dados_form = $this->input->post();
            $this->option->update_option('user_login', $dados_form['login']);
            $this->option->update_option('user_email', $dados_form['email']);
            $this->option->update_option('user_pass', password_hash($dados_form['senha'], PASSWORD_DEFAULT));

            $inserido = $this->option->update_option('setup_executado', 1);
            if($inserido):
                set_msg('<p>Sistema instalado com sucesso, use os dados cadastrados para logar no sistema.</p>');
                redirect('setup/login', 'reflesh');
            endif;
        endif;

        //carrega a view
        $dados['titulo'] = 'BNTH - Setup do sistema';
        $dados['h2'] = 'Setup do sistema';
        $this->load->view('painel/setup', $dados);
    }
    public function login()
    {
         if($this->option->get_options('setup_executado')!=1):
        //setup não está ok, mostrar tela para instalar o sistema
            redirect('setup/instalar' , 'reflesh');
        endif;
             // Regras de validação do formulário
        $this->form_validation->set_rules('login', 'Nome', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]');


               //verifica a validação
        if($this->form_validation->run()== FALSE):
            if(validation_errors()):
                set_msg(validation_errors()); //função do helper
            endif;
        else:
            $dados_form = $this->input->post();
            if($this->option->get_options('user_login') == $dados_form['login']):
                //usuário existe
                if(password_verify($dados_form['senha'], $this->option->get_options('user_pass'))):
                    //senha ok, fazer login
                    $this->session->set_userdata('logged', TRUE);
                     $this->session->set_userdata('user_login', $dados_form['login']);
                      $this->session->set_userdata('user_email', $this->option->get_options('user_email'));
                      // Fazer o redirect para a home do painel
                     //debug: var_dump($_SESSION);
                          redirect('setup/alterar' , 'reflesh');
                else:
                    //senha incorreta
                    set_msg('<p> Senha incorreta!</p>');
                endif;
            else:
                //usuário não existe
                set_msg('<p>Usuário inexistente</p>');
            endif;

          
        endif;
        //carrega a view
        $dados['titulo'] = 'BNTH - Setup do sistema';
        $dados['h2'] = 'Setup do sistema';
        $this->load->view('painel/login', $dados);
    }
    public function alterar(){
        //verificar o login do usuário (função do helper)
        verifica_login();

            // Regras de validação do formulário
        $this->form_validation->set_rules('login', 'Nome', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('senha', 'Senha', 'trim|min_length[6]');
        if(isset($_POST['senha']) && $_POST['senha'] != ''):
            $this->form_validation->set_rules('senha2', 'Repita a Senha', 'trim|required|min_length[6]|matches[senha]');
        endif;
                  //verifica a validação
        if($this->form_validation->run()== FALSE):
            if(validation_errors()):
                set_msg(validation_errors()); //função do helper
            endif;
        else:
            $dados_form = $this->input->post();
            $this->option->update_option('user_login', $dados_form['login']);
            $this->option->update_option('user_email', $dados_form['email']);

            if(isset($dados_form['senha']) && $dados_form['senha'] != ''):
                $this->option->update_option('user_pass', password_hash($dados_form['senha'], PASSWORD_DEFAULT));
            endif;

            set_msg('<p>Dados alterados com sucesso</p>');

        endif;

           //carrega a view
        $_POST['login'] = $this->option->get_options('user_login');
        $_POST['email'] = $this->option->get_options('user_email');

        $dados['titulo'] = 'BNTH - Configuração do sistema';
        $dados['h2'] = 'Altera a configuração básica';
        $this->load->view('painel/config', $dados);
    }
    public function logout(){
        // destrói os dados da sessão
        $this->session->unset_userdata('logged');
        $this->session->unset_userdata('user_login');
        $this->session->unset_userdata('user_email');
        set_msg('<p> Você saiu do sistema!</p>');
        redirect('setup/login', 'reflesh');
    }

}
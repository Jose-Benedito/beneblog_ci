<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Paginas extends CI_Controller {
    // Configuração para o cache global das páginas
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
       // $this->output->cache(1440); //corrensponde a 24 horas até o  cache ser atualizado
        
    }
    public function index()
    {
     //debug:  echo 'página home';
     $data['title'] = "BNTH | Home";
    $data['desc'] = "Exercício de exemplo do capítulo 5 do livro Codeigniter";
    
        $this->load->view('home', $data);
        
    }

    public function empresa(){

       //debug: echo 'página empresa';
        $data['title'] = "BNTH | A Empresa";
        $data['description'] = "Informações sobre a empresa";
        $this->load->view('empresa', $data);
    
    }
    public function servicos(){
        $data['title'] = "BNTH | Serviços";
        $data['description'] = "Informações sobre os serviços prestados";
        $this->load->view('commons/header', $data);
        $this->load->view('servicos');
        $this->load->view('commons/footer');
    }
    public function faleconosco()
    {
    
        $this->load->helper('url');
        $this->load->library (array('form_validation', 'email'));
        $this->load->helper('form');
        $data['title'] = "BNTH | Fale Conosco";
       $data['description'] = "Exercício de exemplo do capítulo 5 do livro CodeIgniter da casa do código";
        
        // Regras de validação do formulário
        $this->form_validation->set_rules('nome', 'Nome', 'trim |required| min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'trim |required|valid_email');
        $this->form_validation->set_rules('assunto', 'Assunto', 'trim |required|min_length[5]');
        $this->form_validation->set_rules('mensagem', 'Mensagem', 'trim |required| min_length[30]');


        if($this->form_validation->run() == FALSE){
            $data['formErrors'] = validation_errors();

        }else{
            //para a chamada do método de envio de email
            $dados_form = $this->input->post(); //recupera os dados do formulário
           //debug: print_r($dados_form);
           $this->email->from($dados_form['email'], $dados_form['nome']);
           $this->email->to('jbeneditomedeiros@gmail.com');
           $this->email->subject($dados_form['assunto']);
           $this->email->message($dados_form['mensagem']);
           if($this->email->send())
                $data['formErrors'] = 'Email enviado com sucesso!';
           else
                $data['formErrors'] = 'Erro ao enviar email, tente novamnete!';

        
        }

        $this->load->view('faleconosco', $data);
    
    }


    public function trabalheconosco()
    {
        $this->load->helper('url');
        $this->load->library ('form_validation');
        $this->load->helper('form');
        $data['title'] = 'BNTH | Trabalhe Conosco';
        $data['description'] = "Exercício de exemplo docapítulo 5 do livro Codeigniter";

        
      $this->load->view('trabalheconosco', $data);
    }
    // confgurações para o disparo de emails
    Private function SendEmailToAdmin($from, $fromName, $to, $toName, $subject, $message, $reply = null, $replyName = null)
    {
        $this->load->library('email');

        $config['charset'] = 'utf-8';
        $config['wordwrap'] = 'TRUE';
        $config['mailtype'] = 'html';
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.seudominio.com.br';
        $config['smtp_user'] = 'jbeneditomedeiros@seudominio.com.br';
        $config['smtp_pass'] = 'suasenha';
        $config['newline'] = '\r\n';

        $this->email->initialize($config);

        $this->email->from($from, $fromName);
        $this->email->to($to, $toName);
        if($reply)
            $this->email->reply_to($reply, $replyName);

        $this->email->subject($subject);
        $this->email->message($message);

        if($this->email->send())
            return true;
        else
            return false;

    }
    
}

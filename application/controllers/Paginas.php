<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Paginas extends CI_Controller {
    // Configuração para o cache global das páginas
    public function __construct()
    {
        parent::__construct();
        //carrega os módulos e classes
        $this->load->helper('url');
        $this->load->model('options_model', 'option');
        $this->load->model('post_model', 'post');
        $this->load->model('video_model', 'video');
       // $this->output->cache(1440); //corrensponde a 24 horas até o  cache ser atualizado
        
    }
    public function index()
    {
     //debug:  echo 'página home';
     $data['titulo'] = "BNTH | Home";
    $data['desc'] = "Exercício de exemplo do capítulo 5 do livro Codeigniter";
    
        $this->load->view('home', $data);
        
    }

    public function empresa(){

       //debug: echo 'página empresa';
        $data['titulo'] = "BNTH | A Empresa";
        $data['description'] = "Informações sobre a empresa";
        $this->load->view('empresa', $data);
    
    }
    public function video(){
        $data['titulo'] = "BNTH | Serviços";
        $data['description'] = "Informações sobre os serviços prestados";
        $this->load->view('commons/header', $data);
        $this->load->view('videoaulas');
        $this->load->view('commons/footer');
    }
    public function controle_livros()
    {
    
        $this->load->helper('url');
        $this->load->library (array('form_validation', 'email'));
        $this->load->helper('form');
        $data['titulo'] = "BNTH | Controle de livros";
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

        $this->load->view('controle_livros', $data);
    
    }


    public function cadastro_livros()
    {
        $this->load->helper('url');
        $this->load->library ('form_validation');
        $this->load->helper('form');
        $data['titulo'] = 'BNTH | Cadastro de livros';
        $data['description'] = "Exercício de exemplo docapítulo 5 do livro Codeigniter";

        
      $this->load->view('cadastro_livros', $data);
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
    public function postagem(){
        if(($id = $this->uri->segment(2))> 0): //segment(2)= refêre-se a posição da rota chamada pós barra da url  no navegador
            if($postagem = $this->post->get_single($id)):
                $dados['titulo'] =  to_html($postagem->titulo).' - BNTH';
                $dados['post_titulo'] = to_html(($postagem->titulo));
                $dados['post_conteudo'] = to_html($postagem->conteudo);
                $dados['post_imagem'] = $postagem->imagem;
                $dados['post_data'] = $postagem->data;
            else:
                $dados['titulo'] = 'Página não encontrada - BNTH';
                $dados['post_titulo'] = 'Postagem não encontrada';
                $dados['post_conteudo'] = '<p>Nenhum post foi encontrado com base nos parâmetros fornecidos</p>';
                $dados['post_imagem'] = '';

            endif;
        else:
            redirect(base_url(), 'refresh');

        endif;
        $this->load->view('painel/postagem', $dados);
    }
    public function videoaula(){
        if(($id = $this->uri->segment(2))> 0): //segment(2)= refêre-se a posição da rota chamada pós barra da url  no navegador
            if($videoaula = $this->video->get_single($id)): //método do model
                $dados['titulo'] =  to_html($videoaula->titulo).' - BNTH';
                $dados['video_titulo'] = to_html(($videoaula->titulo));
                $dados['video_descricao'] = to_html($videoaula->descricao);
                $dados['video_link'] = $videoaula->link;
                $dados['video_imagem'] = $videoaula->imagem;
            else:
                $dados['titulo'] = 'Página não encontrada - BNTH';
                $dados['video_titulo'] = 'Videoaula não encontrada';
                $dados['video_descricao'] = '<p>Nenhum video foi encontrado com base nos parâmetros fornecidos</p>';
                $dados['video_imagem'] = '';

            endif;
        else:
            redirect(base_url(), 'refresh');

        endif;
        $this->load->view('videoaulas', $dados);
    }
    
}

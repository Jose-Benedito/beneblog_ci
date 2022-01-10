<?php $this->load->view('commons/header'); ?>

<div class="container">
    <div class="page-header">
        <h1>Fale Conosco</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-9"> 
            <!--Informa a action e methofo do formulário (helper) da validação -->
            <?php
                if($formErrors):

                    echo '<p>'.$formErrors .'</p>';
                endif;
                
            
                  echo form_open(('home/faleconosco'));
                  echo form_label('Seu nome:', 'nome');
                  echo form_input('nome', set_value('nome'));
                  echo form_label('Seu email:', 'email');
                  echo form_input('email', set_value('email'));
                  echo form_label('Assunto:', 'assunto');
                  echo form_input('assunto', set_value('assunto'));
                  echo form_label('Mensagem:', 'mensagem');
                  echo form_textarea('mensagem', set_value('mensagem'));
                  echo form_submit('enviar', 'Enviar mensagem >>', array('class'=> 'botao')); 
                  echo form_close();?>
            <!--Informa a mensagem  da validação -->

          

        </div>
        <div class="col-md-4">
            <h4>Telefones</h4>
            <p>+55 99 9999-9999 | +55 88 8888-8888</p>
            <hr/>
            <h4>E-mail</h4>
            <p>contato@empresa.com.br</p>
            <hr/>
            <h4>Endereço</h4>
            <p>R. Quinze de Novembro - Praia da Costa, Vila Velha - ES</p>
            <hr/>

        </div>

    </div>

</div>

<?php $this->load->view('commons/footer'); ?>
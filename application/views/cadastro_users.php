<?php $this->load->view('commons/header'); ?>

<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-md-4">
<div class="container">
    <div class="page-header">
        <h1>Cadastrar-se</h1>
    </div>
    <hr>
  <div class="coluna col3">&nbsp;</div>
        <div class="coluna col4">
            <!--Informa a action e methofo do formulário (helper) da validação -->
            <?php
                if($formErrors):

                    echo '<p>'.$formErrors .'</p>';
                endif;
                
            
                  echo form_open();
                  echo form_label('Nome Completo:', 'nome');
                  echo form_input('nome', set_value('nome'));
                  echo form_label('RA:', 'ra');
                  echo form_input('ra', set_value('ra'));
                  echo form_label('Ano/Turma:', 'ano_turma');
                  echo form_input('ano_turma', set_value('ano_turma'));
                  echo form_label('Telefone:', 'telefone');
                  echo form_input('telefone', set_value('telefone'));
                  echo form_submit('cadastrar', 'cadastrar >>', array('class'=> 'botao')); 
                  echo form_close();?>
            <!--Informa a mensagem  da validação -->

          

        </div>
     

    </div>

</div>


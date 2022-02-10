    <?php $this->load->view('painel/header'); ?>


    <div class="container">&nbsp;
    <h2><?php echo $h2; ?></h2>
    
    <?php 
                if($msg = get_msg()):
                    echo '<div class="msg-box">'.$msg.'</div>';
                endif;
                ?>

                <div class="row">
                <div class="col-md-6">
                <?php
                echo form_open();
                echo form_label('Nome para login', 'login');
                echo form_input('login', set_value('login'), array('autofocus' => 'autofocus'));
                echo form_label('Email do administrador do site:', 'email');
                echo form_input('email', set_value('email'));
                echo form_label('Senha: ', 'senha');
                echo form_password('senha');
                echo form_label('Repita a senha: ', 'senha2');
                echo form_password('senha2');
                echo form_submit('enviar',  'Salvar dados', array('class'=> 'botao'));
                echo form_close();



            ?>
                </div>
                </div>
        </div>
     </div>
            
<?php $this->load->view('commons/footer') ?>

  
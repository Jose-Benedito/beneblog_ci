    <?php $this->load->view('painel/header'); ?>

    <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-md-4">

    <div class="coluna col3">&nbsp;</div>
        <div class="coluna col6">
            <h2><?php echo $h2; ?></h2>

            <?php 
                if($msg = get_msg()):
                    echo '<div class="msg-box">'.$msg.'</div>';
                endif;

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
    <div class="coluna col3">&nbsp;</div>

    <?php $this->load->view('painel/footer'); ?>
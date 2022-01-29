<?php $this->load->view('commons/header'); ?>


<title><?php echo $titulo ; ?></title>
</head>
<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-md-4">
<div class="container">
    <div class="page-header">
        <h1>Login</h1>
    </div>
    <hr>
  <div class="coluna col3">&nbsp;</div>
        <div class="coluna col4">
        

            <?php 
                if($msg = get_msg()):
                    echo '<div class="msg-box">'.$msg.'</div>';
                endif;

                echo form_open();
                echo form_label('Usuário', 'login');
                echo form_input('login', set_value('login'), array('autofocus' => 'autofocus'));
                echo form_label('Senha: ', 'senha');
                echo form_password('senha');
                echo form_submit('enviar',  'Autenticar', array('class'=> 'botao'));
                echo form_close();


'                       '
            ?>
            
        </div>
    
</div>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/cover.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/servico.css'); ?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/css/painel.css'); ?>">
    
    <title><?php echo $titulo ; ?></title>
</head>

<body >
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
                echo form_label('Senha:(deixe em branco para não alterar) ', 'senha');
                echo form_password('senha');
                echo form_label('Repita a senha: ', 'senha2');
                echo form_password('senha2');
                echo form_submit('enviar',  'Salvar dados', array('class'=> 'botao'));
                echo form_close();



            ?>
            
        </div>
    <div class="coluna col3">&nbsp;</div>
</body>
</html>
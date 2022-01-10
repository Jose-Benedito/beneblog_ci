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
    <div class="coluna col4">&nbsp;</div>
        <div class="coluna col4 login">
            <h2><? php echo $h2; ?></h2>

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
    <div class="coluna col4">&nbsp;</div>
</body>
</html>
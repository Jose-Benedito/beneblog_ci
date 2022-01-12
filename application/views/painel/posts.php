<?php $this->load->view('painel/header'); ?>

<div class="coluna col2">
    <ul class="sem-marcador sem-padding">
        <li><a href="<?php echo base_url('post/cadastrar'); ?>">INSERIR</a></li>
        <li><a href="<?php echo base_url('post/listar')  ?>">LISTAR</a></li>

</div>
    <div class="coluna col10">
        <h2><?php echo $h2; ?></h2>

        <?php 
            if($msg = get_msg()):
                echo '<div class="msg-box">'.$msg.'</div>';
            endif;

            switch ($tela):
                case 'listar':
                    echo 'tela de listagem';
                break;
                case 'cadastrar':
                    echo 'tela de cadastro';
                break;
                case 'editar':
                    echo 'tela de alteração';
                break;
                case 'excluir':
                    echo 'tela de exclusão';
                break;
            endswitch;

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
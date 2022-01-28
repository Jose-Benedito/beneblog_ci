<?php $this->load->view('commons/header'); ?>

<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-md-4">
<div class="container">
    <div class="page-header">
        <h1>Cadastro de Livros</h1>
    </div>
    <div class="row">
        <div class="col-md-8"> 
                  <!--Informa a action e methodo do formulário (helper) da validação -->
                  <?php echo form_open(('home/trabalheconosco')); 
                  echo form_close();
                  echo form_open_multipart();
                  echo form_label('Título:', 'titulo');
                  echo form_input('titulo', set_value('titulo'));
                  echo form_label('Autor:', 'autor');
                  echo form_input('autor', set_value('autor'));
                  echo form_label('Editora:', 'editora');
                  echo form_input('editora', set_value('editora'));
                  echo form_label('Gênero:', 'genero');
                  echo form_input('genero', set_value('genero'));
                  echo form_label('descrição:', 'descricao');
                  echo form_textarea('descricao', to_html(set_value('descricao')), array('class'=>'editorhtml'));
                  echo form_label('unidade', 'unidade');
                  echo form_input('unidade', set_value('unidade'));
                  echo form_label('data: ', 'data');
                  echo form_input('data ', set_value('data'));
                  echo form_label('Imagem do post (thumbnail):', 'imagem');
                  echo form_upload('imagem');
                  echo form_submit('enviar', 'Salvar post', array('class'=>'botao'));
                  echo form_close();?>
                <!--Informa a mensagem  da validação -->
        </div>
    <div class="col-md-4">     
        <?php 
    if($videoaula = $this->video->get(3)):
        foreach($videoaula as $linha):
            ?>
            <li>
                <img style="width: 200px; height: 300px;" src="<?php echo base_url('uploads/'.$linha->imagem);?>" alt=""/>
                <h4><?php echo to_html($linha->titulo); ?></h4>
                <p><?php echo resumo_post($linha->descricao); ?>...
            <a href="<?php echo base_url('index.php/video/'.$linha->id); ?>">veja o vídeo &raquo;</a></p>
            </li>
            <?php
        endforeach;
    else:
        echo '<p>Nenhum post cadastrado!</p>';
    endif;
    
    
    ?>

        </div>

    </div>

</div>

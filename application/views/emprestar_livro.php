
<?php $this->load->view('commons/header') ?>

<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-md-4">
<div class="container">
<div class="row">
            <div class="col-md-8">   
  
  <?php
    echo form_open_multipart();
    echo form_label('Título:', 'titulo');
    echo form_input('titulo', set_value('titulo', to_html($livro_titulo)));
    echo form_label('Usuário:', 'titulo');
    echo form_input('usuário', set_value('usuário', to_html($livro_titulo)));
    echo form_label('RA:', 'ra');
    echo form_input('ra', set_value('ra', to_html($livro_titulo)));
    echo form_label('Data:', 'data');
    echo form_input('data', set_value('titulo', to_html($livro_titulo)));
    echo form_submit('enviar', 'Salvar', array('class' => 'botao'));
    echo form_close();
    ?>

    </div>

     <div class="col-md-4">
          <h2 class="display-5"><?php echo $livro_titulo; ?></h2>
          <p class="lead"><?php echo $livro_autor; ?></p>
          <p class="lead"><?php echo $livro_genero; ?></p>    
    
          <img style="width: 200px; height: 260px;" src="<?php echo base_url('uploads/'.$livro_imagem);?>" alt=""/>
          <p class="lead"><?php echo $livro_desc; ?></p>
          
    </div>

</div>

</div> 
  


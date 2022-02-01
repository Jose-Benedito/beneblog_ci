
<?php $this->load->view('commons/header') ?>
<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-md-4">
    <div class="coluna col10">
        <h2><?php echo $h2; ?></h2>
        <div class="coluna col2">

<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-md-4">
<div class="container">
<div class="row">
  <div class="col-md-8">   
  
  <?php
    echo form_open_multipart();
    echo form_label('Id:', 'id');
    echo form_input('id', set_value('id',to_html($livros->id)));
  
    echo form_label('Nome:', 'titulo');
    echo form_input('nome', set_value('user_nome'));
    echo form_label('RA:', 'ra');
    echo form_input('ra', set_value('user_ra'));
    echo form_label('Turma:', 'turma');
    echo form_input('turma', set_value('user_turma'));
    echo form_submit('enviar', 'Salvar', array('class' => 'botao'));
    echo form_close();
    ?>

    </div>

     <div class="col-md-4">
          <h2 class="display-5"><?php echo $livros->titulo; ?></h2>
          <p class="lead"><?php echo $livros->autor; ?></p>
          <p class="lead"><?php echo $livros->genero; ?></p>    
    
          <img style="width: 200px; height: 260px;" src="<?php echo base_url('uploads/'.$livros->imagem);?>" alt=""/>
          <p class="lead"><?php echo $livros->descricao; ?></p>
          
    </div>

</div>

</div> 
  


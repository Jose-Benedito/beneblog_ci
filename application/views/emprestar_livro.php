
<?php $this->load->view('commons/header') ?>
<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-md-4">
    <div class="coluna col10">
        <h2><?php echo $h2; ?></h2>
        <div class="coluna col2">

<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-md-4">
<div class="container">
<div class="row">
  <div class="col-md-8"> 
    
  
  
    </div>

     <div class="col-md-4">
          <h2 class="display-5"><?php echo $usernome; ?></h2>
          <p class="lead"><?php echo $userturma; ?></p>
          <p class="lead"><?php echo $userlivro; ?></p>    
    
          <img style="width: 200px; height: 260px;" src="<?php echo base_url('uploads/'.$livros->imagem);?>" alt=""/>
          <p class="lead"><?php echo $usuario->usedata; ?></p>
          
    </div>

</div>

</div> 
  


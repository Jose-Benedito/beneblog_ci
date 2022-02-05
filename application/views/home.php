<?php $this->load->view('commons/header') ?>


<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-md-4">
<div class="container">
    <div class="coluna col10">
      <h2><?php echo $h2; ?></h2> 
        <div class="coluna col2">

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2" class="active"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img style="height: 500px" class="d-block w-100 " src="<?php echo base_url('assets/images/home/books.jpg')?>" alt="First slide">
    </div>
    <div class="carousel-item">
      <img style="height: 500px"  class="d-block w-100" src="<?php echo base_url('assets/images/home/lousa.jpg')?>" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img style="height: 500px"  class="d-block w-100" src="<?php echo base_url('assets/images/home/livros.jpg')?>" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>




  <h3>Últimas postagens</h3>

<ul >
    <?php 
    if($postagem = $this->post->get(3)):
        foreach($postagem as $linha):
            ?>
            <li>
                <img style="width: 500px; height: 300px;" src="<?php echo base_url('uploads/'.$linha->imagem);?>" alt=""/>
                <h4><?php echo to_html($linha->titulo); ?></h4>
                <p><?php echo resumo_post($linha->conteudo); ?>...
            <a href="<?php echo base_url('index.php/post/'.$linha->id); ?>">Leia mais &raquo;</a></p>
            </li>
            <?php
        endforeach;
    else:
        echo '<p>Nenhum post cadastrado!</p>';
    endif;
    
    ?>
 
</ul>


    <div>


</div>
</div>
</div>


<?php $this->load->view('commons/footer') ?>
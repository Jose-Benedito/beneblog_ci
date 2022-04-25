<?php $this->load->view('painel/header') ?>



  <div class="container">
    <img class="float-left"style="width:150px; heigth: 150px;" src="<?php echo base_url('assets/img/pedrabranca.png') ;?>" alt="">
    
    <h2 class="display-4 p-5" class="jumbotron text-center "><?php echo $h2; ?></h2> 
        

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2" class="active"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img style="height: 300px" class="d-block w-100 " src="<?php echo base_url('assets/images/home/books.jpg')?>" alt="First slide">
    </div>
    <div class="carousel-item">
      <img style="height: 300px"  class="d-block w-100" src="<?php echo base_url('assets/images/home/lousa.jpg')?>" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img style="height: 300px"  class="d-block w-100" src="<?php echo base_url('assets/images/home/livros.jpg')?>" alt="Third slide">
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




  <h1 class="display-4">Ler para...</h1>


  <div class="card-deck">
  <div class="card">
    <img class="card-img-top" src="<?php echo base_url('assets/images/home/kid.png')?>" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Descobrir...</h5>
      <p class="card-text">A leitura é o método mais democrático de combater a ignorância</p>
      <p class="card-text"><small class="text-muted">Marcos Vinicius Romeiro</small></p>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="<?php echo base_url('assets/images/home/girl.jpg')?>" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Transcender...</h5>
      <p class="card-text">A leitura é, provavelmente, uma outra maneira de estar em um lugar.</p>
      <p class="card-text"><small class="text-muted">José Saramago</small></p>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="<?php echo base_url('assets/images/home/teddy.jpg')?>" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Sonhar...</h5>
      <p class="card-text">A paixão da leitura é a mais inocente aprazível e a menos dispendiosa.</p>
      <p class="card-text"><small class="text-muted">Marquês de Maricá</small></p>
    </div>
  </div>
</div>



</div>
</div>
</div>
 
<?php $this->load->view('commons/footer') ?>

<?php $this->load->view('commons/header') ?>



  <div class="container">
    
    <h2 class="display-4" class="jumbotron text-center"><?php echo $h2; ?></h2> 
        

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




  <h1 class="display-4">Ler para..</h1>


  <div class="card-deck">
  <div class="card">
    <img class="card-img-top" src="<?php echo base_url('assets/images/home/kid.png')?>" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Descobrir..</h5>
      <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="<?php echo base_url('assets/images/home/girl.jpg')?>" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Transcender...</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="<?php echo base_url('assets/images/home/teddy.jpg')?>" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Sonhar..</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
</div>



</div>
</div>
</div>
 
<?php $this->load->view('commons/footer') ?>

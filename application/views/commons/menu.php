

  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">


<a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3 text-center" href="#">Biblioteca Digital  Pedra Branca</a>

<button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>



<ul class="navbar-nav-12 ">
  <li class="nav mr-auto">
    <a class="nav-link " href="<?php echo base_url('index.php/setup/login'); ?>">Administrativo</a>
  </li>
</ul>
<ul class="navbar-nav-12 ">
  <li class="nav mr-auto">
    <a class="nav-link " href="<?php echo base_url('index.php/setup/logout'); ?>">Sair</a>
  </li>
</ul>
</nav>
<div class="container-fluid">
  <div class="row">
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
    <div class="sidebar-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item">
        <li class="nav-item">
          <a class="nav-link active"  href="<?php echo base_url('index.php/'); ?>">
            <span data-feather="home"></span>
            <i class="fa-solid fa-house" style="padding:5px;" ></i>Home <span class="sr-only">(current)</span>
          </a>
        </li>
          <a class="nav-link active"  href="<?php echo base_url('index.php/livro/listar'); ?>">
            <span data-feather="acervo"></span>
           <i class="fa-solid fa-book" style="padding:5px;" ></i>Acervo<span class="sr-only">(current)</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('index.php/cadastrar_user'); ?>">
            <span data-feather="shopping-cart"></span>
             <i class="fa-solid fa-address-book" style="padding:5px;" ></i>Cadastrar
          </a>
        </li>
        <li class="nav-item">
          
          <a class="nav-link" href="<?php echo base_url('index.php/livro/pesquisar'); ?>">
            <span data-feather="users"></span>
          
             <i class="fa-solid fa-book-open" style="padding:5px;" ></i>Pesquisar livro
          </a>
        </li>

       
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('index.php/pdf/listagem'); ?>">
            <span data-feather="layers"></span>
             <i class="fa-solid fa-file-pdf" style="padding:5px;" ></i>Livros em pdf
          </a>
        </li>
      </ul>
      
      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Links</span>
        <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
          <span data-feather="plus-circle"></span>
        </a>
      </h6>
      <ul class="nav flex-column mb-2">
      <li class="nav-item">
          <a class="nav-link" href="http://beneblog.benethowen.com/">
            <span data-feather="layers"></span>
             <i class="fa-solid fa-blog" style="padding:5px;" ></i>beneblog
          </a>
      </li>
         
      <li class="nav-item">
          <a class="nav-link" href="http://pedranews.benethowen.com/">
            <span data-feather="layers"></span>
             <i class="fa-solid fa-newspaper" style="padding:5px;" ></i>PedraNews
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('index.php/user/horarios'); ?>">
            <span data-feather="layers"></span>
             <i class="fa-solid fa-calendar-check" style="padding:5px;" ></i>Horários de aula
          </a>
      </li>
      </ul>
    
     
    </div>
  </nav>

  <main role="main" class="col-md-8 ml-sm-12 col-lg-10 px-md-4"> 



  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">


<a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3 text-center" href="#">Biblioteca Pedra Branca</a>

<button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>



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
          <a class="nav-link active"  href="<?php echo base_url('index.php/'); ?>">
            <span data-feather="home"></span>
            <i class="fa-solid fa-house">home</i> <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('index.php/setup/alterar'); ?>">
            <span data-feather="file-text"></span>
            Alterar ou criar login
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('index.php/cadastrar_user'); ?>">
            <span data-feather="shopping-cart"></span>
            <i class="fa-solid fa-address-book" style="padding-right:8px;">  Cadastrar</i>
          </a>
        </li>
        <li class="nav-item">
          
          <a class="nav-link" href="<?php echo base_url('index.php/livro/pesquisar'); ?>">
            <span data-feather="users"></span>
            <i class="fa-solid fa-book-open" style="padding-right:8px;">  Pesquisar livro</i>
          
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('index.php/cadastro_livros'); ?>">
            <span data-feather="shopping-cart"></span>
            Cadastrar livros
          </a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('index.php/pdf/listagem'); ?>">
            <span data-feather="layers"></span>
            <i class="fa-solid fa-file-pdf"> Livros em pdfs</i>
          </a>
        </li>
      </ul>
      
      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Administrativo</span>
        <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
          <span data-feather="plus-circle"></span>
        </a>
      </h6>
      <ul class="nav flex-column mb-2">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('index.php/visitantes'); ?>">
            <span data-feather="file-text"></span>
            Controle de acesso da sala de leitura
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('index.php/livro/listar'); ?>">
            <span data-feather="users"></span>
            Editar dados de livros
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('index.php/pdf/cadastrar'); ?>">
            <span data-feather="users"></span>
            Cadastrar Pdfs
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('index.php/pdfs'); ?>">
            <span data-feather="users"></span>
            Editar dados de Pdfs
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('index.php/user/listar'); ?>">
            <span data-feather="bar-chart-2"></span>
            Controle de Retirada
          </a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="file-text"></span>
            Registro de entradas
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="file-text"></span>
            Year-end sale
          </a>
        </li>
      </ul>
    </div>
  </nav>

  <main role="main" class="col-md-8 ml-sm-12 col-lg-10 px-md-4"> 
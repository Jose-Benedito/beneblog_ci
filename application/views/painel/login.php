<?php $this->load->view('commons/header'); ?>


<title><?php echo $titulo ; ?></title>
</head>
<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-md-4">
<div class="container">
    <div class="page-header">
        <h1>Login</h1>
    </div>
    <hr>
  <div class="coluna col3">&nbsp;</div>
        <div class="coluna col4">
        

            <?php 
                if($msg = get_msg()):
                    echo '<div class="msg-box">'.$msg.'</div>';
                    endif;
                   echo form_open();
                    ?>

            <form  class="dropdown-menu p-4">
            <div class="mb-3">
                <label id="usuario" name="usuario" for="usuario" class="form-label">Login</label>
                <input type="text" class="form-control" for="login" id="login" name="login" value="login" placeholder="email@example.com">
                <label id="senha" name="senha" for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" value="senha" placeholder="senha">
               
                <button type="submit" class="btn btn-primary">Autenticar</button>
         
        </div>
    </form>
    
    <?php 
             echo form_close();
             ?>
            
            
            
               <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
               Launch demo modal
             </button>





             <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         ...
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         <button type="button" class="btn btn-primary">Save changes</button>
       </div>
     </div>
   </div>
 </div>
            
        </div>
    
</div>
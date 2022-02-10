<?php $this->load->view('commons/header'); ?>


  <div class="container">
    
      <h2><?php echo $h2; ?></h2>
      
       
        


          <?php
          if ($msg = get_msg()) :
            echo '<div class="msg-box">' . $msg . '</div>';
          endif;
          echo form_open();
          ?>
          <div class="row">
          <div class="col-md-6">
          <form class="form">
              <label id="usuario" name="usuario" for="usuario" class="form-label">Login</label>
              <input type="text" class="form-control" for="login" id="login" name="login" value="login" placeholder="email@example.com">
              <label id="senha" name="senha" for="senha" class="form-label">Senha</label>
              <input type="password" class="form-control" id="senha" name="senha" value="senha" placeholder="senha">

              <button type="submit" class="btn btn-primary">Autenticar</button>

            </form>
          </div>

          <?php
          echo form_close();
          ?>

        </div>
      </div>
  

  
<?php $this->load->view('commons/footer') ?>


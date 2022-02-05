<?php $this->load->view('commons/header'); ?>



<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-md-4">
  <div class="container">
    <div class="coluna col10">
      <h2><?php echo $h2; ?></h2>
      <div class="coluna col2">
        <hr>
        <div class="coluna col3">&nbsp;</div>
        <div class="coluna col4">


          <?php
          if ($msg = get_msg()) :
            echo '<div class="msg-box">' . $msg . '</div>';
          endif;
          echo form_open();
          ?>

          <form class="dropdown-menu p-4">
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

        </div>
      </div>
    </div>

  </div>

<?php $this->load->view('commons/footer') ?>
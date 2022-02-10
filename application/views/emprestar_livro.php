
<?php $this->load->view('commons/header') ?>

<div class="container">
  <h2 class="jumbotron text-center"><?php echo $h2; ?></h2> 

  <div class="table-responsive">
      <table class="table table-striped table-sm">
        <tr>
          <th>Código</th>
          <th>Nome</th>
          <th>Ra</th>
          <th>Turma</th>
          <th>Data</th>
          <th>Título</th>
          <th>Data de devolução</th>
          
          
          
        </tr>
        <?php   if (isset($dadosUsuario) && sizeof($dadosUsuario) > 0):  ?>  
          <?php foreach ($dadosUsuario as $usuario):?>
            <tr>
              <td><?php echo $usuario->id?></td>
              <td><?php echo $usuario->user_nome?></td>
              <td><?php echo $usuario->user_ra?></td>
              <td><?php echo $usuario->user_turma ?></td>
              <td><?php echo $usuario->user_data?></td>
              <td><?php echo $usuario->titulo_livro?></td>
              <td><?php echo $usuario->data_entrega?></td>
            </tr>
            <tr>
              <td><button class="btn btn-outline-primary"> <?php echo anchor('user/editar/' .$usuario->id, "Editar"); ?></button></td>
              
              <td><button class="btn btn-outline-danger"> <?php echo anchor('user/excluir/' . $usuario->id,'Excluir'); ?></button></td>
            </tr>                            
                
                  
              <?php endforeach; ?>
                  </table>
                  <?php else: ?>
                    Sem livro
                <?php endif; ?>
                    
                
                  
                  
                  
</table>
  </div>

</div>
<?php $this->load->view('commons/footer') ?>




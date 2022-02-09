
<?php $this->load->view('commons/header') ?>

<main class="main">
<div class="container">
  <h2><?php echo $h2; ?></h2> 
  <div class="row">
        
      <div class="col">
 
  

     <table class="table table-sm-bordered">
        <tr>
          <th scope="col">Código</th>
          <th scope="col">Nome</th>
          <th scope="col">Ra</th>
          <th scope="col">Turma</th>
          <th scope="col">Data</th>
          <th scope="col">Título</th>
          <th scope="col">Data de devolução</th>
          <th scope="col">Ações</th>
          
          
        </tr>
        <?php   if (isset($dadosUsuario) && sizeof($dadosUsuario) > 0):  ?>  
          <?php foreach ($dadosUsuario as $usuario):?>
            <tr scope="row">
              <td><?php echo $usuario->id?></td>
              <td><?php echo $usuario->user_nome?></td>
              <td><?php echo $usuario->user_ra?></td>
              <td><?php echo $usuario->user_turma ?></td>
              <td><?php echo $usuario->user_data?></td>
              <td><?php echo $usuario->titulo_livro?></td>
              <td><?php echo $usuario->data_entrega?></td>
              <td><button class="btn btn-outline-primary"> <?php echo anchor('user/editar/' .$usuario->id, "Editar"); ?></button></td>
              
              <td><button class="btn btn-outline-danger"> <?php echo anchor('user/excluir/' . $usuario->id,'Excluir'); ?></button></td>
                                           
                
                  
              <?php endforeach; ?>
                  </table>
                  <?php else: ?>
                    Sem livro
                <?php endif; ?>
                    
                
                  
                  
                  
</table>

</div>

</div> 
</div>
</main>



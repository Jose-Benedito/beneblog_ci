
<?php $this->load->view('commons/header') ?>
<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-md-4">
    <div class="coluna col10">
      <h2><?php echo $h2; ?></h2> 
        <div class="coluna col2">

 
  

     <table class="table">
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
              <td><a href="#"></a><button class="btn btn-success">Editar</button></td>
              <td><a href="#"></a><button class="btn btn-danger">Excluir</button></td>
                
                
                  
              <?php endforeach; ?>
                  </table>
                  <?php else: ?>
                    Sem livro
                <?php endif; ?>
                    
                
                  
                  
                  
</table>

</div>

</div> 
</main>
  


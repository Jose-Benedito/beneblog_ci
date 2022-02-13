<?php $this->load->view('commons/header')  ?>



<div class="container">
  <h2 class="jumbotron text-center"><?php echo $h2; ?></h2> 

  <?php
          if ($msg = get_msg()) :
            echo '<div class="msg-box">' . $msg . '</div>';
          endif;
          
          ?>
<!-- Modal Editar -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Visitante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!--Formulário -->
   
      <form action="visitantes/editar" method="POST">
      <div class="modal-body">
                    <input type="hidden" name="update_id" id="update_id">
                    <div class="form-group">
                      <label>Nome</label>
                      <input type="text" name="nome" id="nome"  value="nome" class="form-control" placeholder="Nome">
                    </div>
                   <div class="form-group">
                      <label>Função</label>
                      <select name="funcao" id="funcao" value="funcao" >
                        <option value="coordenador">Coordenador</option>
                        <option value="professor">Professor</option>
                        <option value="agente">Agente</option>
                        <option value="proatec">Proatec</option>
                        <option value="aluno_gremio">Aluno/grêmio</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Hora de entrada</label>
                      <input type="time" name="hora_ent" id="hora_ent" class="form-control" placeholder="hora de entrada">
                    </div> 
                    <div class="form-group">
                      <label>Hora de saída</label>
                      <input type="time" name="hora_saida" id="hora_saida" value="hora_saida"class="form-control" placeholder="hora de saída">
                    </div>
                 
                    
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit"  class="btn btn-primary editbtn ">Atualizar</button>
                  </div>
                </form>
          
        
               
    </div>
  </div>
</div>



<!-- =======================================================================================================-->


<!-- Modal Registrar -->
<div class="modal fade" id="visitanteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Visitante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!--Formulário -->
   
      <form action="visitantes/salvar" method="POST">
      <div class="modal-body">
                    
                    <div class="form-group">
                      <label>Nome</label>
                      <input type="text" name="nome" id="nome"  value="nome" class="form-control" placeholder="Nome">
                    </div>
                   <div class="form-group">
                      <label>Função</label>
                      <select name="funcao" id="funcao" >
                        <option value="coordenador">Coordenador</option>
                        <option value="professor">Professor</option>
                        <option value="agente">Agente</option>
                        <option value="proatec">Proatec</option>
                        <option value="aluno_gremio">Aluno/grêmio</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Hora de entrada</label>
                      <input type="time" name="hora_ent" id="hora_ent" class="form-control" placeholder="hora de entrada">
                    </div> -->
                    <div class="form-group">
                      <label>Hora de saída</label>
                      <input type="time" name="hora_saida" id="hora_saida" value="hora_saida"class="form-control" placeholder="hora de saída">
                    </div>
                 
                    
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="salvar" class="btn btn-primary ">Salvar</button>
                  </div>
                </form>
              
        
               
    </div>
  </div>
</div>


        <div class="container ">
            <p style="text-align:right"><?php echo date("d/m/Y"); ?>
        </div>
      <table class="table table-striped table-sm">
        <tr>
          <th>Código</th>
          <th>Nome</th>
          <th>Função</th>
          <th>hora de entrada</th>
          <th>Hora de saída</th>
          
          <th>Ação</th>
          
          
          
        </tr>
        <?php   if (isset($dadosvisita) && sizeof($dadosvisita) > 0):  ?>  
          <?php foreach ($dadosvisita as $usuario):?>
            <tr>
              <td><?php echo $usuario->id?></td>
              <td><?php echo $usuario->nome?></td>
              <td><?php echo $usuario->funcao?></td>
       
              <td><?php echo $usuario->hora_ent?></td>
              <td><?php echo $usuario->hora_saida?></td>
              
              
              <td>
              <button type="button" class="btn btn-outline-primary editbtn" data-toggle="modal" data-target="#editModal">
                  Atualizar
                </button>
              </td>

             
            </tr>
            

                            
         
                  
              <?php endforeach; ?>
                  </table>
                  <?php else: ?>
                    Sem livro
                <?php endif; ?>
                    
                
                  
                  
                  
</table>
 <!-- Button trigger modal -->
              <div class="container ">
                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#visitanteModal">
                  Novo
                </button>
                  </div>
  </div>

</div>











<script>
$('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
})



</script>



 


<?php $this->load->view('commons/footer') ?>




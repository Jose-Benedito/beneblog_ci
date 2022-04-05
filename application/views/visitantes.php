<?php $this->load->view('commons/header')  ?>



<div class="container">
  <h2 class="jumbotron text-center"><?php echo $h2; ?></h2> 

  <?php
          if ($msg = get_msg()) :
            echo '<div class="msg-box">' . $msg . '</div>';
          endif;
          
          ?>



<!-- =====================================NOVO (SALVAR)==================================================================-->


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
   
      <form action="salvar" method="POST">
      <div class="modal-body">
                    
                    <div class="form-group">
                      <label>Nome</label>
                      <input type="text" name="nome" id="nome"   class="form-control" placeholder="Nome">
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
                    </div> 
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

<!-- ==============================LISTAGEM================================-->
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
             <!-- Button trigger modal editar -->
              <button type="button" class="btn btn-outline-primary " 
                  data-toggle="modal" 
                  data-target="#editarModal" 
                  data-whatever="<?php echo $usuario->id?>"
                  data-whatevernome="<?php echo $usuario->nome?>"
                  data-whateverfuncao="<?php echo $usuario->funcao?>"
                  data-whateverhoraent="<?php echo $usuario->hora_ent?>"
                  data-whateverhorasaida="<?php echo $usuario->hora_saida?>">
                  Atualizar
                </button>
              </td>

             
            </tr>
            

                            
         
                  
              <?php endforeach; ?>
                  </table>
                  <?php else: ?>
                    Sem visitante
                <?php endif; ?>
                    
                
                  
                  
                  
</table>
  <nav aria-label="">
      <ul class="pagination ">
      
         <li class="page-item"><?php echo $this->pagination->create_links(); ?></li>
              
      </ul>
  
  </nav>
 <!-- Button trigger modal  salvar-->
              <div class="container ">
                <button type="button" class="btn btn-outline-success" 
                data-toggle="modal" 
                data-target="#visitanteModal">
                  Novo
                </button>
              </div>
            </div>
            

</div>

<!--=====================================EDITAR========================================= -->
<!-- Modal Editar -->

<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Visitante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="editar" method="POST">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nome:</label>
            <input name="nome" type="text" class="form-control" id="nome">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Funçao:</label>
                      <select name="funcao" id="funcao" >
                        <option value="coordenador">Coordenador</option>
                        <option value="professor">Professor</option>
                        <option value="agente">Agente</option>
                        <option value="proatec">Proatec</option>
                        <option value="aluno_gremio">Aluno/grêmio</option>
                      </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Hora de entrada:</label>
            <input name="hora_ent" type="time" class="form-control" id="hora_ent"></textarea>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Hora de saída:</label>
            <input name="hora_saida" type="time" class="form-control" id="hora_saida"></textarea>
          </div>
          <input name="id" type="hidden" id="id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Editar</button>
        </div>
      </form>
    </div>
  </div>
</div>



<!--=====================================JAVASCRIPT========================================= -->

<script  src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
<script  src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script>
$('#editarModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipientid = button.data('whatever') 
        var recipientnome = button.data('whatevernome')
        var recipientfuncao = button.data('whateverfuncao') 
        var recipienthoraent = button.data('whateverhoraent') 
        var recipienthorasaida = button.data('whateverhorasaida')  // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Registro: visitante ' + recipientid)
        modal.find('.modal-body input').val(recipientid)
        modal.find('#id').val(recipientid)
        modal.find('#nome').val(recipientnome)
        modal.find('#funcao').val(recipientfuncao)
        modal.find('#hora_ent').val(recipienthoraent)
        modal.find('#hora_saida').val(recipienthorasaida)
})



</script>



 


<?php $this->load->view('commons/footer') ?>




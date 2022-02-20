
<?php $this->load->view('commons/header') ?>

<div class="container">
  <h2 class=" jumbotron text-center "><?php echo $h2; ?></h2>
          <?php
          if ($msg = get_msg()) :
            echo '<div class="msg-box">' . $msg . '</div>';
          endif;
          
          ?>
  
  <table class="table table-striped table-sm">
        <tr>
          <th>Cód</th>
          <th>Nome</th>
          <th>Turma</th>
          <th>Livro</th>
          <th>Status</th>
          <th>Ação</th>
          
      
          
          
          
        </tr>
        <?php   if (isset($dadosUsuario) && sizeof($dadosUsuario) > 0):  ?>  
          <?php foreach ($dadosUsuario as $usuario):?>
            <tr>
              
              <td><?php echo $usuario->id?></td>
              <td><?php echo $usuario->user_nome?></td>
              <td><?php echo $usuario->user_turma ?></td>
              <td><?php echo $usuario->titulo_livro ?></td>
              <td><?php echo $usuario->user_status?></td> 
              
               
              
               


              <td>
             <!-- Button trigger modal editar -->
              <button type="button" class="btn btn-outline-primary " 
              data-toggle="modal" 
              data-target="#editarModal" 
              data-whatever="<?php echo $usuario->id?>"
              data-whatevernome="<?php echo $usuario->user_nome?>"
              data-whateverra="<?php echo $usuario->user_ra?>"
              data-whateverturma="<?php echo $usuario->user_turma?>"
            
              data-whatevertlivro="<?php echo $usuario->titulo_livro?>"
              data-whateverdataret="<?php echo $usuario->user_data?>"
              data-whateverdataent="<?php echo $usuario->data_entrega?>"
              data-whateverstatus="<?php echo $usuario->user_status?>">
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
<nav aria-label="">
      <ul class="pagination ">
      
         <li class="page-item"><?php echo $this->pagination->create_links(); ?></li>
              
      </ul>
  
  </nav>
  </div>

</div>
<!--=====================================33333333========================================= -->

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
        <form action="editar_retirada" method="POST">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nome:</label>
            <input name="nome" type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">RA:</label>
            <input name="ra" class="form-control" id="ra-text">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Turma:</label>
            <input name="turma" type="text" class="form-control" id="turma-text">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Título do livro:</label>
            <input name="tlivro" type="text" class="form-control" id="tlivro-text">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Data de retirada:</label>
            <input name="dataret" type="date" class="form-control" id="dataret-text">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Data de entrega:</label>
            <input name="dataent" type="date" class="form-control" id="dataent-text">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Situação:</label>
            <select name="status" type="date" class="form-control" id="status-text">
             <option>A devolver</option> 
             <option>Devolvido</option>
            </select>
          </div>
          <input name="id" type="hidden" id="id_visita">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Editar</button>
        </div>
      </form>
    </div>
  </div>
</div>



<!--=====================================33333333========================================= -->

<script  src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
<script  src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script>
$('#editarModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') 
        var recipientNome = button.data('whatevernome')
        var recipientRa = button.data('whateverra') 
        var recipientTurma = button.data('whateverturma') 
        var recipientTLivro = button.data('whatevertlivro') 
        var recipientDataEnt = button.data('whateverdataent')
        var recipientDataRet = button.data('whateverdataret') 
        var recipientStatus = button.data('whateverstatus')
         // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Emprétimos: cód. ' + recipient)
        modal.find('.modal-body input').val(recipient)
        modal.find('#id_visita').val(recipient)
        modal.find('#recipient-name').val(recipientNome)
        modal.find('#ra-text').val(recipientRa)
        modal.find('#turma-text').val(recipientTurma)
        modal.find('#tlivro-text').val(recipientTLivro)
        modal.find('#dataent-text').val(recipientDataEnt)
        modal.find('#dataret-text').val(recipientDataRet)
        modal.find('#status-text').val(recipientStatus)
       
})



</script>



 
<?php $this->load->view('commons/footer') ?>




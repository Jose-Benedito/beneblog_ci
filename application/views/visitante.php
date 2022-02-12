<?php $this->load->view('commons/header')  ?>



<div class="container">
  <h2 class="jumbotron text-center"><?php echo $h2; ?></h2> 


<!-- Modal -->
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
      <form action="user/sala_de_leitura" method="POST">
      <div class="modal-body">
                    <div class="form-group">
                      <label>Nome</label>
                      <input type="text" name="name" class="form-control" placeholder="Nome">
                    </div>
                    <div class="form-group">
                      <label>Função</label>
                      <select name="funcao" id="funcao">
                        <option value="coordenador">Coordenador</option>
                        <option value="professor">Professor</option>
                        <option value="agente">Agente</option>
                        <option value="proatec">Proatec</option>
                        <option value="aluno_gremio">Aluno/grêmio</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Hora de entrada</label>
                      <input type="time" name="data_ent" class="form-control" placeholder="Nome">
                    </div>
                    <div class="form-group">
                      <label>Hora de saída</label>
                      <input type="time" name="data_ent" class="form-control" placeholder="Nome">
                    </div>

                    
                    ...
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="salvar" class="btn btn-primary">Salvar</button>
                  </div>
                </form>
    </div>
  </div>
</div>

  
      <table class="table table-striped table-sm">
        <tr>
          <th>Código</th>
          <th>Nome</th>
          <th>Função</th>
          <th>Data</th>
          <th>Hora de entrada</th>
          <th>Hora de saída</th>
          <th>Ação</th>
          
          
          
        </tr>
        <?php   if (isset($dadosUsuario) && sizeof($dadosUsuario) > 0):  ?>  
          <?php foreach ($dadosUsuario as $usuario):?>
            <tr>
              <td><?php echo $usuario->id?></td>
              <td><?php echo $usuario->user_nome?></td>
              <td><?php echo $usuario->user_turma ?></td>
              <td><?php echo $usuario->user_data?></td>
              <td><?php echo $usuario->titulo_livro?></td>
              <td><?php echo $usuario->data_entrega?></td>

              <!-- Button trigger modal -->
              <td>
                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#visitanteModal">
                  Editar
                </button>
             </td>
            </tr>
            

                            
                          
                          
        <!-- <button class="btn btn-outline-primary"> <?php echo anchor('user/editar/' .$usuario->id, "Editar"); ?></button> -->
              
        <!-- <td><button class="btn btn-outline-danger"> <?php echo anchor('user/excluir/' . $usuario->id,'Excluir'); ?></button></td> -->
                                        
                
                  
              <?php endforeach; ?>
                  </table>
                  <?php else: ?>
                    Sem livro
                <?php endif; ?>
                    
                
                  
                  
                  
</table>
  </div>

</div>
<?php $this->load->view('commons/footer') ?>




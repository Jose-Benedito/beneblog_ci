<?php $this->load->view('commons/header'); ?>


<div class="container ">
    <h2 class="jumbotron text-center"><?php echo $h2; ?></h2>
        
      

        <?php
        if ($msg = get_msg()) :
            echo '<div class="msg-box">' . $msg . '</div>';
        endif;

        switch ($tela):
            case 'listar':
                ?>
                <div >                                             
                <button class="btn btn-outline-primary "><?php echo anchor('/livro/listar','Listar livros'); ?></button>                                         
                </div>
                <?php
                if (isset($livros) && sizeof($livros) > 0) :
                    
                   // if ($livros = $this->livro->page_livros()) :
                        foreach ($livros as $linha) :
                            ?>
                <table class="table">
                    <thead>
                        <th >Capa</th>
                        <th>Título</th>
                        <th>Gênero</th>
                        <th>Autor</th>
                        <th>Qte</th>
                        
                    </thead>
                        <tr>
                            <td><img style="width: 50px; height: 80px;" src="<?php echo base_url('uploads/' . $linha->imagem); ?>" alt="" />
                            </td>
                            <td><?php echo to_html($linha->titulo); ?></td>
                            <td><?php echo to_html($linha->genero); ?></td>
                            <td><?php echo to_html($linha->autor); ?></td>
                            <td><?php echo to_html($linha->unidade); ?></td>
                        </tr>
                        <tr>
                            <td><button class="btn btn-outline-success " ><?php echo anchor('livro/editar/' . $linha->id,'Editar'); ?></button></td>
                            <td><button class="btn btn-outline-danger"><?php echo anchor('livro/excluir/' . $linha->id, 'Excluir'); ?></button></td>
                            <td><button class="btn btn-outline-primary"><?php echo anchor('livro/emprestarLivro/' . $linha->id,'Retirar'); ?></button></td>
                        </tr>
                                                
                                             
                                        
                        <?php
                            endforeach;
                       // else :
                        //    echo '<p>Nenhum post cadastrado!</p>';
                     //   endif;


                        ?>
                </table>
            </div>
            <nav aria-label="">
                <ul class="pagination ">
                    <li class="page-link"><?php echo $this->pagination->create_links(); ?></li>
                </ul>
            </nav> 
        <?php
                else :
                    echo '<div class="msg-box"><p>Nenhum post cadastrado!</p></div>';
                endif;
                break;


            case 'pesquisar':

                ?>

                <div class="col-md-12">
                    <form class="form m-4" method="GET" action="pesquisar">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="pesquisar" placeholder="Pesquisar por título">
                            </div>
                            <div class="col-md-6">
                                 <input type="text" name="autor" placeholder="Pesquisar por autor">
                            </div>
                            
                            <div class="col-md-6">
                              <select type="text" id="genero" name="genero" value="genero">
                                <option value="drama">Drama</option>
                                <option value="romance">Romance</option>
                                <option value="ficção ">Ficção</option>
                                <option value="aventura">Aventura</option>
                                <option value="hq">HQ</option>
                                <option value="jornalístico">Jornalístico</option>
                                <option value="suspense">Suspense</option>
                                <option value="Poema">Poema</option>
                                <option value="infanto juvenil">Infanto juvenil</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success ">Pesquisar</button>
                                
                            </div>   
                        </div>     
                    </form>



                </div>
      
                <?php
                
                
            
                if (isset($livros) && sizeof($livros) > 0) :?>
                        <?php
                     if ($livros = $this->livro->busca(4)) :
                            foreach ($livros as $linha) :
                        ?>
      
                <table class="table col-sm-8">
                    <thead>
                        <th >Capa</th>
                        <th >Título</th>
                        <th >autor</th>
                        <th >Gênero</th>
                        <th >Qte</th>

                    </thead>
                    <tr>
                    <td><img style="width: 50px; height: 80px;" src="<?php echo base_url('uploads/' . $linha->imagem); ?>" alt="" />
                                                </td>
                        <td><?php echo $linha->titulo ?></td>
                        <td><?php echo $linha->autor ?></td>
                        <td><?php echo $linha->genero ?></td>
                        <td><?php echo $linha->unidade ?></td>
                    </tr>
                    <th>
                        <td><button class="btn btn-outline-success"><?php echo anchor('livro/emprestarLivro/'. $linha->id, 'RETIRAR');?></button></td>
                    </tr>

                  
                              
                        <?php
                           endforeach;
                        else :
                            echo '<p>Nenhum post cadastrado!</p>';
                        endif;


                        ?>

                </table>
          
                </div>
         <!--   <nav aria-label="">
                <ul class="pagination ">
                    <li class="page-link"><?php echo $this->pagination->create_links(); ?></li>
                </ul>
            </nav> -->
                   

        <?php
                else :
                    echo '<div class="msg-box"><p>Título inválido ou não cadastrado!</p></div>';
                endif;
                break;

            case 'cadastro_livros':
                
                echo form_open_multipart();
                echo form_label('Título:', 'titulo');
                echo form_input('titulo', set_value('titulo'));
                echo form_label('Autor:', 'autor');
                echo form_input('autor', set_value('autor'));
                echo form_label('Editora:', 'editora');
                echo form_input('editora', set_value('editora'));

                $options = [ 
                    'genero'=> $livros->genero, 
                    'drama'=> 'Drama',
                    'policial' => 'Policial',
                    'aventura' => 'Aventura',
                    'romance' => 'Romance',
                    'ficção' => 'Ficção científica',
                    'didatico' => 'Didático',
                    'hq' => 'HQ',
                    'poema' => 'Poema',
                    'terror' => 'Terror',
                    'jornalistico' => 'jornalistico'

                ];
                echo form_label('Gênero:', 'genero');
                echo form_dropdown('genero', array('genero', $options));
               
                echo form_label('Descrição:', 'descricao');
                echo form_textarea('descricao', to_html(set_value('descricao')), array('class' => 'editorhtml'));
                echo form_label('Quantidade:', 'unidade');
                echo form_input('unidade', set_value('unidade'),'w =200px');
                echo form_multiselect('id', set_value('id'));
                echo form_label('Imagem do post (thumbnail):', 'imagem');
                echo form_upload('imagem');
                echo form_submit('enviar', 'Salvar', array('class' => 'botao'));
                echo form_close();

                break;
                ?>
                
            <?php
            case 'editar':
                
             

                echo form_open();
                echo form_open_multipart();
                echo form_label('Título:', 'titulo');
                echo form_input('titulo', set_value('titulo', to_html($livros->titulo)));
                echo form_label('Autor:', 'autor');
                echo form_input('autor', set_value('autor', to_html($livros->autor)));
                echo form_label('Descrição:', 'descricao');
                echo form_textarea('descricao', to_html(set_value('descricao', to_html($livros->descricao))), array('class' => 'editorhtml'));
                echo form_label('Editora:', 'editora');
                echo form_input('editora', set_value('editora', to_html($livros->editora)));
                echo form_label('genero', 'genero');
                
                $options = [ 
                    'genero'=> $livros->genero, 
                    'drama'=> 'Drama',
                    'policial' => 'Policial',
                    'aventura' => 'Aventura',
                    'romance' => 'Romance',
                    'ficção' => 'Ficção científica',
                    'didatico' => 'Didático',
                    'hq' => 'HQ',
                    'poema' => 'Poema',
                    'terror' => 'Terror',
                    'jornalistico' => 'jornalistico'

                ];
                    
                //echo form_label('genero atual', implode(',', $option));    
                
                echo form_dropdown('genero', $options);
                echo form_label('Unidade', 'unidade');
                echo form_input('unidade', set_value('unidade', $livros->unidade));
                $local = [
                    'local'=> $livros->local, 
                    'estante1' => 'Estante 1',
                    'estante2' => 'Estante 2',
                    'estante3' => 'Estante 3',
                    'estante4' => 'Estante 4',
                ]; 
                echo form_label('Estante', 'local');     
                echo form_dropdown('local', $local);
                echo form_label('Imagem do post (thumbnail):', 'imagem');
                echo form_upload('imagem');
                // miniatura da imagem recuperada do BD
                echo '<p><small>Imagem atual:</small><br /><img src=" ' . base_url('uploads/' . $livros->imagem) . '" class="thumb-edicao"/></p>';


                echo form_submit('enviar', 'Salvar ', array('class' => 'botao btn-success'));
                echo form_close();
                break;
                ?>
                
            <?php
            case 'excluir':
                echo form_open_multipart();
                echo form_label('Título:', 'titulo');
                echo form_input('titulo', set_value('titulo', to_html($livros->titulo)));
                echo form_label('Autor:', 'autor');
                echo form_input('autor', set_value('autor', to_html($livros->autor)));
                echo form_label('Descrição:', 'descricao');
                echo form_textarea('descricao', to_html(set_value('descricao', to_html($livros->descricao))), array('class' => 'editorhtml'));
                echo form_label('Editora:', 'editora');
                echo form_input('editora', set_value('editora', to_html($livros->editora)));
                echo form_label('genero', 'genero');
                echo form_dropdown('genero', array('SELECIONE', 'Ficção científica', 'Policial', 'Drama', 'Terror', 'Didático', 'Aventura', $livros->genero));
                echo form_label('Unidade', 'unidade');
                echo form_input('unidade', set_value('unidade', $livros->unidade));
                echo form_label('Imagem do post (thumbnail):', 'imagem');
                echo form_upload('imagem');
                // miniatura da imagem recuperada do BD
                echo '<p><small>Imagem:</small><br /><img src=" ' . base_url('uploads/' . $livros->imagem) . '" class="thumb-edicao"/></p>';


                echo form_submit('enviar', 'Excluir ', array('class' => 'botao btn-danger'));
                echo form_close();
                break;
           
           
           
            case 'emprestarLivro':
            ?>
            
            <h2 class="display-5"><?php echo $livros->titulo; ?></h2>
            <p class="lead"><?php echo $livros->autor; ?></p>
            <p class="lead"><?php echo $livros->genero; ?></p>    
      
            <img style="width: 210px; height: 260px;" src="<?php echo base_url('uploads/'.$livros->imagem);?>" alt=""/>
            <p class="lead"><?php echo resumo_post($livros->descricao); ?>...</p>
         
      
         

            <?php
            
            echo form_open_multipart();
            echo form_input('pesquisar', set_value('pesquisar'));
            echo form_submit('enviar', 'Buscar nomes', array('class' => 'botao btn btn-primary btn-m'));
            
            echo form_close(); 
            ?>
           
            

        <?php
            // Busca o usuário
            if (isset($leitor) && sizeof($leitor) > 0) :
                if ($leitor = $this->leitor->busca()) :
                    foreach ($leitor as $linha) :
                    endforeach;
                    else :
                        echo '<p>Nenhum usuário cadastrado!</p>';
                    endif;
                        echo form_open();
                        echo form_open_multipart();
                        ?>

                



        <form class="form" id="form">
        
          <label for="Nome">Nome:</label>
          <input type="text" id="nome" name="nome" value="<?php echo $linha->nome ?>"/>
          <label for="ra">RA:</label>
          <input type="text" id="ra" name="ra" value="<?php echo $linha->ra ?>"/>
          <label for="turma">Ano/Turma:</label>
          <input type="text" id="turma" name="turma" value="<?php echo $linha->turma ?>"/>
          <label for="codigo">Código do livro</label>
          <input type="text" id="id" name="id" value="<?php echo $livros->id ?>"/>
          <label for="titulo">Título</label>
          <input type="text" id="titulo" name="titulo" value="<?php echo $livros->titulo ?>"/>
          <label for="Data de entrega">Data de devolução</label>
          <input id="date" type="date" name="data_entrega" value="2022-02-01">
          <button class="btn btn-primary" type="button"  onclick="apagaForm()">Limpa</button>
          <button type="submit" class="btn btn-success ">Salvar</button>
          </form>
             
            <?php
          
          
          else :
              echo '<div class="msg-box"><p>Nome de usuário inválido ou não cadastrado!</p></div>';
          
          
        endif;
        
              
                
            
            echo form_close();
            break; 
 
    endswitch;
            ?>

    </div>
</div>


<script>
function apagaForm() {
	document.getElementById('nome').value=('');
	document.getElementById('ra').value=('');
	document.getElementById('turma').value=('');
}
</script>
<?php $this->load->view('commons/footer') ?>

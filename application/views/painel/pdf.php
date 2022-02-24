

  

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
                
                <?php
                if (isset($pdfs) && sizeof($pdfs) > 0) :
                    
                   // if ($livros = $this->livro->page_livros()) :
                        foreach ($pdfs as $linha) :
                            ?>
                                    <table class="table">
                                        <thead>
                                            <th >Cod</th>
                                            <th>Título</th>
                                            <th>Autor</th>
                                            <th>Gênero</th>
                                            <th>Descrição</th>
                                            
                                            
                                            </thead>
                                            <tr>
                                                <td><?php echo to_html($linha->id); ?></td>
                                                <td><?php echo to_html($linha->titulo); ?></td>
                                                <td><?php echo to_html($linha->autor); ?></td>
                                               <td><?php echo to_html($linha->genero); ?>
                                                <td><?php echo to_html($linha->descricao); ?></td>
                                            
                                            </tr>
                                            <tr>
                                                <td><button class="btn btn-outline-success " ><?php echo anchor('pdf/editar/' . $linha->id,'Editar'); ?></button></td>
                                                <td><button class="btn btn-outline-danger"><?php echo anchor('pdf/excluir/' . $linha->id, 'Excluir'); ?></button></td>
                                           </tr>
                                                
                                             
                                        
                        <?php
                            endforeach;
                       // else :
                        //    echo '<p>Nenhum post cadastrado!</p>';
                     //   endif;


                        ?>
                    </table>
      <!--  PAGINAÇÃO    </div>
            <nav aria-label="">
                <ul class="pagination ">
                    <li class="page-link"><?php echo $this->pagination->create_links(); ?></li>
                </ul>
            </nav>  -->
        <?php
                else :
                    echo '<div class="msg-box"><p>Nenhum post cadastrado!</p></div>';
                endif;
                break;


            case 'listagem':

                ?>

                <div class="col-md-12">
                    <form class="form" method="GET" action="listagem">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" name="pesquisar" placeholder="Pesquisar por título">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success ">Pesquisar</button>
                                
                            </div>   
                        </div>     
                    </form>



                </div>
      
                <?php
                
                
            
                if (isset($pdfs) && sizeof($pdfs) > 0) :?>
                        <?php
                     if ($pdfs = $this->pdf->get(4)) :
                            foreach ($pdfs as $linha) :
                        ?>
      
                <table class="table col-md-12 col-sm-4">
                    <thead>
                        
                        <th >Título</th>
                        <th >autor</th>
                        <th >Gênero</th> 
                        <th >Descrição</th>

                    </thead>
                    <tr>
                                            
                        <td><?php echo $linha->titulo ?></td>
                        <td><?php echo $linha->autor ?></td>
                        <td><?php echo $linha->genero ?></td>
                        <td><?php echo $linha->descricao ?></td>
                        
                       <td> <a href="<?php echo base_url('./uploads/'.$linha->imagem); ?>" type="application/pdf" target="_blank" rel="external"><?php echo $linha->imagem ?></a></td>
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

            case 'cadastrar':
                
                echo form_open_multipart();
                echo form_label('Título:', 'titulo');
                echo form_input('titulo', set_value('titulo'));
                echo form_label('Autor:', 'autor');
                echo form_input('autor', set_value('autor'));
            

                $options = [ 
                    
                    'drama'=> 'Drama',
                    'policial' => 'Policial',
                    'aventura' => 'Aventura',
                    'romance' => 'Romance',
                    'ficção' => 'Ficção científica',
                    'didatico' => 'Didático',
                    'hq' => 'HQ',
                    'poema' => 'Poema',
                    'terror' => 'Terror',
                    'jornalistico' => 'Jornalistico',
                    'sociologia' => 'sociologia',
                    'historia' => 'História',
                    'filosofia'=> 'Filosofia',
                    'tecnico' => 'Técnico',
                    'programacao'=> 'Programação'

                ];
                echo form_label('Gênero:', 'genero');
                echo form_dropdown('genero', array('SELECIONE', $options));
               
                echo form_label('Descrição:', 'descricao');
                echo form_textarea('descricao', to_html(set_value('descricao')), array('class' => 'editorhtml'));
              
              //  echo form_multiselect('id', set_value('id'));
                echo form_label('Imagem do post (thumbnail):', 'imagem');
                echo form_upload('imagem');
                echo form_submit('enviar', 'Salvar', array('class' => 'botao btn btn-success'));
                echo form_close();

                break;
                ?>
                
            <?php
            case 'editar':
                
             

                echo form_open();
                echo form_open_multipart();
                echo form_label('Título:', 'titulo');
                echo form_input('titulo', set_value('titulo', to_html($pdfs->titulo)));
                echo form_label('Autor:', 'autor');
                echo form_input('autor', set_value('autor', to_html($pdfs->autor)));
                
                $options = [ 
                    'genero'=> $pdfs->genero, 
                    'drama'=> 'Drama',
                    'policial' => 'Policial',
                    'aventura' => 'Aventura',
                    'romance' => 'Romance',
                    'ficção' => 'Ficção científica',
                    'didatico' => 'Didático',
                    'hq' => 'HQ',
                    'poema' => 'Poema',
                    'terror' => 'Terror',
                    'jornalistico' => 'jornalistico',
                    'sociologia' => 'sociologia',
                    'historia' => 'História',
                    'filosofia'=> 'Filosofia',
                    'tecnico' => 'Técnico',
                    'programacao'=> 'Programação'
                    
                ];
                
                //echo form_label('genero atual', implode(',', $option));    
                
                echo form_dropdown('genero', $options); 
                echo form_label('Descrição:', 'descricao');
                echo form_textarea('descricao', to_html(set_value('descricao', to_html($pdfs->descricao))), array('class' => 'editorhtml'));
                
       
                echo form_label('Imagem do post (thumbnail):', 'imagem');
                ?>
                <input type="file" name="imagem">
                <embed type="application/pdf" src="<?php echo base_url('./uploads/'.$pdfs->imagem); ?>" >
                
                <?php
                // echo form_upload('imagem'); 
                //  miniatura da imagem recuperada do BD

                echo form_submit('enviar', 'Salvar ', array('class' => 'botao btn-success'));
                echo form_close();
                break;
                ?>
                
            <?php
            case 'excluir':
                echo form_open_multipart();
                echo form_label('Título:', 'titulo');
                echo form_input('titulo', set_value('titulo', to_html($pdfs->titulo)));
                 echo form_label('Autor:', 'autor');
                echo form_input('autor', set_value('autor', to_html($pdfs->autor))); 
                echo form_label('Descrição:', 'descricao');
               echo form_textarea('descricao', to_html(set_value('descricao', to_html($pdfs->descricao))), array('class' => 'editorhtml'));
            
                echo form_label('genero', 'genero');
                echo form_dropdown('genero', set_value('genero', to_html($pdfs->genero)));
                
                
                echo form_label('Imagem do post (thumbnail):', 'imagem');
                ?>
                <input type="file" name="imagem">
                <?php
                //echo form_upload('imagem'); 
                // miniatura da imagem recuperada do BD
                echo '<p><small>Imagem:</small><br /><img src=" ' . base_url('uploads/pdfs' . $pdfs->titulo) . '" class="thumb-edicao"/></p>';


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

                



        <form class="form">
        
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



<?php $this->load->view('commons/footer') ?>
 
                
                
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
                
            
        
            
            
            
            
            
            
            
            
           
            


  
    

    
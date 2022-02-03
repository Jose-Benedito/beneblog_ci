<?php $this->load->view('painel/header'); ?>

<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-md-4">
    <div class="coluna col10">
        <h2><?php echo $h2; ?></h2>
        <div class="coluna col2">
            
            <ul class="sem-marcador sem-padding">
                
                <li><a href="<?php echo base_url('index.php/livro/listar')  ?>">LISTAR LIVROS</a></li>
            </ul>
    
        </div>

        <?php
        if ($msg = get_msg()) :
            echo '<div class="msg-box">' . $msg . '</div>';
        endif;

        switch ($tela):
            case 'listar':
                if (isset($livros) && sizeof($livros) > 0) :
        ?>
                <table>
                    <thead>
                        <th align="left">Título</th>
                        <th align="right">Ações</th>
                    </thead>

                </table>
                    <div class="col-md-4">
                        <?php
                        if ($livros = $this->livro->get(5)) :
                            foreach ($livros as $linha) :
                        ?>
                            <li>
                                <img style="width: 100px; height: 150px;" src="<?php echo base_url('uploads/' . $linha->imagem); ?>" alt="" />
                                <h4><?php echo to_html($linha->titulo); ?></h4>
                                <p><?php echo ($linha->genero); ?>

                                <td align="right" class="acoes"><?php echo anchor('livro/editar/' . $linha->id, 'Editar'); ?> |
                                <?php echo anchor('livro/excluir/' . $linha->id, 'Excluir'); ?> |
                                <?php echo anchor('livro/emprestarLivro/' . $linha->id, 'Retirar', array('target' => '_blank')); ?> </td>
                            </li>
                        <?php
                            endforeach;
                        else :
                            echo '<p>Nenhum post cadastrado!</p>';
                        endif;


                        ?>

                    </div>
        <?php
                else :
                    echo '<div class="msg-box"><p>Nenhum post cadastrado!</p></div>';
                endif;
                break;

            case 'pesquisar':
      
                    echo form_open_multipart();
                    echo form_input('pesquisar', set_value('pesquisar'));
                    echo form_submit('enviar', 'Pesquisar', array('class' => 'botao'));
                    echo form_close();
                
                
            
                if (isset($livros) && sizeof($livros) > 0) :
                    ?>
                <table>
                    <thead>
                        <th align="left">Título</th>
                        <th align="right">Ações</th>
                    </thead>

                </table>
                    <div class="col-md-4">
                        <?php
                        if ($livros = $this->livro->busca()) :
                            foreach ($livros as $linha) :
                        ?>
                                <li>
                                    <img style="width: 100px; height: 150px;" src="<?php echo base_url('uploads/' . $linha->imagem); ?>" alt="" />
                                    <h4><?php echo to_html($linha->titulo); ?></h4>
                                    <p><?php echo ($linha->genero); ?>

                                    <td align="right" class="acoes"><?php echo anchor('livro/editar/' . $linha->id, 'Editar'); ?> |
                                    <?php echo anchor('livro/excluir/' . $linha->id, 'Excluir'); ?> |
                                    <?php echo anchor('livro/emprestarLivro/' . $linha->id, 'Retirar', array('target' => '_blank')); ?> </td>
                                </li>
                        <?php
                            endforeach;
                        else :
                            echo '<p>Nenhum post cadastrado!</p>';
                        endif;


                        ?>

                    </div>
        <?php
                else :
                    echo '<div class="msg-box"><p>Nenhum post cadastrado!</p></div>';
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
                    'ficção' => 'Ficção científica',
                    'didatico' => 'Didático',
                    'poema' => 'Poema',
                    'terror' => 'Terror',
                    'jornalistico' => 'jornalistico'

                ];
                echo form_label('Gênero:', 'genero');
                echo form_dropdown('genero', array('genero', $options));
               
                echo form_label('Descrição:', 'descricao');
                echo form_textarea('descricao', to_html(set_value('descricao')), array('class' => 'editorhtml'));
                echo form_label('Quantidade:', 'unidade');
                echo form_input('unidade', set_value('unidade'));
                echo form_multiselect('id', set_value('id'));
                echo form_label('Imagem do post (thumbnail):', 'imagem');
                echo form_upload('imagem');
                echo form_submit('enviar', 'Salvar', array('class' => 'botao'));
                echo form_close();

                break;
            case 'editar':
                echo form_open_multipart();
                echo form_label('Título:', 'titulo');
              //  echo form_input('titulo', set_value('titulo', to_html($livros->titulo)));
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
                    'ficção' => 'Ficção científica',
                    'didatico' => 'Didático',
                    'poema' => 'Poema',
                    'terror' => 'Terror',
                    'jornalistico' => 'jornalistico'

                ];
                    
                //echo form_label('genero atual', implode(',', $option));    
                
                echo form_dropdown('genero', $options);
                echo form_label('Unidade', 'unidade');
                echo form_input('unidade', set_value('unidade', $livros->unidade));
                echo form_label('Imagem do post (thumbnail):', 'imagem');
                echo form_upload('imagem');
                // miniatura da imagem recuperada do BD
                echo '<p><small>Imagem atual:</small><br /><img src=" ' . base_url('uploads/' . $livros->imagem) . '" class="thumb-edicao"/></p>';


                echo form_submit('enviar', 'Salvar ', array('class' => 'botao'));
                echo form_close();
                break;
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


                echo form_submit('enviar', 'Excluir ', array('class' => 'botao'));
                echo form_close();
                break;
           case 'emprestarLivro':
            ?>
            <div class="col-md-4" align="right">
            <h2 class="display-5"><?php echo $livros->titulo; ?></h2>
            <p class="lead"><?php echo $livros->autor; ?></p>
            <p class="lead"><?php echo $livros->genero; ?></p>    
      
            <img style="width: 200px; height: 260px;" src="<?php echo base_url('uploads/'.$livros->imagem);?>" alt=""/>
            <p class="lead"><?php echo $livros->descricao; ?></p>
            
            </div>
         

            <?php
            
              
            echo form_open_multipart();
            echo form_label('Nome:', 'titulo');
            echo form_input('nome', set_value('user_nome'));
            echo form_label('RA:', 'ra');
            echo form_input('ra', set_value('user_ra'));
         
            echo form_label('Turma:', 'turma');
            echo form_input('turma', set_value('user_turma'));
            echo form_label('Livro:', 'id');
            echo form_input('id', set_value('id',to_html($livros->id)));
            echo form_label('Titulo do livro');
            echo form_input('titulo', set_value('titulo',to_html($livros->titulo)));
            ?>
            <label for="Data de entrega">Data de devolução</label>
               <input id="date" type="date" name="data_entrega" value="2022-02-01">
               <?php
               // echo form_input('data_entrega', set_value('idata_entrega'));
            echo form_submit('enviar', 'Salvar', array('class' => 'botao'));
            echo form_close();

           
                break; 

        endswitch;





        ?>

    </div>
    <div class="coluna col3">&nbsp;</div>

    <?php $this->load->view('painel/footer'); ?>
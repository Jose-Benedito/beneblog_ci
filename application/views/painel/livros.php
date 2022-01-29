<?php $this->load->view('painel/header'); ?>

<div class="coluna col2">
    <ul class="sem-marcador sem-padding">
        <li><a href="<?php echo base_url('index.php/video/cadastrar'); ?>">INSERIR</a></li>
        <li><a href="<?php echo base_url('index.php/video/listar')  ?>">LISTAR</a></li>

</div>
    <div class="coluna col10">
        <h2><?php echo $h2; ?></h2>

        <?php 
            if($msg = get_msg()):
                echo '<div class="msg-box">'.$msg.'</div>';
            endif;

            switch ($tela):
                case 'listar':
                    if(isset($videos) && sizeof($videos) > 0):
                        ?>
                        <table>
                            <thead>
                                <th align="left">Título</th>
                                <th align="right">Ações</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($videos as $linha):
                                    ?>
                                    <tr>
                                        <td class="titulo-post"><?php echo $linha->titulo; ?> **** | </td>
                                        <td align="right" class="acoes"><?php echo anchor('video/editar/'.$linha->id, 'Editar'); ?> | 
                                        <?php echo anchor('video/excluir/'.$linha->id, 'Excluir');?> |
                                        <?php echo anchor('video/'.$linha->id, 'Ver', array('target'=>'_blank')); ?> </td>

                                    </tr>
                                    <?php
                                endforeach;    

                                ?>
                            </tbody>
                        </table>
                        <?php
                    else:
                       echo '<div class="msg-box"><p>Nenhum post cadastrado!</p></div>';
                    endif; 
                break;
                case 'cadastrar':
                    echo form_open_multipart();
                    echo form_label('Título:', 'titulo');
                    echo form_input('titulo', set_value('titulo'));
                    echo form_label('Autor:', 'autor');
                    echo form_input('autor', set_value('autor'));
                    echo form_label('Editora:', 'editora');
                    echo form_input('editora', set_value('editora'));
                    echo form_label('Gênero:', 'genero');
                    echo form_input('genero', set_value('genero'));
                    echo form_label('Descrição:', 'descricao');
                    echo form_textarea('descricao', to_html(set_value('descricao')), array('class'=>'editorhtml'));
                    echo form_label('Quantidade:', 'unidade');
                    echo form_input('unidade', set_value('unidade'));
                  
                    echo form_label('Imagem do post (thumbnail):', 'imagem');
                    echo form_upload('imagem');
                    echo form_submit('enviar', 'Salvar', array('class'=>'botao'));
                    echo form_close(); 

                break;
                case 'editar':
                    echo form_open_multipart();
                    echo form_label('Título:', 'titulo');
                    echo form_input('titulo', set_value('titulo', to_html($videos->titulo)));
                    echo form_label('Descrição:', 'descricao');
                    echo form_textarea('descricao', to_html(set_value('descricao', to_html($videos->descricao))), array('class'=>'editorhtml'));
                    echo form_label('link', 'link');
                    echo form_input('link', set_value('link', $videos->link));
                    echo form_label('data', 'data');
                    echo form_input('data', set_value('data', $videos->data));
                    echo form_label('Imagem do post (thumbnail):', 'imagem');
                    echo form_upload('imagem');
                    // miniatura da imagem recuperada do BD
                    echo '<p><small>Imagem atual:</small><br /><img src=" '.base_url('uploads/'.$videos->imagem).'" class="thumb-edicao"/></p>';
                    
             
                    echo form_submit('enviar', 'Salvar vídeo', array('class'=>'botao'));
                    echo form_close();
                break;
                case 'excluir':
                    echo form_open_multipart();
                    echo form_label('Título:', 'titulo');
                    echo form_input('titulo', set_value('titulo', to_html($videos->titulo)));
                    echo form_label('Descricao:', 'descricao');
                    echo form_textarea('descricao', to_html(set_value('descricao', to_html($videos->descricao))), array('class'=>'editorhtml'));
                    echo form_label('link', 'link');
                    echo form_input('link', set_value('link'));
                    echo form_label('data', 'data');
                    echo form_input('data', set_value('data'));
                    // miniatura da imagem recuperada do BD
                    echo '<p><small>Imagem:</small><br /><img src=" '.base_url('uploads/'.$videos->imagem).'" class="thumb-edicao"/></p>';
                    
             
                    echo form_submit('enviar', 'Excluir vídeo', array('class'=>'botao'));
                    echo form_close();
                break;
            endswitch;

        



        ?>
        
    </div>
<div class="coluna col3">&nbsp;</div>

<?php $this->load->view('painel/footer'); ?>
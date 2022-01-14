<?php $this->load->view('painel/header'); ?>

<div class="coluna col2">
    <ul class="sem-marcador sem-padding">
        <li><a href="<?php echo base_url('index.php/post/cadastrar'); ?>">INSERIR</a></li>
        <li><a href="<?php echo base_url('index.php/post/listar')  ?>">LISTAR</a></li>

</div>
    <div class="coluna col10">
        <h2><?php echo $h2; ?></h2>

        <?php 
            if($msg = get_msg()):
                echo '<div class="msg-box">'.$msg.'</div>';
            endif;

            switch ($tela):
                case 'listar':
                    if(isset($posts) && sizeof($posts) > 0):
                        ?>
                        <table>
                            <thead>
                                <th align="left">Título</th>
                                <th align="right">Ações</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($posts as $linha):
                                    ?>
                                    <tr>
                                        <td class="titulo-post"><?php echo $linha->titulo; ?></td>
                                        <td align="right" class="acoes"><?php echo anchor('post/editar/'.$linha->id, 'Editar'); ?> | 
                                        <?php echo anchor('post/excluir/'.$linha->id, 'Excluir');?> |
                                        <?php echo anchor('postagem/'.$linha->id, 'Ver', array('target'=>'_blank')); ?> </td>

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
                    echo form_label('Conteúdo:', 'conteudo');
                    echo form_textarea('conteudo', to_html(set_value('conteudo')), array('class'=>'editorhtml'));
                    echo form_label('Imagem do post (thumbnail):', 'imagem');
                    echo form_upload('imagem');
                    echo form_submit('enviar', 'Salvar post', array('class'=>'botao'));
                    echo form_close();

                break;
                case 'editar':
                    echo 'tela de alteração';
                break;
                case 'excluir':
                    echo form_open_multipart();
                    echo form_label('Título:', 'titulo');
                    echo form_input('titulo', set_value('titulo', to_html($posts->titulo)));
                    echo form_label('Conteúdo:', 'conteudo');
                    echo form_textarea('conteudo', to_html(set_value('conteudo', to_html($posts->conteudo))), array('class'=>'editorhtml'));
                    // miniatura da imagem recuperada do BD
                    echo '<p><small>Imagem:</small><br /><img src=" '.base_url('uploads/'.$posts->imagem).'" class="thumb-edicao"/></p>';
                    
             
                    echo form_submit('enviar', 'Excluir post', array('class'=>'botao'));
                    echo form_close();
                break;
            endswitch;

        



        ?>
        
    </div>
<div class="coluna col3">&nbsp;</div>

<?php $this->load->view('painel/footer'); ?>
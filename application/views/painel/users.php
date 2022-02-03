<?php $this->load->view('painel/header'); ?>

<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-md-4">
    <div class="coluna col10">
        <h2><?php echo $h2; ?></h2>
        <div class="coluna col2">
            <ul class="sem-marcador sem-padding">
                
                <li><a href="<?php echo base_url('index.php/User/listar')  ?>">LISTAR USUÁRIOS</a></li>
            </ul>
    
        </div>

        <?php
        if ($msg = get_msg()) :
            echo '<div class="msg-box">' . $msg . '</div>';
        endif;

        switch ($tela):
            case 'listar':
                if (isset($users) && sizeof($users) > 0) :
        ?>
                    <table>
                        <thead>
                            <th align="left">Título</th>
                            <th align="right">Ações</th>
                        </thead>

                    </table>
                    <div class="col-md-4">
                        <?php
                        if ($users = $this->user->get(5)) :
                            foreach ($users as $linha) :
                        ?>
                                <li>
                                   
                                    <h4><?php echo to_html($linha->user_nome); ?></h4>
                                    <p><?php echo ($linha->user_turma); ?>

                                        <td align="right" class="acoes"><?php echo anchor('user/editar/' . $linha->id, 'Editar'); ?> |
                                            <?php echo anchor('user/excluir/' . $linha->id, 'Excluir'); ?> |
                                            <?php echo anchor('user/emprestar_Livro/' . $linha->id, 'Ver', array('target' => '_blank')); ?> </td>
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
                                                        <?php echo anchor('user/excluir/' . $linha->id, 'Excluir'); ?> |
                                                        <?php echo anchor('user/' . $linha->id, 'Ver', array('target' => '_blank')); ?> </td>
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

            case 'cadastrar_users':
                echo form_open();
                echo form_label('Nome Completo:', 'nome');
                echo form_input('nome', set_value('nome'));
                echo form_label('RA:', 'ra');
                echo form_input('ra', set_value('ra'));
                echo form_label('Ano/Turma:', 'turma');

                echo form_input('turma', set_value('turma'));
                echo form_label('Telefone:', 'telefone');
                echo form_input('telefone', set_value('telefone'));
                echo form_submit('cadastrar', 'cadastrar >>', array('class'=> 'botao')); 
                echo form_close();

         
                break;
            case 'editar':
                echo form_open_multipart();
                echo form_open();
                echo form_label('Nome Completo:', 'nome');
                echo form_input('nome', set_value('nome', to_html($users->user_nome)));
                echo form_label('RA:', 'ra');
                echo form_input('ra', set_value('ra', to_html(($users->user_ra))));
                echo form_label('Ano/Turma:', 'turma', to_html($users->user_turma));

                $options = [ 
                    'atual' => $users->user_turma,
                    '5'=> '5ª A',
                    '5b' => '5ª B',
                    '6a' => '6ª A',
                    '6b' => '6ª B',
                    '7a' => '7ª A',
                    '7b' => '7ª B',
                    '7c' => '7ª C',
                    '8a' => '8ª A'

                ];
                echo form_dropdown('turma', array('turma',$options));
                echo form_label('Telefone:', 'telefone');
                echo form_input('telefone', set_value('telefone', to_html($users->user_telefone)));
                echo form_submit('cadastrar', 'cadastrar >>', array('class'=> 'botao')); 
                echo form_close();
                break;
            case 'excluir':
                echo form_open_multipart();
                echo form_open();
                echo form_label('Nome Completo:', 'nome');
                echo form_input('nome', set_value('nome', to_html($users->user_nome)));
                echo form_label('RA:', 'ra');
                echo form_input('ra', set_value('ra', to_html(($users->user_ra))));
                echo form_label('Ano/Turma:', 'turma', to_html($users->user_turma));

                $options = [ 
                    'atual' => $users->user_turma,
                    '5'=> '5ª A',
                    '5b' => '5ª B',
                    '6a' => '6ª A',
                    '6b' => '6ª B',
                    '7a' => '7ª A',
                    '7b' => '7ª B',
                    '7c' => '7ª C',
                    '8a' => '8ª A'

                ];
                echo form_dropdown('turma', array('turma',$options));
                echo form_label('Telefone:', 'telefone');
                echo form_input('telefone', set_value('telefone', to_html($users->user_telefone)));
                echo form_submit('excluir', 'Excluir >>', array('class'=> 'botao')); 
                echo form_close();

             
                break;
               
        endswitch;





        ?>

    </div>
    <div class="coluna col3">&nbsp;</div>

    <?php $this->load->view('painel/footer'); ?>
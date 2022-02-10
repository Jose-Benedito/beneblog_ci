<?php $this->load->view('commons/header'); ?>


    <div class="container">
        <div class="page-header">
            <h1>Cadastro de Livros</h1>
        </div>

        <img style="height: 200px" src="<?php echo base_url('assets/images/home/lousa.jpg')?>" class="img-fluid" alt="">
        <div class="row">
            <div class="col-md-8">
                <?php
                if ($msg = get_msg()) :
                    echo '<div class="msg-box">' . $msg . '</div>';
                endif;

                ?>
                <!--Informa a action e methodo do formulário (helper) da validação -->
                <?php echo form_open();
                echo form_close();
                echo form_open_multipart();
                echo form_label('Título:', 'titulo');
                echo form_input('titulo', set_value('titulo'));
                echo form_label('Autor:', 'autor');
                echo form_input('autor', set_value('autor'));
                echo form_label('Editora:', 'editora');
                echo form_input('editora', set_value('editora'));


                $options = [ 
                     
                    'drama'=> 'Drama',
                    'policial' => 'Policial',
                    'aventura' => 'Aventura',
                    'ficção' => 'Ficção científica',
                    'didatico' => 'Didático',
                    'terror' => 'Terror',
                    'poema' => 'Poema',
                      'hq' => 'HQ',  
                    'jornalistico' => 'jornalistico',
                    'infanto-juvenil' => 'Infanto-Juvenil'

                ];
                echo form_label('Gênero:', 'genero');
                echo form_dropdown('genero', array('genero', $options));
                echo form_label('Descrição:', 'descricao');
                echo form_textarea('descricao', to_html(set_value('descricao')), array('class' => 'editorhtml'));
                echo form_label('Quantidade:', 'unidade');
                echo form_input('unidade', set_value('unidade'));
                //echo form_multiselect('id', array('slecione o livro'));
                //echo form_dropdown('id', array( 'selecione', 'filme', 'drama'));
                echo form_label('Imagem do post (thumbnail):', 'imagem');
                echo form_upload('imagem');
                echo form_submit('enviar', 'Salvar', array('class' => 'botao'));
                echo form_close(); ?>
                <!--Informa a mensagem  da validação -->
            </div>
            <div class="col-md-4">
                <h4>Ultimos cadastrados</h4>
                <?php
                if ($livros = $this->livro->get(2)) :
                    foreach ($livros as $linha) :
                ?>
                             
                        <li>
                            <h5><?php echo to_html($linha->titulo); ?></h5>
                            <img style="width: 130px; height: 180px;" src="<?php echo base_url('uploads/' . $linha->imagem); ?>" alt="" />
                            <p><?php echo ($linha->genero); ?></p>
                            <p><?php echo resumo_post($linha->descricao); ?></p>
                        </li>
                <?php
                    endforeach;
                else :
                    echo '<p>Nenhum post cadastrado!</p>';
                endif;


                ?>

            </div>

        </div>

    </div>

    <?php $this->load->view('commons/footer') ?>
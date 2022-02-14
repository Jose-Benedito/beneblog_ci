<?php $this->load->view('commons/header'); ?>


    <div class="container ">
  <h2 class="jumbotron text-center"><?php echo $h2; ?></h2> 
        
        
        <div class="row">
            <div class="col-8">
        <img style="height: 200px" src="<?php echo base_url('assets/images/home/lousa.jpg')?>" class="img-fluid" alt="">
                <?php
                if ($msg = get_msg()) :
                    echo '<div class="msg-box">' . $msg . '</div>';
                endif;
                    echo form_open_multipart()
                ?>
                <!--Informa a action e methodo do formulário (helper) da validação -->
            

            
                <form class="form" action="/cadastro_livros" method="post" enctype="multipart/form-data">
                        
                <label for="Titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="titulo" />
                <label for="Autor">Autor:</label>
                <input type="text" id="autor" name="autor" placeholder="autor"/>
                <label for="editora">Editora:</label>
                <input type="text" id="editora" name="editora" placeholder="editora"/>
                <label for="genero">Gênero:</label>

                <select type="text" id="genero" name="genero" placeholder="genero">
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

                <label for="descricao">Descrição:</label>
                <textarea type="text" id="descricao" name="descricao" placeholder="descricao"></textarea>
                <label for="unidade">Quantidade:</label>
                <input type="text" id="unidade" name="unidade" placeholder="unidade"/>
   
                
                <label for="local">Estante</label>
                <select type="text" id="local" name="local" placeholder="local">
                    <option value="estante 1">Estante 1</option>
                    <option value="estante 2">Estante 2</option>
                    <option value="estante 1">Estante 3</option>
                    <option value="estante 2">Estante 4</option>
                    <option value="estante 2">Estante 5</option>
                </select>

                <label for="imagem">Imagem da capa (thumbnail):</label>
                <input type="file" id="imagem" name="imagem" name="imagem" value="imagem"/>
                <button class="button btn-success" type="submit" value="salvar">Salvar</button>
                </form>

                <?php echo form_close()  ?>


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
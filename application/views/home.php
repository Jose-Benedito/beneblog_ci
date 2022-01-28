<?php $this->load->view('commons/header') ?>



<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-md-4">


  <h3>Últimas postagens</h3>

<ul >
    <?php 
    if($postagem = $this->post->get(3)):
        foreach($postagem as $linha):
            ?>
            <li>
                <img style="width: 500px; height: 300px;" src="<?php echo base_url('uploads/'.$linha->imagem);?>" alt=""/>
                <h4><?php echo to_html($linha->titulo); ?></h4>
                <p><?php echo resumo_post($linha->conteudo); ?>...
            <a href="<?php echo base_url('index.php/post/'.$linha->id); ?>">Leia mais &raquo;</a></p>
            </li>
            <?php
        endforeach;
    else:
        echo '<p>Nenhum post cadastrado!</p>';
    endif;
    
    ?>
 
</ul>


    <div>
<!--
  <h3>Últimas videoaulas</h3>

<ul class="sem-marcador">
    <?php 
    if($videoaula = $this->video->get(3)):
        foreach($videoaula as $linha):
            ?>
            <li>
                <img style="width: 300px; height: 200px;" src="<?php echo base_url('uploads/'.$linha->imagem);?>" alt=""/>
                <h4><?php echo to_html($linha->titulo); ?></h4>
                <p><?php echo resumo_post($linha->descricao); ?>...
            <a href="<?php echo base_url('index.php/video/'.$linha->id); ?>">veja o vídeo &raquo;</a></p>
            </li>
            <?php
        endforeach;
    else:
        echo '<p>Nenhum post cadastrado!</p>';
    endif;
    
    ?>
 
</ul>
    </div>
-->
</main>

<?php $this->load->view('commons/footer') ?>
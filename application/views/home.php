<?php $this->load->view('commons/header') ?>


<main role="main" class="inner cover">
  <h1 class="cover-heading">Apredendo através da prática.</h1>
  <p class="lead">Até aqui aprendi como criar um <i>controlller</i>, uma <i>view</i>e usar a função <i>base_url</i> do helper <i>url</i> utilizando o livro "Codeigniter:
    Produtivividade na criação de aplicações web em PHP".</p>
  <a href="#" class="btn btn-lg btn-secondary">Learn more</a>
  </p>

  <h3>Últimas postagens</h3>

<ul class="sem-marcador">
    <?php 
    if($postagem = $this->post->get(3)):
        foreach($postagem as $linha):
            ?>
            <li>
                <img style="width: 300px; height: 200px;" src="<?php echo base_url('uploads/'.$linha->imagem);?>" alt=""/>
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

<section>
    <div>

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
</section>
</main>

<?php $this->load->view('commons/footer') ?>
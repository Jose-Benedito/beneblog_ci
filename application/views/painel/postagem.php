<?php $this->load->view('commons/header') ?>

<main role="main" class="inner cover">
<div>
    <section>
        <div class="coluna col8">
            <h2><?php echo $post_titulo; ?></h2>
                <?php echo $post_conteudo; ?>
    
        </div>
        <div class="sem-marcador">
          <h3>Dados do post</h3>
            <img style="width: 400px; height: 200px;" src="<?php echo base_url('uploads/'.$post_imagem);?>" alt="<?php echo $post_titulo; ?>" />
                       
            <ul>
                <li>Publicada em: <?php echo $post_data; ?> </li>
                
            </ul>
        </div>
    </div>
    </section>

    
</main>

<?php $this->load->view('commons/footer') ?>
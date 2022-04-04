<?php $this->load->view('commons/header'); ?>

<div class="container">
    <h2 class="jumbotron text-center"><?php echo $h2; ?></h1>
<?php  

    if($msg = get_msg()):

        echo '<div class="msg-box" >'.$msg.' </div>'; 
    endif;


?>
</div>

<?php $this->load->view('commons/footer'); ?>

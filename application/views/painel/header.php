<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/cover.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/servico.css'); ?>">
     <link rel="stylesheet" href="<?php echo base_url('assets/css/painel.css'); ?>">
     <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-te-1.4.0.css'); ?>">
     <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-te-3.6.0.min.js') ?>"></script>
     <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-te-1.4.0.min.js') ?>"></script>
    
    <title><?php echo $titulo ; ?></title>
</head>

<body >

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                <?php $this->load->view('painel/menu') ?>
            </div>
        </header>
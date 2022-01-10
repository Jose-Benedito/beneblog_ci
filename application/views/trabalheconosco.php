<?php $this->load->view('commons/header'); ?>

<div class="container">
    <div class="page-header">
        <h1>Trabalhe Conosco</h1>
    </div>
    <div class="row">
        <div class="col-md-8"> 
                  <!--Informa a action e methofo do formulário (helper) da validação -->
                  <?php echo form_open(('home/trabalheconosco')); 
                  echo form_close();?>
                <!--Informa a mensagem  da validação -->

            <form class="form-horizontal"  action="">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="nome">Nome</label>
                    <div class="col-md-8">
                        <input id="nome" name="nome" placeholder="Nome" class="form-control input-md" required="" type="text"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="email">Email</label>
                    <div class="col-md-8">
                        <input id="email" name="email" placeholder="Email" class="form-control input-md" required="" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="assunto">Assunto</label>
                    <div class="col-md-8">
                        <input id="assunto" name="assunto" placeholder="Assunto" class="form-control input-md" required="" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="mensagem">Mensagem</label>
                    <div class="col-md-8">
                        <textArea id="mensagem" name="mensagem" class="form-control" row="10"></textArea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="nome">Nome</label>
                    <div class="col-md-10">
                        <input type="submit" value="Enviar" class="btn btn-default pull-right">
                    </div>
                </div>

            </form>

        </div>
        <div class="col-md-4">
            <h4>Telefones</h4>
            <p>+55 99 9999-9999 | +55 88 8888-8888</p>
            <hr/>
            <h4>E-mail</h4>
            <p>contato@empresa.com.br</p>
            <hr/>
            <h4>Endereço</h4>
            <p>R. Quinze de Novembro - Praia da Costa, Vila Velha - ES</p>
            <hr/>

        </div>

    </div>

</div>

<?php $this->load->view('commons/footer'); ?>
<?= $this->conf->get_alertas(); ?>

<form action="" method="post">
    <div class="card text-secondary border-secondary mb-3">
        <div class="card-header"><h3>Configurações Gerais</h3></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">


                    <div class="form-group">
                        <label>Diretorio padrao</label>
                        <input type="text" class="form-control" name="dir" value="<?= $conf->dir; ?>">
                    </div>


                </div>

                <div class="col-md-6">

                </div>
            </div>
            <div style="float: right;">
                <input type="submit" class="btn btn-outline-success" name="enviar" value="Salvar">
            </div>
        </div>
    </div>
    
</form>

<div class="card text-danger border-danger mb-3">
    <div class="card-header"><h3>Limpar base de dados</h3></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <b>Quantidade de registros: </b><?= $this->conf->qtde_registros(); ?>


            </div>

            <div class="col-md-6">
                <b>Deseja limpar a base de dados?</b> 
                <a href="<?= base_url(); ?>admin/confirm" class="btn btn-outline-danger">Sim, limpar base de dados</a>

            </div>
        </div>
    </div>
</div>
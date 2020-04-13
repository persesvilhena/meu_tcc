<?= $this->conf->get_alertas(); ?>
<form action="" method="post">
    <div class="row">
        <div class="col-md-12">

            <div class="card text-secondary border-secondary mb-3">
                <div class="card-header">
                    <div style="float: left;">
                        <h3>Tipos extraídos</h3>
                    </div>
                    <div style="float: right;">
                        <a href="<?= base_url(); ?>admin/limpeza" class="btn btn-outline-info">VOLTAR</a>
                    </div>
                </div>
                <div class="card-body">
                
                    <?php foreach ($tipos as $n) { ?>
                        <div class="form-group">
                            <label><b>Coluna: </b><?= $n->coluna; ?></label>
                            <textarea class="form-control" name="<?= $n->coluna; ?>"><?= $n->tipos; ?></textarea>
                        </div>
                    <?php } ?>
                    <div style="float: right;">
                        <input type="submit" class="btn btn-outline-success" name="enviar" value="Salvar">
                    </div>
                </div>
            </div>

        </div>
    </div>
    
</form>
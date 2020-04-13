<?= $this->conf->get_alertas(); ?>


<div class="card text-danger border-danger mb-3">
    <div class="card-header"><h3>Tem certeza que deseja limpar a base de dados?</h3></div>
    <div class="card-body">
        <div style="float: left;">
            <form action="<?= base_url(); ?>admin/config_geral" method="post">
                <input type="submit" class="btn btn-outline-danger" name="apagar" value="Sim, limpar base de dados">
            </form>
        </div>

        <div style="float: right;">
            <a href="<?= base_url(); ?>admin/config_geral" class="btn btn-outline-danger">Cancelar</a>

        </div>
    </div>
</div>
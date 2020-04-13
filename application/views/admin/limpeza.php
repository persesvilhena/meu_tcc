<div class="row">
    <div class="col-md-12">
        <!--<div class="card text-secondary border-secondary mb-3">
            <div class="card-header"><h3>Extrair valores distintos</h3></div>
            <div class="card-body">
                <a onclick="ajax('extrai', 'operacoes', 'extrai');" href="#" class="btn btn-outline-info">EXTRAI TIPOS</a>
                <div style="float: right;" id="extrai"></div>
            </div>
        </div>-->

        <div class="card text-secondary border-secondary mb-3">
            <div class="card-header"><h3>Ver valores distintos</h3></div>
            <div class="card-body">
                <a href="<?= base_url(); ?>admin/extraindo" class="btn btn-outline-info">VER TIPOS</a>
            </div>
        </div>

        <div class="card text-secondary border-secondary mb-3">
            <div class="card-header"><h3>Realizar processo de limpeza</h3></div>
            <div class="card-body">
                <a onclick="ajax('limpeza', 'operacoes', 'limpeza');" href="#" class="btn btn-outline-info">LIMPAR</a>
                <div style="float: right;" id="limpeza"></div>
            </div>
        </div>

        <div class="card text-success border-success mb-3" id="next_step" style="display: none;">
            <div class="card-header"><h3>Realizar a análise</h3></div>
            <div class="card-body" align="right">
                <a href="<?= base_url(); ?>painel/analise" class="btn btn-outline-success">CONTINUAR</a>
            </div>
        </div>

    </div>
</div>
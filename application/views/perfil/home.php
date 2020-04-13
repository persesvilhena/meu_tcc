<div class="row">
    <div class="col-md-12">
        <?= $this->conf->get_alertas(); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card text-secondary border-secondary mb-3">
            <div class="card-header"><h3 style="float: left;">Perfil</h3>
                <div style="float: right;">
                    <a href="<?= base_url(); ?>perfil/editar/" class="btn btn-outline-primary">Editar meu perfil</a>
                </div>
            </div>
            <div class="card-body">
                <b>Login:</b> <?= $user->login; ?><br>
                <b>Nome:</b> <?= $user->nome; ?><br>
                <b>Sobre:</b> <?= $user->sobre; ?><br>
            </div>
        </div>
    </div>
</div>
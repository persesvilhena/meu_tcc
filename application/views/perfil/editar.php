<div class="row">
    <div class="col-md-12">
        <div class="card text-secondary border-secondary mb-3">
            <div class="card-header"><h3 style="float: left;">Editar perfil</h3>
                <div style="float: right;">
                    <a href="<?= base_url(); ?>perfil/" class="btn btn-outline-primary">Voltar</a>
                </div>
            </div>
            <div class="card-body">
                <form action="" method="post" accept-charset="utf-8">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label>Login</label>
                                <input class="form-control" type="text" name="login" value="<?= $user->login; ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Nome</label>
                                <input class="form-control" type="text" name="nome" value="<?= $user->nome; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Sobre</label>
                                <textarea class="form-control" type="text" name="sobre"><?= $user->sobre; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-outline-success btn-block" name="alterar" value="Salvar">
                </form>
            </div>
        </div>
    </div>
</div>
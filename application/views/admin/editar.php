<div class="row">
    <div class="col-md-12">
        <?= $this->conf->get_alertas(); ?>
        <div class="card text-secondary border-secondary mb-3">
            <div class="card-header"><h3 style="float: left;">Editar perfil</h3>
                <div style="float: right;">
                    <a href="<?= base_url(); ?>admin/users" class="btn btn-outline-primary">Voltar</a>
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
                            <div class="col-md-12">
                                <label>E-mail</label>
                                <input class="form-control" type="text" name="email" value="<?= $user->email; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Sobre</label>
                                <textarea class="form-control" type="text" name="sobre"><?= $user->sobre; ?></textarea>
                            </div>
                            <div class="col-md-6">
                                <label>Ativação</label>
                                <select class="form-control" name="ativo">
                                    <option value="0" <?php if($user->ativo == 0){ echo "selected"; } ?>>Inativo</option>
                                    <option value="1" <?php if($user->ativo == 1){ echo "selected"; } ?>>Ativo</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Administrador</label>
                                <select class="form-control" name="adm">
                                    <option value="0" <?php if($user->adm == 0){ echo "selected"; } ?>>NÃO</option>
                                    <option value="1" <?php if($user->adm == 1){ echo "selected"; } ?>>SIM</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-outline-success btn-block" name="alterar" value="Salvar">
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card text-danger border-danger mb-3">
            <div class="card-header"><h3 style="float: left;">Apagar usuário</h3></div>
            <div class="card-body">
                Remover usuário? <a class="btn btn-outline-danger" href="#" data-toggle="modal" data-target="#apagarUser">Apagar</a>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="apagarUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apagar usuário?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Tem certeza que deseja remover o usuário?</div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <form action="" method="post">
                    <input type="submit" name="apagar" class="btn btn-outline-danger" value="Apagar usuário">
                </form>
            </div>
        </div>
    </div>
</div>

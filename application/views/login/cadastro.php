<div class="container">

    <div class="card card-register mx-auto mt-5">
        <div class="card-header">Cadastre-se</div>
        <div class="card-body">
            <?= $this->logar_model->get_alertas(); ?>
            <form action="" method="post" accept-charset="utf-8">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="exampleInputPassword1">E-mail*</label>
                            <input class="form-control" type="email" name="email" required="required">
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputLastName">Senha*</label>
                            <input class="form-control" type="password" name="senha" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="exampleInputPassword1">Nome*</label>
                            <input class="form-control" type="text" name="nome" required="required">
                        </div>
                        
                        <div class="col-md-12">
                            <label for="exampleConfirmPassword">Sobre</label>
                            <textarea class="form-control" type="text" name="sobre"></textarea>
                        </div>
                    </div>
                </div>
                *Campos obrigatórios <br><br>
                <input type="submit" class="btn btn-primary btn-block" name="cadastrar" value="Cadastrar">
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="<?= base_url(); ?>home/logar">Voltar para página de login</a>
            </div>
        </div>
    </div>
</div>
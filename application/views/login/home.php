  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Fazer login</div>
      <div class="card-body">
        <?php
            if(isset($this->session->userdata['avisos'])){
                $avisos = $this->session->userdata['avisos'];
                foreach ($avisos as $a) { ?>
                    <div class="alert alert-<?= $a['type']; ?> alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Aviso!</strong> <?= $a['message']; ?>
                    </div>
                <?php
                }
                $this->session->set_userdata('avisos', null);
            } 
            if (isset($aviso)) {
                ?>
                <div class="alert alert-<?php echo $tipo; ?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $aviso; ?>
                </div>
                <?php
            }
        ?>
        <form action="<?= base_url(); ?>home/login" id="formlogin" method="post" accept-charset="utf-8">
          <div class="form-group">
            <label for="exampleInputEmail1">E-mail</label>
            <input class="form-control" id="exampleInputEmail1" type="text" placeholder="E-mail" name="login">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Senha</label>
            <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Senha" name="senha">
          </div>
          <input type="submit" name="entrar" class="btn btn-primary btn-block" value="Entrar">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="<?= base_url(); ?>home/cadastro">Cadastrar</a>
        </div>
      </div>
    </div>
  </div>





<!--<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Tables</li>
</ol>-->


<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Usuários
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>E-mail</th>
                        <th>Nome</th>
                        <th>Sobre</th>
                        <th>Administrador</th>
                        <th>Ativo</th>
                        <th>Operações</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>E-mail</th>
                        <th>Nome</th>
                        <th>Sobre</th>
                        <th>Administrador</th>
                        <th>Ativo</th>
                        <th>Operações</th>
                    </tr>
                </tfoot>
                <tbody>
                    
                    <?php foreach ($this->adm_model->users() as $n) { ?>
                        <tr>
                            <td><?= $n->email; ?></td>
                            <td><?= $n->nome; ?></td>
                            <td><?= $n->sobre; ?></td>
                            <?php if($n->adm == 1){ echo "<td><span class=\"badge badge-success\">SIM</span></td>"; }else{ echo "<td><span class=\"badge badge-danger\">NÃO</span></td>"; } ?>
                            <?php if($n->ativo == 1){ echo "<td><span class=\"badge badge-success\">SIM</span></td>"; }else{ echo "<td><span class=\"badge badge-danger\">NÃO</span></td>"; } ?>
                            <td><a href="<?= base_url(); ?>admin/editar/<?= $n->id; ?>" class="btn btn-outline-primary">Editar</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted"></div>
</div>

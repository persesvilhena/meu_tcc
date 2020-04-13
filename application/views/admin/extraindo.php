<?= $this->conf->get_alertas(); ?>
<form action="" method="post">
    <div class="row">
        <div class="col-md-12">
            <div class="card text-secondary border-secondary mb-3">
                <div class="card-header"><h3>Extraindo valores distintos...</h3></div>
                <div class="card-body">
                    Por favor aguarde...
                    <div style="float: right;" id="extrai"></div>
                </div>
            </div>

            <script type="text/javascript">
                ajax('extrai', 'operacoes', 'extrai', '<?= base_url(); ?>admin/tipos');
            </script>

            

        </div>
    </div>
    
</form>
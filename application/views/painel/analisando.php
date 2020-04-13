<div class="row">
	<div class="col-md-12">
		<?= $this->conf->get_alertas(); ?>


		<div class="card text-secondary border-secondary mb-3">
			<div class="card-header"><h3>Realizando análise...</h3></div>
			<div class="card-body">
				Estamos buscando as regras de associação, por favor aguarde...<br>
				Este processo pode levar alguns minutos!
				<!--<a onclick="ajax('weka', 'operacoes', 'weka');" href="#" class="btn btn-outline-info">REALIZAR ANÁLISE</a>-->
                <div style="float: right;" id="weka"></div>
			</div>
		</div>

		<div class="card text-success border-success mb-3" id="next_step" style="display: none;">
			<div class="card-header"><h3>Visualizar a análise</h3></div>
			<div class="card-body" align="right">
				<a href="<?= base_url(); ?>painel/regras" class="btn btn-outline-success">CONTINUAR - VER ANÁLISE</a>
			</div>
		</div>

		<script type="text/javascript">
            ajax('weka', 'operacoes', 'weka', '<?= base_url(); ?>painel/ultima_analise');
        </script>

		
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>


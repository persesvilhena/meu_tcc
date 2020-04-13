<div class="row">
	<div class="col-md-12">
		<?= $this->conf->get_alertas(); ?>
		<div class="card text-secondary border-secondary mb-3">
			<div class="card-header"><h3>Análise</h3></div>
			<div class="card-body">
				<form action="" class="form-horizontal" method="post"> 

					<div class="form-group">
						<label style="width: 100%;"><b>Escolha os editais a serem analisados:</b>
							<br>
							<div style="width: 50%; float: left;">Editais a serem selecionados</div>
							<div style="width: 45%; float: right;">Editais selecionados para análise</div>
						</label>
						<select id='pre-selected-options' multiple='multiple' name="editais[]">
							<?php foreach ($this->conf->editais() as $n) {
								if(in_array($n->edital, $this->conf->user()->es_editais)){
									echo "<option selected>".$n->edital."</option>";
								}else{
									echo "<option>".$n->edital."</option>";
								}
					            
					        } ?>
						</select>
					</div>

					<div class="form-group">
						<label style="width: 100%;"><b>Escolha os campus a serem analisados:</b>
							<br>
							<div style="width: 50%; float: left;">Campus a serem selecionados</div>
							<div style="width: 45%; float: right;">Campus selecionados para análise</div>
						</label>
						<select id='pre-selected-options1' multiple='multiple' name="campus[]">
							<?php foreach ($this->conf->campus() as $n) {
								if(in_array($n->nome, $this->conf->user()->es_campus)){
									echo "<option selected>".$n->nome."</option>";
								}else{
									echo "<option>".$n->nome."</option>";
								}
					        } ?>
						</select>
					</div>
					
					<div class="form-group">
						<div style="float: right;">
							<input type="submit" class="btn btn-outline-success" name="salvar" value="Realizar análise">
						</div>
					</div>
				</form>
			</div>
		</div>

		<!--<div class="card text-secondary border-secondary mb-3">
			<div class="card-header"><h3>Gerar Arquivo Arff</h3></div>
			<div class="card-body">
				<a onclick="ajax('gerar', 'operacoes', 'gerar');" href="#" class="btn btn-outline-info">GERAR ARQUIVO ARFF</a>
                <div style="float: right;" id="gerar"></div>
			</div>
		</div>--

		<div class="card text-secondary border-secondary mb-3">
			<div class="card-header"><h3>Realizar análise</h3></div>
			<div class="card-body">
				<a onclick="ajax('weka', 'operacoes', 'weka');" href="#" class="btn btn-outline-info">REALIZAR ANÁLISE</a>
                <div style="float: right;" id="weka"></div>
			</div>
		</div>

		<div class="card text-success border-success mb-3" id="next_step" style="display: none;">
			<div class="card-header"><h3>Visualizar a análise</h3></div>
			<div class="card-body" align="right">
				<a href="<?= base_url(); ?>painel/regras" class="btn btn-outline-success">CONTINUAR - VER ANÁLISE</a>
			</div>
		</div>-->
		
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>


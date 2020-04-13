<div class="row">
	<div class="col-md-12">
		<div class="card text-secondary border-secondary mb-3">
			<div class="card-header"><h3>Upload</h3></div>
			<div class="card-body">
				<form action="#" class="form-horizontal"> 
					<div class="form-group">
						<label>Campus</label>
						<select name="campus" class="form-control">
							<?php foreach ($this->conf->campus() as $n) { ?>
								<option value="<?= $n->id; ?>"><?= $n->nome; ?></option>
							<?php } ?>
						</select>
					</div>
					
					<div class="form-group">
						<label>Arquivo CSV <small>O arquivo CSV deve possuir no máximo 100Mb</small></label>
						<input type="file" name="arquivo" class="form-control" accept=".csv" required="required">
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="progress progress-striped active">
							<div class="progress-bar" style="width: 0%">
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div style="float: right;">
							<button type="submit" class="btn btn-outline-success upload" name="upload">Fazer upload</button>
						</div>
					</div>
				</form>
			</div>
		</div>


		<div class="card text-secondary border-secondary mb-3">
			<div class="card-header"><h3>Processar arquivo CSV</h3></div>
			<div class="card-body">
				<a onclick="ajax('insercao', 'operacoes', 'insercao');" href="#" class="btn btn-outline-info">PROCESSAR ARQUIVO CSV</a>
                <div style="float: right;" id="insercao"></div>
			</div>
		</div>

		<div class="card text-success border-success mb-3" id="next_step" style="display: none;">
			<div class="card-header"><h3>Realizar a limpeza de dados</h3></div>
			<div class="card-body" align="right">
				<a href="<?= base_url(); ?>admin/limpeza" class="btn btn-outline-success">CONTINUAR</a>
			</div>
		</div>

		
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
	$(document).on('submit', 'form', function (e) {
		e.preventDefault();
		//Receber os dados
		$form = $(this);				
		var formdata = new FormData($form[0]);
		
		//Criar a conexao com o servidor
		var request = new XMLHttpRequest();
		
		//Progresso do Upload
		request.upload.addEventListener('progress', function (e) {
			var percent = Math.round(e.loaded / e.total * 100);
			$form.find('.progress-bar').width(percent + '%').html(percent + '%');
		});
		
		//Upload completo limpar a barra de progresso
		request.addEventListener('load', function(e){
			$form.find('.progress-bar').addClass('progress-bar-success').html('upload completo...');
			//Atualizar a página após o upload completo
			setTimeout("window.open(self.location, '_self');", 1000);
		});
		
		//Arquivo responsável em fazer o upload da imagem
		request.open('post', '<?= base_url(); ?>admin/faz_upload');
		request.send(formdata);
	});
</script>

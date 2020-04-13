<?php
$regras = $this->conf->regras();
?>

<div class="card text-secondary border-secondary mb-3">
    <div class="card-header"><h3>Regras de associação extraídas</h3></div>
    <div class="card-body">
		<?= $this->conf->get_alertas(); ?>
		<table class="table table-hover">
			<thead>
				<tr>
					<th scope="col">Análise</th>
					<th scope="col">Operações</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($regras as $i => $n) { ?>
					<tr>
						<td>Análise feita em: <?= date('H:i:s d/m/Y', strtotime($n->datetime)); ?></td>
						<td>
							<form action="" method="post">
								<a href="<?= base_url(); ?>painel/ver/<?= $n->id; ?>" class="btn btn-outline-primary">Visualizar</a> 
								<input type="hidden" name="id" value="<?= $n->id; ?>">
								<input type="submit" name="apagar" value="Apagar" class="btn btn-outline-danger">
							</form>
						</td>
					</tr>
				<?php }?>
			</tbody>
		</table>
    </div>
</div>


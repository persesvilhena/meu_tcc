<div class="card text-secondary border-secondary mb-3">
    <div class="card-header">
    	<h3 style="float: left;">Visualizando análise</h3>
    	<div style="float: right;">
			<a href="<?= base_url(); ?>painel/regras" class="btn btn-outline-primary">Voltar</a>
		</div>
	</div>

    <?php if(count($regras) != 0){ ?>        
	<div class="card-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th scope="col">Regras</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($regras as $i => $n) { ?>
					<tr>
						<td>
							Em <b><?= $n->porcentagem; ?>%</b> das vezes em que apareceu 
								<?php foreach ($n->se_s as $j => $m){ 
									if($j > 1){
										echo " e <b>". $m."</b>"; 
									}else{
										echo "<b>". $m."</b>"; 
									}
								} ?>
								então também apareceu
								<?php foreach ($n->entao_s as $j => $m){
									if($j > 1){
										echo " e <b>". $m."</b>"; 
									}else{
										echo "<b>". $m."</b>"; 
									}
								} ?>
						</td>
					</tr>

				<?php }?>
			</tbody>
		</table>
    </div>
    <?php }else{
        echo "<div class=\"card-body\">Infelizmente com as restrições e a base de dados usadas para realizar esta análise não foi possível obter regras de associação suficientes para a visualização dos resultados! Tente realizar uma nova análise com menos restrições ou realimentar a base de dados!<br>Veja possíveis restrições que estão impedindo a análise:<br>1. Base de dados insuficiente, sua base de dados possui ".$this->conf->qtde_registros()." registros, o recomendável é que possua no mínimo 1000 registros!<br>2. Poucos editais ou campus selecionados, tente aumentar seu horizonte de dados selecionados escolhendo mais editais ou campus!<br>3. Verifique sua configuração do algoritmo Apriori, seu valor de quantidade de regras, confiança e suporte podem restringir sua análise!</div>";
    }
    ?>


    <!--
    <div class="card-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Porcentagem</th>
					<th scope="col">Se</th>
					<th scope="col">Então</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($regras as $i => $n) { ?>
					<tr>
						<th scope="row"><?= $i; ?></th>
						<td><?= $n->porcentagem; ?></td>
						<td><?php foreach ($n->se_s as $m){ echo $m."<hr>"; } ?></td>
						<td><?php foreach ($n->entao_s as $m){ echo $m."<hr>"; } ?></td>
					</tr>

				<?php }?>
			</tbody>
		</table>
    </div>
	-->
</div>    

<!--<pre>
    <?php 
    var_dump($regras);
    $elementos = array();
    foreach ($regras as $i => $n) {
    	foreach ($n->se_s as $j => $m) {
    		if(!isset($elementos[$m])){
    			$elementos[$m] = $n->se_qtde;
    		}else{
    			$elementos[$m] = $elementos[$m] + $n->se_qtde;
    		}
    	}
    	foreach ($n->entao_s as $j => $m) {
    		if(!isset($elementos[$m])){
    			$elementos[$m] = $n->entao_qtde;
    		}else{
    			$elementos[$m] = $elementos[$m] + $n->entao_qtde;
    		}
    	}
    }
    var_dump($elementos);

    $relacao = array();
    foreach ($regras as $i => $n) {
    	$temp = array();

    	foreach ($n->se_s as $j => $m) {
    		array_push($temp, $m);
    	}
    	foreach ($n->entao_s as $j => $m) {
    		array_push($temp, $m);
    	}

    	foreach ($temp as $m) {
    		foreach ($temp as $o) {
    			if($m != $o){
    				$obj = new StdClass;
    				$obj->a = $m;
    				$obj->b = $o;
    				array_push($relacao, $obj);
    			}
    		}
    	}
    }
    var_dump($relacao);
    ?>
</pre>-->



<?php if(count($regras) != 0){ ?>

<div class="card text-secondary border-secondary mb-3">
    <div class="card-header">
        <h3 style="float: left;">Grafo gerado</h3>
    </div>

    <div class="card-body">

        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>assets/grafo/stylesheets/style.css"/>
        <style type="text/css">
        circle.node {
          cursor: pointer;
          stroke: #000;
          stroke-width: .5px;
        }

        circle.node.directory {
          stroke: #9ecae1;
          stroke-width: 2px;
        }

        circle.node.collapsed {
          stroke: #555;
        }

        .nodetext {
          fill: #252929;
          font-weight: bold;
          text-shadow: 0 0 0.2em white;
        }

        line.link {
          fill: none;
          stroke: #9ecae1;
          stroke-width: 1.5px;
        }
        </style>

        <div id="visualization"></div>


        <script type="text/javascript" src="<?= base_url(); ?>assets/grafo/javascripts/d3/d3.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/grafo/javascripts/d3/d3.geom.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/grafo/javascripts/d3/d3.layout.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/grafo/javascripts/CodeFlower.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/grafo/javascripts/dataConverter.js"></script>
        <script type="text/javascript">
          var currentCodeFlower;
          var createCodeFlower = function(json) {
            if (currentCodeFlower) currentCodeFlower.cleanup();

            var total = countElements(json);
            //w = parseInt(Math.sqrt(total) * 100, 10);
            h = parseInt(Math.sqrt(total) * 100, 10);
            w = parseInt(document.getElementById('visualization').clientWidth);
            //h = parseInt(document.getElementById('visualization').clientHeight);

            currentCodeFlower = new CodeFlower("#visualization", w, w).update(json);
          };

          d3.json('<?= base_url()."painel/ver_json/".$id; ?>', createCodeFlower);

        </script>
    </div>
</div>
<pre>
<?php
function valor($var){
    $res = explode(")", $var);
    return $res[0];
}
foreach ($regras as $i => $n) { 
    if(isset($n->par)){
        $n->par = htmlspecialchars($n->par);
        
        $aux = $n->par;
        //var_dump($aux);
        $pos_conf = strpos($aux, 'conf:(') + 6;
        $aux = substr($aux, $pos_conf);
        $valor_conf = valor($aux);

        $pos_lift = strpos($aux, 'lift:(') + 6;
        $aux = substr($aux, $pos_lift);
        $valor_lift = valor($aux);

        $pos_lev = strpos($aux, 'lev:(') + 5;
        $aux = substr($aux, $pos_lev);
        $valor_lev = valor($aux);

        $pos_conv = strpos($aux, 'conv:(') + 6;
        $aux = substr($aux, $pos_conv);
        $valor_conv = valor($aux);

        $obj = new StdClass;
        $obj->conf = $valor_conf;
        $obj->lift = $valor_lift;
        $obj->lev = $valor_lev;
        $obj->conv = $valor_conv;

        $n->param = $obj;
    }
}
?>
</pre>

<div class="card text-secondary border-secondary mb-3">
    <div class="card-header">
        <h3 style="float: left;">Regras (avançado)</h3>
    </div>

    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Porcentagem</th>
                    <th scope="col">Se</th>
                    <th scope="col">Então</th>
                    <th scope="col">Confiança</th>
                    <th scope="col">Lift</th>
                    <th scope="col">Convicção</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($regras as $i => $n) { ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $n->porcentagem; ?></td>
                        <td><?php foreach ($n->se_s as $m){ echo $m."<hr>"; } ?></td>
                        <td><?php foreach ($n->entao_s as $m){ echo $m."<hr>"; } ?></td>
                        <td><?php if(isset($n->param)){ echo $n->param->conf; } ?></td>
                        <td><?php if(isset($n->param)){ echo $n->param->lift; } ?></td>
                        <td><?php if(isset($n->param)){ echo $n->param->conv; } ?></td>
                    </tr>

                <?php }?>
            </tbody>
        </table>
        
    </div>

    <div class="card-footer">
        <b>Confiança:</b> É a frequência que quando ocorre "se" também ocorre "então".<br>
        <b>Lift:</b> Indica o quanto mais frequente torna-se "então", quando "se" ocorre.<br>
        <b>Convicção:</b> Razão da frequência esperada que "se" ocorre sem "então".
    </div>
</div>
<?php } ?>
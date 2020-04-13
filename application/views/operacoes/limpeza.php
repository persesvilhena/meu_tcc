<?php
$dados = $this->conf->ver();
foreach ($dados as $n) {
	$cont = 0;
	$apagar = 0;
	foreach ($n as $coluna => $v) {
		if($v == null){
			$cont++;
		}else{
			if($coluna != "campus"){
				if($this->conf->verifica_tipo($coluna, $v)){
					$apagar = 1;
				}
			}
		}
	}
	if(($cont > 2) || ($apagar == 1)){
		$this->conf->apagar($n->inscricao);
	}
}
echo "ok";
?>
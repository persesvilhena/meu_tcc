<?php
function fmt($dados){
	$res = "";
	foreach ($dados as $n) {
		$valor = str_replace(",", ".", $n->valores);
		$res .= "\"".$valor . "\", ";
	}
	return substr($res, 0, -2);
}
function att($colunas){
	$ci =& get_instance();
	$colunas = str_replace(" ", "", $colunas);
	$colunas = explode(",", $colunas);
	$res = "";
	foreach ($colunas as $n) {
		$res .= "@attribute ".$n." {".fmt($ci->conf->valores($n))."}\n";
	}
	return $res;
}
function gera_arquivo($colunas){
	$ci =& get_instance();
	$conteudo = "@relation teste\n\n" . att($colunas) . "

	@data
	". $ci->conf->retorna_dados($colunas);
	file_put_contents('arquivo.arff', $conteudo);
}


	gera_arquivo('edital, nomecurso, sexo, cidade, local_origem, tipo_instituicao, renda, pessoas_familia, familia_residencia, cursou_fundamental, escolheu_curso, escolheu_if, vestibular_if, apoio_social, pretende_residir, apos_matricula, atividades_profissao, antes_entrar, menor, pai, mae, atividade_remunerada, sua_participacao, exercer_atividade, sustento, automovel, le, leitura, micro, internet, seletivo, especiais, etnia, sabendo');
	//gera_arquivo('edital, nomecurso, sexo, estado, cidade, local_origem, tipo_instituicao, renda, pessoas_familia, familia_residencia, cursou_fundamental, escolheu_curso, escolheu_if, vestibular_if, apoio_social, pretende_residir, apos_matricula, atividades_profissao, antes_entrar, menor, pai, mae, atividade_remunerada, sua_participacao, exercer_atividade, sustento, automovel, le, leitura, micro, internet, seletivo, especiais, etnia, sabendo');
	echo "o";

?>
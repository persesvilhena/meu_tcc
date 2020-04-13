<?php
$this->conf->limpa_tabela_tipos();
function valores($coluna){
	$ci =& get_instance();
	//$this->db->distinct($coluna);
	$sql = "SELECT DISTINCT `$coluna` as valores FROM `questionario` ";
	$res = $ci->db->query($sql)->result();
	return $res;
}
function fmt($dados){
	$res = "";
	foreach ($dados as $n) {
		//$valor = str_replace(",", "-", $n->valores);
		$valor = $n->valores;
		$res .= "\"".$valor . "\", ";
	}
	return substr($res, 0, -2);
}
function extrai($colunas){
	$ci =& get_instance();
	$colunas = str_replace(" ", "", $colunas);
	$colunas = explode(",", $colunas);
	foreach ($colunas as $n) {
		$ci->conf->insere_tabela_tipos($n, fmt(valores($n)));
	}
}

extrai('edital, nomecurso, sexo, estado, cidade, local_origem, tipo_instituicao, renda, pessoas_familia, familia_residencia, cursou_fundamental, escolheu_curso, escolheu_if, vestibular_if, apoio_social, pretende_residir, apos_matricula, atividades_profissao, antes_entrar, menor, pai, mae, atividade_remunerada, sua_participacao, exercer_atividade, sustento, automovel, le, leitura, micro, internet, seletivo, especiais, etnia, sabendo');

echo "ok";
?>
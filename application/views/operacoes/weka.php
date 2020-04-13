<?php
//$dir = json_decode($this->conf->ver_conf(2)->data)->dir; $this->conf->ver_conf(1)->data
$conf = json_decode($user->apriori);
$regra = $conf->car ." ". $conf->outputItemSets ." ". $conf->removeAllMissingCols ." ". $conf->treatZeroAsMissing ." ". $conf->verbose; 
$regra .= " -c ".$conf->classIndex." -D ".$conf->delta." -T ".$conf->metricType." -C ".$conf->minMetric." -N ".$conf->minRules." -S ".$conf->significanceLevel." -U ".$conf->upperBoundMinSupport." -M ".$conf->lowerBoundMinSupport;
$var = shell_exec("java -classpath weka/weka.jar weka.associations.Apriori -t arquivo.arff -B ".$regra);
//echo "java -classpath weka/weka.jar weka.associations.Apriori -t arquivo.arff -B".$regra;
//echo "<pre>";
//var_dump($var);
$asdasd = explode("\n", $var);
//var_dump($asdasd);
$rasd = array_slice($asdasd, 18, -6);
//var_dump($rasd);
//echo "</pre>";


echo "<pre>";
var_dump($rasd);
echo "</pre>";
foreach ($rasd as $n) {
	echo htmlspecialchars($n)."<br><br>";
}
$novas_regras = array();

foreach ($rasd as $i => $n) {
	$obj = new stdClass;
	$pos_conf = strpos($n, "<conf:(");
	$obj->porcentagem = (float)(substr($n, ($pos_conf + 7), 4)) * 100;
	$pos_tal = strpos($n, "==>");
	$obj->se = substr($n, 3, ($pos_tal - 4));
	$obj->entao = substr($n, ($pos_tal + 4), ($pos_conf - ($pos_tal + 4)));
	$obj->par = substr($n, $pos_conf);

	preg_match_all("/([0-9])+/", $obj->se, $res, PREG_OFFSET_CAPTURE);
	$obj->se_qtde = $res[0][0][0];
	$se_pos = $res[0][0][1];
	$obj->se = substr($obj->se, 0, $se_pos);

	preg_match_all("/([0-9])+/", $obj->entao, $res, PREG_OFFSET_CAPTURE);
	$obj->entao_qtde = $res[0][0][0];
	$entao_pos = $res[0][0][1];
	$obj->entao = substr($obj->entao, 0, $entao_pos);



	$novas_regras[$i] = $obj;

}

$ind = array(
	'edital' => 'Edital:', 
	'nomecurso' => 'Curso:', 
	'sexo' => 'Sexo:', 
	'estado' => 'Estado:', 
	'cidade' => 'Cidade:',
	'local_origem' => 'Local de Origem:',
	'tipo_instituicao' => 'Tipo de instituição de ensino em que cursou maior parte de sua vida acadêmica:',
	'renda' => 'Qual sua renda familiar?',
	'pessoas_familia' => 'Quantas pessoas, incluindo você, vivem da renda mensal do seu grupo familiar?',
	'familia_residencia' => 'Sua família possui residência:',
	'cursou_fundamental' => 'Cursou ensino fundamental?',
	'escolheu_curso' => 'Por que você escolheu esse curso?',
	'escolheu_if' => 'Por que escolheu o IFSULDEMINAS?',
	'vestibular_if' => 'Já prestou vestibular no IFSULDEMINAS?',
	'apoio_social' => 'Tem interesse em se inscrever em algum apoio social?',
	'pretende_residir' => 'Como pretende residir na cidade do campus no qual se inscreveu?',
	'apos_matricula' => 'Após a matrícula, qual transporte você pretende utilizar durante o curso?',
	'atividades_profissao' => 'Você conhece as atividades que pode desenvolver na profissão que está escolhendo?',
	'antes_entrar' => 'Antes de entrar na escola, você residia com seus pais?',
	'menor' => 'Caso seja menor, quem é responsável por você?',
	'pai' => 'Grau de Instrução do Pai:',
	'mae' => 'Grau de Instrução da Mãe:',
	'atividade_remunerada' => 'Você exerce alguma atividade remunerada?',
	'sua_participacao' => 'Qual a sua participação na vida econômica de seu grupo familiar?',
	'exercer_atividade' => 'Se trabalha, qual idade começou a exercer atividade remunerada?',
	'sustento' => 'Quem é o responsável pelo sustento de sua família?',
	'automovel' => 'A família possui automóvel?',
	'le' => 'Você lê, por ano, além dos textos escolares?',
	'leitura' => 'Que tipo de leitura?',
	'micro' => 'Quanto ao uso de microcomputador:',
	'internet' => 'Com que frequência você utiliza a Internet?',
	'seletivo' => 'O que achou do processo de inscrição para o processo seletivo?',
	'especiais' => 'Possui alguma dessas necessidades especiais citadas abaixo?',
	'etnia' => 'Etnia:',
	'sabendo' => 'Como ficou sabendo do Vestibular?'
);



foreach ($novas_regras as $i => $n) {
	foreach ($ind as $j => $m) {
		$n->se = str_replace($j."=", chr(254).$m." ", $n->se);
		$n->entao = str_replace($j."=", chr(254).$m." ", $n->entao);
		$n->se_s = explode(chr(254), $n->se);
		$n->entao_s = explode(chr(254), $n->entao);
	}
	unset($n->se_s[0]);
	unset($n->entao_s[0]);
	$n->se = $n->se_s;
	$n->entao = $n->entao_s;
}



$json = json_encode($novas_regras);
//echo "<pre>";
//var_dump($novas_regras);
//echo "</pre>";
$res = $this->conf->insere_regra(json_encode($novas_regras));
?>
k
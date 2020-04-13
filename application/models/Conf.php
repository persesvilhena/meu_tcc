<?php

class Conf extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function user(){
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('id', $this->session->userdata['id']);
        $res = $this->db->get()->result()[0];
        $res->es_campus = json_decode($res->es_campus);
        $res->es_editais = json_decode($res->es_editais);
        return $res;
    }

    function inserir($data){
    	$dados = array(
            'campus' => $this->user->campus,
    		'edital' => $data[0],
    		'inscricao' => $data[1],
    		'nomecurso' => $data[2],
    		'aluno_id' => $data[3],
    		'nasc' => $data[4],
    		'sexo' => $data[5],
    		'estado' => $data[6],
    		'cidade' => $data[7],
    		'local_origem' => $data[9]
    	);
    	$this->db->insert('questionario', $dados);
    }

    function alterar($id, $nome, $dado){
    	$dados = array(
            'campus' => $this->user->campus,
    		$nome => $dado
    	);
    	$this->db->where('inscricao', $id);
		$this->db->update('questionario', $dados);
    }

    function linha($data, $coluna){
    	$id = $data[1];
    	if($this->verifica($id)){
    		$this->alterar($id, $coluna, $data[9]);
    	}else{
    		$this->inserir($data);
    	}
    }

    function verifica($id){
    	$this->db->select('*');
    	$this->db->from('questionario');
    	$this->db->where('inscricao', $id);
    	if(isset($this->db->get()->result()[0])){
    		return 1;
    	}else{
    		return 0;
    	}
    }

    function ver(){
    	$this->db->select('*');
    	$this->db->from('questionario');
    	//$this->db->limit('200');
    	return $this->db->get()->result();
    }

    function apagar($id){
    	$this->db->where('inscricao', $id);
        $this->db->delete('questionario');
        return $this->db->affected_rows();
    }

    function editais(){
        $sql = "SELECT DISTINCT edital FROM `questionario`";
        return $this->db->query($sql)->result();
    }



    function where_campus(){
        $campus = $this->conf->user()->es_campus;
        $res = "";
        foreach ($campus as $n) {
            $res .= "`nome` = '".$n."' OR";
        }
        $res = substr($res, 0, -2);
        return $res;
    }
    function where_editais(){
        $editais = $this->conf->user()->es_editais;
        $res = "";
        foreach ($editais as $n) {
            $res .= "`edital` = '".$n."' OR";
        }
        $res = substr($res, 0, -2);
        return $res;
    }


    function valores($coluna){
    	//$this->db->distinct($coluna);
    	$sql = "
        SELECT DISTINCT `$coluna` as valores 
        FROM `questionario` 
        INNER JOIN campus ON campus.id = questionario.campus
        WHERE (".$this->where_editais().") 
        AND (".$this->where_campus().")
        ";
    	$res = $this->db->query($sql)->result();
    	return $res;
    }

    function dados($colunas){
    	//$this->db->select($colunas);
    	//$this->db->from('questionario');
    	//$this->db->limit('200');
        //$this->db->query('where `edital` LIKE "%2015%"');
        //return $this->db->get()->result();

        $sql = "
        SELECT $colunas 
        FROM `questionario` 
        INNER JOIN campus ON campus.id = questionario.campus
        WHERE (".$this->where_editais().") 
        AND (".$this->where_campus().")
        ";
        $res = $this->db->query($sql)->result();
    	return $res;
    }
    function retorna_dados($colunas){
    	$dados = $this->dados($colunas);
    	//var_dump(count($dados));
    	$res = "";
    	foreach ($dados as $n) {
    		foreach ($n as $z) {
    			$z = str_replace(",", ".", $z);
    			$res .= "\"". $z . "\", ";
    		}
    		$res = substr($res, 0, -2);
    		$res .= "\n";
    		//echo $res;
    	}
    	return $res;
    }



    function campus(){
        $this->db->select('*');
        $this->db->from('campus');
        return $this->db->get()->result();
    }
    function alt_campus($id){
        $data = array(
            'campus' => $id
        );
        $this->db->where('id', $this->session->userdata['id']);
        $this->db->update('usuario', $data);
        return $this->db->affected_rows();
    }











    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////// TIPOS ///////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function tabela_tipos(){
        $this->db->select('*');
        $this->db->from('questionario_tipos');
        return $this->db->get()->result();
    }
    function altera_tipo($coluna, $tipos){
        $dados = array(
            'tipos' => $tipos
        );
        $this->db->where('coluna', $coluna);
        $this->db->update('questionario_tipos', $dados);
        return $this->db->affected_rows();
    }
    function altera_todos_tipos($dados){
        $res = 0;
        foreach ($dados as $coluna => $tipo) {
            $res = $res + $this->altera_tipo($coluna, $tipo);
            //var_dump($this->altera_tipo($coluna, $tipo));
        }
        return $res;
    }
    
    function limpa_tabela_tipos(){
    	$sql = "TRUNCATE questionario_tipos";
    	$res = $this->db->query($sql);
    	//return $res;
    }

    function insere_tabela_tipos($coluna, $tipos){
    	$dados = array(
    		'coluna' => $coluna,
    		'tipos' => $tipos
    	);
    	$this->db->insert('questionario_tipos', $dados);
    }
    function ver_tipos($coluna){
    	$this->db->select('*');
    	$this->db->from('questionario_tipos');
    	$this->db->where('coluna', $coluna);
    	//$this->db->limit('200');
    	$res = $this->db->get()->result()[0]->tipos;
        return json_decode('['.$res.']');
    }
    function verifica_tipo($coluna, $tipo){
    	if($coluna == "inscricao" || $coluna == "aluno_id" || $coluna == "nasc"){
    		return 0;
    	}else{
	    	$var = in_array($tipo, $this->ver_tipos($coluna));
	    	if($var == 0){
	    		return 1;
	    	}else{
	    		return 0;
	    	}
	    }
    }










    function alt_conf($dados){
        $data = array(
            'apriori' => $dados
        );
        $this->db->where('id', $this->session->userdata['id']);
        $this->db->update('usuario', $data);
        return $this->db->affected_rows();
    }
    function alt_conf_geral($dados){
        $data = array(
            'config' => $dados
        );
        $this->db->where('id', $this->session->userdata['id']);
        $this->db->update('usuario', $data);
        return $this->db->affected_rows();
    }
    function alt_escolha($campus, $editais){
        $data = array(
            'es_campus' => $campus,
            'es_editais' => $editais
        );
        $this->db->where('id', $this->session->userdata['id']);
        $this->db->update('usuario', $data);
        return $this->db->affected_rows();
    }


    function regras(){
        $this->db->select('*');
        $this->db->from('regras');
        $this->db->where('user', $this->session->userdata['id']);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }

    function ver_regra($pos){
        $this->db->select('*');
        $this->db->from('regras');
        $this->db->where('id', $pos);
        return $this->db->get()->result()[0];
    }

    function insere_regra($dados){
        $data = array(
            'data' => $dados,
            'user' => $this->session->userdata['id'],
            'datetime' => date('Y-m-d H:i:s')
        );
        $this->db->insert('regras', $data);
        return $this->db->affected_rows();
    }

    function remove_regra($id){
        $this->db->where('id', $id);
        $this->db->delete('regras');
        return $this->db->affected_rows();
    }




    //////////////////////////////////////////
    ////////// base de dados //////////////////
    /////////////////////////////////////////

    function qtde_registros(){
        $this->db->select('count(*) as qtde');
        $this->db->from('questionario');
        return $this->db->get()->result()[0]->qtde;
    }
    function limpa_base(){
        $sql = "TRUNCATE `questionario_tipos`;";
        $res = $this->db->query($sql);
        $sql = "TRUNCATE `questionario`;";
        $res = $this->db->query($sql);
        return $res;
    }


    ////////////////////////////////////////////
    ////////// estatisticas ////////////////////
    ////////////////////////////////////////////
    function qtde_analises(){
        $this->db->select('count(*) as qtde');
        $this->db->from('regras');
        return $this->db->get()->result()[0]->qtde;
    }
    function qtde_campus(){
        $this->db->select('count(*) as qtde');
        $this->db->from('campus');
        return $this->db->get()->result()[0]->qtde;
    }
    function qtde_usuarios(){
        $this->db->select('count(*) as qtde');
        $this->db->from('usuario');
        return $this->db->get()->result()[0]->qtde;
    }













    function users(){
        $this->db->select('*');
        $this->db->from('usuario');
        return $this->db->get()->result();
    }
    function adms(){
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('adm', 1);
        return $this->db->get()->result();
    }
    function envia_email_adm(){
        foreach ($this->adms() as $n) {
            $form_dados = array(
                'de' => 'admin@tcc.perses.com.br',
                'den' => 'Administração FAQSCIF',
                'para' => $n->email,
                'assunto' => 'Novo usuário na ferramenta FAQSCIF',
                'mensagem' => '<b>Novo usuário na ferramenta FAQSCIF</b><br>
                        Um novo usuário se cadastrou na ferramenta FAQSCIF e aguarda aprovação para uso da ferramenta. <br><a href="http://tcc.perses.com.br">Ir para a ferramenta</a><br>',
                'enviar' => 'enviar'
            );

            $url = "http://labsoft.muz.ifsuldeminas.edu.br/assets/css/mail1.php";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $form_dados);
            curl_exec($curl);
            curl_close($curl);
        }
    }
    function envia_email_todos(){
        foreach ($this->users() as $n) {
            $form_dados = array(
                'de' => 'admin@tcc.perses.com.br',
                'den' => 'Administração FAQSCIF',
                'para' => $n->email,
                'assunto' => 'Nova atualização na base de dados FAQSCIF',
                'mensagem' => '<b>Nova atualização na base de dados</b><br>
            Novos dados foram inseridos na ferramenta FAQSCIF para realização de novas análises. <br><a href="http://tcc.perses.com.br">Ir para a ferramenta</a><br>',
                'enviar' => 'enviar'
            );

            $url = "http://labsoft.muz.ifsuldeminas.edu.br/assets/css/mail1.php";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $form_dados);
            curl_exec($curl);
            curl_close($curl);
        }
    }


                












    function set_alertas($alerta){
        if(!isset($this->session->userdata['alertas'])){
            $this->session->set_userdata('alertas', null);
        }
        $alertas = $this->session->userdata['alertas'];
        if($alertas == null){
            $alertas = array();
        }
        array_push($alertas, $alerta);
        $this->session->set_userdata('alertas', $alertas);
    }

    function get_alertas(){
        if(isset($this->session->userdata['alertas'])){
            $alertas = $this->session->userdata['alertas'];
            $this->session->set_userdata('alertas', null);
            $result = "";
            foreach ($alertas as $n) {
                $tipo = explode("|", $n)[0];
                $msg = explode("|", $n)[1];
                $result .= "<div class=\"alert alert-". $tipo ." alert-dismissible\" role=\"alert\" style=\"margin-top: 15px;\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                    <strong>Aviso!</strong> ". $msg ."
                </div>";
            }
            return $result;
        }
    }
}

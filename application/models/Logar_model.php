<?php

class Logar_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }


    ////////////////////////////////////////////////////
    ////////////////// SISTEMA LOGIN ///////////////////
    ////////////////////////////////////////////////////

    function logar($usuario, $senha){
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('login', $usuario);
        $this->db->where('senha', $senha);
        $resultado = $this->db->get()->result();
        if($resultado){
            if($resultado[0]->ativo == 1){
                $this->session->set_userdata('id', $resultado[0]->id);
                $this->session->set_userdata('login', $resultado[0]->login);
                $this->session->set_userdata('sobre', $resultado[0]->sobre);
                $this->session->set_userdata('logado', '1');
                redirect("painel/analise");
            }else{
                $this->session->set_userdata('logado', '0');
                redirect("home/logar/inativo");
            }
        }else{
            $this->session->set_userdata('logado', '0');
            redirect("home/logar/incorreto");
        }
    }

    function protege(){
        if(isset($this->session->userdata['logado'])){
            if($this->session->userdata['logado'] == 1){
                //echo "ta";
            }else{
                redirect("home/logar/");
            }
        }else{
            redirect("home/logar/");
        }
    }

    function verifica_logado(){
        if(isset($this->session->userdata['logado'])){
            if($this->session->userdata['logado'] == 1){
                redirect("painel/");
            }
        }
    }






    ////////////////////////////////////////////////////////
    ////////////////// SISTEMA DE CADASTRO /////////////////
    ////////////////////////////////////////////////////////
    function cadastrar($login, $senha, $nome, $email, $sobre = ""){
        if(($login != null) && ($senha != null) && ($nome != null) && ($email != null)){
            $this->db->select('*');
            $this->db->from('usuario');
            $this->db->where('login', $login);
            $resultado = (bool)($this->db->get()->result());
            if(!$resultado){
                $data = array(
                'login' => $login,
                'senha' => $senha,
                'nome' => $nome,
                'email' => $email,
                'sobre' => $sobre,
                'cidade' => 0,
                'apriori' => '{"car":"","classIndex":"-1","delta":"0.05","lowerBoundMinSupport":"0.1","metricType":"0","minMetric":"0.9","minRules":"10","outputItemSets":"","removeAllMissingCols":"","significanceLevel":"-1.0","upperBoundMinSupport":"1.0","treatZeroAsMissing":"","verbose":""}',
                'config' => '{"dir":"C:\/xampp\/htdocs\/tcc\/"}',
                'campus' => 0,
                'es_campus' => 'null',
                'es_editais' => 'null'
                );
                $this->db->insert('usuario', $data);

                return $this->db->affected_rows();
            }else{
                return 2;
            }
        }else{
            return 3;
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
}

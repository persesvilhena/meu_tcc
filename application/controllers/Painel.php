<?php
class Painel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('logar_model');
        $this->load->model('perfil_model');
        $this->load->model('cidade_model');
        $this->load->model('conf');
        $this->logar_model->protege();
        $this->user = $this->perfil_model->retorna_dados_usuario();
    }

    public function teste(){
        //$this->conf->envia_email_adm();
        $conf = json_decode($this->user->apriori);
        $regra = $conf->car ." ". $conf->outputItemSets ." ". $conf->removeAllMissingCols ." ". $conf->treatZeroAsMissing ." ". $conf->verbose; 
        $regra .= " -c ".$conf->classIndex." -D ".$conf->delta." -T ".$conf->metricType." -C ".$conf->minMetric." -N ".$conf->minRules." -S ".$conf->significanceLevel." -U ".$conf->upperBoundMinSupport." -M ".$conf->lowerBoundMinSupport;
        $var = "java -classpath weka/weka.jar weka.associations.Apriori -t arquivo.arff -B ".$regra;
        var_dump($var);
        $this->load->view('include/header');
        $this->load->view('painel/home');
        $this->load->view('include/footer');
    }

    public function index() {

        $this->load->view('include/header');
        $this->load->view('painel/home');
        $this->load->view('include/footer');
    }

    public function analise() {
        //var_dump($this->input->post('campus'));
        if ($this->input->post('salvar') != null) {
            $campus = json_encode($this->input->post('campus'));
            $editais = json_encode($this->input->post('editais'));
            /*if($this->conf->alt_escolha($campus, $editais)){
                $this->conf->set_alertas("success|Configuração da análise salva com sucesso!");
            }*/

            $this->conf->alt_escolha($campus, $editais);
            if(count($this->conf->user()->es_editais) && count($this->conf->user()->es_campus)){
                redirect('painel/analisando');
            }else{
                $this->conf->set_alertas("warning|É necessário que você tenha selecionado pelo menos um campus e um edital, por favor revise suas configurações!");
            }
        }
        $this->load->view('include/header');
        $this->load->view('painel/analise');
        $this->load->view('include/footer');
    }
    public function analisando() {
        $this->load->view('include/header');
        $this->load->view('painel/analisando');
        $this->load->view('include/footer');
    }
    public function ultima_analise(){
        $id = $this->conf->regras()[0]->id;
        redirect('painel/ver/'.$id);
    }


    /*public function limpeza() {
        $this->load->view('include/header');
        $this->load->view('painel/limpeza');
        $this->load->view('include/footer');
    }

    public function extraindo() {
        $this->load->view('include/header');
        $this->load->view('painel/extraindo');
        $this->load->view('include/footer');
    }*/



    /*public function weka() {
        $dados['user'] = $this->user;
        $this->load->view('include/header');
        $this->load->view('operacoes/weka', $dados);
        $this->load->view('include/footer');
    }*/

    public function regras() {
        if ($this->input->post('apagar') != null) {
            $this->db->where('id', $this->input->post('id'));
            $this->db->delete('regras');
            if($this->db->affected_rows()){
                $this->conf->set_alertas("success|Análise removida com sucesso!");
            }
        }
        $this->load->view('include/header');
        $this->load->view('painel/regras');
        $this->load->view('include/footer');
    }

    public function ver($id) {
        $dados['regras'] = json_decode($this->conf->ver_regra($id)->data);
        $dados['id'] = $id;
        $this->load->view('include/header');
        $this->load->view('painel/ver', $dados);
        $this->load->view('include/footer');
    }
    public function ver_json($id) {
        $dados['regras'] = json_decode($this->conf->ver_regra($id)->data);
        $this->load->view('painel/ver_json', $dados);
    }

    public function tipos() {
        if ($this->input->post('enviar') != null) {
            $form = $this->input->post();
            unset($form['enviar']);
            //var_dump($this->conf->altera_todos_tipos($form));
            if($this->conf->altera_todos_tipos($form)){
                $this->conf->set_alertas("success|Valores distintos alterados com sucesso!");
            }else{
                $this->conf->set_alertas("danger|Nada foi alterado!");
            }
        }
        $dados['tipos'] = $this->conf->tabela_tipos();
        $this->load->view('include/header');
        $this->load->view('painel/tipos', $dados);
        $this->load->view('include/footer');
    }

    public function config() {
        if ($this->input->post('enviar') != null) {
            $conf = $this->input->post();
            unset($conf['enviar']);
            if($this->conf->alt_conf(json_encode($conf))){
                $this->conf->set_alertas("success|Configuração Apriori salva com sucesso!");
            }else{
                $this->conf->set_alertas("warning|Nada foi alterado!");
            }
        }
        $this->load->view('include/header');
        $this->load->view('painel/config');
        $this->load->view('include/footer');
    }

    /*public function config_geral() {
        if ($this->input->post('enviar') != null) {
            $conf = $this->input->post();
            unset($conf['enviar']);
            if($this->conf->alt_conf_geral(json_encode($conf))){
                $this->conf->set_alertas("success|Configuração Apriori salva com sucesso!");
            }
        }
        if ($this->input->post('apagar') != null) {
            if($this->conf->limpa_base()){
                $this->conf->set_alertas("warning|Base de dados limpa com sucesso!");
            }
        }
        $dados['conf'] = json_decode($this->user->config);
        $this->load->view('include/header');
        $this->load->view('painel/config_geral', $dados);
        $this->load->view('include/footer');
    }

    public function confirm() {
        $this->load->view('include/header');
        $this->load->view('painel/confirm');
        $this->load->view('include/footer');
    }



    public function alimentacao(){
        $this->load->view('include/header');
        $this->load->view('painel/alimentacao');
        $this->load->view('include/footer');
    }

    public function upload(){
        $this->load->view('include/header');
        $this->load->view('painel/upload');
        $this->load->view('include/footer');
    }

    public function faz_upload(){
        //Receber os dados do formulário
        $tmp_name = $_FILES['arquivo']['tmp_name'];
        $name = $_FILES['arquivo']['name'];
        $campus = $_POST['campus'];
        $this->conf->alt_campus($campus);

        $ext = explode(".", $_FILES['arquivo']["name"])[1];

        //Fazer o Upload
        move_uploaded_file($tmp_name, 'docs/'.$this->user->login.'.csv');
        //move_uploaded_file($tmp_name, 'docs/'.$this->user->login.'.'. $ext);

        //Salvar no BD
        /*$result_imagem = "INSERT INTO imagens (nome_imagem, titulo) VALUES ('$name', '$titulo')";
        $resultado_imagem = mysqli_query($conn, $result_imagem);

        if(mysqli_insert_id($conn)){
            $_SESSION['msg'] = "<div class='alert alert-success'>Imagem cadastrada com sucesso!</div>";
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao cadastrada a imagem!</div>";
        }*
    }*/





}

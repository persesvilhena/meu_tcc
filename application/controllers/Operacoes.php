<?php
class Operacoes extends CI_Controller {

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
        $this->load->view('include/header');
        $this->load->view('teste');
        $this->load->view('include/footer');
    }



    public function insercao(){
        $url = base_url()."docs/".$this->user->login.".csv";
        $headers = @get_headers( $url );

        $passou = 1;
        $tamanho = (int)substr($headers[6], 16);
        if($tamanho > 104857600){
            $passou = 0;
            echo "O Tamanho do arquivo excede os 100Mb, por favor envie um arquivo menor!";
        }

        if($passou){
            if( $headers !== FALSE && strpos( $headers[ 0 ], '200' ) !== FALSE ) {
                $ultimo = end($headers);
                $pos = strpos($ultimo, 'text/csv');
                if ($pos === false) {
                    echo "Não é um arquivo csv";
                    $passou = 0;
                } else {
                    $passou = 1;
                }
            }else{
                echo "Infelizmente não encontramos o seu arquivo CSV, por favor envie novamente!";
                $passou = 0;
            }    
        }

        if($passou){
            $msg = "Infelizmente seu arquivo CSV está fora do padrão, você pode ver o formato padrão do arquivo CSV <a href='".base_url()."assets/padrao.csv' class='btn'>clicando aqui</a>";
            $handle = fopen(base_url()."docs/".$this->user->login.".csv", "r");
            $data = fgetcsv($handle, 0, ",");
            
            $qte_col = count($data);
            if($qte_col == 10){
                $ar = array();
                foreach (range(0, 10) as $n) {
                    $ar[$n] = fgetcsv($handle, 0, ",");
                }
                $ant_insc = $ar[0][1];
                foreach ($ar as $n) {
                    if($ant_insc == $n[1]){
                        $ok = 1;
                    }else{
                        $ok = 0;
                    }
                }
                if($ok){
                    //echo "ok";
                }else{
                    echo $msg;
                } 
            }else{
                echo $msg;
            }
            fclose($handle);
        }

        if($passou && $ok){
            $cont = 0;
            $atual = 0;
            $insc = 0;
            $ind = array(
                'local_origem' => 'Local de Origem',
                'tipo_instituicao' => 'Tipo de instituição de ensino em que cursou maior parte de sua vida acadêmica',
                'renda' => 'Qual sua renda familiar?',
                'pessoas_familia' => 'Quantas pessoas, incluindo você, vivem da renda mensal do seu grupo familiar?',
                'familia_residencia' => 'Sua família possui residência:',
                'cursou_fundamental' => 'Cursou ensino fundamental e',
                'escolheu_curso' => 'Por que você escolheu esse curso?',
                'escolheu_if' => 'Por que escolheu o IFSULDEMINAS?',
                'vestibular_if' => 'Já prestou vestibular no IFSULDEMINAS?',
                'apoio_social' => 'Tem interesse em se inscrever em algum apoio social?',
                'pretende_residir' => 'Como pretende residir na cidade do campus no qual se inscreveu?',
                'apos_matricula' => 'Após a matrícula, qual transporte você pretende utilizar durante o curso:',
                'atividades_profissao' => 'Você conhece as atividades que pode desenvolver na profissão que está escolhendo?',
                'antes_entrar' => 'Antes de entrar na escola, você residia com seus pais?',
                'menor' => 'Caso seja menor, quem é responsável por você?',
                'pai' => 'Grau de Instrução do Pai',
                'mae' => 'Grau de Instrução da Mãe:',
                'atividade_remunerada' => 'Você exerce alguma atividade remunerada?',
                'sua_participacao' => 'Qual a sua participação na vida econômica de seu grupo familiar?',
                'exercer_atividade' => 'Se trabalha, qual idade começou a exercer atividade remunerada?',
                'sustento' => 'Quem é o responsável pelo sustento de sua família?',
                'automovel' => 'A família possui automóvel?',
                'le' => 'Você lê, por ano, além dos textos escolares:',
                'leitura' => 'Que tipo de leitura:',
                'micro' => 'Quanto ao uso de microcomputador:',
                'internet' => 'Com que frequência você utiliza a Internet?',
                'seletivo' => 'O que achou do processo de inscrição para o processo seletivo?',
                'especiais' => 'Possui alguma dessas necessidades especiais citadas abaixo?',
                'etnia' => 'Etnia:',
                'sabendo' => 'Como ficou sabendo do Vestibular?'
            );
            if (($handle = fopen(base_url()."docs/".$this->user->login.".csv", "r")) !== FALSE) {
                $row = 0;
                while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
                    foreach ($ind as $i => $valor) {
                        if(substr_count($data[8], htmlentities($valor)) != 0){
                            $this->conf->linha($data, $i);
                        }
                    }
                }
                fclose($handle);
                echo "ok";
                $this->conf->envia_email_todos();
                unlink("docs/".$this->user->login.".csv");
            }
            
        }

    }
















    public function alterar() {
        $this->load->view('operacoes/alterar');
    }

    public function limpeza() {
        $this->load->view('operacoes/limpeza');
    }

    public function extrai() {
        $this->load->view('operacoes/extrai');
    }

    public function gerar() {
        $this->load->view('operacoes/gerar');
    }

    public function weka() {
        if(count($this->conf->user()->es_editais) && count($this->conf->user()->es_campus)){
            $this->gerar();
            $dados['user'] = $this->user;
            $this->load->view('operacoes/weka', $dados);
        }else{
            echo "É necessário que você tenha selecionado pelo menos um campus e um edital, por favor revise suas configurações!";
        }
    }

   



}

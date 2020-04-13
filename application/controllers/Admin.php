<?php
class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('logar_model');
        $this->load->model('perfil_model');
        $this->load->model('cidade_model');
        $this->load->model('adm_model');
        $this->load->model('conf');
        $this->logar_model->protege();
        $this->adm_model->verifica_adm();
        $this->user = $this->perfil_model->retorna_dados_usuario();
    }



    public function index() {
        redirect('admin/users');
    }




    public function users(){
        $this->load->view('include/header');
        $this->load->view('admin/users');
        $this->load->view('include/footer');
    }
    public function editar($id){
        $dados['user'] = $this->perfil_model->retorna_dados_usuario($id);
        if($this->input->post('alterar') != null){
            $data = array(
                'login' => $this->input->post('login'), 
                'nome' => $this->input->post('nome'), 
                'email' => $this->input->post('email'), 
                'sobre' => $this->input->post('sobre'),
                'adm' => $this->input->post('adm'),
                'ativo' => $this->input->post('ativo')
            );

            $resultado = $this->perfil_model->alterar($dados['user']->id, $data);
            if($resultado){
                $this->conf->set_alertas("success|Perfil alterado com sucesso!");
            }else{
                $this->conf->set_alertas("danger|Não foi feita alterações!");
            }
            //redirect('perfil/');
        }
        if($this->input->post('apagar') != null){
            $this->adm_model->apagar_usuario($id);
            $this->conf->set_alertas("success|Usuário removido com sucesso!");
            redirect('admin/users');
        }
        $dados['user'] = $this->perfil_model->retorna_dados_usuario($id);
        $this->load->view('include/header');
        $this->load->view('admin/editar', $dados);
        $this->load->view('include/footer');
    }





    public function config_geral() {
        if ($this->input->post('enviar') != null) {
            $conf = $this->input->post();
            unset($conf['enviar']);
            if($this->conf->alt_conf_geral(json_encode($conf))){
                $this->conf->set_alertas("success|Configuração salva com sucesso!");
            }
        }
        if ($this->input->post('apagar') != null) {
            if($this->conf->limpa_base()){
                $this->conf->set_alertas("warning|Base de dados limpa com sucesso!");
            }
        }
        $dados['conf'] = json_decode($this->user->config);
        $this->load->view('include/header');
        $this->load->view('admin/config_geral', $dados);
        $this->load->view('include/footer');
    }
    public function confirm() {
        $this->load->view('include/header');
        $this->load->view('admin/confirm');
        $this->load->view('include/footer');
    }







    public function limpeza() {
        $this->load->view('include/header');
        $this->load->view('admin/limpeza');
        $this->load->view('include/footer');
    }
    public function extraindo() {
        $this->load->view('include/header');
        $this->load->view('admin/extraindo');
        $this->load->view('include/footer');
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
        $this->load->view('admin/tipos', $dados);
        $this->load->view('include/footer');
    }






    public function alimentacao(){
        $this->load->view('include/header');
        $this->load->view('admin/alimentacao');
        $this->load->view('include/footer');
    }
    public function upload(){
        $this->load->view('include/header');
        $this->load->view('admin/upload');
        $this->load->view('include/footer');
    }
    public function faz_upload(){
        $tmp_name = $_FILES['arquivo']['tmp_name'];
        $name = $_FILES['arquivo']['name'];
        $campus = $_POST['campus'];
        $this->conf->alt_campus($campus);
        $ext = explode(".", $_FILES['arquivo']["name"])[1];
        move_uploaded_file($tmp_name, 'docs/'.$this->user->login.'.csv');
    }



    public function testemail(){
        $this->logar_model->envia_email_adm();
    }

    public function testemail2(){
        $arquivo = "<b>Novo usuário na ferramenta FAQSCIF</b><br>
        Um novo usuário se cadastrou na ferramenta FAQSCIF e aguarda aprovação para uso da ferramenta. <br><a href=\"http://tcc.perses.com.br\">Ir para a ferramenta</a><br>";
        $destino = 'persesvilhena01@gmail.com';
        $assunto = "Novo usuário na ferramenta FAQSCIF";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: Administração FAQSCIF <admin@tcc.perses.com.br>';
        $enviaremail = mail($destino, $assunto, $arquivo, $headers);
    }



}

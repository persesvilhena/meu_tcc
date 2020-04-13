<?php
class Perfil extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('logar_model');
        $this->load->model('perfil_model');
        $this->load->model('conf');
        $this->logar_model->protege();
        $this->user = $this->perfil_model->retorna_dados_usuario();
	}

	public function index() {
        $dados['user'] = $this->perfil_model->retorna_dados_usuario();
        $this->load->view('include/header', $dados);
        $this->load->view('perfil/home', $dados);
        $this->load->view('include/footer');
    }

    public function editar() {
        $dados['user'] = $this->perfil_model->retorna_dados_usuario();

        if($this->input->post('alterar') != null){
            $data = array(
                'login' => $this->input->post('login'), 
                'nome' => $this->input->post('nome'), 
                'sobre' => $this->input->post('sobre')
            );

            $resultado = $this->perfil_model->alterar($dados['user']->id, $data);
            if($resultado){
                $this->conf->set_alertas("success|Perfil alterado com sucesso!");
            }else{
                $this->conf->set_alertas("danger|Não foi feita alterações!");
            }
            redirect('perfil/');
        }

        $this->load->view('include/header', $dados);
        $this->load->view('perfil/editar', $dados);
        $this->load->view('include/footer');
    }
}
?>

<?php

class Adm_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function verifica_adm(){
        if($this->conf->user()->adm == 0){
            redirect('painel');
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

    function apagar_usuario($id){
        $this->db->where('user', $id);
        $this->db->delete('regras');

        $this->db->where('id', $id);
        $this->db->delete('usuario');
        return $this->db->affected_rows();
    }


}

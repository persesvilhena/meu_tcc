<?php

class Perfil_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }



    function retorna_dados_usuario($id = null){
        if($id == null){
            $id = $this->session->userdata['id'];
        }
        
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('usuario.id', $id);
        return $this->db->get()->result()[0];
    }

    function alterar($id, $data){
        $this->db->where('id', $id);
        $this->db->update('usuario', $data);
        return $this->db->affected_rows();
    }


}

<?php

class Cidade_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function retorna_todas_cidades(){
        $this->db->select('*');
        $this->db->from('cidade');
        return $this->db->get()->result();
    }

    function ver($id){
        $this->db->select('*');
        $this->db->from('cidade');
        $this->db->where('cid_id', $id);
        return $this->db->get()->result()[0];
    }

    function inserir($nome){
        $data = array(
        'cid_nome' => $nome
        );
        $this->db->insert('cidade', $data);
        return $this->db->affected_rows();
    }

    
    function alterar($id, $nome){
        $data = array(
        'cid_nome' => $nome
        );
        $this->db->where('cid_id', $id);
        $this->db->update('cidade', $data);
        return $this->db->affected_rows();
    }



    function apagar($id){
        $this->db->where('cid_id', $id);
        $this->db->delete('cidade');
        return $this->db->affected_rows();
    }



}

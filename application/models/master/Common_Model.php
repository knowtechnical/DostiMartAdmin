<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function add_data($table, $form_data){
        $this->db->insert($table, $form_data);
        $id = $this->db->insert_id();
        return $id;
    }

    public function update_table($where,$form_data, $table_name) {
        $this->db->where($where);
        $result = $this->db->update($table_name, $form_data);
        //echo $this->db->last_query();exit; 	
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function deleteData($table, $where){
        $this->db->where($where);
        $this->db->delete($table); 
    }

    public function view_data($table, $where) {
        $this->db->select('*');
        $this->db->from($table);     
        $this->db->where($where);             
        $result = $this->db->get()->result_array();        
        
        return $result;
    }

}

?>
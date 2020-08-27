<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LoginMdl extends CI_Model { 

function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
   
public function savedata_login($form_data) {

        $result = $this->db->insert('admin_login', $form_data);

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
    
    
	function login($email,$password)
    {
    
   $this->db->select('*');
   $this->db->from('login');
   $this->db->where('l_email', $email);
   $this->db->where('l_password', $password);
   $this->db->where('status', 1);
   $this->db->where('l_delete', 1);
   $this->db->limit(1);
 
   $query = $this -> db -> get();
   if($query -> num_rows() == 1)
   {
     return $query->result_array();
   }
   else
   {
     return false;
   }
 }
}

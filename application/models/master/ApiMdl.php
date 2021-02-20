<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ApiMdl extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /*     * ************************  START INSERT QUERY ************** */
	
	   public function login($email,$password,$role) {
            $query = $this->db->query("SELECT * FROM login l WHERE l_delete = '1' AND l.status = '1' AND l_email='$email' AND l_password = '$password' AND l_role = '$role'");// AND role = '$role'
            $result = $query->result_array();
              // echo $this->db->last_query();exit;  
            if (!empty($result)) {
                return $result[0];
            } else {
                return $result;
            }
        }

        public function view_brand($where){
            $this->db->select('*');
            $this->db->from('brand');        
            $this->db->where($where);             
            $result = $this->db->get()->result_array();        
            return $result;
        }

        public function view_category($where){
            $this->db->select('*');
            $this->db->from('category');        
            $this->db->where($where);             
            $result = $this->db->get()->result_array();        
            return $result;
        }

        public function view_product($where){
            $this->db->select('*');
            $this->db->from('product p'); 
            $this->db->join('category c', 'c.c_id = p.fk_category_id');
            $this->db->join('shop s', 's.s_id = p.fk_shop_id');         
            $this->db->where($where);             
            //echo $this->db->last_query();exit;  
            $result = $this->db->get()->result_array();        
            return $result;
        }

        public function view_advertisment($where){
            $this->db->select('*');
            $this->db->from('advertisment a');       
           // $this->db->join('ad_img ai', 'a.a_id = ai.fk_advertisment_id', 'left');         
            $this->db->where($where);             
            $result = $this->db->get()->result_array();      
          
            return $result;
        }

        public function view_quiz($where){
            $this->db->select('*');
            $this->db->from('quiz q');       
            $this->db->where($where);   
            $this->db->order_by("q_id", "DESC");   
            $this->db->limit(1);                 
            $result = $this->db->get()->result_array();        
            return $result;
        }

        public function view_news($where){
            $this->db->select('*');
            $this->db->from('news');        
            $this->db->where($where);   
            $this->db->order_by("n_id", "DESC"); 
            $this->db->limit(1);         
            $result = $this->db->get()->result_array();        
            return $result;
        }

        public function view_shop($where){
            $this->db->select('*');
            $this->db->from('shop s'); 
            $this->db->join('shop_category sc', 's.s_id = sc.fk_shop_id');
            $this->db->where($where);             
            $result = $this->db->get()->result_array();
//echo $this->db->last_query();exit;  
            return $result;
        }

        public function api_view_product_details($where){
            $this->db->select('p.*,s.s_name,c.c_name');
            $this->db->from('product p'); 
            $this->db->join('category c', 'c.c_id = p.fk_category_id');
            $this->db->join('shop s', 's.s_id = p.fk_shop_id');         
            $this->db->where($where);             
            $result = $this->db->get()->result_array();        
            if (!empty($result)) {
                return $result[0];
            } else {
                return $result;
            }
        }


        public function get_product_img($id){
            $this->db->select('*');
            $this->db->from('product_img'); 
            $this->db->where('pi_delete',1);       
            $this->db->where('fk_product_id',$id);             
            $result = $this->db->get()->result_array();        
            return $result;
        }

        public function api_view_shop_details($where){
            $this->db->select('*');
            $this->db->from('shop s'); 
            $this->db->where($where);             
            $result = $this->db->get()->result_array();        
            if (!empty($result)) {
                return $result[0];
            } else {
                return $result;
            }
        }

        public function get_shop_category($id){
            $this->db->select('s.*,c.c_name');
            $this->db->from('shop_category s'); 
            $this->db->join('category c', 'c.c_id = s.fk_category_id');
            $this->db->where('sc_delete',1);     
            $this->db->where('s.status',1);        
            $this->db->where('fk_shop_id',$id);             
            $result = $this->db->get()->result_array();        
            return $result;
        }

        public function api_insert_order($form_data) {
            $this->db->insert('sale_order', $form_data);
            $insert_id = $this->db->insert_id();
            if ($insert_id){
                return $insert_id;
            } else {
                return false;
            }
        }

        public function add_user($form_data) {
            $result = $this->db->insert('login', $form_data);
            if ($result) {
                return $result;
            } else {
                return false;
            }
        }

        public function get_mobile_email($where){
            $this->db->select('l_mobile,l_email');
            $this->db->from('login l'); 
            $this->db->where($where);             
            $result = $this->db->get()->result_array();       
            // echo $this->db->last_query();exit;   
            if (!empty($result)) {
                return $result[0];
            } else {
                return $result;
            }
        }


        public function view_data($table, $where) {
            $this->db->select('*');
            $this->db->from($table);     
            $this->db->where($where);             
            $result = $this->db->get()->result_array();        
            
            return $result;
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

        // public function login($where){
        //     $this->db->select('*');
        //     $this->db->from('login l'); 
        //     $this->db->where($where);             
        //     $result = $this->db->get()->result_array();       
        //     // echo $this->db->last_query();exit;   
        //     if (!empty($result)) {
        //         return $result[0];
        //     } else {
        //         return $result;
        //     }
        // }
	

    

}

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MasterMdl extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /*     * ************************  START INSERT QUERY ************** */

    public function home_type($form_data) {
        $this->db->where('ho_id', 1);
        $result = $this->db->update('home_type', $form_data);
        //echo $this->db->last_query();exit;
       if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function get_home_type() {
        $query = $this->db->query("SELECT * FROM home_type where ho_id='1'");
        $result = $query->result_array();
        if (!empty($result)) {
            return $result[0];
        } else {
            return $result;
        }
    }


    public function view_user($where){
    $this->db->select('*');
    $this->db->from('login');
    //$this->db->join('products p', 'c.productIds = p.productId');
    $this->db->where($where);
    $this->db->where('status','1');
    $this->db->where('l_delete','1');   
	$this->db->order_by("l_id", "DESC"); 	
    $result = $this->db->get()->result_array();
    //echo $this->db->last_query();exit;
    //print_r($result);exit;
    return $result;
    }

    public function add_user($form_data) {
        $result = $this->db->insert('login', $form_data);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
	
	
	
	 public function add_text($form_data) {
        $this->db->where('add_id', 1);
        $result = $this->db->update('add_text', $form_data);
       if ($result) {
            return $result;
        } else {
            return false;
        }
    }
	
	public function get_add_text() {
        $query = $this->db->query("SELECT * FROM add_text where add_id='1'");
        $result = $query->result_array();
        if (!empty($result)) {
            return $result[0];
        } else {
            return $result;
        }
    }

    public function get_user($id) {
        $query = $this->db->query("SELECT * FROM login where l_id='$id'");
        $result = $query->result_array();
        if (!empty($result)) {
            return $result[0];
        } else {
            return $result;
        }
    }

    public function edit_user($id,$form_data) {
        $this->db->where('l_id', $id);
        $result = $this->db->update('login', $form_data);
       if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function deleterow($id,$deleteid,$tablename,$form_data) {
        $this->db->where($deleteid, $id);
        $result = $this->db->update($tablename, $form_data);
        //echo $this->db->last_query();exit;

        if($tablename == 'shop') {
            $this->db->where('fk_shop_id', $id);
            $form_data = array(
                'sc_delete' => 0,
                 );
            $result = $this->db->update("shop_category", $form_data);
        }

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function view_zone($where){
        $this->db->select('*');
        $this->db->from('zone');        
        $this->db->where($where);             
        $result = $this->db->get()->result_array();        
        return $result;
    }

    public function add_zone($form_data) {
        $result = $this->db->insert('zone', $form_data);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function view_brand($where){
        $this->db->select('*');
        $this->db->from('brand');        
        $this->db->where($where);             
        $result = $this->db->get()->result_array();        
        return $result;
    }

    public function add_brand($form_data) {
        $result = $this->db->insert('brand', $form_data);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function edit_table($id,$editid,$tablename,$form_data) {
        $this->db->where($editid, $id);
        $result = $this->db->update($tablename,$form_data);
       if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function view_category($where){
        $this->db->select('*');
        $this->db->from('category');        
        $this->db->where($where);             
        $result = $this->db->get()->result_array();        
        return $result;
    }

    public function add_category($form_data) {
        $result = $this->db->insert('category', $form_data);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function view_product_vendor($where,$where_in){

       
        $this->db->select('p.*,c.c_name,s.s_name');
        $this->db->from('product p'); 
        $this->db->join('category c', 'c.c_id = p.fk_category_id');
        $this->db->join('shop s', 's.s_id = p.fk_shop_id');         
        $this->db->where($where);    
        count($where_in) == 0?'':$this->db->where_in('fk_shop_id', $where_in);
        $this->db->order_by("p_id", "DESC");             
        $result = $this->db->get()->result_array();        
    // echo $this->db->last_query();exit;
        return $result;
    }

    public function view_product($where){
        $this->db->select('p.*,c.c_name,s.s_name');
        $this->db->from('product p'); 
        $this->db->join('category c', 'c.c_id = p.fk_category_id');
        $this->db->join('shop s', 's.s_id = p.fk_shop_id');         
        $this->db->where($where);    
        $this->db->order_by("p_id", "DESC");             
        $result = $this->db->get()->result_array();        
        return $result;
    }

    public function add_product($form_data) {
        $this->db->insert('product', $form_data);
        $insert_id = $this->db->insert_id();
        if ($insert_id){
            return $insert_id;
        } else {
            return false;
        }
    }

    public function add_product_log($form_data) {
        $this->db->insert('product_log', $form_data);
        $insert_id = $this->db->insert_id();
        if ($insert_id){
            return $insert_id;
        } else {
            return false;
        }
    }

    public function add_product_img($form_data_img) {
        $this->db->insert('product_img', $form_data_img);
        $insert_id = $this->db->insert_id();
        if ($insert_id){
            return $insert_id;
        } else {
            return false;
        }
    }

    public function get_product($id){
        $this->db->select('*');
        $this->db->from('product p'); 
        $this->db->join('category c', 'c.c_id = p.fk_category_id');
        $this->db->join('shop s', 's.s_id = p.fk_shop_id');          
        $this->db->where('p_id',$id);             
        $result = $this->db->get()->result_array();        
       // echo $this->db->last_query();exit;
        if (!empty($result)) {
            return $result[0];
        } else {
            return $result;
        }
    }

    public function get_product_img($id){
        $this->db->select('*');
        $this->db->from('product_img'); 
        $this->db->where('fk_product_id',$id);             
        $result = $this->db->get()->result_array();        
        return $result;
    }

    public function edit_product($id,$form_data) {
        $this->db->where('p_id', $id);
        $result = $this->db->update('product', $form_data);
       if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function view_pimg($where){
        $this->db->select('*');
        $this->db->from('product_img');        
        $this->db->where($where);             
        $result = $this->db->get()->result_array();        
        return $result;
    }

    public function view_news($where){
        $this->db->select('*');
        $this->db->from('news');        
        $this->db->where($where);  
        $this->db->order_by("n_id", "DESC");            
        $result = $this->db->get()->result_array();        
        return $result;
    }

    public function add_news($form_data) {
        $result = $this->db->insert('news', $form_data);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function edit_news($id,$form_data) {
        $this->db->where('n_id', $id);
        $result = $this->db->update('news', $form_data);
        //echo $this->db->last_query();exit;
       if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function view_advertisment($where){
        $this->db->select('*');
        $this->db->from('advertisment a');       
       // $this->db->join('ad_img ai', 'a.a_id = ai.fk_advertisment_id', 'left');         
        $this->db->where($where);             
        $result = $this->db->get()->result_array();        
        return $result;
    }

    public function add_advertisment($form_data) {
        $this->db->insert('advertisment', $form_data);
        $insert_id = $this->db->insert_id();
        if ($insert_id){
            return $insert_id;
        } else {
            return false;
        }
    }
	
	
	public function edit_advertisment($id,$form_data) {
		$this->db->where('a_id',$id);             
        $this->db->update('advertisment', $form_data);
        $insert_id = $this->db->insert_id();
        if ($insert_id){
            return $insert_id;
        } else {
            return false;
        }
    }
	
	 public function delete_advertisment($id) {
        $this->db->where('fk_advertisment_id', $id);
        $result = $this->db->update('ad_img');
       if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function add_advertisment_img($form_data) {
        $this->db->insert('ad_img', $form_data);
        $insert_id = $this->db->insert_id();
        if ($insert_id){
            return $insert_id;
        } else {
            return false;
        }
    }

    public function get_advertisment($id){
        $this->db->select('*');
        $this->db->from('advertisment a'); 
        $this->db->where('a_id',$id);             
        $result = $this->db->get()->result_array();        
        if (!empty($result)) {
            return $result[0];
        } else {
            return $result;
        }
    }


    public function get_order($id){
        $this->db->select('*');
        $this->db->from('orders s'); 
        $this->db->join('login l', 'l.l_mobile = s.customer_mobile');
        $this->db->where('id',$id);             
        $result = $this->db->get()->result_array();        
        if (!empty($result)) {
            return $result[0];
        } else {
            return $result;
        }
    }

    public function get_adimg($id){
        $this->db->select('*');
        $this->db->from('ad_img a'); 
        $this->db->where('fk_advertisment_id',$id);             
        $result = $this->db->get()->result_array();        
        if (!empty($result)) {
            return $result;
        } else {
            return $result;
        }
    }

    public function view_quiz($where){
        $this->db->select('*');
        $this->db->from('quiz q');    
           $this->db->join('login l', 'l.l_mobile = q.q_winning_status','left');   
        $this->db->where($where);   
        $this->db->order_by("q_id", "DESC");           
        $result = $this->db->get()->result_array();     
       // echo $this->db->last_query();exit;   
        return $result;
    }

    public function add_quiz($form_data) {
        $this->db->insert('quiz', $form_data);
        $insert_id = $this->db->insert_id();
        if ($insert_id){
            return $insert_id;
        } else {
            return false;
        }
    }

    public function add_quiz_question($form_data_question) {
        $this->db->insert('quiz_question', $form_data_question);
        $insert_id = $this->db->insert_id();
        if ($insert_id){
            return $insert_id;
        } else {
            return false;
        }
    }

    public function get_quiz_question($where){
        $this->db->select('*');
        $this->db->from('quiz q');       
        $this->db->join('quiz_question qq', 'q.q_id = qq.fk_quiz_id');         
        $this->db->where($where);             
        $result = $this->db->get()->result_array();      
        if (!empty($result)) {
            return $result[0];
        } else {
            return $result;
        }
    }

    public function edit_quiz($id,$form_data) {
        $this->db->where('q_id', $id);
        $result = $this->db->update('quiz', $form_data);
        //echo $this->db->last_query();exit;
       if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function view_question(){
        $this->db->select('*');
        $this->db->from('quiz_question qq');       
        $result = $this->db->get()->result_array();        
        return $result;
    }

    public function view_shop($where){
        $this->db->select('*');
        $this->db->from('shop s'); 
       // $this->db->join('shop_category sc', 's.s_id = sc.fk_shop_id', 'left');
        $this->db->where($where);             
        $result = $this->db->get()->result_array();        
        return $result;
    }

    public function view_shop_product($where){
        $this->db->select('s.*,z.z_name');
        $this->db->from('shop s'); 
        $this->db->join('zone z', 'z.z_id = s.fk_zone_id', 'left');
        $this->db->where($where);             
        $result = $this->db->get()->result_array();        
        return $result;
    }

    public function view_shop_id($where){
        $this->db->select('GROUP_CONCAT(s_id SEPARATOR ",") as shop_ids ');
        $this->db->from('shop s'); 
       // $this->db->join('shop_category sc', 's.s_id = sc.fk_shop_id', 'left');
        $this->db->where($where);             
        $result = $this->db->get()->result_array();        
        if (!empty($result)) {
            return $result[0];
        } else {
            return $result;
        }
    }

    public function add_shop($form_data) {
        $this->db->insert('shop', $form_data);
        $insert_id = $this->db->insert_id();
        if ($insert_id){
            return $insert_id;
        } else {
            return false;
        }
    }

    public function add_shop_category($form_data_category) {
        $this->db->insert('shop_category', $form_data_category);
        $insert_id = $this->db->insert_id();
        if ($insert_id){
            return $insert_id;
        } else {
            return false;
        }
    }

    public function edit_shop($id,$form_data) {
        $this->db->where('s_id', $id);
        $result = $this->db->update('shop', $form_data);
        //echo $this->db->last_query();exit;
       if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function edit_shop_category($id,$form_data_category,$whereupdate) {
        $this->db->where($whereupdate);
        $result = $this->db->update('shop_category', $form_data_category);
        //echo $this->db->last_query();exit;
       if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function get_shop($where){
        $this->db->select('*');
        $this->db->from('shop s');       
        $this->db->where($where);             
        $result = $this->db->get()->result_array(); 
        
        //print_r($where); exit;
        if (!empty($result)) {
            return $result[0];
        } else {
            return $result;
        }
    } 

    public function updateRange($product_id) {
        $total_range_value = $this->input->post('total_range_value');
        $weight_unit = $this->input->post('weight_unit');
  
        for($i=0; $i <= $total_range_value;$i++) {
            $range_value = '';
  
            if(isset($_POST['range'.$i])) { 
                $range = $_POST['range'.$i];

                $form_data = array(
                    'product_id' => $product_id,
                    'range' => $range,
                    'weight_unit' => $weight_unit,
                );

                if(isset($_POST['product_range'.$i])) {
                    $this->db->where('range_id', $_POST['product_range'.$i]);
                    $this->db->update('product_weight_range', $form_data);
                } else {
                    $this->db->insert('product_weight_range', $form_data);
                }
                //$insert_id = $this->db->insert_id();
                //echo $range."";
                
            }
        }

        //exit;
    }

    public function getProductWeightRange($product_id) {

        $where = array(
            'product_id' => $product_id,
            'P_delete' => '1',
        );
        $this->db->select('*');
        $this->db->from('product_weight_range p'); 
        $this->db->where($where);      
        $result = $this->db->get()->result_array();

        return $result;
    }

    public function get_shop_category($where){
        $this->db->select('group_concat(fk_category_id) as catids');
        $this->db->from('shop_category sc');       
        $this->db->where($where);             
        $result = $this->db->get()->result_array();      
        if (!empty($result)) {
            return $result[0];
        } else {
            return $result;
        }
    }   
    
    public function view_category_edit($where,$notin){
        $this->db->select('c.*');
        $this->db->from('category c');     
        $this->db->where_not_in('c.c_id', explode(',',$notin));
        $this->db->where($where);      
       //echo $this->db->last_query();exit;       
        $result = $this->db->get()->result_array();        
        return $result;
    }

    function get_category_from_shop($whereall) {
        $this->db->select('c.*');
        $this->db->from('shop_category sc');     
        $this->db->join('category c', 'c.c_id = sc.fk_category_id');
        $this->db->where($whereall);             
        $result = $this->db->get()->result_array();   
        $option = '';
        foreach ($result as $row) {

            $option .= '<option value="' . $row['c_id'] . '">' . $row['c_name'] . '</option>';
        }
        return $option;
    }
    
    public function get_all_category($whereall){
        $this->db->select('sc.*,c.c_name');
        $this->db->from('shop_category sc');     
        $this->db->join('category c', 'c.c_id = sc.fk_category_id');
        $this->db->where($whereall);             
        $result = $this->db->get()->result_array();        
        return $result;
    }

    public function get_quiz($where){
        $this->db->select('*');
        $this->db->from('quiz q');       
        $this->db->where($where);             
        $result = $this->db->get()->result_array();      
        if (!empty($result)) {
            return $result[0];
        } else {
            return $result;
        }
    }

    public function view_orders($where){
        $this->db->select('o.*,l.l_name,d.l_name as delivery_personanme, count(order_id) as items');
        $this->db->from('sale_order o'); 
        $this->db->join('login l', 'l.l_mobile = o.fk_mobile');
        $this->db->join('login d', 'd.l_id = o.fk_delivery_person_id','left');
        $this->db->where($where);  
        $this->db->group_by('o.order_id'); 
        $this->db->order_by('o.o_id', 'desc'); 
        $result = $this->db->get()->result_array();     
        // echo $this->db->last_query();exit;
        return $result;
    }

    public function getAllBrands($where){
        $this->db->select('p.*');
        $this->db->from('product p'); 
        $this->db->where($where);  
        $this->db->group_by('p.brand_name');
        $this->db->order_by('p.brand_name', 'asc'); 
        $result = $this->db->get()->result_array();  
        return $result;
    }

    public function view_orders_v1($where){
        $this->db->select('o.*,o.customer_name as l_name,d.l_name as delivery_personanme, o.order_items as items, DATE_FORMAT(o.order_date, "%d %b %Y %T") as order_date_f');
        $this->db->from('orders o'); 
        $this->db->join('login d', 'd.l_id = o.delivery_person_id','left');
        $this->db->where($where);
        $this->db->order_by('o.order_date', 'desc');
        $result = $this->db->get()->result_array();  
        //print_r($result); exit;   
        // echo $this->db->last_query();exit;
        return $result;
    }

    public function edit_orders($id,$form_data) {
        $this->db->where('id', $id);
        $result = $this->db->update('orders', $form_data);
       if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function view_orders_details($where){
        $this->db->select('o.*,l.l_name,l_mobile,l_role,l_address');
        $this->db->from('sale_order o'); 
        $this->db->join('login l', 'l.l_mobile = o.fk_mobile');
        $this->db->where($where);     
        $this->db->order_by('o.o_id', 'ASC'); 
        $result = $this->db->get()->result_array();     
        return $result;
    }

    public function view_orders_details_v2($where){
        $this->db->select('o.*,i.*, o.order_number as ordernumber, o.customer_name as l_name, o.customer_mobile as l_mobile, o.customer_address as l_address');
        $this->db->from('orders o'); 
        $this->db->join('order_items i', 'i.order_id = o.id');
        $this->db->where($where);     
        $result = $this->db->get()->result_array();     
        return $result;
    }

    public function api_view_product_details($where){
        $this->db->select('p.*,s.s_name,c.c_name');  //  ,so.so_offertext
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

    public function get_offer_details($where_offer){
        $this->db->select('so.*');  //  ,so.so_offertext
        $this->db->from('sale_offer so'); 
     //   $this->db->join('sale_offer so', 'so.fk_product_id = p.p_id');   
        $this->db->where($where_offer);               
        return $result = $this->db->get()->result_array();        
      //  echo $this->db->last_query();exit;
        // if (!empty($result)) {
        //     return $result[0];
        // } else {
        //     return $result;
        // }
    }

    public function notification_update($where,$form_data) {
        $this->db->where($where);
        $result = $this->db->update('sale_order o', $form_data);
       if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function get_single_right_answer_random_one_winner($where){
        $this->db->select('*');
        $this->db->from('quiz_answer qa'); 
        $this->db->join('login l', 'l.l_mobile = qa.fk_mobile');
        $this->db->where('selected_option = fixed_answer');      
        $this->db->where($where);   
        $this->db->order_by("qa_id", 'RANDOM');
        $this->db->limit(1);           
        $result = $this->db->get()->result_array();        
		//echo $this->db->last_query();exit;
        return $result;
    }

    public function view_profit($where){
        $this->db->select_sum('o_amount');
        //$this->db->select('o_amount');
        $this->db->from('sale_order');
        $this->db->where($where); 
        $result = $this->db->get()->result_array();    
        //echo $this->db->last_query();exit;
        if (!empty($result)) {
            return $result[0];
        } else {
            return $result;
        }
    }

    public function view_profit1($where){
        //$this->db->select_sum('o_overall_product_amount_sum');
       $this->db->select('*');
        $this->db->from('sale_order s'); 
        $this->db->join('product p', 'p.p_id = s.fk_product_id');
        $this->db->join('sale_offer so', 'so.fk_order_id = s.order_id', 'left');
        $this->db->where($where);             
        $result = $this->db->get()->result_array(); 
       // echo $this->db->last_query();exit;
        return $result;
    }

    public function add_offer($form_data) {
        $result = $this->db->insert('sale_offer', $form_data);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
	
	
	public function send_push_notification($token_id,$title,$msg){
							// API access key from Google API's Console
				//define( 'API_ACCESS_KEY', 'AAAAFsI2Bao:APA91bEdwRXOAStM2a0qIcvVF3Q_8NzVP8ZH3E_mgw2JcEyt3cuWHM6S6DPneGfJ6BJzDR2DqFeG9v7fN6zlkp5uYr98gl_Sdrio7EJKUy56oWIaCQQsAV0MkmutChiZMzeoPlvFCUpq' );
				$API_ACCESS_KEY = 'AAAACKGZ1J0:APA91bGWBYlaXveaspMTAKGoesyGLddMZUfp_BGxnCEwGOC21vmRSpPv9NkN3O8Vcr5O_Z91Ve-wSS_1q2J4329KI2GHEffNJ_5DXlWegDTQCFaonYYetcbYPJnGB8MoG9do9PdoPvvc';
				$registrationIds = $token_id;

				// prep the bundle
				$msg = array
				(
					'message' 	=> $msg,
					'title'		=> $title,
					'subtitle'	=> 'This is a subtitle. subtitle',
					'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
					'vibrate'	=> 1,
					'sound'		=> 1,
					'largeIcon'	=> 'large_icon',
					'smallIcon'	=> 'small_icon'
				);
				$fields = array
				(
					'registration_ids' 	=> $registrationIds,
					'data'			=> $msg
				);
				 
				$headers = array
				(
					'Authorization: key=' . $API_ACCESS_KEY,
					'Content-Type: application/json'
				);
				 
				$ch = curl_init();
				curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
				curl_setopt( $ch,CURLOPT_POST, true );
				curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
				curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
				curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
				curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
				$result = curl_exec($ch );
				curl_close( $ch );
				return $result;
        }
		
	
		
		public function get_notifications_token($zone_id,$role) {
			//$where = array('l_delete'=>'1','l.status'=>'1','l.l_role'=>'user','l.l_mobile'=>$this->input->post('mobile'));
			//$query = $this->db->query("SELECT GROUP_CONCAT(user_token SEPARATOR ",") FROM login where fk_zone_id='$zone_id' and l_role = '$role' and l_delete = 1 and  status = 1");
			//$result = $query->result_array();        
			
			$this->db->select('user_token'); 
			$this->db->from('login');
			$this->db->where('fk_zone_id', $zone_id);
			$this->db->where('l_role', $role);
			$result = $this->db->get()->result_array();    
			return $result;
        }
		
		 public function add_pushnotification($form_data) {
        $result = $this->db->insert('pushnotification', $form_data);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
	
	  public function view_pushnotification($where){
        $this->db->select('*');
        $this->db->from('pushnotification p');
		$this->db->join('zone c', 'c.z_id = p.fk_zone_id');        
        $this->db->where($where);
        $this->db->order_by('pn_id','desc');
        $result = $this->db->get()->result_array();
       // echo $this->db->last_query();exit;
        return $result;
    }

    public function fireQuery($query) {
        $query = $this->db->query($query);
        $result = $query->result_array();
        return $result;
    }

    public function view_data($table, $where) {

        $this->db->select('*');
        $this->db->from($table);     
        $this->db->where($where);             
        $result = $this->db->get()->result_array();        
        
        return $result;
    }

    public function getIdGenerator($module) {
        $query = $this->db->query("SELECT * FROM id_generator where module='".$module."'");
        $result = $query->result_array();
        
        $status = "";
        if (!empty($result) && count($result) > 0) {

            $id = $result[0]["next_id"] + 1;
            
            $data = array('next_id' => $id);
            $this->db->where('module', $module);
            $status = $this->db->update('id_generator', $data);

        } else {
            return '0';
        }

        return $status == 'true' ? $id : '0';
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

    public function updateOrderPrice($order_id) {
        $order_items = 0;
		$order_items_total_amount = 0;
		$order_delivery_charge_amount = 0;
		$order_savings_amount = 0;
        $order_total_amount = 0;
        $pickup_discount_amount = 0;
        $order_items_discount_amount = 0;


        $where = array('order_id' => $order_id);
        $order_items_data = $this->MasterMdl->view_data("order_items", $where);
       
        $order_where = array('id' => $order_id);
        $order_data = $this->MasterMdl->view_data("orders", $order_where);

        foreach ($order_items_data as $item) {

            $query = "SELECT * FROM product WHERE p_id=".$item['product_id'];
            $inventoryResult = $this->MasterMdl->fireQuery($query);
            
            $userQuantity = intval($item['quantity']);
            $p_amount = floatval($item["amount"]);
            $p_user_profit = floatval($inventoryResult[0]["p_user_profit"]);

            // order items total amount
			$total = $userQuantity * $p_amount;
			$order_items_total_amount = $order_items_total_amount + $total;
            $order_savings_amount = $order_savings_amount + $p_user_profit;
            
            $order_items = $order_items + 1;
        }

        //Fetch delivery charges and thresold
        $where = array('key'=>'delivery', 'delete'=>'1');
        $order_delivery_charge_amount = floatval($this->MasterMdl->view_data('extras_content', $where)[0]['amount']);
        $where = array('key'=>'delivery_thresold', 'delete'=>'1');
        $delivery_thresold = floatval($this->MasterMdl->view_data('extras_content', $where)[0]['amount']);

        // apply delivery charges only if order item total amount exceeds delivery thresold or delivery mode is PickUp
        $order_delivery_charge_amount = $order_items_total_amount >= $delivery_thresold || $order_data[0]["delivery_mode"] == "PickUp" ? 0 : $order_delivery_charge_amount;

        //calculate order total amount = order items total - delivery charges
        $order_total_amount = $order_items_total_amount + $order_delivery_charge_amount;

        //Calculating pickup discount amount when order_delivery mode is PickUp
        $order_items_discount_amount = $order_savings_amount;
        $pickup_discount_amount = $order_data[0]["delivery_mode"] == "PickUp" ? 0.02 * $order_items_total_amount : 0;
        $order_total_amount = $order_total_amount - $pickup_discount_amount;
        $order_savings_amount = $order_savings_amount + $pickup_discount_amount;
        
        $order_data_update = array(
            'order_items' => $order_items,  				
            'order_items_total_amount' => $order_items_total_amount,
            'order_delivery_charge_amount' => $order_delivery_charge_amount,
            'order_savings_amount' => $order_savings_amount,
            'order_items_discount_amount' => $order_items_discount_amount,
            'order_total_amount' => $order_total_amount,
            'pickup_discount_amount' => $pickup_discount_amount,
        );

        $where = array('id' => $order_id);
        $this->MasterMdl->update_table($where ,$order_data_update, "orders");
        //print_r($where);
    }

    public function returnInventoryOrderItems($order_id){
        
        //Return all quantities from order items to inventory
        $where = array('order_id' => $order_id, 'active' => '1');
        $order_items_data = $this->MasterMdl->view_data("order_items", $where);
        foreach ($order_items_data as $item) {

            $userQuantity = intval($item['quantity']);
    
            $query = "SELECT * FROM product WHERE p_id=".$item['product_id'];
            $inventoryResult = $this->MasterMdl->fireQuery($query);

            //Addition of quantity of inventory after order item is added
            $where_update = array('p_id'=>$item['product_id']);
            $totalQuatity = $inventoryResult['0']['p_quantity'];
            $totalQuatity = intval($totalQuatity) + intval($userQuantity);
            $form_data = array('p_quantity'=>$totalQuatity);
            $result = $this->MasterMdl->update_table($where_update, $form_data,'product');

            $where_update = array('order_item_id'=>$item['order_item_id']);
            $form_data = array('active'=> '0');
            $this->MasterMdl->update_table($where_update, $form_data,'order_items');
        }
    }

    public function returnOrderItemQuantity($order_item_id){

        $where = array('order_item_id' => $order_item_id, 'active' => '1');
        $order_items_data = $this->MasterMdl->view_data("order_items", $where);

        foreach ($order_items_data as $item) {

            $userQuantity = intval($item['quantity']);
    
            $query = "SELECT * FROM product WHERE p_id=".$item['product_id'];
            $inventoryResult = $this->MasterMdl->fireQuery($query);

            //Addition of quantity of inventory after order item is added
            $where_update = array('p_id'=>$item['product_id']);
            $totalQuatity = $inventoryResult['0']['p_quantity'];
            $totalQuatity = intval($totalQuatity) + intval($userQuantity);
            $form_data = array('p_quantity'=>$totalQuatity);
            $result = $this->MasterMdl->update_table($where_update, $form_data,'product');

            $where_update = array('order_item_id'=>$item['order_item_id']);
            $form_data = array('active'=> '0');
            $this->MasterMdl->update_table($where_update, $form_data,'order_items');
        }

    }

    public function deleteData($table, $where){
        $this->db->where($where);
        $this->db->delete($table); 
    }

    public function sendNotificationToAdmins($order_id, $order_number){
        
        //Send notification to every admin
        $where_admins = array(
            'l_delete' => 1,
            'l_role' => "admin",
            );
        
        $userAdmins = $this->MasterMdl->view_data("login", $where_admins);
        $msg = "New order received - #".$order_number;
        foreach ($userAdmins as $item) {
            $notify_data = array(
                'message' => $msg,
                'order_id' =>  $order_id,
                'assign_notification_id' =>  $item['l_id'],
                );

            $this->db->insert('order_notification', $notify_data);
        }
        
        //Send notification to super admin
        $notify_data = array(
            'message' => $msg,
            'order_id' =>  $order_id,
            'assign_notification_id' =>  1,
            );

        $this->db->insert('order_notification', $notify_data);
    }

}

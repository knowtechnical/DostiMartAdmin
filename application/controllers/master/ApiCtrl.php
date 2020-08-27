<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ApiCtrl extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('url');
        $this->output->set_template('theme');
        $this->load->library('form_validation');
        $this->load->helper('file');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->database();
        $this->load->model('master/ApiMdl');
         $this->load->model('master/ApiMdl');
    }
    
    public function api_fetchProductsByName() { //http://localhost/mezban/index.php/api_fetchProductsByName
        $response = array();
        $product_name = $this->input->post('product_name');
        if(isset($product_name)) {

            $query = $this->db->query("select p_id, p_name, p_amount as price, ceiling((p_user_profit/p_market_amount)*100) as save_percent
            from 
            product
            where (p_name like '%$product_name%' or brand_name like '%$product_name%') and p_delete=1 ");
            $result = $query->result_array();

            $response['data'] = $result;
        }
        print_r(json_encode($response));
        exit;	
    }



	public function api_login() {  // http://localhost/mezban/index.php/api_login?email=borolejivan@gmail.com&password=123456&role=superadmin
		$email = $this->input->get('email');
		$password = $this->input->get('password');
        $role = $this->input->get('role');        
        $data['data'] = $this->ApiMdl->login($email,$password,$role);
        if(count($data['data']) == 0){
            echo "Email Or Password Does Not Match";exit;
        }else{            
            print_r(json_encode($data));exit;	
        }   
    }
    
    public function api_view_brand() {  //  http://localhost/mezban/index.php/api_view_brand      
        $where = array('b_delete'=>'1','status'=>'1');
        $data['brand'] = $this->ApiMdl->view_brand($where);
        print_r(json_encode($data));exit;	        
    }  

    public function api_view_category() {        //  http://localhost/mezban/index.php/api_view_category
        $where = array('c_delete'=>'1','status'=>'1');
        $data['category'] = $this->ApiMdl->view_category($where);
        print_r(json_encode($data));exit;	   
    }

    public function api_view_product() {        //  http://localhost/mezban/index.php/api_view_product?category_id=&shop_id=7
     //   echo $this->input->get('category_id');exit;
        $where = array_filter(array('p_delete'=>'1','p.status'=>'1','p.fk_shop_id'=>$this->input->get('shop_id'),'p.fk_category_id'=>$this->input->get('category_id')));
      //  print_r($where);exit;
        $data['product'] = $this->ApiMdl->view_product($where);
        print_r(json_encode($data));exit;	   
    }

    public function api_view_advertisment() {       // http://localhost/mezban/index.php/api_view_advertisment
        $where = array('a_delete'=>'1','a.status'=>'1');
        $data['result'] = $this->ApiMdl->view_advertisment($where);
        print_r(json_encode($data));exit;	
    }

    public function api_view_quiz() {        //  // http://localhost/mezban/index.php/api_view_quiz
        $today_date = date('d-m-Y');
        $where = array('q_delete'=>'1','status'=>'1','q.q_start_date' => $today_date);
        $data['result'] = $this->ApiMdl->view_quiz($where);
        print_r(json_encode($data));exit;	
    }

    public function api_view_news() {  //  // http://localhost/mezban/index.php/api_view_news
        $n_date = date('d-m-Y');
        $where = array('n_delete'=>'1','status'=>'1','n_date'=>$n_date);
        $data['result'] = $this->ApiMdl->view_news($where);
        print_r(json_encode($data));exit;
    }

    public function api_view_shop() {        // http://localhost/mezban/index.php/api_view_shop       
        $where = array_filter(array('s_delete'=>'1','s.status'=>'1','sc.status'=>'1','sc.fk_category_id'=>$this->input->get('category_id')));
        $data['result'] = $this->ApiMdl->view_shop($where);
        print_r(json_encode($data));exit;
    }

    public function api_view_product_details() {        //  http://localhost/mezban/index.php/api_view_product_details?product_id=1        
           $where = array('p.p_delete'=>'1','p.status'=>'1','p.p_id'=>$this->input->get('product_id'));
            $data['product'] = $this->ApiMdl->api_view_product_details($where);
            $data['pimages'] = $this->ApiMdl->get_product_img($this->input->get('product_id'));
           print_r(json_encode($data));exit;	   
       }

       public function api_view_shop_details() {        // http://localhost/mezban/index.php/api_view_shop_details     
        $where = array('s_delete'=>'1','s.status'=>'1','s.s_id'=>$this->input->get('shop_id'));
        $data['shop'] = $this->ApiMdl->api_view_shop_details($where);
        $data['category'] = $this->ApiMdl->get_shop_category($this->input->get('shop_id'));
        print_r(json_encode($data));exit;
    }


    public function api_insert_order() {        // http://localhost/mezban/index.php/api_insert_order    
        
        	// $json = '[
			// 	{
			// 	"user_id":"11",
			// 	"product_id":"45",
			// 	"shop_id":"3",
            //     "category_id":"3",
            //     "o_amount":"3",
            //     "o_quantity":"3",
            //     "o_date":"9-5-2019"
			// 	},
			// 	{
			// 	"user_id":"12",
			// 	"product_id":"55",
			// 	"shop_id":"3",
            //     "category_id":"3",
            //     "o_amount":"3",
            //     "o_quantity":"3",
            //     "o_date":"8-5-2019"
			// 	}
            // ]';
            
            
                
		$json = $_GET['invoice'];
		$data = json_decode($json, true);
        $form_data = array();
        $result = array();
        $order_id = date('YmdHis');
		foreach ($data as $item) {
            $form_data = array(
                'order_id' => $order_id,
                'fk_user_id' => $item['user_id'],
                'fk_product_id' =>$item['product_id'],                    
                'fk_category_id' =>$item['category_id'],
                'o_amount' =>$item['o_amount'],
                'o_quantity' =>$item['o_quantity'],
                'o_date' => date('d-m-Y'),            
             );
				// print_r($form_data);
				 $result = $this->db->insert('sale_order', $form_data);
		}
		if($result == true){
		    echo "Success";	
		}else{
			  echo "Error";
		}
		exit;
        
        // $form_data = array(
        //     'fk_user_id' => 1,//(int)$_SESSION['all']['l_id'],
        //     'fk_product_id' => $this->input->get('fk_product_id'),
        //     'fk_brand_id' => $this->input->get('fk_brand_id'),            
        //     'fk_category_id' => $this->input->get('fk_category_id'),
        //     'o_amount' => $this->input->get('o_amount'),
        //     'o_quantity' => $this->input->get('o_quantity'),
        //     'o_date' => date('d-m-Y'),            
        //  );

        //  if ($insert_id = $this->ApiMdl->api_insert_order($form_data)) {
        //     $data =  array('status' => 'Success');
        //     print_r(json_encode($data));exit;
        //  }else{
        //     $data =  array('status' => 'Error')
        //     print_r(json_encode($data));exit;
        //  }

    }


    public function api_signup_user() {        // http://localhost/mezban/index.php/api_signup_user
        
        if (isset($_GET['mobile'])) {

            $where = array('l_delete'=>'1','l.status'=>'1','l.l_email'=>$this->input->get('email'));
            $email = $this->ApiMdl->get_mobile_email($where);
            if(count($email) != 0){
                echo "Email Already Used";exit;
            }
            $where = array('l_delete'=>'1','l.status'=>'1','l.l_mobile'=>$this->input->get('mobile'));
            $email = $this->ApiMdl->get_mobile_email($where);
            if(count($email) != 0){
                echo "Mobile Number Already Used";exit; 
            }
           //echo 2222;exit;
            $uploadpath ='Uploads/profile_image';
            $image_name = 'profile_image';
            $config['upload_path'] = $uploadpath;
            $config['allowed_types'] = 'image|jpg|png|jpeg';						
            $config['overwrite'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload($image_name);
            $data =  $this->upload->data();           
            $proof = $data['file_ext'];
            $pic = $data['file_name'];    
            $profile_image =  $uploadpath.'/'.$pic;

            $form_data = array(
            'l_name' => $this->input->get('name'),
            'l_mobile' => $this->input->get('mobile'),
            'l_email' => $this->input->get('email'),
            'l_password' => $this->input->get('password'),
            'l_profile_image' => $profile_image,
            'l_role' => 'user',
             );
        if ($insert_id = $this->ApiMdl->add_user($form_data)) {
            echo "Success";	
        } else {
            echo "Error";
        }
        exit;    }
    }

    public function api_login_user() {        // http://localhost/mezban/index.php/api_login_user   
        $where = array('l_delete'=>'1','l.status'=>'1','l.l_email'=>$this->input->get('email'),'l.l_password'=>$this->input->get('password'));
            $count = $this->ApiMdl->login($where);
            if(count($count) == 0){
                echo "Email Or Password Does Not Match";exit;
            }else{
                $data = $this->ApiMdl->login($where);
                print_r(json_encode($data));exit;
            }        
    }

}

/***

}

/* End of file welcome.php */
/* Location: ./application/controle_typeers/welcome.php */

        
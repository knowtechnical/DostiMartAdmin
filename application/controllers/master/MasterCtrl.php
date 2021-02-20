<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MasterCtrl extends CI_Controller {

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
        $this->load->model('master/MasterMdl');
        //   $this->load->model('Common_Model');
    }

    public function set_home_type() {
        if (isset($_POST['home_type'])) {            
            $form_data = array('home_type' => $this->input->post('home_type'));
            if ($insert_id = $this->MasterMdl->home_type($form_data)) {                 
            echo 'success';
            } else {
                echo 'error';
            }
            exit;
        }      
    }

    public function get_home_type() {
        $data = $this->MasterMdl->get_home_type();      
        echo $data['home_type'];exit;
    }

    function upload_singleimage($uploadpath,$image_name)
	{
		$config['upload_path'] = $uploadpath;
		$config['allowed_types'] = 'pdf|image|gif|jpg|png|jpeg';						
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->do_upload($image_name);
		$data =  $this->upload->data();		
		
		$proof = $data['file_ext'];
		$pic = $data['file_name'];

		return $uploadpath.'/'.$pic;
	}

    public function view_user() {
        if(!isset($_SESSION['all'])){redirect('login');}
        //print_r($_SESSION['all']);exit;
        if($_SESSION['all']['l_role'] == 'superadmin'){
            $where = array('l_role !='=>'superadmin');
        }elseif($_SESSION['all']['l_role'] == 'admin'){
            $where = array('l_role !='=>'superadmin','l_addedby'=>$_SESSION['all']['l_id']);
        }
       
        $data['result'] = $this->MasterMdl->view_user($where);
        //print_r($data['result']);exit;
        $this->load->view('master/view_user', $data);
    }
	
	public function add_text() {

        if (isset($_POST['submit'])) {

                $form_data = array(
                'add_text' => $this->input->post('add_text'),                
                 );
            if ($insert_id = $this->MasterMdl->add_text($form_data)) {
                $_SESSION['responsemsg'] = "Updated Successfully";
                redirect('view_quiz');
            } else {
                $_SESSION['responsemsg'] = "Error";
                redirect('view_quiz');
            }
        }
		$where = array('z_delete'=>'1','status'=>'1');
		$data['zone'] = $this->MasterMdl->view_zone($where);
		//print_r($data['zone']);exit;
        $this->load->view('master/add_user',$data);
    }

    public function add_user() {

        if (isset($_POST['submit'])) {

                $form_data = array(
                'l_name' => $this->input->post('l_name'),
                'l_addedby' => (int)$_SESSION['all']['l_id'],
                'l_mobile' => $this->input->post('l_mobile'),
                'l_email' => $this->input->post('l_email'),
                'l_password' => $this->input->post('l_password'),
                'l_role' => $this->input->post('l_role'),
				'fk_zone_id' => $this->input->post('fk_zone_id'),
                'otp_status' => $this->input->post('l_role')=='user'?0:1,
                 );
            if ($insert_id = $this->MasterMdl->add_user($form_data)) {
                $_SESSION['responsemsg'] = "Added Successfully";
                redirect('view_user');
            } else {
                $_SESSION['responsemsg'] = "Error";
                redirect('view_user');
            }
        }
		$where = array('z_delete'=>'1','status'=>'1');
		$data['zone'] = $this->MasterMdl->view_zone($where);
		//print_r($data['zone']);exit;
        $this->load->view('master/add_user',$data);
    }

    public function edit_user() {
        $id = $this->uri->segment(2, 0);
        if (isset($_POST['update'])) {
            $form_data = array(
            'l_name' => $this->input->post('l_name'),
            'l_mobile' => $this->input->post('l_mobile'),
            'l_email' => $this->input->post('l_email'),
            'l_password' => $this->input->post('l_password'),
            'l_role' => $this->input->post('l_role'),
			'fk_zone_id' => $this->input->post('fk_zone_id'),
             );
        if ($this->MasterMdl->edit_user($id,$form_data)) {
            $_SESSION['responsemsg'] = "Edited Successfully";
            redirect('view_user');
        } else {
            $_SESSION['responsemsg'] = "Error!";
            redirect('view_user');
        }
    }
	$where = array('z_delete'=>'1','status'=>'1');
		$data['zone'] = $this->MasterMdl->view_zone($where);
       $data['row'] = $this->MasterMdl->get_user($id);        
        $this->load->view('master/edit_user',$data);
    }

    public function deleterow() {
        $id = $this->input->post('id');
        $tdeletecolumn = $this->input->post('tdeletecolumn');
        $deleteid = $this->input->post('deleteid');
        $tablename = $this->input->post('tablename');
        $form_data = array($tdeletecolumn => 0);
        if ($this->MasterMdl->deleterow($id,$deleteid,$tablename,$form_data)) {
            echo 'success';
        } else {
            echo 'error';
        }
        exit;
    }

    public function view_profile() {
        $id = $this->uri->segment(2, 0);        
        $data['row1'] = $this->MasterMdl->get_user($id);     
        
        $where = array('fk_mobile'=>$data['row1']['l_mobile']);
        //print_r($where);exit;
        $orders = $this->MasterMdl->view_orders_details($where);
	
			$data = array();
			$index=0;
			foreach($orders as $row){
				$where_product = array('p.p_delete'=>'1','p.status'=>'1','p.p_id'=>$row['fk_product_id'],'p.fk_category_id'=>$row['fk_category_id']);
				$product = $this->MasterMdl->api_view_product_details($where_product);
				$order_status = array('0'=>'Deleted','1'=>'Pending','2'=>'Completed','3'=>'Canceled');			
               
				$data['result'][$index] = array(
					'shop_name' => $product['s_name'],
					'category_name' => $product ['c_name'],
					'product_name' => $product ['p_name'],
                    'p_amount' => $product ['p_amount'],                  
					'p_quantity' => $product ['p_quantity'],
                    'p_description' => $product ['p_description'],
                    'p_thumbnail' => $product ['p_thumbnail'],
                    'order_id' => $row['order_id'],
                    'l_name' => $row['l_name'],
                    'l_role' => $row['l_role'],
                    'l_mobile' => $row['l_mobile'],
                    'l_address' => $row['l_address'],
                    'o_date' => $row['o_date'],
                    'ostatus' => $row['status'],
					'order_status' => $order_status[$row['status']],				
					 );					 
                     $index++;
            }


        $this->load->view('master/view_profile',$data);
    }

    public function view_zone() {
        if (isset($_POST['submit'])) {
            $form_data = array(
            'z_name' => $this->input->post('z_name'),
            );
        if ($insert_id = $this->MasterMdl->add_zone($form_data)) {
            $_SESSION['responsemsg'] = "Added Successfully";
            redirect('view_zone');
        } else {
            $_SESSION['responsemsg'] = "Error";
            redirect('view_zone');
        }
    }
        $where = array('z_delete'=>'1','status'=>'1');
        $data['result'] = $this->MasterMdl->view_zone($where);
        $this->load->view('master/view_zone', $data);
    }
    public function view_brand() {
        if (isset($_POST['submit'])) {
            $form_data = array(
            'b_name' => $this->input->post('b_name'),
            );
        if ($insert_id = $this->MasterMdl->add_brand($form_data)) {
            $_SESSION['responsemsg'] = "Added Successfully";
            redirect('view_brand');
        } else {
            $_SESSION['responsemsg'] = "Error";
            redirect('view_brand');
        }
    }
        $where = array('b_delete'=>'1','status'=>'1');
        $data['result'] = $this->MasterMdl->view_brand($where);
        $this->load->view('master/view_brand', $data);
    }

    public function edit_table() {

        $id = $this->input->post('id');
        $editid = $this->input->post('editid');
        $tablename = $this->input->post('tablename');       
        if (isset($_POST['b_name'])) {
            $form_data = array('b_name' => $this->input->post('b_name'));
        }  
        if (isset($_POST['c_name'])) {
            $form_data = array('c_name' => $this->input->post('c_name'));
        }   
        if (isset($_POST['z_name'])) {
            $form_data = array('z_name' => $this->input->post('z_name'));
        } 
            if ($this->MasterMdl->edit_table($id,$editid,$tablename,$form_data)) {
                echo 'success';
            } else {
                echo 'error';
            }
            exit;
        }      
    

    public function view_category() {
        if (isset($_POST['submit'])) {
            $form_data = array(
            'c_name' => $this->input->post('c_name'),
            );
        if ($insert_id = $this->MasterMdl->add_category($form_data)) {
            $_SESSION['responsemsg'] = "Added Successfully";
            redirect('view_category');
        } else {
            $_SESSION['responsemsg'] = "Error";
            redirect('view_category');
        }
    }
        $where = array('c_delete'=>'1','status'=>'1');
        $data['result'] = $this->MasterMdl->view_category($where);
        $this->load->view('master/view_category', $data);
    }

    

    public function view_product() { 

        if($_SESSION['all']['l_role']  == 'vendor'){
            $wherevendor = array('s_delete'=>'1','s.status'=>'1','s_addedby'=>$_SESSION['all']['l_id']);
            $shops = $this->MasterMdl->view_shop($wherevendor);  
            $ids = array();
            foreach ($shops as $id)
            {
                $ids[] = $id['s_id'];
            }
            $where = array('p_delete'=>'1','p.status'=>'1');
            $data['result'] = count($shops)==0?array():$this->MasterMdl->view_product_vendor($where,$ids);
        }else{
            $where = array('p_delete'=>'1','p.status'=>'1');
            $data['result'] = $this->MasterMdl->view_product($where);
        }   
        
        
        $this->load->view('master/view_product', $data);
    }

    public function get_category_from_shop() {
        $id = $_POST['fk_shop_id'];
        $whereall = array('sc.sc_delete'=>'1','sc.status'=>'1','sc.fk_shop_id'=> $id);
        $result = $this->MasterMdl->get_category_from_shop($whereall); 
        echo $result;
        die();
    }



    public function add_product() {
        

        if (isset($_POST['submit'])) {          
          
            $is_weight_product = $this->input->post('total_weight') > 0 ? '1' : '0';
            $form_data = array(
            'fk_category_id' => $this->input->post('fk_category_id'),
            'fk_shop_id' => $this->input->post('fk_shop_id'),
            'fk_zone_id' => $this->input->post('fk_zone_id'),
            'p_addedby' => (int)$_SESSION['all']['l_id'],
            'p_name' => $this->input->post('p_name'),
            'p_quantity_description' => $this->input->post('p_quantity_description'),
            'p_show_on_homepage' => $this->input->post('p_show_on_homepage')==1?'1':'0',
            'p_amount' => $this->input->post('p_amount'),
            'p_market_amount' => $this->input->post('p_market_amount'),
            'p_buying_amount' => $this->input->post('p_buying_amount'),
            'p_admin_profit' => $this->input->post('p_admin_profit'),
            'p_user_profit' => $this->input->post('p_user_profit'),
            'p_quantity' => $this->input->post('p_quantity'),
            'weight_unit' => $this->input->post('weight_unit'),
            'p_total_weight' => $this->input->post('total_weight'),
            'profile_margin' => $this->input->post('profile_margin'),
            'is_weight_product' => $is_weight_product,
            'brand_name' => $this->input->post('brand_name'),
            'supplier_name' => $this->input->post('supplier_name'),
            'supplier_address' => $this->input->post('supplier_address'),
            'supplier_contact' => $this->input->post('supplier_contact'),
            'discount_rate' => $this->input->post('discount_rate'),
            'gstin' => $this->input->post('gstin'),
            'p_description' => $this->input->post('p_description'),
            'keywords' => $this->input->post('keywords'),
            'p_thumbnail' => $this->upload_singleimage('Uploads/product_image','p_thumbnail'),
            //'p_description'=>$this->upload_singleimage($uploadpath,$image_name),
                );
                
            if ($insert_id = $this->MasterMdl->add_product($form_data)) {

                    // Adding logs
                    if($this->input->post('purchase_type') == 'purchase') {
                        $purchase_qty = 0;
                        $log = array(
                            'p_selling_price' => $this->input->post('p_amount'),
                            'p_market_amount' => $this->input->post('p_market_amount'),
                            'p_buying_amount' => $this->input->post('p_buying_amount'),
                            'p_admin_profit' => $this->input->post('p_admin_profit'),
                            'p_user_profit' => $this->input->post('p_user_profit'),
                            'supplier_name' => $this->input->post('supplier_name'),
                            'supplier_address' => $this->input->post('supplier_address'),
                            'supplier_contact' => $this->input->post('supplier_contact'),
                            'gstin' => $this->input->post('gstin'),
                            'purchase_quantity' => $purchase_qty,
                            'profile_margin' => $this->input->post('profile_margin'),
                            'discount_rate' => $this->input->post('discount_rate'),
                            'product_id' => $insert_id,
                            //'p_description'=>$this->upload_singleimage($uploadpath,$image_name),
                            );
                        $this->MasterMdl->add_product_log($log);
                    }

                    $weight_unit = $this->input->post('total_range_value');
                    $this->MasterMdl->updateRange($insert_id);
 
                    $imagetype = array(image_type_to_mime_type(IMAGETYPE_GIF), image_type_to_mime_type(IMAGETYPE_JPEG),
                    image_type_to_mime_type(IMAGETYPE_PNG), image_type_to_mime_type(IMAGETYPE_BMP));
                    $error_msg = "";
                    $imageUploadERROR = FALSE;
                    $FOLDER = "Uploads/product_image/";
                    $myfile = $_FILES["uploaded_file"];
                    $total_images = count($myfile['name']);
                   
                    for ($i = 0; $i < $total_images; $i++) {
                        if ($myfile["name"][$i] <> "" && $myfile["error"][$i] == 0) {     
                            if (in_array($myfile["type"][$i], $imagetype)) {
                                    $file_extention = @strtolower(@end(@explode(".", $myfile["name"][$i])));
                                $file_name = date("Ymd") . '_' . rand(10000, 990000) . '.' . $file_extention;
                                
                                if (move_uploaded_file($myfile["tmp_name"][$i], $FOLDER . $file_name) === FALSE) {
                                    $error_msg = "Error while uploading the file";
                                } else {
                                    $error_msg = "File uploaded successfully with name: " . $file_name;
                                }
                            } else {
                                $error_msg = "File is not a valid image type.";
                            }
                        }
                        if(strlen($FOLDER.$file_name) > 23){
                            $form_data_img = array(
                            'product_img' => $FOLDER.$file_name,
                            'fk_product_id' => $insert_id,                    
                            );
                            $this->MasterMdl->add_product_img($form_data_img);  
                        }
                    } 
                   
                    $_SESSION['responsemsg'] = "Added Successfully";
                    redirect('view_product');
            } else {
                $_SESSION['responsemsg'] = "Error";
                redirect('view_product');
            }
        }

        // $wherecategory = array('c_delete'=>'1','status'=>'1');
        // $data['category'] = $this->MasterMdl->view_category($wherecategory);
        $where = array('s_delete'=>'1','s.status'=>'1','z_delete'=>'1','z.status'=>'1');
        $data['shop'] = $this->MasterMdl->view_shop_product($where);     
        //print_r( $data['shop'] );exit;   
        // $wherebrand = array('b_delete'=>'1','status'=>'1');
        // $data['brand'] = $this->MasterMdl->view_brand($wherebrand);
        $this->load->view('master/add_product', $data);
    }


    public function view_product_details() {
        $id = $this->uri->segment(2, 0);
        $data['row'] = $this->MasterMdl->get_product($id);    
        //$data['productimg'] = $this->MasterMdl->get_product_img($id);  
        $wherepimg = array('fk_product_id'=>$id,'pi_delete'=>'1');
        $data['productimg'] = $this->MasterMdl->view_pimg($wherepimg);
        $data['range'] = $this->MasterMdl->getProductWeightRange($id);
        $this->load->view('master/view_product_details',$data);
    }

    public function edit_product() {

        $id = $this->uri->segment(2, 0);
        if (isset($_POST['update'])) {    
            if (!empty($_FILES["p_thumbnail"]["name"])) {
                unlink(base_url().$this->input->post('bk_p_thumbnail')); 
                $uploadimg = $this->upload_singleimage('Uploads/product_image','p_thumbnail');
            }else{
                $uploadimg = $this->input->post('bk_p_thumbnail');
            }
  
            $is_weight_product = $this->input->post('p_total_weight') > 0 ? '1' : '0';    
            
            #add inventory quantity
            $purchase_qty = 0;
            $purchase_qty = $this->input->post('purchase_qty');
            

            $product_results = $this->MasterMdl->get_product($id);
            $inventory_quantity = $product_results['p_quantity'];
            $inventory_quantity = $inventory_quantity + intval($purchase_qty);

            //Add product purchase logs only if "purchase" is selected
            if($this->input->post('purchase_type') == 'purchase') {
                $log = array(
                    'p_selling_price' => $this->input->post('p_amount'),
                    'p_market_amount' => $this->input->post('p_market_amount'),
                    'p_buying_amount' => $this->input->post('p_buying_amount'),
                    'p_admin_profit' => $this->input->post('p_admin_profit'),
                    'p_user_profit' => $this->input->post('p_user_profit'),
                    'purchase_quantity' => $purchase_qty,
                    'supplier_name' => $this->input->post('supplier_name'),
                    'supplier_address' => $this->input->post('supplier_address'),
                    'supplier_contact' => $this->input->post('supplier_contact'),
                    'gstin' => $this->input->post('gstin'),
                    'profile_margin' => $this->input->post('profile_margin'),
                    'discount_rate' => $this->input->post('discount_rate'),
                    'product_id' => $id,
                );
                $this->MasterMdl->add_product_log($log);
            }

            $form_data = array(
                'fk_category_id' => $this->input->post('fk_category_id'),
                'fk_shop_id' => $this->input->post('fk_shop_id'),
                'p_addedby' => (int)$_SESSION['all']['l_id'],
                'p_show_on_homepage' => $this->input->post('p_show_on_homepage')==1?'1':'0',
                'p_name' => $this->input->post('p_name'),
                'p_quantity_description' => $this->input->post('p_quantity_description'),
                'p_amount' => $this->input->post('p_amount'),
                'profile_margin' => $this->input->post('profile_margin'),
                'p_market_amount' => $this->input->post('p_market_amount'),
                'p_buying_amount' => $this->input->post('p_buying_amount'),
                'p_admin_profit' => $this->input->post('p_admin_profit'),
                'p_user_profit' => $this->input->post('p_user_profit'),
                'p_quantity' => $inventory_quantity,
                'purchase_quantity' => $this->input->post('purchase_qty'),
                'weight_unit' => $this->input->post('weight_unit'),
                'total_weight' => $this->input->post('p_total_weight'),
                'is_weight_product' => $is_weight_product,
                'brand_name' => $this->input->post('brand_name'),
                'supplier_name' => $this->input->post('supplier_name'),
                'supplier_address' => $this->input->post('supplier_address'),
                'supplier_contact' => $this->input->post('supplier_contact'),
                'gstin' => $this->input->post('gstin'),
                'p_description' => $this->input->post('p_description'),
                'discount_rate' => $this->input->post('discount_rate'),
                'keywords' => $this->input->post('keywords'),
                'p_thumbnail' => $uploadimg,
             );
            if ($this->MasterMdl->edit_product($id,$form_data)) {

                $this->MasterMdl->updateRange($id);

                $imagetype = array(image_type_to_mime_type(IMAGETYPE_GIF), image_type_to_mime_type(IMAGETYPE_JPEG),
                image_type_to_mime_type(IMAGETYPE_PNG), image_type_to_mime_type(IMAGETYPE_BMP));
                $error_msg = "";
                $imageUploadERROR = FALSE;
                $FOLDER = "Uploads/product_image/";
                $myfile = $_FILES["uploaded_file"];   ///
                $total_images =  count($myfile['name']);
                //echo $total_images;exit;
                for ($i = 0; $i < $total_images; $i++) {
                if ($myfile["name"][$i] <> "" && $myfile["error"][$i] == 0) {     
                    if (in_array($myfile["type"][$i], $imagetype)) {
                            $file_extention = @strtolower(@end(@explode(".", $myfile["name"][$i])));
                            $file_name = date("Ymd") . '_' . rand(10000, 990000) . '.' . $file_extention;
                            
                            if (move_uploaded_file($myfile["tmp_name"][$i], $FOLDER . $file_name) === FALSE) {
                                $error_msg = "Error while uploading the file";
                            } else {
                                $error_msg = "File uploaded successfully with name: " . $file_name;
                            }
                        } else {
                            $error_msg = "File is not a valid image type.";
                        }
                    }
                    if(strlen($FOLDER.$file_name) > 23){
                        $form_data_img = array(
                        'product_img' => $FOLDER.$file_name,
                        'fk_product_id' => $id,                    
                        );
                        $this->MasterMdl->add_product_img($form_data_img);  
                    } 
                }
                $_SESSION['responsemsg'] = "Edited Successfully";
                redirect('view_product');
            } else {
                $_SESSION['responsemsg'] = "Error!";
                redirect('view_product');
            }
        }

        $where = array('s_delete'=>'1','s.status'=>'1');
        $data['shop'] = $this->MasterMdl->view_shop_product($where);
        $data['range'] = $this->MasterMdl->getProductWeightRange($id);
        // $wherebrand = array('b_delete'=>'1','status'=>'1');
        // $data['brand'] = $this->MasterMdl->view_brand($wherebrand);
        $wherepimg = array('fk_product_id'=>$id,'pi_delete'=>'1');
        $data['productimg'] = $this->MasterMdl->view_pimg($wherepimg);       
        $data['row'] = $this->MasterMdl->get_product($id);        
        $this->load->view('master/edit_product',$data);
    }

    public function view_news() {
        if (isset($_POST['submit'])) {
            
            $target_dir = "Uploads/news/";
            $n_pdf = $target_dir . basename($_FILES["n_pdf"]["name"]);
            $FileType = pathinfo($n_pdf, PATHINFO_EXTENSION);
            $rand = md5(uniqid() . rand());
            $post_image = $rand . "." . $FileType;
            $n_pdf = $target_dir . $post_image;
            if (move_uploaded_file($_FILES["n_pdf"]["tmp_name"], $n_pdf)) {
                $n_pdf = $n_pdf;
            } else {
                $n_pdf = "";
            }


            $form_data = array(
            'n_name' => $this->input->post('n_name'),    
            'n_date' => $this->input->post('n_date'),         
            'n_pdf'=>$n_pdf,
            );
        if ($insert_id = $this->MasterMdl->add_news($form_data)) {
            $_SESSION['responsemsg'] = "Added Successfully";
            redirect('view_news');
        } else {
            $_SESSION['responsemsg'] = "Error";
            redirect('view_news');
        }
    }
        $where = array('n_delete'=>'1','status'=>'1');
        $data['result'] = $this->MasterMdl->view_news($where);
        $this->load->view('master/view_news', $data);
    }

    public function edit_news() {
        if (isset($_POST['update'])) {
            
            $id = $this->input->post('editnews_id');

            if (!empty($_FILES["n_pdf"]["name"])) {
                unlink(base_url().$this->input->post('bk_n_pdf')); 
                $uploadpath = 'Uploads/news';
                $image_name = 'n_pdf';
                $uploadimg = $this->upload_singleimage($uploadpath,$image_name);

            }else{
                $uploadimg = $this->input->post('bk_n_pdf');
            }            

            $form_data = array(
            'n_name' => $this->input->post('n_name'), 
            'n_date' => $this->input->post('n_date'),               
            'n_pdf'=>$uploadimg,
            );
        if ($this->MasterMdl->edit_news($id,$form_data)) {
            $_SESSION['responsemsg'] = "Edited Successfully";
            redirect('view_news');
        } else {
            $_SESSION['responsemsg'] = "Error!";
            redirect('view_news');
        }
        }    
    }

    public function view_advertisment() {        
        $where = array('a_delete'=>'1','a.status'=>'1');
        $data['result'] = $this->MasterMdl->view_advertisment($where);
        $this->load->view('master/view_advertisment', $data);
    }

    public function add_advertisment() {
        if (isset($_POST['submit'])) {         
            $form_data = array(
            'a_name' => $this->input->post('a_name'),                
            'a_addedby' => (int)$_SESSION['all']['l_id'],
            'a_start_date' => date('Y-m-d', strtotime($this->input->post('a_start_date'))),//$this->input->post('a_start_date'),
            'a_end_date' => date('Y-m-d', strtotime($this->input->post('a_end_date'))),//$this->input->post('a_end_date'),
            'a_date' => date('Y-m-d'),
            'a_page' => $this->input->post('a_page'),
            'a_amount' => $this->input->post('a_amount'),
            'a_total_amount' => $this->input->post('a_total_amount'),
                );
            if ($insert_id = $this->MasterMdl->add_advertisment($form_data)) {
                $imagetype = array(image_type_to_mime_type(IMAGETYPE_GIF), image_type_to_mime_type(IMAGETYPE_JPEG),
                image_type_to_mime_type(IMAGETYPE_PNG), image_type_to_mime_type(IMAGETYPE_BMP));
                $error_msg = "";
                $imageUploadERROR = FALSE;
                $FOLDER = "Uploads/ad_image/";
                $myfile = $_FILES["uploaded_file"];
                $uploaded_file_position = $_POST["uploaded_file_position"];

                for ($i = 0; $i < count($myfile["name"]); $i++) {
                if ($myfile["name"][$i] <> "" && $myfile["error"][$i] == 0) {     
                    if (in_array($myfile["type"][$i], $imagetype)) {
                            $file_extention = @strtolower(@end(@explode(".", $myfile["name"][$i])));
                            $file_name = date("Ymd") . '_' . rand(10000, 990000) . '.' . $file_extention;
                            
                            if (move_uploaded_file($myfile["tmp_name"][$i], $FOLDER . $file_name) === FALSE) {
                                $error_msg = "Error while uploading the file";
                            } else {
                                $error_msg = "File uploaded successfully with name: " . $file_name;
                            }
                        } else {
                            $error_msg = "File is not a valid image type.";
                        }
                    }
                    if(strlen($FOLDER.$file_name) > 23){
                    $form_data_img = array(
                    'ai_img' => $FOLDER.$file_name,
                    'ai_position' => $uploaded_file_position[$i],
                    'fk_advertisment_id' => $insert_id,                    
                    );
                    $this->MasterMdl->add_advertisment_img($form_data_img);  
                    }
                }                    
                $_SESSION['responsemsg'] = "Added Successfully";
                redirect('view_advertisment');

            } else {
                $_SESSION['responsemsg'] = "Error";
                redirect('view_advertisment');
            }
        }        
        $this->load->view('master/add_advertisment');
    }

    public function edit_advertisment() {
        $id = $this->uri->segment(2, 0);
        if (isset($_POST['update'])) {         
            
                $form_data = array(
                'a_name' => $this->input->post('a_name'),                
                
                'a_start_date' => $this->input->post('a_start_date'),
                'a_end_date' => $this->input->post('a_end_date'),
               // 'a_position' => $this->input->post('a_position'),
                'a_page' => $this->input->post('a_page'),
                'a_amount' => $this->input->post('a_amount'),
                'a_total_amount' => $this->input->post('a_total_amount'),
                 );
				 
                // print_r($form_data);exit;
                
                $imagetype = array(image_type_to_mime_type(IMAGETYPE_GIF), image_type_to_mime_type(IMAGETYPE_JPEG),
                image_type_to_mime_type(IMAGETYPE_PNG), image_type_to_mime_type(IMAGETYPE_BMP));
                $error_msg = "";
                $imageUploadERROR = FALSE;
                $FOLDER = "Uploads/ad_image/";
                $myfile = $_FILES["uploaded_file"];
                $uploaded_file_position = $_POST["uploaded_file_position"];
                for ($i = 0; $i < count($myfile["name"]); $i++) {
                   
                if ($myfile["name"][$i] <> "" && $myfile["error"][$i] == 0) {     
                    if (in_array($myfile["type"][$i], $imagetype)) {
                            $file_extention = @strtolower(@end(@explode(".", $myfile["name"][$i])));
                            $file_name = date("Ymd") . '_' . rand(10000, 990000) . '.' . $file_extention;
                            
                            if (move_uploaded_file($myfile["tmp_name"][$i], $FOLDER . $file_name) === FALSE) {
                                $error_msg = "Error while uploading the file";
                            } else {
                                $error_msg = "File uploaded successfully with name: " . $file_name;
                            }
                        } else {
                            $error_msg = "File is not a valid image type.";
                        }
                    }
                    if(strlen($FOLDER.$file_name) > 23){
                    $form_data_img = array(
                    'ai_img' => $FOLDER.$file_name,
                    'ai_position' => $uploaded_file_position[$i],
                    'fk_advertisment_id' => $id,                    
                     );
                     $this->MasterMdl->add_advertisment_img($form_data_img);  
                    }
                }


                if ($this->MasterMdl->edit_advertisment($id,$form_data)) {                   
            $_SESSION['responsemsg'] = "Updated Successfully";
                redirect('view_advertisment');
            } else {
               
                $_SESSION['responsemsg'] = "Updated Successfully";
                redirect('view_advertisment');
            }
        }        
        $data['row'] = $this->MasterMdl->get_advertisment($id); 
        $data['row_img'] = $this->MasterMdl->get_adimg($id);     
          //print_r($data);   exit;
        $this->load->view('master/edit_advertisment',$data);
        //$this->load->view('master/edit_advertisment');
    }

    public function view_advertisment_details() {
        $id = $this->uri->segment(2, 0);
        $data['row'] = $this->MasterMdl->get_advertisment($id);     
        $data['productimg'] = $this->MasterMdl->get_adimg($id);
       // print_r($data['productimg']);exit;
        $this->load->view('master/view_advertisment_details',$data);
    }

    public function view_quiz() {        
        $where = array('q_delete'=>'1','q.status'=>'1');
        $data['result'] = $this->MasterMdl->view_quiz($where);
		$data['add_text'] = $this->MasterMdl->get_add_text($where);
		//print_r($data['add_text']);exit;
        $this->load->view('master/view_quiz', $data);
    }

    public function add_quiz() {
        if (isset($_POST['submit'])) {         
            
                $form_data = array(
                'q_user_id' => (int)$_SESSION['all']['l_id'],   
                'q_name' => $this->input->post('q_name'),   
                'q_start_date' => date("Y-m-d", strtotime($this->input->post('q_start_date'))),
                'q_question' => $this->input->post('q_question'),  
                'q_op1' => $this->input->post('q_op1'),  
                'q_op2' => $this->input->post('q_op2'),  
                'q_op3' => $this->input->post('q_op3'),  
                'q_op4' => $this->input->post('q_op4'),   
                'q_answer' => $this->input->post('q_answer'),                
                 );
            if ($insert_id = $this->MasterMdl->add_quiz($form_data)) {
                 
            $_SESSION['responsemsg'] = "Added Successfully";
                redirect('view_quiz');
            } else {
                $_SESSION['responsemsg'] = "Error";
                redirect('view_quiz');
            }
        }        
        $this->load->view('master/add_quiz');
    }
    
    public function edit_quiz() {
        $id = $this->uri->segment(2, 0);
        if (isset($_POST['update'])) {         
            
                $form_data = array(
                'q_name' => $this->input->post('q_name'),   
                'q_start_date' =>  date("Y-m-d", strtotime($this->input->post('q_start_date'))),
                'q_question' => $this->input->post('q_question'),  
                'q_op1' => $this->input->post('q_op1'),  
                'q_op2' => $this->input->post('q_op2'),  
                'q_op3' => $this->input->post('q_op3'),  
                'q_op4' => $this->input->post('q_op4'),   
                'q_answer' => $this->input->post('q_answer'),                
                 );
            if ($insert_id = $this->MasterMdl->edit_quiz($id,$form_data)) {                 
            $_SESSION['responsemsg'] = "Updated Successfully";
                redirect('view_quiz');
            } else {
                $_SESSION['responsemsg'] = "Error";
                redirect('view_quiz');
            }
        }        
        $where = array('q_delete'=>'1','q.status'=>'1','q.q_id' => $id);
        $data['row'] = $this->MasterMdl->get_quiz($where);
       // print_r($data['row']);exit;
        $this->load->view('master/edit_quiz',$data);
    }

    public function view_quiz_details() {
        $id = $this->uri->segment(2, 0);
             
        $where = array('q_delete'=>'1','q.status'=>'1','q.q_id' => $id);
        $data['row'] = $this->MasterMdl->get_quiz($where);
       // print_r($data['row']);exit;
        $this->load->view('master/view_quiz_details',$data);
    }

    public function view_question() {        
        $data['result'] = $this->MasterMdl->view_question();
        $this->load->view('master/view_question', $data);
    }

    public function delete_question() {
        $id = $this->uri->segment(2, 0);
        $this->db->where('qq_id', $id);
        $result = $this->db->delete('quiz_question');
        //echo $this->db->last_query();exit;
        if ($result == true || $result == 1) {
            $_SESSION['responsemsg'] = "Deleted Successfully";
            redirect('view_quiz');
        } else {
            $_SESSION['responsemsg'] = "Error!";
            redirect('view_quiz');
        }
    }

    public function view_shop() {        
        $where = array('s_delete'=>'1','s.status'=>'1');
        $data['result'] = $this->MasterMdl->view_shop($where);
        
        $this->load->view('master/view_shop', $data);
    }

    public function add_shop() {
        if (isset($_POST['submit'])) {
                    
                $uploadpath = 'Uploads/shop_image';
                $image_name = 's_image';
                $form_data = array(
                's_addedby' => (int)$_SESSION['all']['l_id'],
                's_name' => $this->input->post('s_name'),
                's_stime' => $this->input->post('s_stime'),
                's_etime' => $this->input->post('s_etime'),
                'fk_zone_id' => $this->input->post('fk_zone_id'),
                's_show_on_homepage' => $this->input->post('s_show_on_homepage')==1?'1':'0',
                's_number' => $this->input->post('s_number'),
                's_address' => $this->input->post('s_address'),
                's_image' => $this->upload_singleimage($uploadpath,$image_name),
                's_description' => $this->input->post('s_description'),
                 );
            if ($insert_id = $this->MasterMdl->add_shop($form_data)) {
                $fk_category_id = $_POST["fk_category_id"];
                for ($i = 0; $i < count($fk_category_id); $i++) {    
                    $form_data_category = array(
                    'fk_shop_id' => $insert_id,
                    'fk_category_id' => $fk_category_id[$i],                    
                    );
                    $this->MasterMdl->add_shop_category($form_data_category);       
                }                    
                $_SESSION['responsemsg'] = "Added Successfully";
                redirect('view_shop');
            } else {
                $_SESSION['responsemsg'] = "Error";
                redirect('view_shop');
            }
        }
        $wherezone = array('z_delete'=>'1','status'=>'1');
        $data['zone'] = $this->MasterMdl->view_zone($wherezone);
        $wherecategory = array('c_delete'=>'1','status'=>'1');
        $data['category'] = $this->MasterMdl->view_category($wherecategory);
        $wherebrand = array('b_delete'=>'1','status'=>'1');
        $data['brand'] = $this->MasterMdl->view_brand($wherebrand);
        $this->load->view('master/add_shop', $data);
    }

    public function edit_shop() {
        $id = $this->uri->segment(2, 0);
        if (isset($_POST['update'])) {              

            if (!empty($_FILES["s_image"]["name"])) {
                $uploadpath = 'Uploads/shop_image';$image_name = 's_image';
                $s_image = $this->upload_singleimage($uploadpath,$image_name);
            }else{
                $s_image = $this->input->post('bk_s_image');
            } 
            $form_data = array(
            's_addedby' => (int)$_SESSION['all']['l_id'],
            's_name' => $this->input->post('s_name'),
            's_stime' => $this->input->post('s_stime'),
            's_etime' => $this->input->post('s_etime'),
            'fk_zone_id' => $this->input->post('fk_zone_id'),
            's_show_on_homepage' => $this->input->post('s_show_on_homepage')==1?'1':'0',
            's_number' => $this->input->post('s_number'),
            's_address' => $this->input->post('s_address'),
            's_image' => $s_image,
            's_description' => $this->input->post('s_description'),
            );
            if ($this->MasterMdl->edit_shop($id,$form_data)) {

                $fk_category_id = $_POST["fk_category_id"];
                for ($i = 0; $i < count($fk_category_id); $i++) {    
                    $form_data_category = array(
                    'fk_shop_id' => $id,
                    'fk_category_id' => $fk_category_id[$i],                    
                    );
                    $this->MasterMdl->add_shop_category($form_data_category);       
                }                       
                $_SESSION['responsemsg'] = "Updated Successfully";
                redirect('view_shop');
            } else {
                $_SESSION['responsemsg'] = "Error";
                redirect('view_shop');
            }
        }
        $catids = array();
        $wherecot = array('sc_delete'=>'1','status'=>'1','sc.fk_shop_id'=> $id);
        $catids = $this->MasterMdl->get_shop_category($wherecot);
        //print_r($catids['catids']);exit;
        //print_r(explode(',',$data['catids']) );exit;
        $wherecategory = array('c_delete'=>'1','status'=>'1');
        $data['category'] = $this->MasterMdl->view_category_edit($wherecategory,$catids['catids']);
        $wherebrand = array('b_delete'=>'1','status'=>'1');
        $data['brand'] = $this->MasterMdl->view_brand($wherebrand);
        $where = array('s_delete'=>'1','s.status'=>'1','s.s_id'=> $id);
        $data['row'] = $this->MasterMdl->get_shop($where);     
        $whereall = array('sc.sc_delete'=>'1','sc.status'=>'1','sc.fk_shop_id'=> $id);
        $data['allcategory'] = $this->MasterMdl->get_all_category($whereall); 
        $wherezone = array('z_delete'=>'1','status'=>'1');
        $data['zone'] = $this->MasterMdl->view_zone($wherezone);   
        //print_r($data['allcategory']);exit;
        $this->load->view('master/edit_shop', $data);
    }

    public function view_shop_details() {
        $id = $this->uri->segment(2, 0);
        $whereall = array('sc.sc_delete'=>'1','sc.status'=>'1','sc.fk_shop_id'=> $id);
        $data['allcategory'] = $this->MasterMdl->get_all_category($whereall); 
        $where = array('s_delete'=>'1','s.status'=>'1','s.s_id'=> $id);
        $data['row'] = $this->MasterMdl->get_shop($where);   
    
        $this->load->view('master/view_shop_details',$data);
    }

    public function view_orders() {

        $whereorders = array('o.status'=>'1','o.o_noti_status'=>'0');
        $form_data = array('o_noti_status'=>'1');
        $this->MasterMdl->notification_update($whereorders,$form_data);

        $date = $this->input->get('date', TRUE) ==''? date('d-m-Y'):$this->input->get('date', TRUE);
        //$whereorders2 = array_filter(array('o.o_delete'=>'1','o.o_date'=>$date));
        //$whereorders2 = array_filter(array('o.o_delete'=>'1'));
        //$data['result'] = $this->MasterMdl->view_orders($whereorders2);
        $whereorders2 = array_filter(array('o.active'=>'1')); 
        $data['result'] = $this->MasterMdl->view_orders_v1($whereorders2);
        $whereusers = array('l_delete'=>'1','status'=>'1','l_role'=>'delivery_person');
        $data['delivery_person'] = $this->MasterMdl->view_user($whereusers);
        // print_r($data['result']);exit;          
        $this->load->view('master/view_orders',$data);
    }

    public function get_notification() {
        $whereorders = array('assign_notification_id'=> $_SESSION['all']['l_id'],'seen'=>'No');
        $data['result'] = $this->MasterMdl->view_data("order_notification", $whereorders);    
        echo count($data['result']);   exit;
        
    }


    public function get_notification_list() {

        $whereorders = array('n.seen'=>'No','n.assign_notification_id'=> $_SESSION['all']['l_id']);
        $this->db->select('n.message, o.order_number, n.order_id, o.customer_name, o.order_date');
        $this->db->from('order_notification n'); 
        $this->db->join('orders o', 'o.id = n.order_id ');
        $this->db->where($whereorders);    
        $this->db->order_by("n.order_id", "DESC");             
        $result = $this->db->get()->result_array();    
    
        $noti = '';
        $count = 0;
                // FOR IMAGE IN NOTIFICATION
                // <div class="message-img">
                //     <img src="http://localhost/mezban/assets/img/contact/2.jpg" alt="">
                // </div>
        foreach($result as $odata){
        if($count == 3){ 
            break;
            }
            $date = date('d M', strtotime($odata["order_date"]));
            $noti .= '<li style="display:block;"><a href="'.site_url().'/view_order_details/'. $odata["order_id"].'" >          
                <div class="message-content" style="border:1px solid gray;border-radius: 2px; padding:5px;">
                    <p style="margin:0px;">Name : '. $odata["customer_name"].' <br>Order: #'. $odata["order_number"].'</p>
                </div></a></li>';
                $count++;
        }
        echo $noti;exit;
    }

    public function assign_delivery() {
        if (isset($_POST['submit'])) {
            $form_data = array(
            'delivery_person_id' => $this->input->post('save_delivery_person_id'),
            'order_status' => "Assigned",
            );
        if ($insert_id = $this->MasterMdl->edit_orders($this->input->post('save_order_id_modal'),$form_data)) {
            $_SESSION['responsemsg'] = "Assign Successfully";
            redirect('view_orders');
        } else {
            $_SESSION['responsemsg'] = "Error";
            redirect('view_orders');
        }
        }    
    }

    public function view_order_details() {        
        $id = $this->uri->segment(2, 0);
        $where = array('id'=> $id);
        $orders = $this->MasterMdl->view_orders_details_v2($where);
        $where_notify = array('order_id'=> $id, 'assign_notification_id'=> $_SESSION['all']['l_id']);
        $form_notify = array('seen'=> 'Yes');
        $this->MasterMdl->update_table($where_notify, $form_notify, "order_notification") ;
			//print_r($orders);exit;
			$data = array();
            $index=0;
          
			foreach($orders as $row){
                $order_status = array('0'=>'Deleted','1'=>'In Process','2'=>'Assigned','3'=>'Picked','4'=>'Delivered','5'=>'Cancelled');

                $where_product = array('p_delete'=>'1','status'=>'1','p_id'=>$row['product_id']);
                $product = $this->MasterMdl->view_data("product",$where_product);
                //print_r($where_product);exit;
                $where_offer = array('so.fk_product_id'=>$row['product_id'],'so.fk_order_id'=>$row['order_id']);
                $offer = $this->MasterMdl->get_offer_details($where_offer);        
                $offer_amount = count($offer) == 0?0:$offer[0]['so_offer_amount'];   		
           

				$data['result'][$index] = array(
				    'product_name' => $row['product_name'],
                    'p_amount' => $product[0]['p_amount'],
                    'p_quantity' => $row['quantity'],
                    'item_total_amount' => $row['item_total_amount'],
                    'order_total_amount' => $row['order_total_amount'],
                    'order_items_total_amount' => $row['order_items_total_amount'],
                    'pickup_discount_amount' => $row['pickup_discount_amount'],
                    'order_delivery_charge_amount' => $row['order_delivery_charge_amount'],
                    'mrp' => $row['mrp_rate'],
                    'discount_amount' => $row['discount_rate'],
                    'admin_profit' => $row['admin_profile'],
                    'customer_mobile' => $row['customer_mobile'],
                    'delivery_mode' => $row['delivery_mode'],
                    'customer_address' => $row['customer_address'],
                    'p_description' => $product[0]['p_description'],
                    'p_thumbnail' => $product[0]['p_thumbnail'],
                    'o_overall_product_amount' => $row['order_total_amount'],
                    'order_id' => $row['order_id'],
                    'product_id' => $row['product_id'],
                    'l_name' => $row['customer_name'],   
                    'order_item_id' => $row['order_item_id'],                   
                    'o_date' => $row['order_date'],
                    'ostatus' => $row['order_status'],
                    'active' => $row['active'],
                    'order_number' => $row['order_number'],
                    'notes' => $row['notes'],
                    'city' => $row['city'],
                    'house_no' => $row['house_no'],
                    'street_address' => $row['street_address'],
                    'apartment_name' => $row['apartment_name'],
                    'landmark' => $row['landmark'],
                    'pincode' => $row['pincode'],
                    'brand_name' => $product[0]['brand_name'],
                    'p_quantity_description' => $product[0]['p_quantity_description'],
                    'check_number_of_product' => $index,	
					 );					 
                     $index++;           
            }
            //print_r($data);
            //exit;
                       
        $this->load->view('master/view_order_details', $data);
    }

    public function order_print_view(){
        $order_id = $this->uri->segment(2, 0);
        $where = array('id'=> $order_id);
        $orders = $this->MasterMdl->view_orders_details_v2($where);

        $index = 0;
        foreach($orders as $row){

            $where_product = array('p_delete'=>'1','status'=>'1','p_id'=>$row['product_id']);
            $product = $this->MasterMdl->view_data("product",$where_product);
            $data['result'][$index] = array(
                'product_name' => $product[0]['p_name'],
                'p_amount' => $product[0]['p_amount'],
                'p_quantity' => $row['quantity'],
                'item_total_amount' => $row['item_total_amount'],
                'order_total_amount' => $row['order_total_amount'],
                'order_items_total_amount' => $row['order_items_total_amount'],
                'pickup_discount_amount' => $row['pickup_discount_amount'],
                'order_delivery_charge_amount' => $row['order_delivery_charge_amount'],
                'mrp' => $product[0]['p_market_amount'],
                'discount_amount' => $product[0]['p_user_profit'],
                'customer_mobile' => $row['customer_mobile'],
                'delivery_mode' => $row['delivery_mode'],
                'customer_address' => $row['customer_address'],
                'order_savings_amount' => $row['order_savings_amount'],
                'p_description' => $product[0]['p_description'],
                'p_thumbnail' => $product[0]['p_thumbnail'],
                'o_overall_product_amount' => $row['order_total_amount'],
                'order_id' => $row['order_id'],
                'product_id' => $row['product_id'],
                'l_name' => $row['customer_name'],   
                'order_item_id' => $row['order_item_id'],                   
                'o_date' => $row['order_date'],
                'ostatus' => $row['order_status'],
                'active' => $row['active'],
                'order_number' => $row['order_number'],
                'city' => $row['city'],
                'house_no' => $row['house_no'],
                'street_address' => $row['street_address'],
                'apartment_name' => $row['apartment_name'],
                'landmark' => $row['landmark'],
                'pincode' => $row['pincode'],
                'brand_name' => $product[0]['brand_name'],
                'p_quantity_description' => $product[0]['p_quantity_description'],
                'check_number_of_product' => $index,	
                
                 );

            $index++; 
        }

        $this->load->view('master/order_print_view', $data);
    }

    public function select_winner() {
            $id = $_POST['quiz_id'];
            $where_answer = array('fk_question_id'=>$id);
            $selected_winner = $this->MasterMdl->get_single_right_answer_random_one_winner($where_answer);
            $form_data = array('q_winning_status' => $selected_winner[0]['fk_mobile']);
            if ($insert_id = $this->MasterMdl->edit_quiz($id,$form_data)) {           
                echo "Success";
            } else {
               echo "Error";              
            } 
            exit;    
    }

    public function deleteimg() {
        $id = $this->input->post('id');
        $this->db->where('ai_id', $id);
        $result = $this->db->delete('ad_img');
        //echo $this->db->last_query();exit;
        if ($result == true || $result == 1) {
           echo "success";
           
        } else {
           echo 'error';
        }
        exit;
    }

    public function view_orders_dperson() {
        
     //   echo $product_id;exit;
        $order_status = 2;//$this->input->get('order_status', TRUE) ==''? 1:$this->input->get('order_status', TRUE);
        //$whereorders = array_filter(array('fk_delivery_person_id'=>$_SESSION['all']['l_id'],'o.status'=>$order_status));
        $whereorders = array_filter(array('fk_delivery_person_id'=>$_SESSION['all']['l_id']));
        
        //print_r($whereorders);exit;
        $data['result'] = $this->MasterMdl->view_orders($whereorders);
         
        $whereusers = array('l_delete'=>'1','status'=>'1','l_role'=>'delivery_person');
        $data['delivery_person'] = $this->MasterMdl->view_user($whereusers);
        //print_r($data['delivery_person']);exit;          
        $this->load->view('master/view_orders_dperson',$data);
    }

    public function order_status_by_dperson() {
        if (isset($_POST['submit'])) {
            $form_data = array(
            'status' => (int)$this->input->post('save_delivery_status'),
            );
            $status =  (int)$this->input->post('save_delivery_status') == '3'?'Completed':'Canceled';
             $msg = 'Order Successfully '.$status;
        if ($insert_id = $this->MasterMdl->edit_orders($this->input->post('save_order_id_modal'),$form_data)) {
            $_SESSION['responsemsg'] = $msg;
            redirect('view_orders_dperson');
        } else {
            $_SESSION['responsemsg'] = "Error";
            redirect('view_orders_dperson');
        }
        }    
    }

    public function edit_order() {
        $order_id = $this->uri->segment(2, 0);
        $order_where = array('id' => $order_id);
        $order_data = $this->MasterMdl->view_data("orders", $order_where);
        $order_number = $order_data[0]['order_number'];

        $userItems = array();
        $orderItems = $this->MasterMdl->get_order($order_id);

        if (isset($_POST['update'])) {         
            
            
            $total_item_count = $_POST['total_count'];
            $orderItems['delivery_mode'] = $this->input->post('pickup') == "" ? "Home" : "PickUp";
            $orderItems["customer_address"] = $_POST["customer_address"];
            $orderItems["customer_name"] = $_POST["customer_name"];
            $orderItems["customer_mobile"] = $_POST["customer_mobile"];
            $orderItems["pickup"] = $this->input->post('pickup') == "" ? "Home" : "PickUp";

            //Check availability of products.
            $isInventoryAvailable = true;
            $order_items = 0;
            $order_items_total_amount = 0;
            $order_delivery_charge_amount = 0;
            $order_savings_amount = 0;
            $order_total_amount = 0;

            for($j = 1; $j <= $total_item_count; $j++){

                $active = $_POST['active'.$j];
                if($active == "deleted") 
                    continue;

                $product_id = $_POST['added_product'.$j];
                $userquantity = $_POST['quantity'.$j];
                $productResult = $this->MasterMdl->get_product($product_id); 
                $userItems[$j]['id'] = $productResult['p_id'];
                $userItems[$j]['name'] = $productResult['p_name'];
                $userItems[$j]['quantity'] = $userquantity;
                $userItems[$j]['price'] = $productResult['p_amount'];
                $userItems[$j]['subtotal'] = floatval($productResult['p_amount'])*floatval($userquantity);

                $query = "SELECT * FROM product WHERE p_quantity >=".$userquantity." and p_delete='1' and p_id=".$product_id;
                $inventoryResult = $this->MasterMdl->fireQuery($query);
                
                //Check inventory result found or not if found then go ahead otherwise inventory not avaiable so order cannot be place
                if(empty($inventoryResult)) {
                    $userItems[$j]['inStock'] = "no";
                    $isInventoryAvailable = false;
                } else {
                    $userItems[$j]['inStock'] = "yes";
                    $p_amount = floatval($inventoryResult[0]["p_amount"]);
                    $p_user_profit = floatval($inventoryResult[0]["p_user_profit"]);

                    // order items total amount
                    $total = $userquantity * $p_amount;
                    $order_items_total_amount = $order_items_total_amount + $total;
                    $order_savings_amount = $order_savings_amount + $p_user_profit;
                }

                $order_items = $order_items + 1;


            }

            // If inventory available then only proceed to place order
            if($isInventoryAvailable) {

                for($j = 1; $j <= $total_item_count; $j++){
 
                    $active = $_POST['active'.$j];
                    if($active == "deleted") 
                        continue;

                    $product_id = $_POST['added_product'.$j];
                    $userQuantity = $_POST['quantity'.$j];
                    $productResult = $this->MasterMdl->get_product($product_id); 
                  
                    $query = "SELECT * FROM product WHERE p_id=".$product_id;
                    $inventoryResult = $this->MasterMdl->fireQuery($query);

                    $p_amount = floatval($inventoryResult[0]["p_amount"]);
                    $p_user_profit = floatval($inventoryResult[0]["p_user_profit"]);
                    $p_name = $inventoryResult[0]["p_name"];
                    $fk_shop_id = $inventoryResult[0]["fk_shop_id"];
                    $fk_zone_id = $inventoryResult[0]["fk_zone_id"];
                    $fk_category_id = $inventoryResult[0]["fk_category_id"];

                    $mrp_rate = $inventoryResult[0]["p_market_amount"];
                    $buying_rate = $inventoryResult[0]["p_buying_amount"];
                    $discount_rate = $inventoryResult[0]["discount_rate"];
                    $selling_rate = $inventoryResult[0]["p_amount"];
                    $profit_margin = $inventoryResult[0]["profile_margin"];
                    $admin_profile = $inventoryResult[0]["p_admin_profit"];
                    $user_profit = $inventoryResult[0]["p_user_profit"];
                    $p_thumbnail = $inventoryResult[0]["p_thumbnail"];
                    $brand_name = $inventoryResult[0]["brand_name"];
                    // order items total amount
                    $item_total_amount = $userQuantity * $p_amount;
                    
                    $order_item_data = array(
                        'order_number' => $order_number,
                        'product_id' => $product_id,
                        'product_name' => $p_name,
                        'quantity' => $userQuantity,
                        'amount' => $p_amount,  				
                        'item_total_amount' => $item_total_amount,
                        'savings' => $p_user_profit,
                        'order_id' => $order_id,
                        'zone_id' => $fk_zone_id,
                        'shop_id' => $fk_shop_id,
                        'category_id' => $fk_category_id,
                        
                        'mrp_rate' => $mrp_rate,
                        'buying_rate' => $buying_rate,  
                        'discount_rate' => $discount_rate,  
                        'selling_rate' => $selling_rate,  
                        'profit_margin' => $profit_margin,  
                        'admin_profile' => $admin_profile,  
                        'user_profit' => $user_profit,
                        'productImg' => $p_thumbnail, 
                        'brand_name' => $brand_name, 
                        );
                    
                    $orderItemResult = $this->db->insert('order_items', $order_item_data);

                    //Deduction of inventory after order item is added
                    $where_update = array('p_id'=>$product_id);
                    $totalQuatity = $inventoryResult['0']['p_quantity'];
                    $totalQuatity = intval($totalQuatity) - intval($userQuantity);
                    $form_data = array('p_quantity'=>$totalQuatity);
                    $result = $this->MasterMdl->update_table($where_update, $form_data,'product');
    
                }

                $order_data_update = array(
                    'customer_name' =>$orderItems["customer_name"],  				
                    'customer_mobile' => $orderItems["customer_mobile"],
                    'delivery_mode' => $orderItems['delivery_mode']
                );
                $where = array('id' => $order_id);
                $this->MasterMdl->update_table($where ,$order_data_update, "orders");

                $this->MasterMdl->updateOrderPrice($order_id);
                redirect('view_order_details/'.$order_id);

            }

            #$_SESSION['responsemsg'] = "Updated Successfully";
            # redirect('view_advertisment');
        }        

 
        $data['row'] = $orderItems; 
        $data['items'] = $userItems;

        $brandNames = array();
        $where = array('p_delete'=> '1');
        $brandNames = $this->MasterMdl->getAllBrands($where);
        $data['brandNames'] = $brandNames;

        $where = array('key'=>'delivery', 'delete'=>'1');
        $order_delivery_charge_amount = floatval($this->MasterMdl->view_data('extras_content', $where)[0]['amount']);
        $where = array('key'=>'delivery_thresold', 'delete'=>'1');
        $delivery_thresold = floatval($this->MasterMdl->view_data('extras_content', $where)[0]['amount']);

        $data['delivery_charge'] = $order_delivery_charge_amount;
        $data['delivery_thresold'] = $delivery_thresold;

        $where = array('id'=> $order_id);
        $orders = $this->MasterMdl->view_orders_details_v2($where);
        $data['order_items'] = $orders;

        //print_r($data);
        //$data['row_img'] = $this->MasterMdl->get_adimg($id);     
        //print_r($data['row']);exit;
        $this->load->view('master/edit_order', $data);
        //$this->load->view('master/edit_advertisment');
    }

    public function cancel_order() {
        $order_id = $this->uri->segment(2, 0);
       
        $order_data = array(
            'order_status' => 'Cancelled',
            'cancel_time' => date('Y-m-d HH:mm'),
            );

        $where_update = array('id' => $order_id);
        $result = $this->MasterMdl->update_table($where_update, $order_data, 'orders');

        $this->MasterMdl->returnInventoryOrderItems($order_id);

        redirect('view_order_details/'.$order_id);
    }

    public function delete_order_item(){
        $order_item_id = $this->uri->segment(2, 0);
        $where = array('order_item_id' => $order_item_id, 'active' => '1');
        $order_items_data = $this->MasterMdl->view_data("order_items", $where);

        $order_id = $order_items_data[0]['order_id'];
        $where = array('order_id' => $order_id);
        $items = $this->MasterMdl->view_data("order_items", $where);
        //echo count($items);
        if(count($items) == 1){

            $order_data = array(
                'order_status' => 'Cancelled',
                'cancel_time' => date('Y-m-d HH:mm'),
                );
    
            $where_update = array('id' => $order_id);
            $result = $this->MasterMdl->update_table($where_update, $order_data, 'orders');
            $this->MasterMdl->returnInventoryOrderItems($order_id);

        } else {

            $this->MasterMdl->returnOrderItemQuantity($order_item_id);
            $where = array('order_item_id' => $order_item_id);
            $this->MasterMdl->deleteData("order_items", $where);
            $this->MasterMdl->updateOrderPrice($order_id);
        }

        redirect('view_order_details/'.$order_id);
    }

    public function change_status(){
        $order_id =  $_POST['order_id'];
        $order_status =  $_POST['order_status'];
        $order_data = array(
            'order_status' => $order_status,
            'completed_time' => date('Y-m-d HH:mm'),
            );
        $where_update = array('id' => $order_id);
        $result = $this->MasterMdl->update_table($where_update, $order_data, 'orders');

        redirect('view_orders');
    }

    public function add_order() {
         
        $userItems = array();
        $orderItem = array();
        if (isset($_POST['update'])) {         
            
            
            $total_item_count = $_POST['total_count'];

            //Check availability of products.
            $isInventoryAvailable = true;
            $order_items = 0;
            $order_items_total_amount = 0;
            $order_delivery_charge_amount = 0;
            $order_savings_amount = 0;
            $order_total_amount = 0;


            $orderItem["customer_address"] = $_POST["customer_address"];
            $orderItem["customer_name"] = $_POST["customer_name"];
            $orderItem["customer_mobile"] = $_POST["customer_mobile"];
            $orderItem["pickup"] = $this->input->post('pickup') == "" ? "Home" : "PickUp";

            for($j = 1; $j <= $total_item_count; $j++){
 
                $active = $_POST['active'.$j];
                if($active == "deleted") 
                    continue;

                $product_id = $_POST['added_product'.$j];
                $userquantity = $_POST['quantity'.$j];
                $productResult = $this->MasterMdl->get_product($product_id); 
                $userItems[$j]['id'] = $productResult['p_id'];
                $userItems[$j]['name'] = $productResult['p_name'];
                $userItems[$j]['quantity'] = $userquantity;
                $userItems[$j]['price'] = $productResult['p_amount'];
                $userItems[$j]['subtotal'] = floatval($productResult['p_amount'])*floatval($userquantity);
                
                $query = "SELECT * FROM product WHERE p_quantity >=".$userquantity." and p_delete='1' and p_id=".$product_id;
                $inventoryResult = $this->MasterMdl->fireQuery($query);
                
                //Check inventory result found or not if found then go ahead otherwise inventory not avaiable so order cannot be place
                if(empty($inventoryResult)) {
                    $userItems[$j]['inStock'] = "no";
                    $isInventoryAvailable = false;
                } else {
                    $userItems[$j]['inStock'] = "yes";
                    $p_amount = floatval($inventoryResult[0]["p_amount"]);
                    $p_user_profit = floatval($inventoryResult[0]["p_user_profit"]);

                    // order items total amount
                    $total = $userquantity * $p_amount;
                    $order_items_total_amount = $order_items_total_amount + $total;
                    $order_savings_amount = $order_savings_amount + $p_user_profit;
                }
                $order_items = $order_items + 1;


            }

            // If inventory available then only proceed to place order
            if($isInventoryAvailable) {
                $delivery_mode= $this->input->post('pickup') == "" ? "Home" : "PickUp";
                //echo "Hello";

                //Fetch delivery charges and thresold
                $where = array('key'=>'delivery', 'delete'=>'1');
                $order_delivery_charge_amount = floatval($this->MasterMdl->view_data('extras_content', $where)[0]['amount']);
                $where = array('key'=>'delivery_thresold', 'delete'=>'1');
                $delivery_thresold = floatval($this->MasterMdl->view_data('extras_content', $where)[0]['amount']);

                // apply delivery charges only if order item total amount exceeds delivery thresold or delivery mode is PickUp
			    $order_delivery_charge_amount = $order_items_total_amount >= $delivery_thresold || $delivery_mode == "PickUp" ? 0 : $order_delivery_charge_amount;

                //calculate order total amount = order items total - delivery charges
                $order_total_amount = $order_items_total_amount + $order_delivery_charge_amount;

                //Calculating pickup discount amount when order_delivery mode is PickUp
			    $order_items_discount_amount = $order_savings_amount;
			    $pickup_discount_amount = $delivery_mode == "PickUp" ? 0.02 * $order_items_total_amount : 0;
			    $order_total_amount = $order_total_amount - $pickup_discount_amount;
                $order_savings_amount = $order_savings_amount + $pickup_discount_amount;
            
                $unque_order_id = $this->MasterMdl->getIdGenerator("order");
                $order_number = "DM".date('dmY').$unque_order_id;
                $order_data = array(
                    'order_number' => $order_number,
                    'customer_name' =>  $orderItem["customer_name"],
                    'customer_address' => $orderItem["customer_address"],
                    'customer_mobile' =>  $orderItem["customer_mobile"],  
                    'near_address' => "",
                    'order_items' => $order_items,
                    'delivery_mode' => $delivery_mode,
                    'order_items_total_amount' => $order_items_total_amount,
                    'order_delivery_charge_amount' => $order_delivery_charge_amount,
                    'order_savings_amount' => $order_savings_amount,
                    'order_total_amount' => $order_total_amount,
                    'order_items_discount_amount' => $order_items_discount_amount,
                    'pickup_discount_amount' => $pickup_discount_amount,
                    'order_weight_quantity' => 0,
                    'order_weight_amount' => 0,    
                    'zone_id' => 5,    
                    'order_date' => date('Y-m-d H:i'),
                    );


                // Saving order
                $orderResult = $this->db->insert('orders', $order_data);
                $order_id = $this->db->insert_id();
            
                for($j = 1; $j <= $total_item_count; $j++){
 
                    $active = $_POST['active'.$j];
                    if($active == "deleted") 
                        continue;

                    $product_id = $_POST['added_product'.$j];
                    $userQuantity = $_POST['quantity'.$j];
                    $productResult = $this->MasterMdl->get_product($product_id); 
                  
                    $query = "SELECT * FROM product WHERE p_id=".$product_id;
                    $inventoryResult = $this->MasterMdl->fireQuery($query);

                    $p_amount = floatval($inventoryResult[0]["p_amount"]);
                    $p_user_profit = floatval($inventoryResult[0]["p_user_profit"]);
                    $p_name = $inventoryResult[0]["p_name"];
                    $fk_shop_id = $inventoryResult[0]["fk_shop_id"];
                    $fk_zone_id = $inventoryResult[0]["fk_zone_id"];
                    $fk_category_id = $inventoryResult[0]["fk_category_id"];

                    $mrp_rate = $inventoryResult[0]["p_market_amount"];
                    $buying_rate = $inventoryResult[0]["p_buying_amount"];
                    $discount_rate = $inventoryResult[0]["discount_rate"];
                    $selling_rate = $inventoryResult[0]["p_amount"];
                    $profit_margin = $inventoryResult[0]["profile_margin"];
                    $admin_profile = $inventoryResult[0]["p_admin_profit"];
                    $user_profit = $inventoryResult[0]["p_user_profit"];
                    $p_thumbnail = $inventoryResult[0]["p_thumbnail"];
                    $brand_name = $inventoryResult[0]["brand_name"];
                    // order items total amount
                    $item_total_amount = $userQuantity * $p_amount;
                    
                    $order_item_data = array(
                        'order_number' => $order_number,
                        'product_id' => $product_id,
                        'product_name' => $p_name,
                        'quantity' => $userQuantity,
                        'amount' => $p_amount,  				
                        'item_total_amount' => $item_total_amount,
                        'savings' => $p_user_profit,
                        'order_id' => $order_id,
                        'zone_id' => $fk_zone_id,
                        'shop_id' => $fk_shop_id,
                        'category_id' => $fk_category_id,

                        'mrp_rate' => $mrp_rate,
                        'buying_rate' => $buying_rate,  
                        'discount_rate' => $discount_rate,  
                        'selling_rate' => $selling_rate,  
                        'profit_margin' => $profit_margin,  
                        'admin_profile' => $admin_profile,  
                        'user_profit' => $user_profit,
                        'productImg' => $p_thumbnail, 
                        'brand_name' => $brand_name, 
                        );
                    
                    $orderItemResult = $this->db->insert('order_items', $order_item_data);

                    //Deduction of inventory after order item is added
                    $where_update = array('p_id'=>$product_id);
                    $totalQuatity = $inventoryResult['0']['p_quantity'];
                    $totalQuatity = intval($totalQuatity) - intval($userQuantity);
                    $form_data = array('p_quantity'=>$totalQuatity);
                    $result = $this->MasterMdl->update_table($where_update, $form_data,'product');
    
                }
                
                $this->MasterMdl->sendNotificationToAdmins($order_id, $order_number);

                redirect('view_order_details/'.$order_id);
            }
            #$_SESSION['responsemsg'] = "Updated Successfully";
            # redirect('view_advertisment');
        }        

        $data['row'] = $orderItem;
        $data['items'] = $userItems;

        $brandNames = array();
        $where = array('p_delete'=> '1');
        $brandNames = $this->MasterMdl->getAllBrands($where);
        $data['brandNames'] = $brandNames;
        
        $where = array('key'=>'delivery', 'delete'=>'1');
        $order_delivery_charge_amount = floatval($this->MasterMdl->view_data('extras_content', $where)[0]['amount']);
        $where = array('key'=>'delivery_thresold', 'delete'=>'1');
        $delivery_thresold = floatval($this->MasterMdl->view_data('extras_content', $where)[0]['amount']);

        $data['delivery_charge'] = $order_delivery_charge_amount;
        $data['delivery_thresold'] = $delivery_thresold;

        //print_r($data);
        $this->load->view('master/add_order', $data);
    }

    public function assign_offer() {
        if (isset($_POST['submit'])) {
            $form_data = array(
            'fk_order_id' => $this->input->post('m_order_id'),
            'fk_product_id' => $this->input->post('m_product_id'),
            'so_product_amount' => $this->input->post('m_product_amount'),
            'so_offer_amount' => $this->input->post('m_offer_amount'),
            'so_offertext' => $this->input->post('m_offer_details'),
            );
        if ($insert_id = $this->MasterMdl->add_offer($form_data)) {
            $_SESSION['responsemsg'] = "Assign Successfully";
            redirect('view_order_details/'.$this->input->post('m_order_id'));
        } else {
            $_SESSION['responsemsg'] = "Error";
            redirect('view_order_details/'.$this->input->post('m_order_id'));
        }
        }    
    }

    public function view_push_notification() {        
					 
			//	$conn=mysqli_connect("localhost", "sahyadhri_user", "Sahyadhri@2017", "db_sahyadhri") or
			//	die("Could not connect: " . mysqli_error());


			//$result1 = mysqli_query($conn,"SELECT ml.fcm_id FROM master_login ml JOIN orders o ON ml.id = o.customer_id WHERE o.orders_id =1");
			//$row1 = mysqli_fetch_array($result1, MYSQLI_NUM);

			//$result2 = mysqli_query($conn,"SELECT ml.fcm_id FROM master_login ml WHERE ml.role_type = 'O'");
			//$row2 = mysqli_fetch_array($result2, MYSQLI_NUM);
			//$a=$row1[0].",".$row2[0];


		//	$registrationIds =explode(',',$a);


			$registrationIds = array('eTlqjZ5Nqrw:APA91bEgx0nr73uuK0nQr_EnRg3vsi2wyWeZqpZVRSZkmAE80JeqEz02EBW4MPKtNTGUurfbhaRfsuz1Z30otPf8Ki-3StxWuEle9cMhEyEbaC6mmMc_mjMfbs6ZEtetffGuI-FazAN9','eBSGFzNsRBQ:APA91bHHz-PyGpUwJshwFLcS6UcUZZUrjVR2kZjBDVVNrvcmP0YOCR_JIl9b6cdCAdWhV1SMYMzI5n9kD4GFKRAfinDoFSx1iJWzRDWstPtxYlLQYgDke4l2mJuvvV7ZULoZDyYzT-9Q');



			  // print_r($registrationIds);


			// API access key from Google API's Console
			define( 'API_ACCESS_KEY', 'AAAAPYErecg:APA91bGGIhwI4giMb-n-fAUK2luKJ2g4a4SZ9YD1tHNbR_cZpbkuc6SbTbGH2X0uXkUHHTxuANDeR9Ufp6JJi_Pb__toH_cp4CPvPfeDM-PmQ8HfbnIEfgS2vXHaMil7p3IRkSgtlsR-' );
			
			$msg = array
			(
				'message' 	=> 'here is a message. message',
				'title'		=> 'Sahyadhri',
				//'subtitle'	=> 'This is a subtitle. subtitle',
			//	'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
			//	'vibrate'	=> 1,
			//	'sound'		=> 1,
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
				'Authorization: key=' . API_ACCESS_KEY,
				'Content-Type: application/json'
			);
			 
			$ch = curl_init();
			curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
			curl_setopt( $ch,CURLOPT_POST, true );
			curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
			curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
			$result = curl_exec($ch );
			curl_close( $ch );
			print_r($result);exit;
     }
	 	 		

     public function view_pushnotification() {
        if (isset($_POST['submit'])) {		
		
            $form_data = array(
            'fk_zone_id' => $this->input->post('fk_zone_id'),
			'title' => $this->input->post('title'),
			'message' => $this->input->post('message'),
			'date' => date('Y-m-d H:i:s'),
            );
            if ($insert_id = $this->MasterMdl->add_pushnotification($form_data)) {
                
                // SEND PUSH NOTIFICATION  //$token_id = array('fqM9ubvpTsM:APA91bFwLR1L6qcOq13bAUSuF2Ucv1McfODefnyX5ZMrlUPAt9J2DuAJs-R-SUbwIX2zbVr-jppb0pKpWg6kzrzQ_QX38B7BcsP2hhbN34NmtIrzgsUjkm-0mkXfmCaaCnhlfWo6r8H7');
                $zoneqid = $this->input->post('fk_zone_id');
                $tokens = $this->MasterMdl->get_notifications_token($zoneqid,'user');
            //	print_r($tokens);exit;
                //$whereudatashow = array('order_id'=>$this->input->post('order_id'));
                //$udatashow = $this->MasterMdl->view_orders($whereudatashow);
                    //print_r($udatashow);exit;
                
                $pnotestatus = array();
                foreach($tokens as $tok){			
                    $token_id = array($tok['user_token']);
                    $title  = $this->input->post('title');
                    $msg = $this->input->post('message');
                    $resp = $this->MasterMdl->send_push_notification($token_id,$title,$msg);
                    $pnotestatus[] =  $resp;
                }
                
                // END PUSH NOTIFICATION		
                $_SESSION['responsemsg'] = "Send Successfully";
                redirect('view_pushnotification');
            } else {
                $_SESSION['responsemsg'] = "Error";
                redirect('view_pushnotification');
            }

        }

        $wherezone = array('z_delete'=>'1','status'=>'1');
        $data['zone'] = $this->MasterMdl->view_zone($wherezone);
        
        $data['result'] = $this->MasterMdl->view_pushnotification(array());
        $this->load->view('master/view_pushnotification', $data);
    }


}

/***

}

/* End of file welcome.php */
/* Location: ./application/controle_typeers/welcome.php */
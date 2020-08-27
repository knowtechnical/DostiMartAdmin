<?php
	
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class DashboardCtrl extends CI_Controller {

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
       // $this->load->model('Common_Model');
    }

    public function admin_dashboard() {
        $whereshop = array('s_delete'=>'1','s.status'=>'1');
        $data['shop'] = $this->MasterMdl->view_shop($whereshop);   
        $wherecategory = array('c_delete'=>'1','status'=>'1');
        $data['category'] = $this->MasterMdl->view_category($wherecategory);
        $whereproduct = array('p_delete'=>'1','p.status'=>'1');
        $data['product'] = $this->MasterMdl->view_product($whereproduct);
        $whereorders = array('o.o_delete'=>'1');
        $data['orders'] = $this->MasterMdl->view_orders($whereorders); 
        $whereorderscomplete = array('o.o_delete'=>'1','o.status'=>'2');
        $data['orderscomplete'] = $this->MasterMdl->view_orders($whereorderscomplete); 
        $whereorderspending = array('o.o_delete'=>'1','o.status'=>'1');
        $data['orderspending'] = $this->MasterMdl->view_orders($whereorderspending); 
        $whereorderscancel = array('o.o_delete'=>'1','o.status'=>'3');
        $data['orderscancel'] = $this->MasterMdl->view_orders($whereorderscancel); 
             
        // OVERALL PROFIT   
        $p_buying_amount = 0;
        $p_selling_amount = 0;
        $t_offer_amount = 0;

        $p_buying_amount_today = 0;
        $p_selling_amount_today = 0;
        $t_offer_amount_today = 0;

        $whereprofit = array('o_delete'=>'1','s.status'=>'2');
        $profit_overall_query = $this->MasterMdl->view_profit1($whereprofit);
      //  echo "<pre>";print_r($profit_overall_query);exit;
        foreach($profit_overall_query as $po){    
            $date = date('d-m-Y');
            if($date == $po['o_date']){               
            $p_buying_amount_today  += $po['p_buying_amount'] * $po['o_quantity'];
            $p_selling_amount_today  += $po['p_amount'] * $po['o_quantity'];
            $t_offer_amount_today  += $po['so_offer_amount']=='' || NULL?0: $po['so_offer_amount'];
            }

            $p_buying_amount  += $po['p_buying_amount'] * $po['o_quantity'];
            $p_selling_amount  += $po['p_amount'] * $po['o_quantity'];
            $t_offer_amount  += $po['so_offer_amount']=='' || NULL?0: $po['so_offer_amount'];
        }
        // echo $p_selling_amount .'______'. $p_buying_amount .'______'. $t_offer_amount;
       // echo "<br>";
        $data['profit'] = $p_selling_amount - $p_buying_amount - $t_offer_amount;
       // echo "<br>";
       // echo  $p_selling_amount_today .'______'. $p_buying_amount_today .'______'. $t_offer_amount_today;
       // echo "<br>";
        $data['profit_today'] = $p_selling_amount_today - $p_buying_amount_today - $t_offer_amount_today;

        $whereprofit_adv = array('a_delete'=>'1','status'=>'1');
        $profit_overall_advert = $this->MasterMdl->view_advertisment($whereprofit_adv);
        $data['profit_today_at'] = 0;
        $data['profit_at'] = 0;
        foreach($profit_overall_advert as $poa){    
             $date = date('Y-m-d');
            if($date == $poa['a_date']){               
                $data['profit_today_at']  += $poa['a_amount'];           
            }
                $data['profit_at']  += $poa['a_amount'];
        }
      
        $this->load->view('master/admin_dashboard',$data);
    }

    public function test_form() {
        
        $this->load->view('master/test_form');
    }

    public function test_table() {
        
        $this->load->view('master/test_table');
    }

    public function test_all() {
        
        $this->load->view('master/test_all');
    }

    public function test_profile() {
        
        $this->load->view('master/test_profile');
    }

    public function test_info() {
        
        $this->load->view('master/test_info');
    }

    
      public function superadmin_dashboard() {
        $this->load->view('master/superadmin_dashboard');
    }


}

/***

}

/* End of file welcome.php */
/* Location: ./application/controle_typeers/welcome.php */
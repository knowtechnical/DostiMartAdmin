<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PurchaseEntryCtrl extends CI_Controller {

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
        $this->load->model('master/PurchaseEntryMdl');
        $this->load->model('master/Common_Model');
    }
    
    public function view_purchase(){
        $purchaseList = array();
        $where = array();
        $purchaseList = $this->PurchaseEntryMdl->getViewPurchaseList($where);
        $data['purchaseList'] = $purchaseList;

        $this->load->view('master/view_purchase', $data);
    }

    public function add_purchase(){
        
        if (isset($_POST['update'])) {

            $total_item_count = $_POST['total_count'];
            $supplier_id = $_POST["supplier"];
            $bill_no = $_POST["bill_no"];
            $bill_date = date('Y-m-d', strtotime($this->input->post('bill_date')));

            $where = array('id'=> $supplier_id);
            $supplier_detail = $this->Common_Model->view_data("supplier",$where);

            // Adding purchase entry
            $purchase_entry = array(
                'bill_no' => $bill_no,
                'bill_date' => $bill_date,
                'supplier_id' => $supplier_id,
                );
            $purchase_id = $this->Common_Model->add_data('purchase_entry', $purchase_entry);

            for($j = 1; $j <= $total_item_count; $j++){

                $active = $_POST['active'.$j];
                if($active == "deleted") 
                    continue;
                
                $product_id = $_POST['added_product'.$j];
                $mrp = $_POST['mrp'.$j];
                $buying_rate = $_POST['buying_rate'.$j];
                $discount_rate = $_POST['discount_rate'.$j];
                $selling_price = $_POST['selling_price'.$j];
                $profit_margin = $_POST['profit_margin'.$j];
                $purchase_qty = $_POST['purchase_qty'.$j];
                $p_admin_profit = $_POST['p_admin_profit'.$j];
                $p_user_profit = $_POST['p_user_profit'.$j];

                // Adding product log purchase entry.
                $log = array(
                    'p_selling_price' => $selling_price,
                    'p_market_amount' => $mrp,
                    'p_buying_amount' => $buying_rate,
                    'p_admin_profit' => $p_admin_profit,
                    'p_user_profit' => $p_user_profit,
                    'supplier_name' => $supplier_detail[0]['name'],
                    'supplier_address' => $supplier_detail[0]['address'],
                    'supplier_contact' => $supplier_detail[0]['contact_no'],
                    'gstin' => $supplier_detail[0]['gst_in'],
                    'purchase_quantity' => $purchase_qty,
                    'profile_margin' => $profit_margin,
                    'discount_rate' => $discount_rate,
                    'product_id' => $product_id,
                    'purchase_id' => $purchase_id,
                    );                
                $log_id = $this->Common_Model->add_data('purchase_products', $log);

                // Entry for inventory in product
                $where_p = array('p_id'=> $product_id);
                $product_results = $this->Common_Model->view_data("product", $where_p);
                $inventory_quantity = $product_results[0]['p_quantity'];
                $inventory_quantity = $inventory_quantity + intval($purchase_qty);
                
                $where = array('p_id'=> $product_id);
                $product_form = array(
                    'p_amount' => $selling_price,
                    'p_quantity' => $inventory_quantity,
                    'p_market_amount' => $mrp,
                    'p_buying_amount' => $buying_rate,
                    'p_admin_profit' => $p_admin_profit,
                    'p_user_profit' => $p_user_profit,
                    'supplier_name' => $supplier_detail[0]['name'],
                    'supplier_address' => $supplier_detail[0]['address'],
                    'supplier_contact' => $supplier_detail[0]['contact_no'],
                    'gstin' => $supplier_detail[0]['gst_in'],
                    'purchase_quantity' => $purchase_qty,
                    'profile_margin' => $profit_margin,
                    'discount_rate' => $discount_rate,
                    );
                
                $this->Common_Model->update_table($where, $product_form, "product");
                
            }

            redirect('view_purchase');
        }


        $brandNames = array();
        $where = array('p_delete'=> '1');
        $brandNames = $this->PurchaseEntryMdl->getAllBrands($where);
        $data['brandNames'] = $brandNames;

        $where = array();
        $supplier_results = $this->Common_Model->view_data("supplier", $where);
        $data['supplierList'] = $supplier_results;
        
        $this->load->view('master/add_purchase', $data);
    }

    public function edit_purchase(){
        $purchase_id = $this->uri->segment(2, 0);

        if (isset($_POST['update'])) {

            $total_item_count = $_POST['total_count'];
            $supplier_id = $_POST["supplier"];
            $bill_no = $_POST["bill_no"];
            $bill_date = date('Y-m-d', strtotime($this->input->post('bill_date')));

            // Adding purchase entry
            $purchase_entry = array(
            'bill_no' => $bill_no,
            'bill_date' => $bill_date,
            'supplier_id' => $supplier_id,
            );
            $where = array('id'=> $purchase_id);
            $this->Common_Model->update_table($where, $purchase_entry, "purchase_entry");

            $where = array('id'=> $supplier_id);
            $supplier_detail = $this->Common_Model->view_data("supplier",$where);

            for($j = 1; $j <= $total_item_count; $j++){

                $active = $_POST['active'.$j];
                if($active == "deleted") 
                    continue;
                
                $product_id = $_POST['added_product'.$j];
                $mrp = $_POST['mrp'.$j];
                $buying_rate = $_POST['buying_rate'.$j];
                $discount_rate = $_POST['discount_rate'.$j];
                $selling_price = $_POST['selling_price'.$j];
                $profit_margin = $_POST['profit_margin'.$j];
                $purchase_qty = $_POST['purchase_qty'.$j];
                $p_admin_profit = $_POST['p_admin_profit'.$j];
                $p_user_profit = $_POST['p_user_profit'.$j];

                // Adding product log purchase entry.
                $log = array(
                    'p_selling_price' => $selling_price,
                    'p_market_amount' => $mrp,
                    'p_buying_amount' => $buying_rate,
                    'p_admin_profit' => $p_admin_profit,
                    'p_user_profit' => $p_user_profit,
                    'supplier_name' => $supplier_detail[0]['name'],
                    'supplier_address' => $supplier_detail[0]['address'],
                    'supplier_contact' => $supplier_detail[0]['contact_no'],
                    'gstin' => $supplier_detail[0]['gst_in'],
                    'purchase_quantity' => $purchase_qty,
                    'profile_margin' => $profit_margin,
                    'discount_rate' => $discount_rate,
                    'product_id' => $product_id,
                    'purchase_id' => $purchase_id,
                    );                
                $log_id = $this->Common_Model->add_data('purchase_products', $log);

                // Entry for inventory in product
                $where_p = array('p_id'=> $product_id);
                $product_results = $this->Common_Model->view_data("product", $where_p);
                $inventory_quantity = $product_results[0]['p_quantity'];
                $inventory_quantity = $inventory_quantity + intval($purchase_qty);
                
                $where = array('p_id'=> $product_id);
                $product_form = array(
                    'p_amount' => $selling_price,
                    'p_quantity' => $inventory_quantity,
                    'p_market_amount' => $mrp,
                    'p_buying_amount' => $buying_rate,
                    'p_admin_profit' => $p_admin_profit,
                    'p_user_profit' => $p_user_profit,
                    'supplier_name' => $supplier_detail[0]['name'],
                    'supplier_address' => $supplier_detail[0]['address'],
                    'supplier_contact' => $supplier_detail[0]['contact_no'],
                    'gstin' => $supplier_detail[0]['gst_in'],
                    'purchase_quantity' => $purchase_qty,
                    'profile_margin' => $profit_margin,
                    'discount_rate' => $discount_rate,
                    );
                
                $this->Common_Model->update_table($where, $product_form, "product");
                
            }

            redirect('view_purchase');
        }

        //Purchase details
        $where = array('id' => $purchase_id);
        $purchaseResults = $this->Common_Model->view_data("purchase_entry", $where);

        //Supplier details
        $where = array('id'=> $purchaseResults[0]['supplier_id']);
        $supplierDetail = $this->Common_Model->view_data("supplier",$where);
 
        //Purchase Product Log details 
        $where = array('purchase.purchase_id'=> $purchase_id);
        $productPurchaseLogs = $this->PurchaseEntryMdl->getPurchaseLogsById($where);
     
        $brandNames = array();
        $where = array('p_delete'=> '1');
        $brandNames = $this->PurchaseEntryMdl->getAllBrands($where);
        $data['brandNames'] = $brandNames;

        $where = array();
        $supplier_results = $this->Common_Model->view_data("supplier", $where);
        $data['supplierList'] = $supplier_results;
        
        $data["purchaseResults"] =  $purchaseResults[0];
        $data["supplierDetail"] =  $supplierDetail[0];
        $data["productPurchaseLogs"] =  $productPurchaseLogs;

        $this->load->view('master/edit_purchase', $data);
    }

    public function deletePurchaseItem(){
        $id = $this->uri->segment(2, 0);

        //Get Product Purchase Log
        $where = array('id' => $id);
        $purchaseResults = $this->Common_Model->view_data("purchase_products", $where);

        $purchase_qty = $purchaseResults[0]['purchase_quantity'];
        $product_id = $purchaseResults[0]['product_id'];

        // Revert purchase entry from product
        $where_p = array('p_id'=> $product_id);
        $product_results = $this->Common_Model->view_data("product", $where_p);
        $inventory_quantity = $product_results[0]['p_quantity'];
        $inventory_quantity = $inventory_quantity - intval($purchase_qty);

        $where = array('p_id'=> $product_id);
                $product_form = array(
                    'p_quantity' => $inventory_quantity,
                );        
        $this->Common_Model->update_table($where, $product_form, "product");
                
        //Delete purchase log
        $where = array("id" => $id);
        $log_id = $this->Common_Model->deleteData('purchase_products', $where);

        redirect('edit_purchase/'.$purchaseResults[0]['purchase_id']);
    }

    public function add_supplier(){
        $response = array();
        $response['success'] = 'failed';

        $supplier_name = $this->input->post('supplier_name');
        $supplier_gst_in = $this->input->post('supplier_gst_in');
        $supplier_contact = $this->input->post('supplier_contact');
        $supplier_email = $this->input->post('supplier_email');
        $supplier_address = $this->input->post('supplier_address');

        $supplier_data = array(
            'name' => $supplier_name,
            'address' =>  $supplier_address,
            'contact_no' => $supplier_contact,
            'email' =>  $supplier_email,  
            'gst_in' => $supplier_gst_in
            );

        $id = $this->Common_Model->add_data('supplier', $supplier_data);
        if(isset($id) && $id >0) {
            $response['id'] = $id;
            $response['name'] = $supplier_name;
            $response['success'] = 'success';
        }

        print_r(json_encode($response));
        exit;
    }
}

?>
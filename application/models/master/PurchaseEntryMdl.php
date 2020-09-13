<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PurchaseEntryMdl extends CI_Model {

    function __construct() {
        parent::__construct();
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

    public function getViewPurchaseList($where){
        $this->db->select('p.*, s.name, s.address, s.email');
        $this->db->from('purchase_entry p');
        $this->db->join('supplier s', 'p.supplier_id = s.id','left');
        $this->db->where($where);
        $this->db->order_by('p.bill_date', 'desc'); 
        $result = $this->db->get()->result_array();  
        return $result;
    }

    function getPurchaseLogsById($where){
        $this->db->select('purchase.*, p.p_quantity_description, p.brand_name, p.p_name, p.p_quantity, p.p_thumbnail');
        $this->db->from('purchase_products purchase');
        $this->db->join('product p', 'purchase.product_id = p.p_id','left');
        $this->db->where($where);
        $result = $this->db->get()->result_array();  
        return $result;
    }
}
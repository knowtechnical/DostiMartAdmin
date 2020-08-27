<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class LoginCtrl extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('file');
        $this->load->library('email');
        $this->load->model('LoginMdl');
    }

    function login() {
        $this->load->helper(array('form'));
        $this->load->view('login');
    }

    public function sign_in() {
        if (isset($_POST['login'])) {           
             $email = $this->input->post('email');
            $password = $this->input->post('password');
            $result = $this->LoginMdl->login($email, $password);          
           //print_r($result);exit;
            if ($result) {                
                $_SESSION['all'] = $result[0];  
                if($result[0]['l_role'] == 'superadmin' || $result[0]['l_role'] == 'admin'){
                    return  redirect('admin_dashboard', 'refresh');  
                }elseif($result[0]['l_role'] == 'vendor'){
                    return  redirect('view_product', 'refresh');  
                }elseif($result[0]['l_role'] == 'delivery_person'){
                    return  redirect('view_orders_dperson', 'refresh');  
                }
                               
            }else{             
                $_SESSION['error'] = "Invalid Username or Password..!!";
                 redirect('login');
            }
        }
    }

    public function sign_up() {
        if (isset($_POST['submit'])) {
            $form_data = array(
                'fname' => $this->input->post('fname'),
                'lname' => $this->input->post('lname'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'password' => $this->input->post('password'),
                'role' => $this->input->post('role'),
                'address' => $this->input->post('address'),
            );

            if ($this->LoginMdl->savedata_login($form_data)) {
                $_SESSION['success'] = "Signup Successfully Please Login Here";
                redirect('login');
            } else {
                $_SESSION['error'] = "Error";
                redirect('login');
            }
        }
    }

    function lockscreen() {
        $this->load->view('lockscreen');
    }

    function logout() {        
        $this->session->unset_userdata('logged_in');
        session_destroy();
       return redirect('login');
    }

}

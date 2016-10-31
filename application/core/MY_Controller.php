<?php
class MY_Controller extends CI_Controller{
    var $data = array();
    
    function __construct(){
        parent::__construct();
        $this->benchmark->mark('code_start');
        
        $who = strtolower($this->uri->segment(1)); if($who != 'admin123' && $who != 'user') return;
        $controller = strtolower($this->uri->rsegment(1)); if($controller == 'logout') return;
        $action = strtolower($this->uri->rsegment(2));
        
        if($who == 'user'){
            //users who's not logged in can only access to login, register, reset_password pages.
            $pages = array('login', 'register', 'reset_password');
            
            if(!$this->user_logged_in() && !in_array($controller, $pages)) redirect('user/login');
                
            //user who's logged in cannot access to login, register, reset_password pages.
            if($this->user_logged_in() && in_array($controller, $pages)) redirect('user/stats');
            
            //load helpers and libraries
            $this->load->model('user_model');
            $this->load->helper('form');
            $this->load->library('form_validation');
        }
        
        if($who == 'admin123'){
            if(!$this->session->has_userdata('admin') && $controller != 'login') redirect('admin123/login');
            if($this->session->has_userdata('admin') && $controller == 'login') redirect('admin123/dashboard');
            $this->load->model('admin_model');
            $this->load->helper('form');
            $this->load->library('form_validation');
        }
    }
    
    function user_logged_in(){
        if($this->session->has_userdata('user_id')) return true;
        
        return false;
    }
    
    function __destruct(){
        $this->benchmark->mark('code_end');

        echo $this->benchmark->elapsed_time('code_start', 'code_end');
    }
}
<?php
class MY_Controller extends CI_Controller{
    var $data = array();
    var $back;
    
    function __construct(){
        parent::__construct();
        if(isset($_SESSION['back'])) $this->back = $_SESSION['back'];
        else $this->back = base_url();
        
        $who = strtolower($this->uri->segment(1)); if($who != 'admin' && $who != 'user') return;
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
        
        if($who = 'admin'){
            
        }
    }
    
    function user_logged_in(){
        if($this->session->has_userdata('user_id')) return true;
        
        return false;
    }
}
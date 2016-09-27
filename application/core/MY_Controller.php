<?php
class MY_Controller extends CI_Controller{
    var $data = array();
    
    function __construct(){
        parent::__construct();
        $controller = $this->uri->segment(1);
        $controller = strtolower($controller);
        
        if($controller == 'admin'){
            
        }
    }
}
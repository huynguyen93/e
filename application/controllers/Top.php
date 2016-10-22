<?php
class Top extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('user_model');
    }
    
    function index(){
        $this->data['view'] = 'top';
        $this->load->view('layout', $this->data);
    }
}
<?php
class Categories extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('category_model');
    }
    
    function index(){
        $this->data['categories'] = $this->category_model->get_list();
        
        $this->data['view'] = 'admin/category/index';
        $this->load->view('admin/index', $this->data);
    }
    
    function create(){
        if(isset($_POST['submit'])){
            $name = $this->db->escape_str($_POST['name']);
            $num = intval($_POST['num']);
            
            $data = array(
                'name' => $name,
                'num' => $num
            );
            $this->category_model->create($data);
        }
        
        $this->data['view'] = 'admin/category/create';
        $this->load->view('admin/index', $this->data);
    }
}
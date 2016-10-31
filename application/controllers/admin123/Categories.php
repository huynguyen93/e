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
        // delete the line below to create categories
        redirect(admin_url('categories'));
        
        if(!$this->input->post('add_new_cat_btn')) redirect(admin_url('categories'));
        
        $this->form_validation->set_rules('name', 'Category Name', 'trim|strip_tags|alpha_numeric|max_length[30]');
        $this->form_validation->set_rules('slug', 'Category Slug', 'trim|strip_tags|max_length[30]');
        $this->form_validation->set_rules('num', 'Category Order Number', 'trim|strip_tags|max_length[2]|numeric');
        
        if($this->form_validation->run() == false) redirect(admin_url('categories'));
        
        $data = array(
            'name' => $this->input->post('name'),
            'slug' => $this->input->post('slug'),
            'num' => $this->input->post('num')
        );
        
        $this->category_model->create($data);
        
        $this->data['view'] = 'admin/category/create';
        $this->load->view('admin/index', $this->data);
    }
}
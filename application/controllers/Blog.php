<?php
class Blog extends MY_Controller{
    
    function __construct(){
        parent::__construct();
        
        $this->load->model('blog_model');
    }
    
    function index(){
        $total_posts = $this->blog_model->get_total_rows();
        
        if(isset($_GET['sort_by']) && $_GET['sort_by'] == 'popularity') $order = 'view_count';
        else $order = 'date';
        
        $cond = array(
            'select' => 'id, title, slug, intro, date, view_count',
            'order' => array($order, 'desc')
        );
        $posts = $this->blog_model->get_list($cond);
        
        $this->data['posts'] = $posts;
        $this->data['view'] = 'blog/index';
        $this->load->view('layout', $this->data);
    }
    
    function show_post(){
        $post_slug = $this->uri->rsegment(3);
        
        $post = $this->blog_model->get_single('slug', $post_slug);
        
        $this->data['post'] = $post;
        $this->data['view'] = 'blog/show_post';
        $this->load->view('layout', $this->data);
    }
}
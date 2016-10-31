<?php
class Blog extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('blog_model');
    }
    
    function index(){
        $this->data['view'] = 'admin/blog/index';
        $this->load->view('admin/index', $this->data);
    }
    
    function create(){
        $this->data['view'] = 'admin/blog/create';
        if(!$this->input->post('add_post_btn')) {
            $this->load->view('admin/index', $this->data);
            return;
        }
        
        $this->form_validation->set_rules('title', 'Title', 'trim|required|strip_tags|max_length[255]');
        $this->form_validation->set_rules('slug', 'Slug', 'trim|required|strip_tags|max_length[255]');
        $this->form_validation->set_rules('intro', 'Intro', 'trim|required|strip_tags|max_length[500]');
        $this->form_validation->set_rules('body', 'Body', 'trim|required');
        
        if($this->form_validation->run() == false){
            $this->load->view('admin/index', $this->data);
            return;
        }
        
        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $this->input->post('slug'),
            'intro' => $this->input->post('intro'),
            'body' => $this->input->post('body'),
            'date' => time()
        );
        if($post = $this->blog_model->create($data)) {
            $this->session->set_flashdata('success', 'New blog post has been created.');
            redirect(admin_url('blog/edit/'.$post));
        } else {
            $this->session->set_flashdata('fail', 'Creating new post has failed, please try again.');
            $this->load->view('admin/index', $this->data);
        }
    }
    
    
    
    function edit(){
//        if(!$this->input->post('edit_post_btn')) redirect(admin_url('blog'));
        $post_id = $this->uri->rsegment(3);
        $post = $this->blog_model->get_single('id', $post_id);
        $this->data['view'] = 'admin/blog/edit';
        
        if($this->input->post('edit_post_btn'))
        {
            
            $this->form_validation->set_rules('post_id', 'Post id', 'trim|required|numeric|max_length[3]');
            $this->form_validation->set_rules('title', 'Title', 'trim|required|strip_tags|max_length[255]');
            $this->form_validation->set_rules('slug', 'Slug', 'trim|required|strip_tags|max_length[255]');
            $this->form_validation->set_rules('intro', 'Intro', 'trim|required|strip_tags|max_length[500]');
            $this->form_validation->set_rules('body', 'Body', 'trim|required');

            if($this->form_validation->run() == false){
                $this->load->view('admin/index', $this->data);
                return;
            }
            
            $post_id = $this->input->post('post_id');
            $data = array(
                'title' => $this->input->post('title'),
                'slug' => $this->input->post('slug'),
                'intro' => $this->input->post('intro'),
                'body' => $this->input->post('body')
            );
            $query = array(
                'set' => $data,
                'where' => 'id ='.$post_id
            );
            if($this->blog_model->update($query)){
                $this->session->set_flashdata('success', 'The post is updated successfully!');
                redirect(admin_url('blog/edit/'.$post_id));
            } else {
                $this->session->set_flashdata('fail', 'The post is not updated, try again!');
                redirect(admin_url('blog/edit/'.$post_id));
            }
        }
        
        $this->data['post'] = $post;
        $this->load->view('admin/index', $this->data);
    }
}
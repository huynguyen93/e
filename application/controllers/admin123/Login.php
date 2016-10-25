<?php
class Login extends MY_Controller{
    function index(){
        $this->load->view('admin/login');
    }
    
    function process(){
        if(!$this->input->post('login')) redirect('admin123/login');
        
        //validation
        $this->form_validation->set_rules('username', 'Username', 'trim|strip_tags|required|max_length[50]');
        $this->form_validation->set_rules('password', 'Password', 'trim|strip_tags|required|max_length[40]');
        if($this->form_validation->run() == false){
            redirect('admin123/login');
        }
        
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $admin = $this->admin_model->get_single('username', $username);
        //if username is not correct:
        if(!$admin) redirect('admin123/login');
        
        //if username is correct -> check password
        $password = md5($password.$admin->salt);
        $cond = array('where' => "username='$username' AND password='$password'");
        $admin = $this->admin_model->get_detail($cond);
        
        //if password is not correct:
        if(!$admin) redirect('admin123/login');
        
        //if username and pasword are correct:
        $this->session->set_userdata('admin', true);
        redirect('admin123/dashboard');
        
    }
}
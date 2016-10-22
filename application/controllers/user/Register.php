<?php
class Register extends MY_Controller{
    public function index(){
        $this->data['view'] = 'user/register';
        $this->load->view('layout', $this->data);
    }
    
    public function process(){
        if( ! $this->input->post('submit_register')) redirect('user/login');
        make_flashdata();
        
        //if user confirms captcha incorrectly:
        if($this->input->post('captcha') != $_SESSION['captcha']){
            $this->session->set_flashdata('fail', 'Captcha is not typed correctly, please try again!');
            redirect('user/register');
        }
        
        //captcha confimation is done correctly, validate the inputs:
        unset($_SESSION['captcha']);
        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|max_length[20]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
        $this->form_validation->set_rules('email', 'Email', 'trim|strip_tags|required|valid_email|is_unique[users.email]', array('is_unique' => 'This email has been used.'));
        $this->form_validation->set_rules('password', 'Password', 'strip_tags|required');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');
        
        //if inputs are not valid:
        if($this->form_validation->run() == false){
            $this->session->set_flashdata('error', validation_errors('<p class="alert alert-danger">', '</p>'));
            redirect('user/register');
        }
        
        //if inputs are all valid:
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $salt = rand(100,999);
        $data = array(
            'username' => $username,
            'email' => $email,
            'password' => md5($password.$salt),
            'salt' => $salt,
            'created_at' => time()
        );
        
        //if user creation fails:
        $user_id = $this->user_model->create($data);
        if($user_id == false){
            $this->session->set_flashdata('fail', 'There was an unexpected problem, please try again!');
            redirect('user/register');
        }
        
        //if user is created successfully, get the user logged in:
        $cond['where'] = 'id='.$user_id;
        $user = $this->user_model->get_detail($cond);
        $user_data = array(
            'user_id' => $user->id,
            'user_nickname' => $user->username,
            'user_email' => $user->email,
            'user_recent_word_count' => $user->recent_word_count
        );
        $this->session->set_userdata($user_data);
        
        unset($_SESSION['flash']);
        redirect($this->back);
    }
    
    
}
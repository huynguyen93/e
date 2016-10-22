<?php
class User extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    
    public function index(){
        
    }
    
    public function logged_in(){
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) return true;
        return false;
    }
    
    public function register(){
        //if the user has logged in:
        if($this->logged_in()) redirect(base_url());
        
        //load libraries:
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        //show registration form
        $this->data['view'] = 'user/register';
        if( ! $this->input->post('submit_register')){
            $this->load->view('layout', $this->data);
            return false;
        }
        
        //if user confirms captcha incorrectly:
        if($this->input->post('captcha') != $_SESSION['captcha']){
            $_SESSION['message'] = '<p class="alert alert-danger">Confirm numbers are not correct! Try again!</p>';
            $this->load->view('layout', $this->data);
            return false;
        }
        
        //captcha confimation is done correctly, validate the inputs:
        unset($_SESSION['captcha']);
        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|max_length[20]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
        $this->form_validation->set_rules('email', 'Email', 'trim|strip_tags|required|valid_email|is_unique[users.email]', array('is_unique' => 'This email has been used.'));
        $this->form_validation->set_rules('password', 'Password', 'strip_tags|required');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');
        
        //if inputs are not valid:
        if($this->form_validation->run() == false){
            $this->load->view('layout', $this->data);
            return false;
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
            $this->data['error'] = "There was an unexpected problem, please try again!";
            $this->load->view('layout', $this->data);
            return false;
        }
        
        //if user is created successfully, get the user logged in:
        $cond['where'] = 'id='.$user_id;
        $user = $this->user_model->get_detail($cond);

        $_SESSION['user_id'] = (int)$user->id;
        $_SESSION['username'] = (string)$user->username;
        $_SESSION['logged_in'] = (bool)true;
        
        if(isset($_SESSION['back'])) redirect($_SESSION['back']);
        redirect(base_url());
    }
    
    
    public function login(){
        
    }
    
    function reset_password(){
        //if the user is being logged in:
        if(isset($_SESSION['user_id'])) redirect(base_url());
        
        //show reset password form
        $this->data['view'] = 'user/reset_password';
        if( ! $this->input->post('submit_reset_password')){
            $this->load->view('layout', $this->data);
            return false;
        }
    }
    
    
}
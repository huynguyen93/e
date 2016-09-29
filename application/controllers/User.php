<?php
class User extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('user_model');
    }
    
    public function register(){
        //if the user is being logged in:
        if(isset($_SESSION['user_id'])) redirect(base_url());
        
        //load libraries:
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        //show register form
        $this->data['view'] = 'user/register';
        if( ! $this->input->post('submit_register')){
            $this->load->view('layout', $this->data);
            return false;
        }
        
        //if user confirms captcha incorrectly:
        if($this->input->post('captcha') != $_SESSION['captcha']){
            $_SESSION['message'] = '<p class="message">Confirm numbers are not correct! Try again!</p>';
            $this->load->view('layout', $this->data);
            return false;
        }
        unset($_SESSION['captcha']);
        
        //captcha confimation is done correctly, validate the inputs:
        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|max_length[20]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]', array('is_unique' => 'This email has been used.'));
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');
        
        //if inputs are not valid:
        if($this->form_validation->run() == false){
            $_SESSION['message'] = '<p>FAILED</p>';
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
        $_SESSION['user_group'] = (bool)$user->user_group;
        
        redirect(base_url());
    }
    
    
    public function login(){
        //if the user is being logged in:
        if(isset($_SESSION['user_id'])) redirect(base_url());
        
        //load libraries:
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        //view login form:
        $this->data['view'] = 'user/login';
        if( ! $this->input->post('submit_login')){
            $this->load->view('layout', $this->data);
            return false;
        }
        
        //when user submits form:
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[50]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        //inputs are not valid:
        if($this->form_validation->run() == false){
            $_SESSION['message'] = '<p>FAILED</p>';
            $this->load->view('layout', $this->data);
            return false;
        }
        
        //inputs are valid, check if the email is true:
        $email = $this->input->post('email');
        $cond = array();
        $cond['select'] = 'email, salt';
        $cond['where'] = "email='$email'";
        
        //if the email is false:
        if(!$user = $this->user_model->get_detail($cond)){
            $_SESSION['message'] = 'Wrong email or password';
            $this->load->view('layout', $this->data);
            return false;
        }
        
        //the email is true, check the assword:
        $password = $this->input->post('password');
        $password = md5($password.$user->salt);
        $cond = array();
        $cond['select'] = 'id, username, words, email, user_group, created_at';
        $cond['where'] = "email='$email' AND password='$password'";
        $user = $this->user_model->get_detail($cond);
        
        //password is true:
        if($user){            
            $_SESSION['user_id'] = (int)$user->id;
            $_SESSION['username'] = (string)$user->username;
            $_SESSION['logged_in'] = (bool)true;
            $_SESSION['user_group'] = (bool)$user->group;
            
            redirect(base_url());
            return true;
        }
        
        //password is false:
        $_SESSION['message'] = 'Wrong email or password';
        $this->load->view('layout', $this->data);
    }
    
    function forgot_password(){
        
    }
    
    function change_password(){
        
    }
    
    function logout(){
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['logged_in']);
            unset($_SESSION['user_group']);
        }
        redirect(base_url());
    }
    
    function get_captcha(){
        if(!isset($_SESSION['captcha'])){
            $pool = '0123456789'; $captcha = '';
            while(strlen($captcha)<4) $captcha .= substr($pool, rand(0, strlen($pool)), 1);
            $_SESSION['captcha'] = $captcha;
        }
        
        $this->data['captcha'] = $_SESSION['captcha'];
        $this->load->view('user/captcha', $this->data);
    }
}
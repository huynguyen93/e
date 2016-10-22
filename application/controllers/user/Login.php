<?php
class Login extends MY_Controller{
    
    public function index(){
        $this->data['view'] = 'user/login';
        $this->load->view('layout', $this->data);
    }
    
    public function process(){
        if(!$this->input->post('submit_login')) redirect('user/login');
        
        //when user submits form:
        make_flashdata();
        $this->form_validation->set_rules('email', 'Email', 'trim|strip_tags|required|valid_email|max_length[50]');
        $this->form_validation->set_rules('password', 'Password', 'trim|strip_tags|required|max_length[30]');
        
        //inputs are not valid:
        if($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors('<p class="alert alert-danger">', '</p>'));
            redirect('user/login');
        }
        
        //inputs are valid, check if the email is true:
        $email = $this->input->post('email');
        $cond = array();
        $cond['select'] = 'email, salt';
        $cond['where'] = "email='$email'";
        
        //if the email is false:
        if(!$user = $this->user_model->get_detail($cond)){
            $this->session->set_flashdata('fail', 'Wrong email or password');
            redirect('user/login');
        }
        //the email is true, check the assword:
        $password = $this->input->post('password');
        $password = md5($password.$user->salt);
        $cond = array('where' => "email='$email' AND password='$password'");
        $user = $this->user_model->get_detail($cond);
        
        //password is true:
        if($user){
            $user_data = array(
                'user_id' => $user->id,
                'user_nickname' => $user->username,
                'user_email' => $user->email,
                'user_updated_at' => $user->updated_at,
                'user_recent_word_count' => $user->recent_word_count
            );
            
            $this->session->set_userdata($user_data);
            
            unset($_SESSION['flash']);
            redirect($this->back);
        }
        
        //password is false:
        $this->session->set_flashdata('fail', 'Wrong email or password');
        redirect('user/login');
    }
}
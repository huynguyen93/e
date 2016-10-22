<?php
class Reset_password extends MY_Controller{
    public function index(){
        $this->data['view'] = 'user/reset_password';
        $this->load->view('layout', $this->data);
    }
    
    public function process(){
        if(!$this->input->post('submit_reset_password')) redirect('user/reset_password');
        
        make_flashdata();
        $this->form_validation->set_rules('email', 'Email', 'trim|strip_tags|required|valid_email|max_length[50]');
        
        if($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors('<p class="alert alert-danger">', '</p>'));
            redirect('user/reset_password');
        }
        
        //inputs are valid, check if the email is true:
        $this->load->model('user_model');
        $email = $this->input->post('email');
        $cond = array('where' => "email='$email'");
        
        //if the email is false:
        if(!$user = $this->user_model->get_detail($cond)){
            $this->session->set_flashdata('fail', 'Wrong email.');
            redirect('user/reset_password');
        }
        
        //the email is true, reset the password:
        $new_password = $this->generateRandomString(8);
        $cond = array();
        $cond['set'] = array( 'password' => md5($new_password.$user->salt) );
        $cond['where'] = array('id', $user->id);
        if($this->user_model->update($cond) == false){
            $this->session->set_flashdata('fail', 'Failed. Please try again!');
            redirect('user/reset_password');
        }
        
        $this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mailtrap.io';
        $config['smtp_user'] = '4268b58f7e30c4';
        $config['smtp_pass'] = '98e076d3c2e66a';
        $config['smtp_port'] = '2525';
        $config['smtp_crypto'] = 'tls';
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");  
        
        $this->email->from('admin@freedictations.com', 'Admin');
        $this->email->to('gsmbinhthanh@gmail.com');

        $this->email->subject('Reset password');
        $this->email->message('Your new password is: '. $new_password);

        if($this->email->send()){
            $this->session->set_flashdata('warning', 'Check your email inbox for the new password');
            redirect('user/login');
        } else {
            $this->session->set_flashdata('fail', 'There were some unexpected problems, please try again!');
            redirect('user/reset_password');
        }
    }
    
    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
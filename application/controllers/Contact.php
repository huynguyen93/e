<?php
class Contact extends CI_Controller{
    
    function index(){
        $this->load->helper('form');
        $this->data['view'] = 'contact';
        $this->load->view('layout', $this->data);
    }
    
    function send_message(){
        if(!$this->input->post('send_email')) redirect('contact');
        
        $this->form_validation->set_rules('email', 'Email', 'trim|strip_tags|required|valid_email|max_length[50]');
        $this->form_validation->set_rules('');
        
        $this->load->library('email');
        
        //configuration email system
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mailtrap.io';
        $config['smtp_user'] = '4268b58f7e30c4';
        $config['smtp_pass'] = '98e076d3c2e66a';
        $config['smtp_port'] = '2525';
        $config['smtp_crypto'] = 'tls';
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");  
        
        $this->email->from('loimuonnoi93@gmail.com', 'Your Name');
        $this->email->to('gsmbinhthanh@gmail.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        if($this->email->send()){
            echo "sent";
        } else {
            echo $this->email->print_debugger();
        }
    }
}
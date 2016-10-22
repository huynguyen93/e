<?php
class Change_password extends MY_Controller{
    public function index(){
        $this->data['view'] = 'user/change_password';
        $this->load->view('layout', $this->data);
    }
    
    public function process(){
        if(!$this->input->post('submit_change_password')) redirect('user/change_password');
        
        $this->form_validation->set_rules('old_password', 'Old Password', 'strip_tags|required');
        $this->form_validation->set_rules('new_password', 'New Password', 'strip_tags|required');
        $this->form_validation->set_rules('confirm_password', 'Password confirmation', 'required|matches[new_password]');
        
        if($this->form_validation->run() == false){
            $this->session->set_flashdata('error', validation_errors('<p class="alert alert-danger">', '</p>'));
            redirect('user/change_password');
        }
        
        $user_id = $_SESSION['user_id'];
        $cond = array();
        $cond['where'] = array('id' => $user_id);
        $user = $this->user_model->get_detail($cond);
        
        $cond = array();
        $cond['where'] = array( 'id' => $user_id, 'password' => md5($this->input->post('old_password') . $user->salt) );
        if(!$user = $this->user_model->get_detail($cond)){
            $this->session->set_flashdata('fail', 'Failed, old password is not correct!');
            redirect('user/change_password');
        }
        
        $new_password = md5($this->input->post('new_password') . $user->salt);
        $cond = array();
        $cond['set'] = array('password' => $new_password);
        $cond['where'] = array('id' => $user_id);
        if($this->user_model->update($cond) == false){
            $this->session->set_flashdata('fail', 'There were some unexpected problems, please try again!');
            redirect('user/change_password');
        }
        
        $this->session->set_flashdata('success', 'Your password has been updated!');
        redirect('user/stats');
        
    }
}
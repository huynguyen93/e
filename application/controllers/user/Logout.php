<?php
class Logout extends CI_Controller{
    
    function index(){
        if($this->session->has_userdata('user_id')){
            $user_data = array(
                'user_id',
                'user_nickname',
                'user_email',
                'user_recent_word_count'
            );
            $this->session->unset_userdata($user_data);
        }
        redirect($this->back);
    }
}
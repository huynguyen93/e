<?php
class FAQ extends MY_Controller{
    function index(){
        $this->data['view'] = 'faq';
        $this->load->view('layout', $this->data);
    }
}
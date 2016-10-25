<?php
class Dashboard extends MY_Controller{
    function index(){
        $this->data['view'] = 'admin/dashboard';
        $this->load->view('admin/index', $this->data);
    }
}
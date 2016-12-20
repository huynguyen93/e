<?php
class Captcha extends CI_Controller{
    function index(){
        if(!isset($_SESSION['captcha'])){
            $pool = '0123456789'; $_SESSION['captcha'] = '';
            while(strlen($_SESSION['captcha'])<4) $_SESSION['captcha'] .= substr($pool, rand(0, strlen($pool)), 1);
        }
//        die($_SESSION['captcha']);
        $this->data['captcha'] = $_SESSION['captcha'];
        $this->load->view('partials/_captcha', $this->data);
    }
}
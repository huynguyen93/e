<?php
class Captcha extends CI_Controller{
    function index(){
        if(!isset($_SESSION['captcha'])){
            $pool = '0123456789'; $captcha = '';
            while(strlen($captcha)<4) $captcha .= substr($pool, rand(0, strlen($pool)), 1);
            $_SESSION['captcha'] = $captcha;
        }
        
        $this->data['captcha'] = $_SESSION['captcha'];
        $this->load->view('partials/_captcha', $this->data);
    }
}
<?php
class Logout extends MY_Controller{
    function index(){
        unset($_SESSION['admin']);
        redirect();
    }
}
<?php
function pre($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function admin_url($uri = ''){
    return $uri == '' ? base_url('admin123/dashboard') : base_url('admin123/'.$uri);
}
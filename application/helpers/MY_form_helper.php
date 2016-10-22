<?php
function make_flashdata(){
    if(!empty($_POST))
        foreach($_POST as $name => $val)
            $_SESSION['flash'][$name] = $val;

    if(!empty($_GET))
        foreach($_GET as $name => $val)
            $_SESSION['flash'][$name] = $val; 
}

function old_value($name){
    if(isset($_SESSION['flash'][$name])) echo $_SESSION['flash'][$name]; unset($_SESSION['flash'][$name]);
}
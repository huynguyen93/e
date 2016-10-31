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

function slugify($text){
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
    return 'n-a';
    }

    return $text;
}
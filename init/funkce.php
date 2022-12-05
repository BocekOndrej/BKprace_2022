<?php

function view($nazev,$model = ''){
    global $title;
    require(CESTA . "views/layout.view.php");
}

function lockAdmin(){
    if(!isset($_SESSION["role"])||$_SESSION["role"]!=2) header("location:../index.php");
}

function osetritString($value){
    $temp = filter_var(trim($value),FILTER_SANITIZE_STRING);
    if($temp===false){
        return '';
    }
    return $temp;
}

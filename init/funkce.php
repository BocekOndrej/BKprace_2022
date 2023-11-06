<?php

function view($nazev,$model = ''){
    global $title;
    require(CESTA . "views/layout.view.php");
}

function lockAdmin(){
    if(!isset($_SESSION["role"])||$_SESSION["role"]!=2) header("location:../index.php");
}
function lockUser(){
    if(!isset($_SESSION["role"])||$_SESSION["role"]!=3) header("location:../index.php");
}

function sanitizeString($value){
    $temp = filter_var(trim($value),FILTER_SANITIZE_STRING);
    if($temp===false){
        return '';
    }
    return $temp;
}
function searchObjectsRecursive($objects, $searchString) {
    $filteredObjects = array_filter($objects, function($object) use ($searchString) {
        foreach ($object as $property => $value) {
            if (is_array($value)) {
                // If the property is an array, recursively search through its elements
                if (searchObjectsRecursive($value, $searchString)) {
                    return true;
                }
            } elseif (is_object($value)) {
                // If the property is an object, recursively search through its properties
                if (searchObjectsRecursive([$value], $searchString)) {
                    return true;
                }
            } elseif (stripos($value, $searchString) !== false) {
                return true; // If the string is found, include the object
            }
        }
        return false; // If the string is not found in any property, exclude the object
    });

    return $filteredObjects;
}
?>
<script>
    function insertValuesFiltry(){
        if(post.length != 0 && ( post.orderby != undefined || post.hledat != undefined)){
            $(document).ready(function(){
                $('#orderby').val(post.orderby);
                $('#hledat').val(post.hledat);
            });
        }
    }
    function insertValuesDetail(){
        if(post.length != 0 && post.id != undefined && post.smazat == undefined){
            viewDetail(parseInt(post.id));
        }
    }
</script>

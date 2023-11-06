<?php
require ("../init/config.php");

if(isset($_POST["id"])&&isset($_POST["heslo"])){
    $id = sanitizeString($_POST["id"]);
    $heslo = sanitizeString($_POST["heslo"]);
    $zakazka = Data::getZakazka($id);
    if($zakazka->heslo == $heslo){
        $model = [
            "zakazka" => $zakazka
        ];
    }else{
        //NOTIFIKACE
    }
} 
else{
    $model = null;
}
view("zakazky/zakazkyGuest",$model);
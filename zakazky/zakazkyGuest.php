<?php
require ("../init/config.php");

if(isset($_POST["id"])&&isset($_POST["heslo"])){
    $id = sanitizeString($_POST["id"]);
    $heslo = sanitizeString($_POST["heslo"]);
    $zakazka = Data::getZakazka($id);
    if($zakazka != null && $zakazka->heslo == $heslo){
        $model = [
            "zakazka" => $zakazka
        ];
    }else{
        $_SESSION['msg-bad'] = "Špatné ID nebo HESLO";
        $model = null;
    }
} 
else{
    $model = null;
}
view("zakazky/zakazkyGuest",$model);
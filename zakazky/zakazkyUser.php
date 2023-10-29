<?php
require ("../init/config.php");

if(isset($_GET["id"])){
    $id = sanitizeString($_GET["id"]);
    $zakazka = Data::getZakazka($id);
    $zakazkyAll = Data::getAllZakazkaForUser($_SESSION["zakaznik"]);
    $zakaznici = Data::getAllZakaznik();
    $stavy = Data::getAllStav();
    $zbozi = Data::getAllZbozi();
    $model = [
        "zakazkyAll" => $zakazkyAll,
        "zakazka" => $zakazka,
        "zakaznici" => $zakaznici,
        "stavy" => $stavy,
        "zbozi"=> $zbozi
    ];
    view("zakazky/zakazkyUser",$model);
} else {
    $zakazkyAll = Data::getAllZakazkaForUser($_SESSION["zakaznik"]);
    $model = ["zakazkyAll" => $zakazkyAll];
    view("zakazky/zakazkyUser",$model);
}
<?php
require ("../init/config.php");
lockUser();
    $stavy = Data::getAllStav();
    $zbozi = Data::getAllZbozi();
    $zakazkyAll = Data::getAllZakazkaForUser($_SESSION["zakaznik"]);
    $model = [
        "zakazkyAll" => $zakazkyAll,
        "stavy"=>$stavy,
        "zbozi"=> $zbozi
    ];
    view("zakazky/zakazkyUser",$model);

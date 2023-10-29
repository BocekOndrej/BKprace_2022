<?php
    require ("../init/config.php");
    lockAdmin();
    $title = "Sklad";
    if(isset($_POST["upravit"]) && $_POST["upravit"]=="Upravit"){
        $id = sanitizeString($_POST['id']);
        $nazev = sanitizeString($_POST['nazev']);
        $mnozstvi = sanitizeString($_POST['mnozstvi']);
        $jednotka = sanitizeString($_POST['jednotka']);
        $sercis = sanitizeString($_POST['sercis']);
        $zaruka = sanitizeString($_POST['zaruka']);
        $cena1 = sanitizeString($_POST['cena1']);
        $cena2 = sanitizeString($_POST['cena2']);
        $datum = sanitizeString($_POST['datum']);
        $obchod = sanitizeString($_POST['obchod']);
        $dph = sanitizeString($_POST['DPH']);
        $pozn = sanitizeString($_POST['pozn']); 
        if(Data::editZbozi($id,$nazev,$mnozstvi,$jednotka,$sercis,$zaruka,$cena1,$cena2,$datum,$obchod,$dph,$pozn)){
            $_SESSION["msg-good"]="Zboží upraveno.";           
        };
    }
    if(isset($_POST["smazat"]) && $_POST["smazat"]=="Smazat"){
        $id = sanitizeString($_POST["id"]);
        if(Data::deleteZbozi($id)){ 
            $_SESSION["msg-good"]="Zboží úspěšně smazáno.";
        }
    }

    if(isset($_GET["id"])){
        $id = sanitizeString($_GET["id"]);
        $polozka = Data::getZbozi($id);
        $zbozi = Data::getAllZbozi();
        $model = [
            "zbozi"=>$zbozi,
            "polozka"=>$polozka
        ];
        view("sklad/detail",$model);
    } else {
        $zbozi = Data::getAllZbozi();
        $model = [
            "zbozi"=>$zbozi,
        ];
        view("sklad/detail",$model);
    }
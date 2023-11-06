<?php
    require ("../init/config.php");
    lockAdmin();
    $title = "Sklad";
    if(isset($_POST['pridat'])){
        $nazev = sanitizeString($_POST['nazev']);
        $mnozstvi = sanitizeString($_POST['mnozstvi']);
        $jednotka = sanitizeString($_POST['jednotka']);
        $sercis = sanitizeString($_POST['sercis']);
        $zaruka = sanitizeString($_POST['zaruka']);
        $cena1 = sanitizeString($_POST['cena1']);
        $cena2 = sanitizeString($_POST['cena2']);
        $datum = sanitizeString($_POST['datum']);
        $obchod = sanitizeString($_POST['obchod']);
        $dph = sanitizeString($_POST['dph']);
        $pozn = sanitizeString($_POST['pozn']);
        $vysledek = Data::AddZbozi($nazev, $mnozstvi, $jednotka, $sercis, $zaruka, $cena1, $cena2, $datum, $obchod, $dph, $pozn);
        if($vysledek){
            $_SESSION["msg-good"]="Zboží přidáno.";
        }  
    }
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
        $dph = sanitizeString($_POST['dph']);
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

    if(isset($_POST["filtrovat"]) && isset($_POST["orderby"])){
        $zbozi = Data::getAllZbozi($_POST["orderby"]);
    }else{
        $zbozi = Data::getAllZbozi();
    }
    if(isset($_POST["filtrovat"]) && isset($_POST["hledat"])){
        $hledanyString = $_POST["hledat"];
        $zbozi = searchObjectsRecursive($zbozi, $hledanyString);    
    }
    $model = [
        "zbozi"=>$zbozi,
    ];
    view("sklad/detail",$model);
    
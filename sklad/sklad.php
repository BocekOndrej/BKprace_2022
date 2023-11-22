<?php
    require ("../init/config.php");
    lockAdmin();
    $title = "Sklad";
    //Sekce pro přidání zboží
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
        $vysledek = Data::addZbozi($nazev, $mnozstvi, $jednotka, $sercis, $zaruka, $cena1, $cena2, $datum, $obchod, $dph, $pozn);
        if($vysledek){
            $_SESSION["msg-good"]="Zboží přidáno.";
        }  
    }
    //Sekce upravujici zbozi
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
    //sekce která maže zboží
    if(isset($_POST["smazat"]) && $_POST["smazat"]=="Smazat"){
        $id = sanitizeString($_POST["id"]);
        Data::deleteZboziFromAllZakazka($id);
        if(Data::deleteZbozi($id)){ 
            $_SESSION["msg-good"]="Zboží úspěšně smazáno.";
        }
    }
    //Sekce rozhodující o filtrování a řazení
    if(isset($_POST["filtrovat"]) && $_POST["orderby"] =! ""){
        $zbozi = Data::getAllZbozi($_POST["orderby"]);
    }else{
        $zbozi = Data::getAllZbozi();
    }
    if(isset($_POST["filtrovat"]) && isset($_POST["hledat"])){
        $hledanyString = sanitizeString($_POST["hledat"]);
        $zbozi = searchObjectsRecursive($zbozi, $hledanyString);    
    }
    //Tady se předají data do příslušného view
    $model = [
        "zbozi"=>$zbozi,
    ];
    view("sklad/detail",$model);
    
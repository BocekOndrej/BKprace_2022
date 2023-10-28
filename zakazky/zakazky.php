<?php
require ("../init/config.php");
lockAdmin();

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
    $idZakazky = sanitizeString($_POST["id"]);
    if($_POST["vratit"]==true){
        $zboziArray = Data::getAllZboziForZakazka($id);
        foreach($zboziArray as $zbozi){
            $newMnozstvi = Data::getZboziMnozstvi($zbozi->id) + $zbozi->mnozstvi;
            Data::editZboziMnozstvi($zbozi->id,$newMnozstvi);
        }
    }else if($_POST["vratit"]==false){
        Data::deleteZboziFromZakazka($id);
    }
    if(Data::deleteZakazka($idZakazky)){ 
        $_SESSION["msg-good"]="Zakázka úspěšně smazána.";
    }
}

if(isset($_GET["id"])){
    $id = sanitizeString($_GET["id"]);
    $zakazka = Data::getZakazka($id);
    $zakazkyAll = Data::getAllZakazka();
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
    view("zakazky/detail",$model);
} else {
    $zakazky = Data::getAllZakazka();
    view("zakazky/zakazky",$zakazky);
}
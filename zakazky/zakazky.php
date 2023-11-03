<?php
require ("../init/config.php");
lockAdmin();

if(isset($_POST["upravit"]) && $_POST["upravit"]=="Upravit"){
        $id = sanitizeString($_POST['id']);
        $datum_zac = sanitizeString($_POST['datum_zac']);
        $datum_konec = sanitizeString($_POST['datum_konec']);
        $zakaznik = sanitizeString($_POST['zakaznik']);
        $cena = sanitizeString($_POST['cena']);
        $dph = sanitizeString($_POST['dph']);
        $stav = sanitizeString($_POST['stav']);
        if($datum_konec == null && $stav == 3){
            $datum_konec = date("Y-m-d");
        }
        $pozn1 = sanitizeString($_POST['pozn1']);
        $pozn2 = sanitizeString($_POST['pozn2']);

        $vysledek1 = Data::editZakazka($id,$datum_zac,$datum_konec,$zakaznik,$cena,$dph,$stav,$pozn1,$pozn2,);

        $zboziArray = Data::getAllZboziForZakazka($id);
        foreach($zboziArray as $zbozi){
            $newMnozstvi = Data::getZboziMnozstvi($zbozi->id)[0] + $zbozi->mnozstvi;
            Data::editZboziMnozstvi($zbozi->id,$newMnozstvi);          
        }
        Data::deleteAllZboziFromZakazka($id);

        if(isset($_POST['newNazev'])){
            foreach($_POST['newNazev'] as $zbozi){
                    $index=array_search($zbozi,$_POST['newNazev']);
                    $nazev = sanitizeString($_POST['newNazev'][$index]);
                    $mnozstvi = sanitizeString($_POST['newMnozstvi'][$index]);
                    $jednotka = sanitizeString($_POST['newJednotka'][$index]);
                    $sercis = sanitizeString($_POST['sercis'][$index]);
                    $zaruka = sanitizeString($_POST['zaruka'][$index]);
                    $cena1 = sanitizeString($_POST['cena1'][$index]);
                    $cena2 = sanitizeString($_POST['cena2'][$index]);
                    $datumZbozi = sanitizeString($_POST['datumZbo'][$index]);
                    $obchod = sanitizeString($_POST['obchod'][$index]);
                    $dph = sanitizeString($_POST['dphZbo'][$index]);
                    $pozn = "";
                    $vysledek2 = Data::AddZbozi($nazev, 0, $jednotka, $sercis, $zaruka, $cena1, $cena2, $datumZbozi, $obchod, $dph, $pozn);
                    $idDB = Data::getZboziIdByNazev($nazev)[0];
                    $vysledek3 = Data::addZboziToZakazka($id,$idDB,$mnozstvi);
                }
            }
        if(isset($_POST['zboziId'])){
        foreach($_POST['zboziId'] as $zboziId){
                $index=array_search($zboziId,$_POST['zboziId']);
                $mnozstvi = sanitizeString($_POST['zboziPocet'][$index]);
                $vysledek3 = Data::addZboziToZakazka($id,$zboziId,$mnozstvi);
                $actualMnozstvi = Data::getZboziMnozstvi($zboziId)[0];
                Data::editZboziMnozstvi($zboziId,$actualMnozstvi-$mnozstvi);
            }
        }
        $_SESSION["msg-good"]="Zakázka úspěšně upravena.";
}
if(isset($_POST["smazat"]) && $_POST["smazat"]=="Smazat"){
    $idZakazky = sanitizeString($_POST["id"]);
    if(isset($_POST["vratit"])&&$_POST["vratit"]=="true"){
        $zboziArray = Data::getAllZboziForZakazka($idZakazky);
        foreach($zboziArray as $zbozi){
            $newMnozstvi = Data::getZboziMnozstvi($zbozi->id)[0] + $zbozi->mnozstvi;
            Data::editZboziMnozstvi($zbozi->id,$newMnozstvi);          
        }
        Data::deleteAllZboziFromZakazka($idZakazky);
    }else if(!isset($_POST["vratit"])){
        Data::deleteAllZboziFromZakazka($idZakazky);
    }
    if(Data::deleteZakazka($idZakazky)){ 
        $_SESSION["msg-good"]="Zakázka úspěšně smazána.";
    }
}
if(isset($_POST["filtrovat"]) && isset($_POST["orderby"])){
    $zakazkyAll = Data::getAllZakazka($_POST["orderby"]);
}else{
    $zakazkyAll = Data::getAllZakazka();
}
if(isset($_POST["filtrovat"]) && isset($_POST["hledat"])){
    $hledanyString = $_POST["hledat"];
    $zakazkyAll = searchObjectsRecursive($zakazkyAll, $hledanyString);    
}

    


$zakaznici = Data::getAllZakaznik();
$stavy = Data::getAllStav();
$zbozi = Data::getAllZbozi();
$model = [
    "zakazkyAll" => $zakazkyAll,
    "zakaznici" => $zakaznici,
    "stavy" => $stavy,
    "zbozi"=> $zbozi
];
view("zakazky/detail",$model);


<?php
require ("../init/config.php");
lockAdmin();
$zakaznici = Data::getAllZakaznik();
$zbozi = Data::getAllZbozi();
$stavy = Data::getAllStav();
$model = [
    "zakaznici"=> $zakaznici,
    "zbozi"=> $zbozi,
    "stavy"=> $stavy,
];

$title = "Přidat novou zakázku";  

    if(isset($_POST['submit'])){
        $datum = sanitizeString($_POST['datum']);
        $zakaznik = sanitizeString($_POST['zakaznik']);
        $cena = sanitizeString($_POST['cena']);
        $dph = sanitizeString($_POST['dph']);
        $stav = sanitizeString($_POST['stav']);
        $pozn1 = sanitizeString($_POST['pozn1']);
        $pozn2 = sanitizeString($_POST['pozn2']);
        $heslo = "123456789";

        $vysledek1 = Data::addZakazka($datum,$zakaznik,$cena,$dph,$stav,$pozn1,$pozn2,$heslo);
        $id = Data::maxId("zakazka");
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
        
        //Vytvoření zákaznického účtu pokud má více jak 1 zakázku
        $zakazky = Data::getAllZakazka();
        $zakaznikObj = null;
        $allZakazniciId = [];
        foreach($model["zakaznici"] as $zakaznikObjArr){
            if($zakaznikObjArr->id == $zakaznik)$zakaznikObj= $zakaznikObjArr;
        }
        foreach($zakazky as $zakazka){
            $allZakazniciId[] = $zakazka->objZakaznik->id;
        }
        $uzivatele = Data::getAllUzivatel();
        $allUzivateleLogins = [];
        foreach($uzivatele as $uzivatel){
            $allUzivateleLogins[] = $uzivatel->login;
        }
        if((count(array_keys($allZakazniciId, $zakaznik)) == 2 ) && ($zakaznikObj->email != null) && (count(array_keys($allUzivateleLogins, $zakaznikObj->email)) == 0 )){
            $heslo = "123456"."84oasů.f+A;Sa>wˇe8'(f4y6";
            $heslo_hash = hash("sha256",$heslo);
            Data::addUzivatel($zakaznikObj->jmeno." ".$zakaznikObj->prijmeni,$zakaznikObj->email,$heslo_hash,3,$zakaznikObj->id);
        }
        
        if($vysledek1){
            $_SESSION["msg-good"]="Zakázka vytvořena.";
            header("location:zakazky.php");
            exit();
        }  
        
    }

view("zakazky/pridat",$model);


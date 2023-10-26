<?php
require ("../init/config.php");
$model[] = Data::getAllZakaznik();
$model[] = Data::getAllZbozi();
$model[] = Data::getAllStav();

lockAdmin();
$title = "Přidat novou zakázku";  
    if(isset($_POST['submit'])){
        $id = sanitizeString($_POST['id']);
        $datum = sanitizeString($_POST['datum']);
        $zakaznik = sanitizeString($_POST['zakaznik']);
        $datum = sanitizeString($_POST['datum']);
        $cena = sanitizeString($_POST['cena']);
        $dph = sanitizeString($_POST['dph']);
        $stav = sanitizeString($_POST['stav']);
        $pozn1 = sanitizeString($_POST['pozn1']);
        $pozn2 = sanitizeString($_POST['pozn2']);
        $heslo = "123456789";
        $vysledek1 = Data::addZakazka($id,$datum,$zakaznik,$cena,$dph,$stav,$pozn1,$pozn2,$heslo);
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
        //PO PŘIDÁNÍ ZBOŽÍ DO TABULEK JE POTŘEBA ZBOŽÍ SNÍŽIT MNOŽSTVÍ VE SKLADU, MOŽNÁ DOBRÝ UDĚLAT TO V KAŽDÝM FOREACHI
        
        /*
        if($vysledek){
            $_SESSION["msg-good"]="Zakázka vytvořena.";
            header("location:zakazky.php");
            exit();
        }  */
    }

view("zakazky/pridat",$model);


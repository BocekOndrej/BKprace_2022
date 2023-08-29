<?php
require ("../init/config.php");
$model[] = Data::getAllZakaznik();
$model[] = Data::getAllZbozi();
$model[] = Data::getAllStav();

lockAdmin();
$title = "Přidat novou zakázku";  
    if(isset($_POST['submit'])){
        $datum = sanitizeString($_POST['datum']);
        $zakaznik = sanitizeString($_POST['zakaznik']);
        $datum = sanitizeString($_POST['datum']);
        $cena = sanitizeString($_POST['cena']);
        $dph = sanitizeString($_POST['dph']);
        $stav = sanitizeString($_POST['stav']);
        $pozn1 = sanitizeString($_POST['pozn1']);
        $pozn2 = sanitizeString($_POST['pozn2']);
        //$vysledek1 = Data::AddZakazka($nazev, $mnozstvi, $jednotka, $sercis, $zaruka, $cena1, $cena2, $datum, $obchod, $dph, $pozn);
        if(isset($_POST['zboziId'])){
        foreach($_POST['zboziId'] as $zbozi){
                Data::AddZboziToZakazka();
            }
        }/*
        if($vysledek){
            $_SESSION["msg-good"]="Zakázka vytvořena.";
            header("location:zakazky.php");
            exit();
        }  */
    }

view("zakazky/pridat",$model);


<?php
    require ("../init/config.php");
    lockAdmin();
    $title = "Přidat zboží";  
    if(isset($_POST['submit'])){
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
            header("location:sklad.php");
            exit();
        }  
    }

    view("sklad/pridat");

?>
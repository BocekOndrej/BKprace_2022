<?php
    require ("../init/config.php");
    lockAdmin();
    $title = "Přidat zboží";  
    if(isset($_POST['submit'])){
        $nazev = osetritString($_POST['nazev']);
        $mnozstvi = osetritString($_POST['mnozstvi']);
        $jednotka = osetritString($_POST['jednotka']);
        $sercis = osetritString($_POST['sercis']);
        $zaruka = osetritString($_POST['zaruka']);
        $cena1 = osetritString($_POST['cena1']);
        $cena2 = osetritString($_POST['cena2']);
        $datum = osetritString($_POST['datum']);
        $obchod = osetritString($_POST['obchod']);
        $dph = osetritString($_POST['dph']);
        $pozn = osetritString($_POST['pozn']);
        $vysledek = Data::pridatZbozi($nazev, $mnozstvi, $jednotka, $sercis, $zaruka, $cena1, $cena2, $datum, $obchod, $dph, $pozn);
        if($vysledek){
            $_SESSION["msg-good"]="Zboží přidáno.";
            header("location:sklad.php");
            exit();
        }  
    }

    view("sklad/pridat");

?>
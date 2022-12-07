<?php
    require ("../init/config.php");
    lockAdmin();
    $title = "Sklad";
    if(isset($_POST["upravit"]) && $_POST["upravit"]=="Upravit"){
        $id = osetritString($_POST['id']);
        $nazev = osetritString($_POST['nazev']);
        $mnozstvi = osetritString($_POST['mnozstvi']);
        $jednotka = osetritString($_POST['jednotka']);
        $sercis = osetritString($_POST['sercis']);
        $zaruka = osetritString($_POST['zaruka']);
        $cena1 = osetritString($_POST['cena1']);
        $cena2 = osetritString($_POST['cena2']);
        $datum = osetritString($_POST['datum']);
        $obchod = osetritString($_POST['obchod']);
        $dph = osetritString($_POST['DPH']);
        $pozn = osetritString($_POST['pozn']); 
        if(Data::upravitPolozku($id,$nazev,$mnozstvi,$jednotka,$sercis,$zaruka,$cena1,$cena2,$datum,$obchod,$dph,$pozn)){
            $_SESSION["msg-good"]="Zboží upraveno.";           
        };
    }
    if(isset($_POST["smazat"]) && $_POST["smazat"]=="Smazat"){
        $id = osetritString($_POST["id"]);
        if(Data::smazatPolozku($id)){ 
            $_SESSION["msg-good"]="Zboží úspěšně smazáno.";
        }
    }

    if(isset($_GET["id"])){
        $id = osetritString($_GET["id"]);
        $polozka = Data::ziskatPolozku($id);
        $zbozi = Data::ziskatZbozi();
        $model = [$zbozi,$polozka];
        view("sklad/detail",$model);
    } else {
        $zbozi = Data::ziskatZbozi();
        view("sklad/sklad",$zbozi);
    }
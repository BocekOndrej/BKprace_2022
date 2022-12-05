<?php
  require ("../init/config.php");
  $title = "Upravit zboží";
  lockAdmin();
  if(isset($_GET["id"])){
    $id = osetritString($_GET["id"]);
    $zbozi = Data::ziskatPolozku($id);
    view("sklad/upravit",$zbozi);
  }
  if(isset($_POST["zmenit"])){
    if($_POST["zmenit"]=="Změnit"){
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
      $vysledek = Data::upravitPolozku($id,$nazev,$mnozstvi,$jednotka,$sercis,$zaruka,$cena1,$cena2,$datum,$obchod,$dph,$pozn);
      if($vysledek){
        $_SESSION["msg-good"]="Zboží upraveno.";
        header("location:sklad.php");
      }
    }else if($_POST["zmenit"]=="Zpět"){
    header("location:sklad.php");
    }
  }

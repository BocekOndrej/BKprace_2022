<?php
    require ("../init/config.php");
    lockAdmin();
  if(isset($_GET["id"])){
    $id = sanitizeString($_GET["id"]);
    $zakaznik = Data::getZakaznik($id);
    view("zakaznici/smazat",$zakaznik);
  }

  if(isset($_POST["smazat"])&&$_POST["smazat"]=="Ano"){ 
    $id = $id = sanitizeString($_POST['id']);  
    $zakaznik = Data::getZakaznik($id);
    $count = Data::countZakAdr($zakaznik->adr);
    if ($count == 1) {
      Data::deleteAdresa($zakaznik->adr);  
    }
    if(Data::deleteZakaznik($id)){
      $_SESSION["msg-good"]="Zákazník úspěšně smazán.";
      header("location:zakaznici.php");
    }
    }else if(isset($_POST["smazat"])&&$_POST["smazat"]=="Ne"){
      header("location:zakaznici.php");
    }

    
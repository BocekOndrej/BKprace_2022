<?php
    require ("../init/config.php");
    lockAdmin();
  if(isset($_GET["id"])){
    $id = osetritString($_GET["id"]);
    $zakaznik = Data::ziskatZakaznika($id);
    view("zakaznici/smazat",$zakaznik);
  }

  if(isset($_POST["smazat"])&&$_POST["smazat"]=="Ano"){ 
    $id = $id = osetritString($_POST['id']);  
    $zakaznik = Data::ziskatZakaznika($id);
    $count = Data::pocetZakAdr($zakaznik->adr);
    if ($count == 1) {
      Data::smazatAdresu($zakaznik->adr);  
    }
    if(Data::smazatZakaznika($id)){
      $_SESSION["msg-good"]="Zákazník úspěšně smazán.";
      header("location:zakaznici.php");
    }
    }else if(isset($_POST["smazat"])&&$_POST["smazat"]=="Ne"){
      header("location:zakaznici.php");
    }

    
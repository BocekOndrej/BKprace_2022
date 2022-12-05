<?php
  require ("../init/config.php");
  $title = "Smazat zboží"; 
  lockAdmin();
  if(isset($_GET["id"])){
    $id = osetritString($_GET["id"]);
    $zbozi = Data::ziskatPolozku($id);
    view("sklad/smazat",$zbozi);
  }
  if(isset($_POST["smazat"])&&$_POST["smazat"]=="Ano"){
    $id = osetritString($_POST["id"]);
    $vysledek = Data::smazatPolozku($id);
    if($vysledek){ 
      $_SESSION["msg-good"]="Zboží úspěšně smazáno.";
      header("location:sklad.php");
    }
  }else if(isset($_POST["smazat"])&&$_POST["smazat"]=="Ne"){
      header("location:sklad.php");
  }
<?php
  require ("../init/config.php");
  if(isset($_POST["login"]) && isset($_POST["heslo"])){
    $login = sanitizeString($_POST["login"]);
    $heslo = $_POST["heslo"];
    $heslo = $heslo."84oasů.f+A;Sa>wˇe8'(f4y6";
    $heslo_hash = hash("sha256",$heslo);
    $uzivatel = Data::getUzivatel($login,$heslo_hash);
    if($uzivatel != null){
      $_SESSION["id"]=$uzivatel->id;
      $_SESSION["login"]=$uzivatel->login;
      $_SESSION["jmeno"]=$uzivatel->jmeno;
      $_SESSION["role"]=$uzivatel->role;
      $_SESSION["zakaznik"]=$uzivatel->zakaznik;
      $_SESSION["nazevRole"]=$uzivatel->nazev;
      $_SESSION['msg-good']="Úspěšně přihlášen";
      header("location:../index.php");
      exit;
    }else{
      $_SESSION['msg-bad']="Špatný login nebo heslo";
      header("location:../index.php");
      exit;
    }
    
  }
 ?>
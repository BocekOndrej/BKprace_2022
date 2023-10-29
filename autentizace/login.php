<?php
  require ("../init/config.php");
  if(isset($_POST["login"]) && isset($_POST["heslo"])){
    $heslo = $_POST["heslo"];
    $heslo = $heslo."84oasů.f+A;Sa>wˇe8'(f4y6";
    $heslo_hash = hash("sha256",$heslo);
    $dotaz = 'SELECT COUNT(*) FROM uzivatel WHERE uzivatel.login="'.$_POST["login"].'" and heslo="'.$heslo_hash.'";';
    $vysledek = mysqli_query($spojeni, $dotaz);
    $radek = mysqli_fetch_assoc($vysledek);
    $cislo = $radek["COUNT(*)"];  
    if($cislo==1){
      $dotaz = 'SELECT * FROM uzivatel JOIN t_role ON t_role.id = uzivatel.role where uzivatel.login="'.$_POST["login"].'" and heslo="'.$heslo_hash.'";';
      $vysledek = mysqli_query($spojeni, $dotaz);
      $loguzivatel = mysqli_fetch_assoc($vysledek);
      $_SESSION["id"]=$loguzivatel["id"];
      $_SESSION["login"]=$loguzivatel["login"];
      $_SESSION["heslo"]=$loguzivatel["heslo"];
      $_SESSION["jmeno"]=$loguzivatel["jmeno"];
      $_SESSION["role"]=$loguzivatel["role"];
      $_SESSION["zakaznik"]=$loguzivatel["zakaznik"];
      $_SESSION["nazevRole"]=$loguzivatel["nazev"];
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
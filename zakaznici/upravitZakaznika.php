<?php
  require ("../init/config.php");
  lockAdmin();
  if(isset($_GET["id"])){
    $id = osetritString($_GET["id"]);
    $zakaznik = Data::ziskatZakaznika($id);
    view("zakaznici/upravit",$zakaznik);
  }
  if(isset($_POST["zmenit"])){
    if($_POST["zmenit"]=="Změnit"){
        $id = osetritString($_POST['id']);
        $jmeno = osetritString($_POST['jmeno']);
        $prijmeni = osetritString($_POST['prijmeni']);
        $firma = osetritString($_POST['firma']);
        $ICO = osetritString($_POST['ico']);
        $mesto = osetritString($_POST['mesto']);
        $ulice = osetritString($_POST['ulice']);
        $CP = osetritString($_POST['cp']);
        $PSC = osetritString($_POST['psc']);
        $tel = osetritString($_POST['tel']);
        $email = osetritString($_POST['email']);
        $pozn = osetritString($_POST['pozn']);
        $zakaznik = Data::ziskatZakaznika($id);
        $count = Data::pocetZakAdr($zakaznik->adr);
        if ($count > 1) {
          $adr = Data::ziskatAdresu($mesto, $ulice, $CP, $PSC)->id;
            if(empty($adr)){
              Data::pridatAdresu($mesto, $ulice, $CP, $PSC);
              $adr = Data::ziskatAdresu($mesto, $ulice, $CP, $PSC)->id;
            }
        }
        else {
          $adr = $zakaznik->adr;
          Data::upravitAdresu($adr, $mesto, $ulice, $CP, $PSC);
        }
        
        if(Data::upravitZakaznika($id,$jmeno,$prijmeni,$firma,$ICO,$adr,$tel,$email,$pozn)){
            $_SESSION["msg-good"]="Zákazník upraven.";
            header("location:zakaznici.php");
        }      
    }else if($_POST["zmenit"]=="Zpět"){
    header("location:zakaznici.php");
    }
  }
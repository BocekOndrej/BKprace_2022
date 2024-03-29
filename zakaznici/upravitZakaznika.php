<?php
  require ("../init/config.php");
  lockAdmin();
  if(isset($_GET["id"])){
    $id = sanitizeString($_GET["id"]);
    $zakaznik = Data::getZakaznik($id);
    view("zakaznici/upravit",$zakaznik);
  }
  if(isset($_POST["zmenit"])){
    if($_POST["zmenit"]=="Změnit"){
        $id = sanitizeString($_POST['id']);
        $jmeno = sanitizeString($_POST['jmeno']);
        $prijmeni = sanitizeString($_POST['prijmeni']);
        $firma = sanitizeString($_POST['firma']);
        $ICO = sanitizeString($_POST['ico']);
        $mesto = sanitizeString($_POST['mesto']);
        $ulice = sanitizeString($_POST['ulice']);
        $CP = sanitizeString($_POST['cp']);
        $PSC = sanitizeString($_POST['psc']);
        $tel = sanitizeString($_POST['tel']);
        $email = sanitizeString($_POST['email']);
        $pozn = sanitizeString($_POST['pozn']);
        $zakaznik = Data::getZakaznik($id);
        $count = Data::countZakAdr($zakaznik->adr);
        if ($count > 1) {
          $adr = Data::getAdresa($mesto, $ulice, $CP, $PSC)->id;
            if(empty($adr)){
              Data::addAdresa($mesto, $ulice, $CP, $PSC);
              $adr = Data::getAdresa($mesto, $ulice, $CP, $PSC)->id;
            }
        }
        else {
          $adr = $zakaznik->adr;
          Data::editAdresa($adr, $mesto, $ulice, $CP, $PSC);
        }
        
        if(Data::editZakaznik($id,$jmeno,$prijmeni,$firma,$ICO,$adr,$tel,$email,$pozn)){
            $_SESSION["msg-good"]="Zákazník upraven.";
            header("location:zakaznici.php");
        }      
    }else if($_POST["zmenit"]=="Zpět"){
    header("location:zakaznici.php");
    }
  }
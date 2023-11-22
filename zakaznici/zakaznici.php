<?php
require ("../init/config.php");
lockAdmin();
$title = "Přehled zákazníků"; 
//Sekce zpracující přidání nového zákazníka, zajišťuje to, že dva zakaznici mužou byt na stejny adrese
if(isset($_POST['pridat'])){
  $jmeno = sanitizeString($_POST['jmeno']);
  $prijmeni = sanitizeString($_POST['prijmeni']);
  $firma = sanitizeString($_POST['firma']);
  $ico = sanitizeString($_POST['ico']);
  $mesto = sanitizeString($_POST['mesto']);
  $ulice = sanitizeString($_POST['ulice']);
  $CP = sanitizeString($_POST['cp']);
  $PSC = sanitizeString($_POST['psc']);
  $tel = sanitizeString($_POST['tel']);
  $email = sanitizeString($_POST['email']);
  $pozn = sanitizeString($_POST['pozn']);
  if(($mesto != "")&&($CP != "")&&($PSC != "")){
      $adr = Data::getAdresa($mesto, $ulice, $CP, $PSC);
      if(empty($adr)){
          Data::addAdresa($mesto, $ulice, $CP, $PSC);
          $adr = Data::getAdresa($mesto, $ulice, $CP, $PSC)->id;
      } else {
        $adr = $adr->id;
      } 
  }
  else{       
      $adr = 0;                    
  }             
  if(Data::addZakaznik($jmeno,$prijmeni,$firma,$ico,$adr,$tel,$email,$pozn))
  {
      $_SESSION["msg-good"]="Zákazník úspěšně přidán.";
  }
}
//Sekce pro upravu taky řeší jestli nejsou na stejny adrese, jestli jo tak tvoří novou, pokud je upravená
if(isset($_POST["upravit"]) && $_POST["upravit"]=="Upravit"){
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
        }
}
//mazání zákazníka taky kontroluje adresu, smaže ji jen tehdy, pokud jí má jen jeden zákazník
if(isset($_POST["smazat"]) && $_POST["smazat"]=="Smazat"){
    $id = sanitizeString($_POST['id']);  
    $zakaznik = Data::getZakaznik($id);
    $count = Data::countZakAdr($zakaznik->adr);
    if ($count == 1) {
      Data::deleteAdresa($zakaznik->adr);  
    }
    $zakazky = Data::getAllZakazka();
    foreach ($zakazky as $zakazka) {
        if($zakazka->zakaznik == $id){
            Data::editZakazka($zakazka->id,$zakazka->datum_zac,$zakazka->datum_konec,null,
            $zakazka->cena,$zakazka->dph,$zakazka->stav,$zakazka->pozn1,$zakazka->pozn2);
        }
    }
    if(Data::deleteZakaznik($id)){
      $_SESSION["msg-good"]="Zákazník úspěšně smazán.";
    }
}
//sekce s filtrama a řazením dat
if(isset($_POST["filtrovat"]) && $_POST["orderby"] != ""){
    $zakaznici = Data::getAllZakaznik($_POST["orderby"]);
}else{
    $zakaznici = Data::getAllZakaznik();
}
if(isset($_POST["filtrovat"]) && isset($_POST["hledat"])){
    $hledanyString = $_POST["hledat"];
    $zakaznici = searchObjectsRecursive($zakaznici, $hledanyString);    
}
//předání dat do view
$model = [
    "zakaznici"=> $zakaznici
];
view("zakaznici/detail",$model);

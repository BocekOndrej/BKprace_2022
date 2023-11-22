<?php
require ("../init/config.php");
lockAdmin();

if(isset($_POST["info"])) {
    /*
    $zakaznikId = sanitizeString($_POST['zakaznik']);
    $zakaznik = Data::getZakaznik($zakaznikId);
    $zakaznikEmail = $zakaznik->email;
    if(!empty($zakaznik->email)){
        $id = sanitizeString($_POST['id']);
    $subject = "Servisní firma - Zakázka: ".$id."";
    $msg = "Vaše zakázka s číslem: ".$id." byla dokončena";
    $headers = "From: <bp@selitech.cz>"."\r\n".
            "Content-Type: text/html; charset=UTF-8"."\r\n";
    if(mail($zakaznikEmail,$subject,$msg,$headers)){
        $_SESSION["msg-good"] = "Zákazník byl informován";
        Data::editZakazkaStav($id,"4");
    }
    }
    */
}

if(isset($_POST["upravit"]) && $_POST["upravit"]=="Upravit"){
        $id = sanitizeString($_POST['id']);
        $datum_zac = sanitizeString($_POST['datum_zac']);
        $datum_konec = sanitizeString($_POST['datum_konec']);
        $cena = sanitizeString($_POST['cena']);
        $dph = sanitizeString($_POST['dph']);
        $stav = sanitizeString($_POST['stav']);
        if($datum_konec == null && $stav == 3){
            $datum_konec = date("Y-m-d");
        }
        $pozn1 = sanitizeString($_POST['pozn1']);
        $pozn2 = sanitizeString($_POST['pozn2']);
        //pokud je vytvářen novej zakaznik
        if(isset($_POST["jmeno"])){
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
                $adr = Data::getAdresa($mesto, $ulice, $CP, $PSC)->id;
                if(empty($adr)){
                    Data::addAdresa($mesto, $ulice, $CP, $PSC);
                    $adr = Data::getAdresa($mesto, $ulice, $CP, $PSC)->id;
                }  
            }
            else{       
                $adr = 0;                    
            }             
            Data::addZakaznik($jmeno,$prijmeni,$firma,$ico,$adr,$tel,$email,$pozn);
            $zakaznik = Data::maxId("zakaznik");
        } else {
            $zakaznik = sanitizeString($_POST['zakaznik']);
        }
        //uprava zakazky
        $vysledek1 = Data::editZakazka($id,$datum_zac,$datum_konec,$zakaznik,$cena,$dph,$stav,$pozn1,$pozn2,);
        //smazani všeho zboží ze zakázky, aby se tam mohlo přiřadit znovu
        $zboziArray = Data::getAllZboziForZakazka($id);
        foreach($zboziArray as $zbozi){
            $newMnozstvi = Data::getZboziMnozstvi($zbozi->id)[0] + $zbozi->mnozstvi;
            Data::editZboziMnozstvi($zbozi->id,$newMnozstvi);          
        }
        Data::deleteAllZboziFromZakazka($id);
        //tvorba a přiřazení novýho zboží
        if(isset($_POST['newNazev'])){
            foreach($_POST['newNazev'] as $zbozi){
                    $index=array_search($zbozi,$_POST['newNazev']);
                    $nazev = sanitizeString($_POST['newNazev'][$index]);
                    $mnozstvi = sanitizeString($_POST['newMnozstvi'][$index]);
                    $jednotka = sanitizeString($_POST['newJednotka'][$index]);
                    $sercis = sanitizeString($_POST['sercis'][$index]);
                    $zaruka = sanitizeString($_POST['zaruka'][$index]);
                    $cena1 = sanitizeString($_POST['cena1'][$index]);
                    $cena2 = sanitizeString($_POST['cena2'][$index]);
                    $datumZbozi = sanitizeString($_POST['datumZbo'][$index]);
                    $obchod = sanitizeString($_POST['obchod'][$index]);
                    $dph = sanitizeString($_POST['dphZbo'][$index]);
                    $pozn = "";
                    $vysledek2 = Data::addZbozi($nazev, 0, $jednotka, $sercis, $zaruka, 
                    $cena1, $cena2, $datumZbozi, $obchod, $dph, $pozn);
                    $idDB = Data::getZboziIdByNazev($nazev)[0];
                    $vysledek3 = Data::addZboziToZakazka($id,$idDB,$mnozstvi);
                }
            }
            //přiřazení starýho zboží
        if(isset($_POST['zboziId'])){
        foreach($_POST['zboziId'] as $zboziId){
                $index=array_search($zboziId,$_POST['zboziId']);
                $mnozstvi = sanitizeString($_POST['zboziPocet'][$index]);
                $vysledek3 = Data::addZboziToZakazka($id,$zboziId,$mnozstvi);
                $actualMnozstvi = Data::getZboziMnozstvi($zboziId)[0];
                Data::editZboziMnozstvi($zboziId,$actualMnozstvi-$mnozstvi);
            }
        }
        //sekce vytváří nový zákaznický účet
        $zakazky = Data::getAllZakazka();
        $zakaznici = Data::getAllZakaznik();
        $zakaznikObj = null;
        $allZakazniciId = [];
        foreach($zakaznici as $zakaznikObjArr){
            if($zakaznikObjArr->id == $zakaznik)$zakaznikObj= $zakaznikObjArr;
        }
        foreach($zakazky as $zakazka){
            $allZakazniciId[] = $zakazka->objZakaznik->id;
        }
        $uzivatele = Data::getAllUzivatel();
        $allUzivateleLogins = [];
        foreach($uzivatele as $uzivatel){
            $allUzivateleLogins[] = $uzivatel->login;
        }
        if((count(array_keys($allZakazniciId, $zakaznik)) > 1 ) && !empty($zakaznikObj->email)
         && (count(array_keys($allUzivateleLogins, $zakaznikObj->email)) == 0 )){
            //$heslo = bin2hex(openssl_random_pseudo_bytes(4));
            $heslo = "123456789";
            $hesloSalted = $heslo."84oasů.f+A;Sa>wˇe8'(f4y6";
            $hesloHash = hash("sha256",$hesloSalted);

            Data::addUzivatel($zakaznikObj->jmeno." ".$zakaznikObj->prijmeni,
            $zakaznikObj->email,$hesloHash,3,$zakaznikObj->id);
            /*
            $msg = "Dobrý den,\r\nv systému Servisní Firmy byl vytvořen účet:\r\n
            login: ".$zakaznikObj->email."\r\n
            heslo: ".$heslo."";
            $headers = "From: <bp@selitech.cz>"."\r\n".
            "Content-Type: text/html; charset=UTF-8"."\r\n";
            mail($zakaznikObj->email,"Servisní firma - Nový Účet",$msg,$headers);
            */
        }

        $_SESSION["msg-good"]="Zakázka úspěšně upravena.";
}
//Sekce s mazáním zakázky
if(isset($_POST["smazat"]) && $_POST["smazat"]=="Smazat"){
    $idZakazky = sanitizeString($_POST["id"]);
    if(isset($_POST["vratit"])&&$_POST["vratit"]=="true"){
        $zboziArray = Data::getAllZboziForZakazka($idZakazky);
        foreach($zboziArray as $zbozi){
            $newMnozstvi = Data::getZboziMnozstvi($zbozi->id)[0] + $zbozi->mnozstvi;
            Data::editZboziMnozstvi($zbozi->id,$newMnozstvi);          
        }
        Data::deleteAllZboziFromZakazka($idZakazky);
    }else if(!isset($_POST["vratit"])){
        Data::deleteAllZboziFromZakazka($idZakazky);
    }
    if(Data::deleteZakazka($idZakazky)){ 
        $_SESSION["msg-good"]="Zakázka úspěšně smazána.";
    }
}
//Sekce s filtry a řazením
if(isset($_POST["filtrovat"]) && $_POST["orderby"] != ""){
    $orderby = sanitizeString($_POST["orderby"]);
    $zakazkyAll = Data::getAllZakazka($orderby);
}else{
    $zakazkyAll = Data::getAllZakazka("stav ASC, datum_zac DESC");
}
if(isset($_POST["filtrovat"]) && isset($_POST["hledat"])){
    $hledanyString = $_POST["hledat"];
    $zakazkyAll = searchObjectsRecursive($zakazkyAll, $hledanyString);    
}

    

//Předání dat do view
$zakaznici = Data::getAllZakaznik();
$stavy = Data::getAllStav();
$zbozi = Data::getAllZbozi();
$model = [
    "zakazkyAll" => $zakazkyAll,
    "zakaznici" => $zakaznici,
    "stavy" => $stavy,
    "zbozi"=> $zbozi
];
view("zakazky/detail",$model);


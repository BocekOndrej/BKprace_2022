<?php
require ("../init/config.php");
lockAdmin();
$zakaznici = Data::getAllZakaznik();
$stavy = Data::getAllStav();
$zbozi = Data::getAllZbozi();
$model = [
    "zakaznici" => $zakaznici,
    "stavy" => $stavy,
    "zbozi"=> $zbozi
];

$title = "Přidat novou zakázku";  

    if(isset($_POST['pridat'])){
        $datum = sanitizeString($_POST['datum_zac']);
        $datum = sanitizeString($_POST['datum_konec']);
        $cena = sanitizeString($_POST['cena']);
        $dph = sanitizeString($_POST['dph']);
        $stav = sanitizeString($_POST['stav']);
        $pozn1 = sanitizeString($_POST['pozn1']);
        $pozn2 = sanitizeString($_POST['pozn2']);
        $heslo = bin2hex(openssl_random_pseudo_bytes(4));

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

        $vysledek1 = Data::addZakazka($datum,$zakaznik,$cena,$dph,$stav,$pozn1,$pozn2,$heslo);
        $id = Data::maxId("zakazka");
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
                    $vysledek2 = Data::AddZbozi($nazev, 0, $jednotka, $sercis, $zaruka, $cena1, $cena2, $datumZbozi, $obchod, $dph, $pozn);
                    $idDB = Data::getZboziIdByNazev($nazev)[0];
                    $vysledek3 = Data::addZboziToZakazka($id,$idDB,$mnozstvi);
                }
            }
        if(isset($_POST['zboziId'])){
        foreach($_POST['zboziId'] as $zboziId){
                $index=array_search($zboziId,$_POST['zboziId']);
                $mnozstvi = sanitizeString($_POST['zboziPocet'][$index]);
                $vysledek3 = Data::addZboziToZakazka($id,$zboziId,$mnozstvi);
                $actualMnozstvi = Data::getZboziMnozstvi($zboziId)[0];
                Data::editZboziMnozstvi($zboziId,$actualMnozstvi-$mnozstvi);
            }
        }
        
        //Vytvoření zákaznického účtu pokud má více jak 1 zakázku
        $zakazky = Data::getAllZakazka();
        $zakaznikObj = null;
        $allZakazniciId = [];
        foreach($model["zakaznici"] as $zakaznikObjArr){
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
        if((count(array_keys($allZakazniciId, $zakaznik)) == 2 ) && ($zakaznikObj->email != null) && (count(array_keys($allUzivateleLogins, $zakaznikObj->email)) == 0 )){
            $heslo = "123456"."84oasů.f+A;Sa>wˇe8'(f4y6";
            $heslo_hash = hash("sha256",$heslo);
            Data::addUzivatel($zakaznikObj->jmeno." ".$zakaznikObj->prijmeni,$zakaznikObj->email,$heslo_hash,3,$zakaznikObj->id);
        }
        
        if($vysledek1){
            $_SESSION["msg-good"]="Zakázka vytvořena.";
            header("location:zakazky.php");
            exit();
        }  
        
    }

view("zakazky/pridat",$model);


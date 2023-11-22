<?php

require_once("zbozi.class.php");
require_once("zakaznik.class.php");
require_once("zakazka.class.php");
require_once("adresa.class.php");
require_once("stav.class.php");
require_once("uzivatel.class.php");
class MySqlData{
    private $zdroj;
    function __construct($zdroj){
        $this->zdroj=$zdroj;
    }
    //V connect se nastavuje login a heslo do DB
    private function connect(){
        try {
            return new PDO($this->zdroj, "root", "");
        } catch(PDOException $e){
            return null;
        }
    }
    //Metoda pro čtení dat, vrací PHP objekt
    private function queryObj($sql,$obj,$parm = []){
        $db = $this->connect();
        if ($db === null) {
            return;
        }

        if (empty($parm)) {
            $smt = $db->query($sql);
        } 
        else {
            $smt = $db->prepare($sql);
            $smt->execute($parm);
        }
        
        $result = $smt->fetchAll(PDO::FETCH_CLASS, $obj);

        if(empty($result)){
            return;
        }

        $smt = null;
        $db = null;

        return $result;
    }

    private function getAllObj($tabulka, $obj, $orderby = null){
        if($orderby == null){
            return $this->queryObj('SELECT * FROM '.$tabulka.'', $obj); 
        } else {
            return $this->queryObj('SELECT * FROM '.$tabulka.' ORDER BY '.$orderby.';', $obj);
        } 
    }
    //Metoda pro čtení, vrací assoc array
    private function query($sql,$parm = []){
        $db = $this->connect();
        if ($db === null) {
            return;
        }

        if (empty($parm)) {
            $smt = $db->query($sql);
        } 
        else {
            $smt = $db->prepare($sql);
            $smt->execute($parm);
        }
        
        $result = $smt->fetchAll();

        if(empty($result)){
            return;
        }

        $smt = null;
        $db = null;

        return $result;
    }
    //metoda pro zápis, vrací null pokud neproběhne
    private function executeSql($sql,$parm = []){
        $db = $this->connect();
        if ($db === null) {
            return;
        }

        if (empty($parm)) {
            $smt = $db->query($sql);
        } 
        else {
            $smt = $db->prepare($sql);
            $smt->execute($parm);
        }

        $smt = null;
        $db = null;

        return true;
    }

    public function maxId($tabulka){
        return $this->query('SELECT MAX(id) FROM '.$tabulka.';')[0][0];
    }


    public function AddUzivatel($jmeno,$login,$heslo,$role,$zakaznik){
        return $this->executeSql('INSERT INTO uzivatel (jmeno, uzivatel.login, heslo, uzivatel.role, zakaznik)
        VALUES(:jmeno, :login, :heslo, :role, :zakaznik);',
        [
            ':jmeno' => $jmeno,
            ':login' => $login,
            ':heslo' => $heslo,
            ':role' => $role,
            ':zakaznik' => $zakaznik
        ]);
    }

    public function getAllUzivatel(){
        return $this->getAllObj('uzivatel','Uzivatel');
    }

    public function getUzivatel($login,$heslo){
        $result = $this->queryObj('SELECT * FROM uzivatel LEFT JOIN t_role 
        ON t_role.id = uzivatel.role WHERE uzivatel.login = :login AND uzivatel.heslo = :heslo;
        ','Uzivatel',[
            ':login' => $login,
            ':heslo'=> $heslo
        ]);
        if($result != null){
            return $result[0];
        }else{
            return $result;
        }
    }
    //Metody pro čteni a zapis zboží
    public function addZbozi($nazev,$mnozstvi,$jednotka,$sercis,$zaruka,$cena1,$cena2,$datum,$obchod,$dph,$pozn){
        return $this->executeSql('INSERT INTO sklad (nazev, mnozstvi, jednotka, sercis, zaruka, cena1, cena2, datum, obchod, dph, pozn)
        VALUES(:nazev, :mnozstvi, :jednotka, :sercis, :zaruka, :cena1, :cena2, :datum, :obchod, :dph, :pozn);',
        [
            ':nazev' => $nazev,
            ':mnozstvi' => $mnozstvi,
            ':jednotka' => $jednotka,
            ':sercis' => $sercis,
            ':zaruka' => $zaruka,
            ':cena1' => $cena1,
            ':cena2' => $cena2,
            ':datum' => $datum,
            ':obchod' => $obchod,
            ':dph' => $dph,
            ':pozn' => $pozn
        ]);
    }

    public function getAllZbozi($orderby = null){

        return $this->getAllObj('sklad','Zbozi', $orderby);
    }

    
    public function getZbozi($id){
        $result = $this->queryObj('SELECT * FROM sklad WHERE id = :id;','Zbozi',
            [
                ':id' => $id
            ]);
            if($result != null){
                return $result[0];
            }else{
                return $result;
            }
    }
    public function getZboziMnozstvi($id){
        $result = $this->query('SELECT mnozstvi FROM sklad WHERE id = :id;',
            [
                ':id' => $id
            ]);
            if($result != null){
                return $result[0];
            }else{
                return $result;
            }
    }

    public function getZboziIdByNazev($nazev){
        $result = $this->query('SELECT id FROM sklad WHERE nazev = :nazev;',
            [
                ':nazev' => $nazev
            ]);
            if($result != null){
                return $result[0];
            }else{
                return $result;
            }
    }

    public function deleteZbozi($id){
        return $this->executeSql('DELETE FROM sklad WHERE id = :id;',
        [
            ':id' => $id
        ]);
    }

    public function editZbozi($id,$nazev,$mnozstvi,$jednotka,$sercis,$zaruka,$cena1,$cena2,$datum,$obchod,$dph,$pozn){
        return $this->executeSql('UPDATE sklad
        SET nazev=:nazev, mnozstvi=:mnozstvi, jednotka=:jednotka, sercis=:sercis, zaruka=:zaruka,
        cena1=:cena1, cena2=:cena2, datum=:datum, obchod=:obchod, dph=:dph, pozn=:pozn
        WHERE id=:id;',
        [
            ':id' => $id,
            ':nazev' => $nazev,
            ':mnozstvi' => $mnozstvi,
            ':jednotka' => $jednotka,
            ':sercis' => $sercis,
            ':zaruka' => $zaruka,
            ':cena1' => $cena1,
            ':cena2' => $cena2,
            ':datum' => $datum,
            ':obchod' => $obchod,
            ':dph' => $dph,
            ':pozn' => $pozn
        ]);
    }

    public function editZboziMnozstvi($id,$mnozstvi){
        return $this->executeSql('UPDATE sklad
        SET mnozstvi=:mnozstvi
        WHERE id=:id;',
        [
            ':id' => $id,
            ':mnozstvi' => $mnozstvi
        ]);
    }
    //Metody pro čtení a zápis adres
    public function getAdresa($mesto,$ulice,$CP,$PSC){
        $adr = $this->queryObj('SELECT * FROM adresa 
        WHERE mesto=:mesto AND ulice=:ulice AND CP=:CP AND PSC=:PSC;',
        'Adresa',
        [
            ':mesto' => $mesto,
            ':ulice' => $ulice,
            ':CP' => $CP,
            ':PSC' => $PSC
        ]);
        if(!empty($adr)){
            return $adr[0];
        } else {
            return null;
        }
    }

    public function addAdresa($mesto,$ulice,$CP,$PSC){
        return $this->executeSql('INSERT INTO adresa (mesto, ulice, CP, PSC)
        VALUES(:mesto, :ulice, :CP, :PSC);',
        [
            ':mesto' => $mesto,
            ':ulice' => $ulice,
            ':CP' => $CP,
            ':PSC' => $PSC
        ]);
    }

    public function editAdresa($id,$mesto,$ulice,$CP,$PSC){
        return $this->executeSql('UPDATE adresa
        SET mesto=:mesto, ulice=:ulice, CP=:CP, PSC=:PSC
        WHERE id=:id;',
        [
            ':id' => $id,
            ':mesto' => $mesto,
            ':ulice' => $ulice,
            ':CP' => $CP,
            ':PSC' => $PSC
        ]);
    }

    public function deleteAdresa($id){
        return $this->executeSql('DELETE FROM adresa WHERE id = :id;',
        [
            ':id' => $id
        ]);
    }
    //Metody pro čtení a zápis zákazníků
    public function getAllZakaznik($orderby = null){
        if($orderby == null){
            return $this->queryObj('SELECT zakaznik.*, adresa.mesto, adresa.ulice, adresa.CP, adresa.PSC
            FROM zakaznik 
            LEFT JOIN adresa 
            ON adresa.id = zakaznik.adr;',
            'Zakaznik',);
        } else {
            return $this->queryObj('SELECT zakaznik.*, adresa.mesto, adresa.ulice, adresa.CP, adresa.PSC
            FROM zakaznik 
            LEFT JOIN adresa 
            ON adresa.id = zakaznik.adr ORDER BY '.$orderby.';',
            'Zakaznik',);
        }      
    }

    public function getZakaznik($id){
        $zakaznik = $this->queryObj('SELECT zakaznik.*, adresa.mesto, adresa.ulice, adresa.CP, adresa.PSC
        FROM zakaznik 
        LEFT JOIN adresa 
        ON adresa.id = zakaznik.adr 
        WHERE zakaznik.id = :id;',
        'Zakaznik',
        [
            ':id' => $id
        ]);
        if($zakaznik == null) return null;
        else return $zakaznik[0];
        }
    //spočítá kolik je zákazníků na adrese
    public function countZakAdr($idadr){
        $zakaznici = $this->getAllZakaznik();
        $count = 0;
        foreach ($zakaznici as $zakaznik) {
            if ($zakaznik->adr == $idadr) {
                $count++;
            }
        }
        return $count;
    }

    public function addZakaznik($jmeno,$prijmeni,$firma,$ICO,$adr,$tel,$email,$pozn){
        return $this->executeSql('INSERT INTO zakaznik (jmeno, prijmeni, firma, ICO, adr, tel, email, pozn)
        VALUES(:jmeno, :prijmeni, :firma, :ICO, :adr, :tel, :email, :pozn);',
        [
            ':jmeno' => $jmeno,
            ':prijmeni' => $prijmeni,
            ':firma' => $firma,
            ':ICO' => $ICO,
            ':adr' => $adr,
            ':tel' => $tel,
            ':email' => $email,
            ':pozn' => $pozn
        ]);
    }

    public function editZakaznik($id,$jmeno,$prijmeni,$firma,$ICO,$adr,$tel,$email,$pozn){
        return $this->executeSql('UPDATE zakaznik
        SET jmeno=:jmeno, prijmeni=:prijmeni, firma=:firma, ICO=:ICO, adr=:adr, tel=:tel, email=:email, pozn=:pozn
        WHERE id=:id;',
        [
            ':id'=> $id,
            ':jmeno' => $jmeno,
            ':prijmeni' => $prijmeni,
            ':firma' => $firma,
            ':ICO' => $ICO,
            ':adr' => $adr,
            ':tel' => $tel,
            ':email' => $email,
            ':pozn' => $pozn
        ]); 
    }

    public function deleteZakaznik($id){
        return $this->executeSql('DELETE FROM zakaznik WHERE id = :id;',
        [
            ':id' => $id
        ]);
    }
    //Metody pro čtení a editaci zakázek
    public function getAllZboziForZakazka($id){
        $zboziArr = [];
        $query = $this->query('SELECT zbo_id,mnozstvi FROM zakazka_zbo WHERE zak_id = :id',[
            ':id' => $id
        ]);
        if($query != null){
            foreach ($query as $radek ){
                $zbozi = $this->getZbozi($radek[0]);
                $zbozi->mnozstvi = $radek[1];
                $zboziArr[] = $zbozi;
            }
        }
        return $zboziArr;
    }
    
    public function getZakazka($id){
        $zakazka = $this->queryObj('SELECT * FROM zakazka WHERE id = :id;','Zakazka',
            [
                ':id' => $id
            ]);
        if($zakazka == null){
            return $zakazka;
        }
        else{
            $zakazka = $zakazka[0];
        }
        $stavy = $this->getAllStav(); 
        foreach($stavy as $stav){
            if($stav->id == $zakazka->stav){
                $zakazka->objStav = $stav;
            }
        }
        $zakaznik = $this->getZakaznik($zakazka->zakaznik);
        $zbozi = $this->getAllZboziForZakazka($zakazka->id);
        $zakazka->init($zbozi, $zakaznik);
        
        return $zakazka;
    }
    public function getAllZakazka($orderby){
        $zakazky = [];
        if($orderby != null){
            $zakazkyIds = $this->query('SELECT id FROM zakazka ORDER BY '.$orderby.'');
        }else{
            $zakazkyIds = $this->query('SELECT id FROM zakazka');
        }
        if($zakazkyIds != null){
            foreach ($zakazkyIds as $zakazkaId){
                $zakazky[] = $this->getZakazka($zakazkaId["id"]);
            }
        }
        return $zakazky;
    }
    public function getAllZakazkaForUser($zakaznik){
        $zakazky = [];
        $query = $this->query('SELECT id FROM zakazka WHERE zakaznik ='.$zakaznik.'');
        if($query != null){
            foreach ($query as $zakazka_id){
                $zakazky[] = $this->getZakazka($zakazka_id[0]);
            }
        }
        return $zakazky;
    }

    public function getAllStav(){
        return $this->queryObj('SELECT * FROM stav','Stav');
    }
    public function addZakazka($datum_zac,$datum_konec,$zakaznik,$cena,$dph,$stav,$pozn1,$pozn2,$heslo){
        return $this->executeSql('INSERT INTO zakazka (datum_zac,datum_konec,zakaznik,cena,dph,stav,pozn1,pozn2,heslo)
        VALUES(:datum_zac, :datum_konec, :zakaznik, :cena, :dph, :stav, :pozn1, :pozn2, :heslo);',
        [
            ':datum_zac' => $datum_zac,
            ':datum_konec' => $datum_konec,
            ':zakaznik' => $zakaznik,
            ':cena' => $cena,
            ':dph' => $dph,
            ':stav' => $stav,
            ':pozn1' => $pozn1,
            ':pozn2' => $pozn2,
            ':heslo' => $heslo
        ]);
    }
    
    public function addZboziToZakazka($zakazka,$zbozi,$mnozstvi){
        return $this->executeSql('INSERT INTO zakazka_zbo (zak_id,zbo_id,mnozstvi)
        VALUES(:zak_id, :zbo_id, :mnozstvi);',
        [
            ':zak_id' => $zakazka,
            ':zbo_id' => $zbozi,
            ':mnozstvi' => $mnozstvi
        ]);
    }

    public function deleteZakazka($id){
        return $this->executeSql('DELETE FROM zakazka WHERE id = :id;',
        [
            ':id' => $id
        ]);
    }

    public function deleteZboziFromZakazka($zakazkaId,$zboziId){
        return $this->executeSql('DELETE FROM zakazka_zbo WHERE zak_id = :zakazkaId AND zbo_id = :zboziId;',
        [
            ':zakazkaId' => $zakazkaId,
            'zboziId'=> $zboziId
        ]);
    }

    public function deleteAllZboziFromZakazka($zakazkaId){
        return $this->executeSql('DELETE FROM zakazka_zbo WHERE zak_id = :zakazkaId;',
        [
            ':zakazkaId' => $zakazkaId
        ]);
    }
    public function deleteZboziFromAllZakazka($zboziId){
        return $this->executeSql('DELETE FROM zakazka_zbo WHERE zbo_id = :zboziId;',
        [
            ':zboziId' => $zboziId
        ]);
    }

    public function editZakazka($id,$datum_zac,$datum_konec,$zakaznik,$cena,$dph,$stav,$pozn1,$pozn2){
        return $this->executeSql('UPDATE zakazka
        SET datum_zac = :datum_zac,datum_konec = :datum_konec, zakaznik = :zakaznik,
         cena = :cena, dph = :dph, stav = :stav, pozn1 = :pozn1, pozn2 = :pozn2
        WHERE id=:id;',
        [
            ':id'=> $id,
            ':datum_zac' => $datum_zac,
            'datum_konec'=> $datum_konec,
            ':zakaznik' => $zakaznik,
            ':cena' => $cena,
            ':dph' => $dph,
            ':stav' => $stav,
            ':pozn1' => $pozn1,
            ':pozn2' => $pozn2
        ]);
    }

    public function editZakazkaStav($id,$stav){
        return $this->executeSql('UPDATE zakazka
        SET stav = :stav
        WHERE id=:id;',
        [
            ':id'=> $id,
            ':stav' => $stav
        ]);
    }

}


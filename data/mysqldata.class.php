<?php

require_once("zbozi.class.php");
require_once("zakaznik.class.php");
require_once("zakazka.class.php");
require_once("adresa.class.php");
require_once("stav.class.php");
class MySqlData{
    private $zdroj;
    function __construct($zdroj){
        $this->zdroj=$zdroj;
    }

    private function conncet(){
        try {
            return new PDO($this->zdroj, "root", "");
        } catch(PDOException $e){
            return null;
        }
    }

    private function queryObj($sql,$obj,$parm = []){
        $db = $this->conncet();
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

    private function getAllObj($tabulka, $obj){
        return $this->queryObj('SELECT * FROM '.$tabulka.'', $obj);
    }

    private function query($sql,$parm = []){
        $db = $this->conncet();
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

    private function executeSql($sql,$parm = []){
        $db = $this->conncet();
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

    private function reindex($tabulka){
        $ID = $this->query('SELECT id FROM '.$tabulka.';');
        $newid = 1;
        foreach ($ID as $id) {
            if($id[0]!=$newid){
                $this->executeSql('UPDATE '.$tabulka.'
                SET id=:newid
                WHERE id=:id;',[
                    ':newid' => $newid,
                    ':id' => $id[0]
                ]);
            }
            $newid++;
        }
    }

    private function maxId($tabulka){
        return $this->query('SELECT MAX(id) FROM '.$tabulka.';')[0][0];
    }
    
    public function setAutoInc($tabulka){
        $newId = $this->maxId($tabulka);
        if($newId<=0){
            return $this->executeSql('ALTER TABLE '.$tabulka.' AUTO_INCREMENT = 1;');
        }
        else{
            return $this->executeSql('ALTER TABLE '.$tabulka.' AUTO_INCREMENT = '.$newId.';');
        }
    }

    public function AddZbozi($nazev,$mnozstvi,$jednotka,$sercis,$zaruka,$cena1,$cena2,$datum,$obchod,$dph,$pozn){
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

    public function getAllZbozi(){
        return $this->getAllObj('sklad','Zbozi');
    }

    public function getZbozi($id){
        return $this->queryObj('SELECT * FROM sklad WHERE id = :id;','Zbozi',
            [
                ':id' => $id
            ])[0];
    }

    public function deleteZbozi($id){
        $this->executeSql('DELETE FROM sklad WHERE id = :id;',
        [
            ':id' => $id
        ]);
        $this->reindex("sklad");
        return $this->setAutoInc("sklad");
    }

    public function editZbozi($id,$nazev,$mnozstvi,$jednotka,$sercis,$zaruka,$cena1,$cena2,$datum,$obchod,$dph,$pozn){
        return $this->executeSql('UPDATE sklad
        SET nazev=:nazev, mnozstvi=:mnozstvi, jednotka=:jednotka, sercis=:sercis, zaruka=:zaruka, cena1=:cena1, cena2=:cena2, datum=:datum, obchod=:obchod, dph=:dph, pozn=:pozn
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

    public function getAdresa($mesto,$ulice,$CP,$PSC){
        return $this->queryObj('SELECT * FROM adresa 
        WHERE mesto=:mesto AND ulice=:ulice AND CP=:CP AND PSC=:PSC;',
        'Adresa',
        [
            ':mesto' => $mesto,
            ':ulice' => $ulice,
            ':CP' => $CP,
            ':PSC' => $PSC
        ])[0];
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
        $this->executeSql('DELETE FROM adresa WHERE id = :id;',
        [
            ':id' => $id
        ]);
        $this->reindex("adresa");
        return $this->setAutoInc("adresa");
    }

    public function getAllZakaznik(){
        return $this->queryObj('SELECT zakaznik.*, adresa.mesto, adresa.ulice, adresa.CP, adresa.PSC
        FROM zakaznik 
        LEFT JOIN adresa 
        ON adresa.id = zakaznik.adr;',
        'Zakaznik',);
    }

    public function getZakaznik($id){
        return $this->queryObj('SELECT zakaznik.*, adresa.mesto, adresa.ulice, adresa.CP, adresa.PSC
        FROM zakaznik 
        LEFT JOIN adresa 
        ON adresa.id = zakaznik.adr 
        WHERE zakaznik.id = :id;',
        'Zakaznik',
        [
            ':id' => $id
        ])[0];
    }

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
        $this->executeSql('DELETE FROM zakaznik WHERE id = :id;',
        [
            ':id' => $id
        ]);
        $this->reindex("zakaznik");
        return $this->setAutoInc("zakaznik");
    }

    private function getAllZboziForZakazka($id){
        $zboziArr = [];
        $query = $this->query('SELECT zbo_id,mnozstvi FROM zakazka_zbo WHERE zak_id = :id',[
            ':id' => $id
        ]);
        foreach ($query as $radek ){
            $zbozi = $this->getZbozi($radek[0]);
            $zbozi->mnozstvi = $radek[1];
            $zboziArr[] = $zbozi;
        }
        return $zboziArr;
    }
    
    public function getZakazka($id){
        $zakazka = $this->queryObj('SELECT * FROM zakazka WHERE id = :id;','Zakazka',
            [
                ':id' => $id
            ])[0];
            
        $zakaznik = $this->getZakaznik($zakazka->zakaznik);
        $zbozi = $this->getAllZboziForZakazka($zakazka->id);
        $zakazka->init($zbozi, $zakaznik);
        
        return $zakazka;
    }
    public function getAllZakazka(){
        $zakazky = [];
        foreach ($this->query('SELECT id FROM zakazka') as $zakazka_id){
            $zakazky[] = $this->getZakazka($zakazka_id[0]);
        }
        return $zakazky;
    }
    public function getAllStav(){
        return $this->queryObj('SELECT * FROM stav','Stav');
    }
    public function addZakazku($datum,$zakaznik,$cena,$dph,$stav,$pozn1,$pozn2){
        $this->executeSql();
    }
    

}


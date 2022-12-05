<?php

require_once("zbozi.class.php");
require_once("zakaznik.class.php");
require_once("adresa.class.php");
class MySqlData{
    private $zdroj;
    function __construct($zdroj){
        $this->zdroj=$zdroj;
    }

    private function spojeni(){
        try {
            return new PDO($this->zdroj, "root", "");
        } catch(PDOException $e){
            return null;
        }
    }

    private function queryObj($sql,$obj,$parm = []){
        $db = $this->spojeni();
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

    private function query($sql,$parm = []){
        $db = $this->spojeni();
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

    private function vykonatSql($sql,$parm = []){
        $db = $this->spojeni();
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

    private function maxId($tabulka){
        return $this->query('SELECT MAX(id) FROM '.$tabulka.';')[0][0];
    }
    public function nastavAutoInc($tabulka){
        $newId = $this->maxId($tabulka);
        if($newId<=0){
            return $this->vykonatSql('ALTER TABLE '.$tabulka.' AUTO_INCREMENT = 1;');
        }
        else{
            return $this->vykonatSql('ALTER TABLE '.$tabulka.' AUTO_INCREMENT = '.$newId.';');
        }
    }

    public function pridatZbozi($nazev,$mnozstvi,$jednotka,$sercis,$zaruka,$cena1,$cena2,$datum,$obchod,$dph,$pozn){
        return $this->vykonatSql('INSERT INTO sklad (nazev, mnozstvi, jednotka, sercis, zaruka, cena1, cena2, datum, obchod, dph, pozn)
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

    public function ziskatZbozi(){
        return $this->queryObj('SELECT * FROM sklad','Zbozi');
    }

    public function ziskatPolozku($id){
        return $this->queryObj('SELECT * FROM sklad WHERE id = :id;','Zbozi',
            [
                ':id' => $id
            ])[0];
    }

    public function smazatPolozku($id){
        $this->vykonatSql('DELETE FROM sklad WHERE id = :id;',
        [
            ':id' => $id
        ]);
        return $this->nastavAutoInc("sklad");
    }

    public function upravitPolozku($id,$nazev,$mnozstvi,$jednotka,$sercis,$zaruka,$cena1,$cena2,$datum,$obchod,$dph,$pozn){
        return $this->vykonatSql('UPDATE sklad
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

    public function ziskatAdresu($mesto,$ulice,$CP,$PSC){
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

    public function pridatAdresu($mesto,$ulice,$CP,$PSC){
        return $this->vykonatSql('INSERT INTO adresa (mesto, ulice, CP, PSC)
        VALUES(:mesto, :ulice, :CP, :PSC);',
        [
            ':mesto' => $mesto,
            ':ulice' => $ulice,
            ':CP' => $CP,
            ':PSC' => $PSC
        ]);
    }

    public function upravitAdresu($id,$mesto,$ulice,$CP,$PSC){
        return $this->vykonatSql('UPDATE adresa
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

    public function smazatAdresu($id){
        $this->vykonatSql('DELETE FROM adresa WHERE id = :id;',
        [
            ':id' => $id
        ]);
        return $this->nastavAutoInc("adresa");
    }

    public function ziskatZakazniky(){
        return $this->queryObj('SELECT zakaznik.*, adresa.mesto, adresa.ulice, adresa.CP, adresa.PSC
        FROM zakaznik 
        LEFT JOIN adresa 
        ON adresa.id = zakaznik.adr;',
        'Zakaznik',);
    }

    public function ziskatZakaznika($id){
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

    public function pocetZakAdr($idadr){
        $zakaznici = $this->ziskatZakazniky();
        $count = 0;
        foreach ($zakaznici as $zakaznik) {
            if ($zakaznik->adr == $idadr) {
                $count++;
            }
        }
        return $count;
    }

    public function pridatZakaznika($jmeno,$prijmeni,$firma,$ICO,$adr,$tel,$email,$pozn){
        return $this->vykonatSql('INSERT INTO zakaznik (jmeno, prijmeni, firma, ICO, adr, tel, email, pozn)
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

    public function upravitZakaznika($id,$jmeno,$prijmeni,$firma,$ICO,$adr,$tel,$email,$pozn){
        return $this->vykonatSql('UPDATE zakaznik
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

    public function smazatZakaznika($id){
        $this->vykonatSql('DELETE FROM zakaznik WHERE id = :id;',
        [
            ':id' => $id
        ]);
        return $this->nastavAutoInc("zakaznik");
    }

}
<?php 


class Data{
    static private $data;
    static public function inicializace(mysqldata $mysqldata){
        return self::$data = $mysqldata;
    }
 //   static public function maxId($tabulka){
 //       return self::$data->maxId($tabulka);
 //   }
    static public function AddZbozi($nazev,$mnozstvi,$jednotka,$sercis,$zaruka,$cena1,$cena2,$datum,$obchod,$dph,$pozn){
        return self::$data->AddZbozi($nazev,$mnozstvi,$jednotka,$sercis,$zaruka,$cena1,$cena2,$datum,$obchod,$dph,$pozn);
    }
    static public function getAllZbozi(){
        return self::$data->getAllZbozi();
    }
    static public function getZbozi($id){
        return self::$data->getZbozi($id);
    }
    static public function getZboziMnozstvi($id){
        return self::$data->getZboziMnozstvi($id);
    }
    static public function getZboziIdByNazev($nazev){
        return self::$data->getZboziIdByNazev($nazev);
    }
    static public function editZboziMnozstvi($id,$mnozstvi){
        return self::$data->editZboziMnozstvi($id,$mnozstvi);
    }
    static public function deleteZbozi($id){
        return self::$data->deleteZbozi($id);
    }
    static public function editZbozi($id,$nazev,$mnozstvi,$jednotka,$sercis,$zaruka,$cena1,$cena2,$datum,$obchod,$dph,$pozn){
        return self::$data->editZbozi($id,$nazev,$mnozstvi,$jednotka,$sercis,$zaruka,$cena1,$cena2,$datum,$obchod,$dph,$pozn);
    }
    static public function getAdresa($mesto,$ulice,$CP,$PSC){
        return self::$data->getAdresa($mesto,$ulice,$CP,$PSC);
    }
    static public function addAdresa($mesto,$ulice,$CP,$PSC){
        return self::$data->addAdresa($mesto,$ulice,$CP,$PSC);
    }
    static public function editAdresa($id, $mesto, $ulice, $CP, $PSC){
        return self::$data->editAdresa($id, $mesto, $ulice, $CP, $PSC);
    }
    static public function deleteAdresa($id){
        return self::$data->deleteAdresa($id);
    }
    static public function getAllZakaznik(){
        return self::$data->getAllZakaznik();
    }
    static public function getZakaznik($id){
        return self::$data->getZakaznik($id);
    }
    static public function countZakAdr($id){
        return self::$data->countZakAdr($id);
    }
    static public function addZakaznik($jmeno,$prijmeni,$firma,$ICO,$adr,$tel,$email,$pozn){
        return self::$data->addZakaznik($jmeno,$prijmeni,$firma,$ICO,$adr,$tel,$email,$pozn);
    }
    static public function editZakaznik($id,$jmeno,$prijmeni,$firma,$ICO,$adr,$tel,$email,$pozn){
        return self::$data->editZakaznik($id,$jmeno,$prijmeni,$firma,$ICO,$adr,$tel,$email,$pozn);
    }
    static public function deleteZakaznik($id){
        return self::$data->deleteZakaznik($id);
    }
    static public function getZakazka($id){
        return self::$data->getZakazka($id);
    }
    static public function getAllZakazka(){
        return self::$data->getAllZakazka();
    }

    static public function getAllStav(){
        return self::$data->getAllStav();
    }

    static public function addZakazka($id,$datum,$zakaznik,$cena,$dph,$stav,$pozn1,$pozn2,$heslo){
        return self::$data->addZakazka($id,$datum,$zakaznik,$cena,$dph,$stav,$pozn1,$pozn2,$heslo);
    }

    static public function addZboziToZakazka($zakazka,$zbozi,$mnozstvi){
        return self::$data->addZboziToZakazka($zakazka,$zbozi,$mnozstvi);
    }
}
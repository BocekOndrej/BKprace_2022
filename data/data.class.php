<?php 


class Data{
    static private $data;
    static public function inicializace($mysqldata){
        return self::$data = $mysqldata;
    }
 //   static public function maxId($tabulka){
 //       return self::$data->maxId($tabulka);
 //   }
    static public function pridatZbozi($nazev,$mnozstvi,$jednotka,$sercis,$zaruka,$cena1,$cena2,$datum,$obchod,$dph,$pozn){
        return self::$data->pridatZbozi($nazev,$mnozstvi,$jednotka,$sercis,$zaruka,$cena1,$cena2,$datum,$obchod,$dph,$pozn);
    }
    static public function ziskatZbozi(){
        return self::$data->ziskatZbozi();
    }
    static public function ziskatPolozku($id){
        return self::$data->ziskatPolozku($id);
    }
    static public function smazatPolozku($id){
        return self::$data->smazatPolozku($id);
    }
    static public function upravitPolozku($id,$nazev,$mnozstvi,$jednotka,$sercis,$zaruka,$cena1,$cena2,$datum,$obchod,$dph,$pozn){
        return self::$data->upravitPolozku($id,$nazev,$mnozstvi,$jednotka,$sercis,$zaruka,$cena1,$cena2,$datum,$obchod,$dph,$pozn);
    }
    static public function ziskatAdresu($mesto,$ulice,$CP,$PSC){
        return self::$data->ziskatAdresu($mesto,$ulice,$CP,$PSC);
    }
    static public function pridatAdresu($mesto,$ulice,$CP,$PSC){
        return self::$data->pridatAdresu($mesto,$ulice,$CP,$PSC);
    }
    static public function upravitAdresu($id, $mesto, $ulice, $CP, $PSC){
        return self::$data->upravitAdresu($id, $mesto, $ulice, $CP, $PSC);
    }
    static public function smazatAdresu($id){
        return self::$data->smazatAdresu($id);
    }
    static public function ziskatZakazniky(){
        return self::$data->ziskatZakazniky();
    }
    static public function ziskatZakaznika($id){
        return self::$data->ziskatZakaznika($id);
    }
    static public function pocetZakAdr($id){
        return self::$data->pocetZakAdr($id);
    }
    static public function pridatZakaznika($jmeno,$prijmeni,$firma,$ICO,$adr,$tel,$email,$pozn){
        return self::$data->pridatZakaznika($jmeno,$prijmeni,$firma,$ICO,$adr,$tel,$email,$pozn);
    }
    static public function upravitZakaznika($id,$jmeno,$prijmeni,$firma,$ICO,$adr,$tel,$email,$pozn){
        return self::$data->upravitZakaznika($id,$jmeno,$prijmeni,$firma,$ICO,$adr,$tel,$email,$pozn);
    }
    static public function smazatZakaznika($id){
        return self::$data->smazatZakaznika($id);
    }
}
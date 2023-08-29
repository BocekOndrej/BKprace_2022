<?php

require_once("zakaznik.class.php");
require_once("zbozi.class.php");

class Zakazka
{

    public $id;
    public $datum_zac;
    public $datum_konec;
    public $zakaznik;
    public $cena;
    public $dph;
    public $stav;
    public $pozn1;
    public $pozn2;
    public $heslo;

    public $arrayZbozi;

    public Zakaznik $objZakaznik;

    public function init($zbozi,Zakaznik $zakaznik)
    {
        $this->arrayZbozi=$zbozi;
        $this->objZakaznik=$zakaznik;
    }
    
}
<?php 
session_start();

//CESTA je absolutní a NAZEV_SLOZKY pro relativní cesty k souborum. Do NAZEV_SLOZKY je třeba vyplnit cestu z rootu do adresáře appky
define('CESTA', dirname(__FILE__, 2)."/");
define ('NAZEV_SLOZKY',"/".explode(DIRECTORY_SEPARATOR , __FILE__)[3]);


require ("funkce.php");
require(CESTA. "data/data.class.php");
require(CESTA. "data/mysqldata.class.php");

Data::inicializace(new MySqlData('mysql:dbname=bkprace;host=localhost;port=3306;charset=utf8'));
//HESLO A LOGIN DO DATABAZE SE NASTAVUJE V data/mysqldata.class.php
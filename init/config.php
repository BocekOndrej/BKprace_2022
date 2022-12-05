<?php 
session_start();

define('CESTA', dirname(__FILE__, 2)."/");
define ('NAZEV_SLOZKY', explode(DIRECTORY_SEPARATOR , __FILE__)[3]);

require ("funkce.php");
//require ("connectDB.php");
require(CESTA. "data/data.class.php");
require(CESTA. "data/mysqldata.class.php");

Data::inicializace(new MySqlData('mysql:dbname=bkprace;host=localhost;port=3306'));
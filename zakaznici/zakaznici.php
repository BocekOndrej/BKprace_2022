<?php
    require ("../init/config.php");
    lockAdmin();
    $title = "Přehled zákazníků"; 
    $zakaznici = Data::getAllZakaznik();
    view("zakaznici/zakaznici",$zakaznici);
?>
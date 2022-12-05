<?php
    require ("../init/config.php");
    lockAdmin();
    $title = "Přehled zákazníků"; 
    $zakaznici = Data::ziskatZakazniky();
    view("zakaznici/zakaznici",$zakaznici);
?>
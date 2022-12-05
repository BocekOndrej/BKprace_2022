<?php
    require ("../init/config.php");
    lockAdmin();
    $title = "Sklad";
    $zbozi = Data::ziskatZbozi();
    view("sklad/sklad",$zbozi);
<?php
require ("../init/config.php");
$zakazky = Data::getAllZakazka();
view("zakazky/zakazky",$zakazky);
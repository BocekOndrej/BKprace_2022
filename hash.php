<?php
$heslo = "H6TMnZwP";
$hesloSalted = $heslo."84oasů.f+A;Sa>wˇe8'(f4y6";
$hesloHash = hash("sha256",$hesloSalted);
echo $hesloHash;
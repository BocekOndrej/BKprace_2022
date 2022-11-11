<?php

function maxId($tabulka,$spojeni){
    $dotaz="SELECT MAX(id) FROM ".$tabulka.";";
    $vysledek = mysqli_query($spojeni, $dotaz);
    $radek = mysqli_fetch_row($vysledek);
    return $radek[0];
}

function setAutoinc($tabulka,$spojeni){
    $newId = maxId($tabulka,$spojeni);
    $dotaz = "ALTER TABLE ".$tabulka." AUTO_INCREMENT = ".$newId.";";
    mysqli_query($spojeni, $dotaz);
}

function smazatDleId($id,$tabulka,$spojeni){
    $dotaz = "DELETE FROM ".$tabulka." WHERE id=".$id.";"; 
    mysqli_query($spojeni, $dotaz);
    setAutoinc($tabulka,$spojeni);
    if(mysqli_query($spojeni, $dotaz))return true;
    else return false;
}

function getZakaznikById($id,$spojeni){
    $dotaz = "SELECT * 
    FROM zakaznik 
    LEFT JOIN adresa 
    ON zakaznik.adr = adresa.id
    WHERE zakaznik.id=".$id.";";
    $vysledek = mysqli_query($spojeni, $dotaz);
    return mysqli_fetch_array($vysledek);
}













?>
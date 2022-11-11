<?php
    $title = "Přehled zákazníků";
    require "hlavicka.php";
    require "connectDB.php";  
    if(!isset($_SESSION["role"])||$_SESSION["role"]!=2) header("location:index.php");

    $dotaz = "SELECT * FROM adresa LEFT JOIN zakaznik ON zakaznik.adr=adresa.id WHERE zakaznik.id IS NULL;";
    $vysledek = mysqli_query($spojeni, $dotaz);
    while($radek = mysqli_fetch_assoc($vysledek)){
        smazatDleId($radek['id'],"adresa",$spojeni);
    }
    $dotaz = "SELECT * 
    FROM zakaznik 
    LEFT JOIN adresa 
    ON zakaznik.adr = adresa.id;";
    $vysledek = mysqli_query($spojeni, $dotaz);
?>
    <a href="pridatZakaznika.php" id="regi" class="btn">Přidat zákazníka</a>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">                             
                <table class='w-100 sprava-tab'>
                <tr class='radek-clanky'><th>ID</th><th>Jméno</th><th>Příjmení</th><th>Firma</th><th>IČO</th><th>Město</th><th>Ulice</th><th>ČP</th><th>PSČ</th><th>Telefon</th><th>Email</th><th>Poznámka</th><td></td><td></td></tr>
                <?php 
                while($radek = mysqli_fetch_array($vysledek)) : ?>
                    <tr>
                    <td><?=$radek[0]?></td>
                    <td><?=$radek['jmeno']?></td>
                    <td><?=$radek['prijmeni']?></td>
                    <td><?=$radek['firma']?></td>
                    <td><?=$radek['ICO']?></td>
                    <td><?=$radek['mesto']?></td>
                    <td><?=$radek['ulice']?></td>
                    <td><?=$radek['CP']?></td>
                    <td><?=$radek['PSC']?></td>
                    <td><?=$radek['tel']?></td>
                    <td><?=$radek['email']?></td>
                    <td><?=$radek['pozn']?></td>
                    <td><a href="smazatZakaznik.php?id=<?=$radek[0]?>" class="btn">Smazat</a></td>
                    <td><a href="upravitZakaznik.php?id=<?=$radek[0]?>" class="btn">Upravit</a></td>
                    </tr>
                <?php endwhile; ?>
                </table>              
                </div>
        </div>
    </div>
<?php
    require "pata.php";
?>
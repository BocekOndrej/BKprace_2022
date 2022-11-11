<?php
    $title = "Sklad";
    require "hlavicka.php";
    require "connectDB.php";  
    if(!isset($_SESSION["role"])||$_SESSION["role"]!=2) header("location:index.php");
    $dotaz = "SELECT * FROM sklad";
    $vysledek = mysqli_query($spojeni, $dotaz);
?>
    <a href="pridatZbozi.php" id="regi" class="btn">Přidat zboží</a>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">                
                <table class='w-100 sprava-tab'>
                <tr class='radek-clanky'><th>ID</th><th>Název</th><th>Množství</th><th>Jednotka</th><th>Seriové číslo</th><th>Záruka</th><th>Nákup</th><th>Prodej</th><th>Datum zakoupení</th><th>Obchod</th><th>DPH</th><th>Poznámka</th><td></td><td></td></tr>
                <?php while($radek = mysqli_fetch_assoc($vysledek)) : ?>
                    <td><?=$radek['id']?></td>
                    <td><?=$radek['nazev']?></td>
                    <td><?=$radek['mnozstvi']?></td>
                    <td><?=$radek['jednotka']?></td>
                    <td><?=$radek['sercis']?></td>
                    <td><?=$radek['zaruka']?></td>
                    <td><?=$radek['cena1']?></td>
                    <td><?=$radek['cena2']?></td>
                    <td><?=$radek['datum']?></td>
                    <td><?=$radek['obchod']?></td>
                    <td><?=$radek['DPH']?></td>
                    <td><?=$radek['pozn']?></td>
                    <td><a href="smazatZbozi.php?id=<?=$radek["id"]?>" class="btn">Smazat</a></td>
                    <td><a href="upravitZbozi.php?id=<?=$radek["id"]?>" class="btn">Upravit</a></td>
                    </tr>
                    <?php endwhile; ?>
                </table>    
                </div>
        </div>
    </div>
<?php
    require "pata.php";
?>
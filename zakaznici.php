<?php
    $title = "Přehled zákazníků";
    require "header.php";
    require "connectDB.php";   
    if(!isset($_SESSION["role"])||$_SESSION["role"]!=2) header("location:index.php");

    $dotaz = "SELECT * FROM adresa LEFT JOIN zakaznik ON zakaznik.zak_adr=adresa.adr_id WHERE zak_id IS NULL;";
    $vysledek = mysqli_query($spojeni, $dotaz);
    while($radek = mysqli_fetch_assoc($vysledek)){
        $dotaz2 = "DELETE FROM adresa WHERE adr_id=".$radek['adr_id'].";";
        $vysledek2 = mysqli_query($spojeni, $dotaz2);
    }
    $dotaz = "SELECT * 
    FROM zakaznik 
    LEFT JOIN adresa 
    ON zakaznik.zak_adr = adresa.adr_id;";
    $vysledek = mysqli_query($spojeni, $dotaz);

?>
    <a href="pridatZakaznika.php" id="regi" class="btn">Přidat zákazníka</a>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php
                $i=0;
                
                echo "<table class='w-100 sprava-tab'>";
                echo "<tr class='radek-clanky'><th>ID</th><th>Jméno</th><th>Příjmení</th><th>Firma</th><th>IČO</th><th>Město</th><th>Ulice</th><th>ČP</th><th>PSČ</th><th>Telefon</th><th>Email</th><th>Poznámka</th><td></td><td></td></tr>";
                while($radek = mysqli_fetch_assoc($vysledek)){
                    if (($i%2)==1)
                    {
                        echo "<tr class='radek-clanky'>";
                    }
                    else echo "<tr class='radek radek-clanky'>";
                    echo "<td>".$radek['zak_id']."</td>";
                    echo "<td>".$radek['zak_name']."</td>";
                    echo "<td>".$radek['zak_sname']."</td>";
                    echo "<td>".$radek['zak_fir_name']."</td>";
                    echo "<td>".$radek['zak_ICO']."</td>";
                    echo "<td>".$radek['adr_mesto']."</td>";
                    echo "<td>".$radek['adr_ulice']."</td>";
                    echo "<td>".$radek['adr_CP']."</td>";
                    echo "<td>".$radek['adr_PSC']."</td>";
                    echo "<td>".$radek['zak_tel']."</td>";
                    echo "<td>".$radek['zak_email']."</td>";
                    echo "<td>".$radek['zak_note']."</td>";
                    echo '<td><a href="smazatZakaznik.php?id='.$radek["zak_id"].'" class="btn">Smazat</a></td>';
                    echo '<td><a href="upravitZakaznik.php?id='.$radek["zak_id"].'" class="btn">Upravit</a></td>';
                    echo "</tr>";
                    $i++;
                }
                echo "</table>";
                ?>
                </div>
        </div>
    </div>
<?php
    require "footer.php";
?>
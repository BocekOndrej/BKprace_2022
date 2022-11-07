<?php
    $title = "Sklad";
    require "header.php";
    require "connectDB.php";  
    if(!isset($_SESSION["role"])||$_SESSION["role"]!=2) header("location:index.php");
    $dotaz = "select * from sklad";
    $vysledek = mysqli_query($spojeni, $dotaz);
?>
    <a href="pridatZbozi.php" id="regi" class="btn">Přidat zboží</a>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php
                $i=0;
                echo "<table class='w-100 sprava-tab'>";
                echo "<tr class='radek-clanky'><th>ID</th><th>Název</th><th>Množství</th><th>Jednotka</th><th>Seriové číslo</th><th>Záruka</th><th>Nákup</th><th>Prodej</th><th>Datum zakoupení</th><th>Obchod</th><th>DPH</th><th>Poznámka</th><td></td><td></td></tr>";
                while($radek = mysqli_fetch_assoc($vysledek)){
                    if (($i%2)==1)
                    {
                        echo "<tr class='radek-clanky'>";
                    }
                    else echo "<tr class='radek radek-clanky'>";
                    echo "<td>".$radek['zbo_id']."</td>";
                    echo "<td>".$radek['zbo_name']."</td>";
                    echo "<td>".$radek['zbo_amount']."</td>";
                    echo "<td>".$radek['zbo_unit']."</td>";
                    echo "<td>".$radek['zbo_sercis']."</td>";
                    echo "<td>".$radek['zbo_zaruka']."</td>";
                    echo "<td>".$radek['zbo_price1']."</td>";
                    echo "<td>".$radek['zbo_price2']."</td>";
                    echo "<td>".$radek['zbo_date']."</td>";
                    echo "<td>".$radek['zbo_shop']."</td>";
                    echo "<td>".$radek['zbo_DPH']."</td>";
                    echo "<td>".$radek['zbo_note']."</td>";
                    echo '<td><a href="smazatZbozi.php?id='.$radek["zbo_id"].'" class="btn">Smazat</a></td>';
                    echo '<td><a href="upravitZbozi.php?id='.$radek["zbo_id"].'" class="btn">Upravit</a></td>';
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
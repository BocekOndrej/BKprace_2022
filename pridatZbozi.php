<?php
    $title = "Přidat zboží";
    require "header.php";
    require "connectDB.php";  
    if(!isset($_SESSION["role"])||$_SESSION["role"]!=2) header("location:index.php");
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $amount = $_POST['amount'];
        $unit = $_POST['unit'];
        $sercis = $_POST['sercis'];
        $zaruka = $_POST['zaruka'];
        $price1 = $_POST['price1'];
        $price2 = $_POST['price2'];
        $date = $_POST['date'];
        $dph = $_POST['dph'];
        $shop = $_POST['shop'];
        $note = $_POST['note'];
        $dotaz = "INSERT INTO sklad (zbo_name, zbo_amount, zbo_unit, zbo_sercis, zbo_zaruka, zbo_price1, zbo_price2, zbo_date, zbo_shop, zbo_DPH, zbo_note)
        VALUES('$name','$amount','$unit','$sercis','$zaruka','$price1','$price2','$date','$shop','$dph','$note');";
        if(mysqli_query($spojeni, $dotaz))
        {
            $_SESSION["msg-good"]="Zboží úspěšně přidáno.";
            header("location:sklad.php");
        }
        else
        {
            $_SESSION["msg-bad"]="Vyskytla se chyba";
            header("location:sklad.php");
        }       
    }

?>
    <h3 align="center">Přidat nové zboží</h3>
    <form action="pridatZbozi.php" method="POST">
        <div class="d-flex justify-content-center mb-3">
            <div class="d-inline-flex" id="reg">
                <table border = 1 align=center>
                    <tr>
                        <td>Název zboží</td><td colspan="2"><input class="form-control" type="text" name="name" required></td>
                    </tr>
                    <tr>
                        <td>Počet</td><td ><input class="form-control" type="number" min="0" value="0" name="amount" required></td>
                        <td><select name="unit">
                                <option value="ks">ks</option>
                                <option value="g">g</option>
                                <option value="m">m</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td>Seriové číslo</td><td colspan="2"><input class="form-control" type="text" name="sercis" required></td>
                    </tr>
                    <tr>
                        <td>Záruka</td><td ><input class="form-control" type="number" min="0" name="zaruka" required></td><td>Měsíců</td>
                    </tr>
                    <tr>
                        <td>Nákupní cena</td><td colspan="2"><input class="form-control" type="number" min="0" step=".001" name="price1" required></td>
                    </tr>
                    <tr>
                        <td>Prodejní cena</td><td colspan="2"><input class="form-control" type="number" min="0" step=".001" name="price2" required></td>
                    </tr>
                    <tr>
                        <td>Datum zakoupení</td><td colspan="2"><input class="form-control" type="date" name="date" required></td>
                    </tr>
                    <tr>
                        <td>DPH</td><td colspan="2"><input class="form-control" type="number" min="0" name="dph" required></td>
                    </tr>
                    <tr>
                        <td>Zakoupeno</td><td colspan="2"><input class="form-control" type="text" name="shop" required></td>
                    </tr>
                    <tr>
                        <td>Poznámka</td><td colspan="2"><input class="form-control" type="text" name="note"></td>
                    </tr>
                    <tr>
                        <td colspan="3" align=center style="padding-top:20px" ><input style="width:50%" type="submit" name="submit" value="Vložit do skladu" id="reg-but"></td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
<?php    
    require "footer.php";
?>
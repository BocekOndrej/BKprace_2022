<?php
  require "header.php";
  require "connectDB.php";
  if(!isset($_SESSION["role"])||$_SESSION["role"]!=2) header("location:index.php");
  if(isset($_GET["id"])){
    $id = $_GET["id"];
    $dotaz = "select * from sklad where zbo_id=".$id;
    $vysledek = mysqli_query($spojeni, $dotaz);
    $radek = mysqli_fetch_assoc($vysledek);
    $name = $radek["zbo_name"];
    $amount = $radek["zbo_amount"];
    $unit = $radek["zbo_unit"];
    $sercis = $radek["zbo_sercis"];
    $zaruka = $radek["zbo_zaruka"];
    $price1 = $radek["zbo_price1"];
    $price2 = $radek["zbo_price2"];
    $date = $radek["zbo_date"];
    $shop = $radek["zbo_shop"];
    $dph = $radek["zbo_DPH"];
    $note = $radek["zbo_note"];
  }
  if(isset($_GET["zmenit"])){
    if($_GET["zmenit"]=="Změnit"){
        $name = $_GET['name'];
        $amount = $_GET['amount'];
        $unit = $_GET['unit'];
        $sercis = $_GET['sercis'];
        $zaruka = $_GET['zaruka'];
        $price1 = $_GET['price1'];
        $price2 = $_GET['price2'];
        $date = $_GET['date'];
        $dph = $_GET['dph'];
        $shop = $_GET['shop'];
        $note = $_GET['note'];
        $dotaz = "UPDATE sklad
        SET zbo_name='$name', zbo_amount='$amount', zbo_unit='$unit', zbo_sercis='$sercis', zbo_zaruka='$zaruka', zbo_price1='$price1', zbo_price2='$price2', zbo_date='$date', zbo_shop='$shop', zbo_dph='$dph', zbo_note='$note'
        WHERE zbo_id='".$_GET['id']."';";
        $vysledek = mysqli_query($spojeni, $dotaz);
        if($vysledek){
            $_SESSION["msg-good"]="Zboží upraveno.";
            header("location:sklad.php");
        }
    }else if($_GET["zmenit"]=="Zpět"){
    header("location:sklad.php");
    }
  }
 ?>

<h3 align="center">Upravit zboží</h3>
<form action="upravitZbozi.php" method="get">
    <div class="d-flex justify-content-center mb-3">
        <div class="d-inline-flex" id="reg">
            <table>
                <tr>
                    <td>ID</td><td><input type="text" name="id" value="<?php echo $id;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                    <td>Název</td><td><input type="text" name="name" value="<?php echo $name;?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Množství</td><td><input type="number" name="amount" min="0" value="<?php echo $amount;?>" class="form-control">
                        <select name="unit" class="form-control">
                            <option value="ks">ks</option>
                            <option value="g">g</option>
                            <option value="m">m</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Seriové číslo</td><td><input type="text" name="sercis" value="<?php echo $sercis;?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Záruka</td><td><input type="number" name="zaruka" min="0" value="<?php echo $zaruka;?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Nákupní cena</td><td><input type="number" name="price1" min="0" step=".001" value="<?php echo $price1;?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Prodejní cena</td><td><input type="number" name="price2" min="0" step=".001" value="<?php echo $price2;?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Datum zakoupení</td><td><input type="date" name="date" value="<?php echo $date;?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Obchod</td><td><input type="text" name="shop" value="<?php echo $shop;?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>DPH</td><td><input type="number" name="dph" min="0" value="<?php echo $dph;?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Poznámka</td><td><input type="text" name="note" value="<?php echo $note;?>" class="form-control"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" name="zmenit" value="Změnit" id="reg-but">&nbsp;<input type="submit" name="zmenit" value="Zpět" id="reg-but"></td>
                </tr>
            </table>
        </div>
    </div>
</form>

<?php
  require "footer.php";
 ?>
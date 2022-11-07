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
  if(isset($_POST["smazat"])){
    if($_POST["smazat"]=="Ano"){
      $dotaz = "DELETE FROM sklad WHERE zbo_id=".$_POST["id"];
      $vysledek = mysqli_query($spojeni, $dotaz);
      $newid=$_POST["id"]-1;
      $dotaz = "ALTER TABLE sklad AUTO_INCREMENT = ".$newid.";";
      $vysledek2 = mysqli_query($spojeni, $dotaz);
      if($vysledek){
        $_SESSION["msg-good"]="Zboží úspěšně smazáno.";
        header("location:sklad.php");
      }
    }else if($_POST["smazat"]=="Ne"){
      header("location:sklad.php");
    }
  }
 ?>

<h3 align="center">Smazat zboží</h3>
<form action="smazatZbozi.php" method="post">
    <div class="d-flex justify-content-center mb-3">
        <div class="d-inline-flex" id="reg">
            <table>
                <tr>
                <td>ID</td><td><input type="text" name="id" value="<?php echo $id;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Název</td><td><input type="text" value="<?php echo $name;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Množství</td><td><input type="text" value="<?php echo $amount;?>" readonly class="form-control"><input type="text" value="<?php echo $unit;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Seriové číslo</td><td><input type="text" value="<?php echo $sercis;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Záruka</td><td><input type="text" value="<?php echo $zaruka;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Nákupní cena</td><td><input type="text" value="<?php echo $price1;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Prodejní cena</td><td><input type="text" value="<?php echo $price2;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Datum zakoupení</td><td><input type="text" value="<?php echo $date;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Obchod</td><td><input type="text" value="<?php echo $shop;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>DPH</td><td><input type="text" value="<?php echo $dph;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Poznámka</td><td><input type="text" value="<?php echo $note;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td colspan="2" align="center">Opravdu chcete smazat zboží?</td>
                </tr>
                <tr>
                <td colspan="2" align="center"><input type="submit" name="smazat" value="Ano" id="reg-but">&nbsp;<input type="submit" name="smazat" value="Ne" id="reg-but"></td>
                </tr>
            </table>
        </div>
    </div>
</form>

 <?php
  require "footer.php";
 ?>
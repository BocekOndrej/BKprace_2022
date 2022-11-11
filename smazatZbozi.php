<?php
  require "hlavicka.php";
  require "connectDB.php";
  if(!isset($_SESSION["role"])||$_SESSION["role"]!=2) header("location:index.php");
  if(isset($_GET["id"])){
    $id = $_GET["id"];
    $dotaz = "SELECT * FROM sklad WHERE id=".$id;
    $vysledek = mysqli_query($spojeni, $dotaz);
    $radek = mysqli_fetch_assoc($vysledek);
    $nazev = $radek["nazev"];
    $mnozstvi = $radek["mnozstvi"];
    $jednotka = $radek["jednotka"];
    $sercis = $radek["sercis"];
    $zaruka = $radek["zaruka"];
    $cena1 = $radek["cena1"];
    $cena2 = $radek["cena2"];
    $datum = $radek["datum"];
    $obchod = $radek["obchod"];
    $dph = $radek["DPH"];
    $pozn = $radek["pozn"];
  }
  if(isset($_POST["smazat"])&&$_POST["smazat"]=="Ano"){
      $vysledek = smazatDleId($_POST["id"],"sklad",$spojeni);
      if($vysledek){ 
        $_SESSION["msg-good"]="Zboží úspěšně smazáno.";
        header("location:sklad.php");
      }
  }else if(isset($_POST["smazat"])&&$_POST["smazat"]=="Ne"){
      header("location:sklad.php");
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
                <td>Název</td><td><input type="text" value="<?php echo $nazev;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Množství</td><td><input type="text" value="<?php echo $mnozstvi;?>" readonly class="form-control"><input type="text" value="<?php echo $jednotka;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Seriové číslo</td><td><input type="text" value="<?php echo $sercis;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Záruka</td><td><input type="text" value="<?php echo $zaruka;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Nákupní cena</td><td><input type="text" value="<?php echo $cena1;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Prodejní cena</td><td><input type="text" value="<?php echo $cena2;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Datum zakoupení</td><td><input type="text" value="<?php echo $datum;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Obchod</td><td><input type="text" value="<?php echo $obchod;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>DPH</td><td><input type="text" value="<?php echo $dph;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Poznámka</td><td><textarea readonly class="form-control"><?php echo $pozn;?></textarea></td>
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
  require "pata.php";
 ?>
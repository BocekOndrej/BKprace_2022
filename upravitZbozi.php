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
  if(isset($_POST["zmenit"])){
    if($_POST["zmenit"]=="Změnit"){
        $nazev = $_POST['nazev'];
        $mnozstvi = $_POST['mnozstvi'];
        $jednotka = $_POST['jednotka'];
        $sercis = $_POST['sercis'];
        $zaruka = $_POST['zaruka'];
        $cena1 = $_POST['cena1'];
        $cena2 = $_POST['cena2'];
        $datum = $_POST['datum'];
        $dph = $_POST['dph'];
        $obchod = $_POST['obchod'];
        $pozn = $_POST['pozn'];
        $dotaz = "UPDATE sklad
        SET nazev='$nazev', mnozstvi='$mnozstvi', jednotka='$jednotka', sercis='$sercis', zaruka='$zaruka', cena1='$cena1', cena2='$cena2', datum='$datum', obchod='$obchod', dph='$dph', pozn='$pozn'
        WHERE id='".$_POST['id']."';";
        $vysledek = mysqli_query($spojeni, $dotaz);
        if($vysledek){
            $_SESSION["msg-good"]="Zboží upraveno.";
            header("location:sklad.php");
        }
    }else if($_POST["zmenit"]=="Zpět"){
    header("location:sklad.php");
    }
  }
 ?>

<h3 align="center">Upravit zboží</h3>
<form action="upravitZbozi.php" method="post">
    <div class="d-flex justify-content-center mb-3">
        <div class="d-inline-flex" id="reg">
            <table>
                <tr>
                    <td>ID</td><td><input type="text" name="id" value="<?php echo $id;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                    <td>Název</td><td><input type="text" name="nazev" value="<?php echo $nazev;?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Množství</td><td><input type="number" name="mnozstvi" min="0" value="<?php echo $mnozstvi;?>" class="form-control">
                        <select name="jednotka" class="form-control">
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
                    <td>Nákupní cena</td><td><input type="number" name="cena1" min="0" step=".001" value="<?php echo $cena1;?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Prodejní cena</td><td><input type="number" name="cena2" min="0" step=".001" value="<?php echo $cena2;?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Datum zakoupení</td><td><input type="date" name="datum" value="<?php echo $datum;?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Obchod</td><td><input type="text" name="obchod" value="<?php echo $obchod;?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>DPH</td><td><select name="dph">
                                        <option value="15">15</option>
                                        <option value="12">12</option>
                                    </select>%</td>
                </tr>
                <tr>
                    <td>Poznámka</td><td><textarea name="pozn" class="form-control"><?php echo $pozn;?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" name="zmenit" value="Změnit" id="reg-but">&nbsp;<input type="submit" name="zmenit" value="Zpět" id="reg-but"></td>
                </tr>
            </table>
        </div>
    </div>
</form>

<?php
  require "pata.php";
 ?>
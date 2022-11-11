<?php
  require "hlavicka.php";
  require "connectDB.php";
  if(!isset($_SESSION["role"])||$_SESSION["role"]!=2) header("location:index.php");
  if(isset($_GET["id"])){
    $id = $_GET["id"];
    $radek = getZakaznikById($id,$spojeni);
    $jmeno = $radek["jmeno"];
    $prijmeni = $radek["prijmeni"];
    $firma = $radek["firma"];
    $ico = $radek["ICO"];
    $mesto = $radek["mesto"];
    $ulice = $radek["ulice"];
    $cp = $radek["CP"];
    $psc = $radek["PSC"];
    $tel = $radek["tel"];
    $email = $radek["email"];
    $pozn = $radek["pozn"];
  }
  if(isset($_POST["zmenit"])){
    if($_POST["zmenit"]=="Změnit"){
        $jmeno = $_POST['jmeno'];
        $prijmeni = $_POST['prijmeni'];
        $firma = $_POST['firma'];
        $ico = $_POST['ico'];
        $mesto = $_POST['mesto'];
        $ulice = $_POST['ulice'];
        $cp = $_POST['cp'];
        $psc = $_POST['psc'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $pozn = $_POST['pozn'];
        $dotaz = "SELECT id FROM adresa WHERE mesto='".$mesto."' AND ulice='".$ulice."' AND CP='".$cp."' AND PSC='".$psc."';";
        $vysledek = mysqli_query($spojeni, $dotaz);
        $radek = mysqli_fetch_array($vysledek);
        if($radek != ""){
            $adr = $radek[0];
        }
        else {
            $dotaz = "INSERT INTO adresa (mesto, ulice, CP, PSC)
            VALUES('$mesto','$ulice','$cp','$psc');";
            if(mysqli_query($spojeni, $dotaz))
            {
                $adr = maxId("adresa",$spojeni);
            }
        }
        $dotaz2 = "UPDATE zakaznik
        SET jmeno='$jmeno', prijmeni='$prijmeni', firma='$firma', ico='$ico', adr='$adr', tel='$tel', email='$email', pozn='$pozn'
        WHERE id='".$_POST['id']."';";
        $vysledek = mysqli_query($spojeni, $dotaz2);
        if($vysledek){
            $_SESSION["msg-good"]="Zákazník upraven.";
            header("location:zakaznici.php");
        }
    }else if($_POST["zmenit"]=="Zpět"){
    header("location:zakaznici.php");
    }
  }
 ?>

<h3 align="center">Upravit zákazníka</h3>
<form action="upravitZakaznik.php" method="post">
    <div class="d-flex justify-content-center mb-3">
        <div class="d-inline-flex" id="reg">
            <table>
                    <tr>
                        <td>ID</td><td colspan="2"><input class="form-control" type="text" name="id" value="<?php echo $id;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Jméno</td><td colspan="2"><input class="form-control" type="text" name="jmeno" value="<?php echo $jmeno;?>"></td>
                    </tr>
                    <tr>
                        <td>Příjmení</td><td colspan="2"><input class="form-control" type="text" name="prijmeni" value="<?php echo $prijmeni;?>"></td>
                    </tr>
                    <tr>
                        <td>Firma</td><td colspan="2"><input class="form-control" type="text" name="firma" value="<?php echo $firma;?>"></td>
                    </tr>
                    <tr>
                        <td>IČO</td><td colspan="2"><input class="form-control" type="text" name="ico" value="<?php echo $ico;?>"></td>
                    </tr>
                    <tr>
                        <td>Město</td><td colspan="2"><input class="form-control" type="text" name="mesto" value="<?php echo $mesto;?>"></td>
                    </tr>
                    <tr>
                        <td>Ulice a číslo popisné</td><td><input class="form-control" type="text" name="ulice" value="<?php echo $ulice;?>"></td><td><input class="form-control" type="number" name="cp" value="<?php echo $cp;?>"></td>
                    </tr>
                    <tr>
                        <td>PSČ</td><td><input class="form-control" type="number" name="psc" value="<?php echo $psc;?>"></td>
                    </tr>
                    <tr>
                        <td>Telefoní číslo</td><td colspan="2"><input class="form-control" type="text" name="tel" value="<?php echo $tel;?>"></td>
                    </tr>
                    <tr>
                        <td>Email</td><td colspan="2"><input class="form-control" type="email" name="email" value="<?php echo $email;?>"></td>
                    </tr>
                    <tr>
                        <td>Poznámka</td><td colspan="2"><input class="form-control" type="text" name="pozn" value="<?php echo $pozn;?>"></td>
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
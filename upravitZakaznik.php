<?php
  require "header.php";
  require "connectDB.php";
  if(!isset($_SESSION["role"])||$_SESSION["role"]!=2) header("location:index.php");
  if(isset($_GET["id"])){
    $id = $_GET["id"];
    $dotaz = "SELECT * 
    FROM zakaznik 
    LEFT JOIN adresa 
    ON zakaznik.zak_adr = adresa.adr_id
    WHERE zak_id=".$id.";";
    $vysledek = mysqli_query($spojeni, $dotaz);
    $radek = mysqli_fetch_assoc($vysledek);
    $name = $radek["zak_name"];
    $sname = $radek["zak_sname"];
    $firma = $radek["zak_fir_name"];
    $ico = $radek["zak_ICO"];
    $mesto = $radek["adr_mesto"];
    $ulice = $radek["adr_ulice"];
    $cp = $radek["adr_CP"];
    $psc = $radek["adr_PSC"];
    $tel = $radek["zak_tel"];
    $email = $radek["zak_email"];
    $note = $radek["zak_note"];
  }
  if(isset($_GET["zmenit"])){
    if($_GET["zmenit"]=="Změnit"){
        $name = $_GET['name'];
        $sname = $_GET['sname'];
        $firma = $_GET['firma'];
        $ico = $_GET['ico'];
        $mesto = $_GET['mesto'];
        $ulice = $_GET['ulice'];
        $cp = $_GET['cp'];
        $psc = $_GET['psc'];
        $tel = $_GET['tel'];
        $email = $_GET['email'];
        $note = $_GET['note'];
        $dotaz = "SELECT adr_id FROM adresa WHERE adr_mesto='".$mesto."' AND adr_ulice='".$ulice."' AND adr_CP='".$cp."' AND adr_PSC='".$psc."';";
        $vysledek = mysqli_query($spojeni, $dotaz);
        $radek = mysqli_fetch_array($vysledek);
        if($radek != ""){
            $zak_adr = $radek[0];
        }
        else {
            $dotaz = "INSERT INTO adresa (adr_mesto, adr_ulice, adr_CP, adr_PSC)
            VALUES('$mesto','$ulice','$cp','$psc');";
            if(mysqli_query($spojeni, $dotaz))
            {
                $dotaz = "SELECT MAX(adr_id) FROM adresa;";
                $vysledek = mysqli_query($spojeni, $dotaz);
                $radek = mysqli_fetch_row($vysledek);
                $zak_adr = $radek[0];
            }
        }
        $dotaz2 = "UPDATE zakaznik
        SET zak_name='$name', zak_sname='$sname', zak_fir_name='$firma', zak_ico='$ico', zak_adr='$zak_adr', zak_tel='$tel', zak_email='$email', zak_note='$note'
        WHERE zak_id='".$_GET['id']."';";
        $vysledek = mysqli_query($spojeni, $dotaz2);
        if($vysledek){
            $_SESSION["msg-good"]="Zákazník upraven.";
            header("location:zakaznici.php");
        }
    }else if($_GET["zmenit"]=="Zpět"){
    header("location:zakaznici.php");
    }
  }
 ?>

<h3 align="center">Upravit zákazníka</h3>
<form action="upravitZakaznik.php" method="get">
    <div class="d-flex justify-content-center mb-3">
        <div class="d-inline-flex" id="reg">
            <table>
                    <tr>
                        <td>ID</td><td colspan="2"><input class="form-control" type="text" name="id" value="<?php echo $id;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Jméno</td><td colspan="2"><input class="form-control" type="text" name="name" value="<?php echo $name;?>"></td>
                    </tr>
                    <tr>
                        <td>Příjmení</td><td colspan="2"><input class="form-control" type="text" name="sname" value="<?php echo $sname;?>"></td>
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
                        <td>Email</td><td colspan="2"><input class="form-control" type="text" name="email" value="<?php echo $email;?>"></td>
                    </tr>
                    <tr>
                        <td>Poznámka</td><td colspan="2"><input class="form-control" type="text" name="note" value="<?php echo $note;?>"></td>
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
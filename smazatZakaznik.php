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
  if(isset($_POST["smazat"])&&$_POST["smazat"]=="Ano"){   
        $radek = getZakaznikById($_POST["id"],$spojeni);   
        $adr = $radek["adr"];
        $vysledek = smazatDleId($_POST["id"],"zakaznik",$spojeni);
        $dotaz = "SELECT id FROM zakaznik WHERE adr=".$adr.";";
        $vysledek2 = mysqli_query($spojeni, $dotaz);
        $radek = mysqli_fetch_array($vysledek2);
        if(!$radek){
            smazatDleId($_POST["id"],"adresa",$spojeni);
        }
        if($vysledek){
        $_SESSION["msg-good"]="Zákazník úspěšně smazán.";
        header("location:zakaznici.php");
        }
    }else if(isset($_POST["smazat"])&&$_POST["smazat"]=="Ne"){
      header("location:zakaznici.php");
    }
 ?>

<h3 align="center">Smazat zákazníka</h3>
<form action="smazatZakaznik.php" method="post">
    <div class="d-flex justify-content-center mb-3">
        <div class="d-inline-flex" id="reg">
            <table>
                    <tr>
                        <td>ID</td><td colspan="2"><input class="form-control" type="text" name="id" value="<?php echo $id;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Jméno</td><td colspan="2"><input class="form-control" type="text" name="name" value="<?php echo $jmeno;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Příjmení</td><td colspan="2"><input class="form-control" type="text" name="sname" value="<?php echo $prijmeni;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Firma</td><td colspan="2"><input class="form-control" type="text" name="firma" value="<?php echo $firma;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>IČO</td><td colspan="2"><input class="form-control" type="text" name="ico" value="<?php echo $ico;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Město</td><td colspan="2"><input class="form-control" type="text" name="mesto" value="<?php echo $mesto;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Ulice a číslo popisné</td><td><input class="form-control" type="text" name="ulice" value="<?php echo $ulice;?>" readonly></td><td><input class="form-control" type="number" name="cp" value="<?php echo $cp;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>PSČ</td><td><input class="form-control" type="number" name="psc" value="<?php echo $psc;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Telefoní číslo</td><td colspan="2"><input class="form-control" type="text" name="tel" value="<?php echo $tel;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Email</td><td colspan="2"><input class="form-control" type="text" name="email" value="<?php echo $email;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Poznámka</td><td colspan="2"><textarea class="form-control" name="note" readonly><?php echo $pozn;?></textarea></td>
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
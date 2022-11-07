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
    $fir_name = $radek["zak_fir_name"];
    $ico = $radek["zak_ICO"];
    $mesto = $radek["adr_mesto"];
    $ulice = $radek["adr_ulice"];
    $cp = $radek["adr_CP"];
    $psc = $radek["adr_PSC"];
    $tel = $radek["zak_tel"];
    $email = $radek["zak_email"];
    $note = $radek["zak_note"];
  }
  if(isset($_POST["smazat"])){
    if($_POST["smazat"]=="Ano"){   
        $dotaz = "SELECT * 
        FROM zakaznik 
        LEFT JOIN adresa 
        ON zakaznik.zak_adr = adresa.adr_id
        WHERE zak_id=".$_POST["id"].";";
        $vysledek = mysqli_query($spojeni, $dotaz);
        $radek = mysqli_fetch_assoc($vysledek);    
        $adr = $radek["zak_adr"];
        $dotaz = "DELETE FROM zakaznik WHERE zak_id=".$_POST["id"].";";
        $vysledek = mysqli_query($spojeni, $dotaz);
        $newid=$_POST["id"]-1;
        $dotaz = "ALTER TABLE zakaznik AUTO_INCREMENT = ".$newid.";";
        $vysledek2 = mysqli_query($spojeni, $dotaz);
        $dotaz = "SELECT zak_id FROM zakaznik WHERE zak_adr=".$adr.";";
        $vysledek2 = mysqli_query($spojeni, $dotaz);
        $radek = mysqli_fetch_array($vysledek2);
        if(!$radek){
            $dotaz = "DELETE FROM adresa WHERE adr_id=".$adr.";";
            $vysledek = mysqli_query($spojeni, $dotaz);
        }
        if($vysledek){
            $_SESSION["msg-good"]="Zákazník úspěšně smazán.";
            header("location:zakaznici.php");
        }
    }else if($_POST["smazat"]=="Ne"){
      header("location:zakaznici.php");
    }
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
                        <td>Jméno</td><td colspan="2"><input class="form-control" type="text" name="name" value="<?php echo $name;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Příjmení</td><td colspan="2"><input class="form-control" type="text" name="sname" value="<?php echo $sname;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Firma</td><td colspan="2"><input class="form-control" type="text" name="firma" value="<?php echo $fir_name;?>" readonly></td>
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
                        <td>Poznámka</td><td colspan="2"><input class="form-control" type="text" name="note" value="<?php echo $note;?>" readonly></td>
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
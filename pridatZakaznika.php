<?php
    $title = "Přidat zákazníka";
    require "header.php";
    require "connectDB.php";  
    if(!isset($_SESSION["role"])||$_SESSION["role"]!=2) header("location:index.php");

        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $sname = $_POST['sname'];
            $firma = $_POST['firma'];
            $ico = $_POST['ico'];
            $mesto = $_POST['mesto'];
            $ulice = $_POST['ulice'];
            $cp = $_POST['cp'];
            $psc = $_POST['psc'];
            $tel = $_POST['tel'];
            $email = $_POST['email'];
            $note = $_POST['note'];
            if(($mesto != "")&&($cp != "")&&($psc != "")){
                $dotaz = "SELECT adr_id FROM adresa WHERE adr_mesto='".$mesto."' AND adr_ulice='".$ulice."' AND adr_CP='".$cp."' AND adr_PSC='".$psc."';";
                $vysledek = mysqli_query($spojeni, $dotaz);
                $radek = mysqli_fetch_array($vysledek);
                if($radek != ""){
                    $zak_adr = $radek[0];
                }
                else{
                    $dotaz = "INSERT INTO adresa (adr_mesto, adr_ulice, adr_CP, adr_PSC)
                    VALUES('$mesto','$ulice','$cp','$psc');";
                    if(mysqli_query($spojeni, $dotaz))
                    {
                        $dotaz = "SELECT MAX(adr_id) FROM adresa;";
                        $vysledek = mysqli_query($spojeni, $dotaz);
                        $radek = mysqli_fetch_row($vysledek);
                        $zak_adr = $radek[0]; 
                    }
                    else{
                        $_SESSION["msg-bad"]="Vyskytla se chyba při tvorbě adresy";
                        header("location:pridatZakaznika.php");
                    }
                }
            }
            else{       
                $zak_adr = "";                    
            }             
            $dotaz = "INSERT INTO zakaznik (zak_name, zak_sname, zak_fir_name, zak_ICO, zak_adr, zak_tel, zak_email, zak_note)
            VALUES('$name','$sname','$firma','$ico','$zak_adr','$tel','$email','$note');";
            if(mysqli_query($spojeni, $dotaz))
            {
                $_SESSION["msg-good"]="Zákazník úspěšně přidán.";
                header("location:zakaznici.php");
            }
            else
            {
                $_SESSION["msg-bad"]="Vyskytla se chyba";
                header("location:zakaznici.php");
            }   
        }
    
    
    

?>
    <h3 align="center">Přidat nového zkazníka</h3>
    <form action="pridatZakaznika.php" method="POST">
        <div class="d-flex justify-content-center mb-3">
            <div class="d-inline-flex" id="reg">
                <table border = 1 align=center>
                    <tr>
                        <td>Jméno</td><td colspan="2"><input class="form-control" type="text" name="name" required></td>
                    </tr>
                    <tr>
                        <td>Příjmení</td><td colspan="2"><input class="form-control" type="text" name="sname" required></td>
                    </tr>
                    <tr>
                        <td>Firma</td><td colspan="2"><input class="form-control" type="text" name="firma"></td>
                    </tr>
                    <tr>
                        <td>IČO</td><td colspan="2"><input class="form-control" type="text" name="ico"></td>
                    </tr>
                    <tr>
                        <td>Město</td><td colspan="2"><input class="form-control" type="text" name="mesto"></td>
                    </tr>
                    <tr>
                        <td>Ulice a číslo popisné</td><td><input class="form-control" type="text" name="ulice"></td><td><input class="form-control" type="number" name="cp"></td>
                    </tr>
                    <tr>
                        <td>PSČ</td><td><input class="form-control" type="number" name="psc"></td>
                    </tr>
                    <tr>
                        <td>Telefoní číslo</td><td colspan="2"><input class="form-control" type="text" name="tel"></td>
                    </tr>
                    <tr>
                        <td>Email</td><td colspan="2"><input class="form-control" type="text" name="email"></td>
                    </tr>
                    <tr>
                        <td>Poznámka</td><td colspan="2"><input class="form-control" type="text" name="note"></td>
                    </tr>                   
                    <tr>
                        <td colspan="3" align=center style="padding-top:20px" ><input style="width:50%" type="submit" name="submit" value="Vložit zákazníka" id="reg-but"></td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
<?php    
    require "footer.php";
?>
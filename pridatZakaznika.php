<?php
    $title = "Přidat zákazníka";
    require "hlavicka.php";
    require "connectDB.php";  
    if(!isset($_SESSION["role"])||$_SESSION["role"]!=2) header("location:index.php");

        if(isset($_POST['submit'])){
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
            if(($mesto != "")&&($cp != "")&&($psc != "")){
                $dotaz = "SELECT id FROM adresa WHERE mesto='".$mesto."' AND ulice='".$ulice."' AND CP='".$cp."' AND PSC='".$psc."';";
                $vysledek = mysqli_query($spojeni, $dotaz);
                $radek = mysqli_fetch_array($vysledek);
                if($radek != ""){
                    $adr = $radek[0];
                }
                else{
                    $dotaz = "INSERT INTO adresa (mesto, ulice, CP, PSC)
                    VALUES('$mesto','$ulice','$cp','$psc');";
                    if(mysqli_query($spojeni, $dotaz))
                    {
                        $adr = maxId("adresa",$spojeni); 
                    }
                    else{
                        $_SESSION["msg-bad"]="Vyskytla se chyba při tvorbě adresy";
                        header("location:pridatZakaznika.php");
                    }
                }
            }
            else{       
                $adr = "";                    
            }             
            $dotaz = "INSERT INTO zakaznik (jmeno, prijmeni, firma, ICO, adr, tel, email, pozn)
            VALUES('$jmeno','$prijmeni','$firma','$ico','$adr','$tel','$email','$pozn');";
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
                        <td>Jméno</td><td colspan="2"><input class="form-control" type="text" name="jmeno" required></td>
                    </tr>
                    <tr>
                        <td>Příjmení</td><td colspan="2"><input class="form-control" type="text" name="prijmeni" required></td>
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
                        <td>Email</td><td colspan="2"><input class="form-control" type="email" name="email"></td>
                    </tr>
                    <tr>
                        <td>Poznámka</td><td colspan="2"><textarea class="form-control" name="pozn"></textarea></td>
                    </tr>                   
                    <tr>
                        <td colspan="3" align=center style="padding-top:20px" ><input style="width:50%" type="submit" name="submit" value="Vložit zákazníka" id="reg-but"></td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
<?php    
    require "pata.php";
?>
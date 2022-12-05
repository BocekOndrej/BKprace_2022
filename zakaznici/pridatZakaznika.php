<?php
    require ("../init/config.php");
    lockAdmin();
    $title = "Přidat zákazníka"; 
        if(isset($_POST['submit'])){
            $jmeno = osetritString($_POST['jmeno']);
            $prijmeni = osetritString($_POST['prijmeni']);
            $firma = osetritString($_POST['firma']);
            $ico = osetritString($_POST['ico']);
            $mesto = osetritString($_POST['mesto']);
            $ulice = osetritString($_POST['ulice']);
            $CP = osetritString($_POST['cp']);
            $PSC = osetritString($_POST['psc']);
            $tel = osetritString($_POST['tel']);
            $email = osetritString($_POST['email']);
            $pozn = osetritString($_POST['pozn']);
            if(($mesto != "")&&($CP != "")&&($PSC != "")){
                $adr = Data::ziskatAdresu($mesto, $ulice, $CP, $PSC)->id;
                if(empty($adr)){
                    Data::pridatAdresu($mesto, $ulice, $CP, $PSC);
                    $adr = Data::ziskatAdresu($mesto, $ulice, $CP, $PSC)->id;
                }  
            }
            else{       
                $adr = 0;                    
            }             
            if(Data::pridatZakaznika($jmeno,$prijmeni,$firma,$ico,$adr,$tel,$email,$pozn))
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
        
        view("zakaznici/pridat");
?>
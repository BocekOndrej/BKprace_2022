<?php
    require ("../init/config.php");
    lockAdmin();
    $title = "Přidat zákazníka"; 
        if(isset($_POST['submit'])){
            $jmeno = sanitizeString($_POST['jmeno']);
            $prijmeni = sanitizeString($_POST['prijmeni']);
            $firma = sanitizeString($_POST['firma']);
            $ico = sanitizeString($_POST['ico']);
            $mesto = sanitizeString($_POST['mesto']);
            $ulice = sanitizeString($_POST['ulice']);
            $CP = sanitizeString($_POST['cp']);
            $PSC = sanitizeString($_POST['psc']);
            $tel = sanitizeString($_POST['tel']);
            $email = sanitizeString($_POST['email']);
            $pozn = sanitizeString($_POST['pozn']);
            if(($mesto != "")&&($CP != "")&&($PSC != "")){
                $adr = Data::getAdresa($mesto, $ulice, $CP, $PSC)->id;
                if(empty($adr)){
                    Data::addAdresa($mesto, $ulice, $CP, $PSC);
                    $adr = Data::getAdresa($mesto, $ulice, $CP, $PSC)->id;
                }  
            }
            else{       
                $adr = 0;                    
            }             
            if(Data::addZakaznik($jmeno,$prijmeni,$firma,$ico,$adr,$tel,$email,$pozn))
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
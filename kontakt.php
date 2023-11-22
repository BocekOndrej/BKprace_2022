<?php
    require ("init/config.php");
    if (isset($_POST["odeslat"])) {
        /*
        $subject = sanitizeString($_POST["predmet"]);
        $msg = sanitizeString($_POST["zprava"]);
        $email = sanitizeString($_POST["email"]);
        $sender = "From: <".$email.">"."\r\n";
        if(mail("bocek04@student.vspj.cz",$subject,$msg,$sender)){
            $_SESSION['msg-good'] = 'Váš dotaz byl odeslán';
        }
        */
    }
    view("kontakt");
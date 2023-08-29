<?php 
  $servername = "127.0.0.1";
  $username = "root";
  $password = "";
  $dbname = "bkprace";
  $spojeni = mysqli_connect($servername, $username, $password, $dbname);
  mysqli_set_charset($spojeni, "utf8");
 ?>
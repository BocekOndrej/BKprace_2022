<?php
  $title = "Vaše objednávka";
  require "hlavička.php";
  require "connectDB.php";
 ?>
 <p class="display-3" style="text-align: center">Zadejte údaje o objednávce</p>
 <form action="objPass.php" method="get">
 <div class="d-flex justify-content-center mb-3">
   <div class="d-inline-flex" id="reg">
    <table border = 1 align=center>
     <tr>
       <td>Číslo objednávky: </td><td><input class="form-control" type="text" name="cislo" required></td>
     </tr>
     <tr>
       <td>Heslo: </td><td><input class="form-control" type="text" name="heslo" required></td>
     </tr>
     <tr>
       <td colspan="2" align=center style="padding-top:20px" ><input style="width:90%" type="submit" name="getobj" value="Zobrazit objednávku" id="reg-but"></td>
     </tr>
    </table>
   </div>
 </div>
 </form>
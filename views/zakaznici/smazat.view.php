<h3 align="center">Smazat zákazníka</h3>
<form action="smazatZakaznika.php" method="post">
    <div class="d-flex justify-content-center mb-3">
        <div class="d-inline-flex" id="reg">
            <table>
                    <tr>
                        <td>ID</td><td colspan="2"><input class="form-control" type="text" name="id" value="<?php echo $model->id;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Jméno</td><td colspan="2"><input class="form-control" type="text" name="jmeno" value="<?php echo $model->jmeno;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Příjmení</td><td colspan="2"><input class="form-control" type="text" name="prijmeni" value="<?php echo $model->prijmeni;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Firma</td><td colspan="2"><input class="form-control" type="text" name="firma" value="<?php echo $model->firma;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>IČO</td><td colspan="2"><input class="form-control" type="text" name="ico" value="<<?php echo $model->ICO;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Město</td><td colspan="2"><input class="form-control" type="text" name="mesto" value="<?php echo $model->mesto;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Ulice a číslo popisné</td><td><input class="form-control" type="text" name="ulice" value="<?php echo $model->ulice;?>" readonly></td>
                        <td><input class="form-control" type="number" name="cp" value="<?php echo $model->CP;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>PSČ</td><td><input class="form-control" type="number" name="psc" value="<?php echo $model->PSC;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Telefoní číslo</td><td colspan="2"><input class="form-control" type="text" name="tel" value="<?php echo $model->tel;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Email</td><td colspan="2"><input class="form-control" type="text" name="email" value="<?php echo $model->email;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Poznámka</td><td colspan="2"><textarea class="form-control" name="pozn" readonly><?php echo $model->pozn;?></textarea></td>
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
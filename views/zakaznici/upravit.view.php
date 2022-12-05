<h3 align="center">Upravit zákazníka</h3>
<form action="upravitZakaznika.php" method="post">
    <div class="d-flex justify-content-center mb-3">
        <div class="d-inline-flex" id="reg">
            <table>
                    <tr>
                        <td>ID</td><td colspan="2"><input class="form-control" type="text" name="id" value="<?php echo $model->id;?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Jméno</td><td colspan="2"><input class="form-control" type="text" name="jmeno" value="<?php echo $model->jmeno;?>"></td>
                    </tr>
                    <tr>
                        <td>Příjmení</td><td colspan="2"><input class="form-control" type="text" name="prijmeni" value="<?php echo $model->prijmeni;?>"></td>
                    </tr>
                    <tr>
                        <td>Firma</td><td colspan="2"><input class="form-control" type="text" name="firma" value="<?php echo $model->firma;?>"></td>
                    </tr>
                    <tr>
                        <td>IČO</td><td colspan="2"><input class="form-control" type="text" name="ico" value="<?php echo $model->ICO;?>"></td>
                    </tr>
                    <tr>
                        <td>Město</td><td colspan="2"><input class="form-control" type="text" name="mesto" value="<?php echo $model->mesto;?>"></td>
                    </tr>
                    <tr>
                        <td>Ulice a číslo popisné</td><td><input class="form-control" type="text" name="ulice" value="<?php echo $model->ulice;?>"></td>
                        <td><input class="form-control" type="number" name="cp" value="<?php echo $model->CP;?>"></td>
                    </tr>
                    <tr>
                        <td>PSČ</td><td><input class="form-control" type="number" name="psc" value="<?php echo $model->PSC;?>"></td>
                    </tr>
                    <tr>
                        <td>Telefoní číslo</td><td colspan="2"><input class="form-control" type="text" name="tel" value="<?php echo $model->tel;?>"></td>
                    </tr>
                    <tr>
                        <td>Email</td><td colspan="2"><input class="form-control" type="email" name="email" value="<?php echo $model->email;?>"></td>
                    </tr>
                    <tr>
                        <td>Poznámka</td><td colspan="2"><textarea class="form-control" name="pozn"><?php echo $model->pozn;?></textarea></td>
                    </tr> 
                    <tr>
                        <td colspan="2" align="center"><input type="submit" name="zmenit" value="Změnit" id="reg-but">&nbsp;<input type="submit" name="zmenit" value="Zpět" id="reg-but"></td>
                    </tr>
            </table>
        </div>
    </div>
</form>
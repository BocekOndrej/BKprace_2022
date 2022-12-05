<h3 align="center">Smazat zboží</h3>
<form action="smazatZbozi.php" method="post">
    <div class="d-flex justify-content-center mb-3">
        <div class="d-inline-flex" id="reg">
            <table>
                <tr>
                <td>ID</td><td><input type="text" name="id" value="<?php echo $model->id;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Název</td><td><input type="text" value="<?php echo $model->nazev;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Množství</td><td><input type="text" value="<?php echo $model->mnozstvi;?>" readonly class="form-control">
                <input type="text" value="<?php echo $model->jednotka;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Seriové číslo</td><td><input type="text" value="<?php echo $model->sercis;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Záruka</td><td><input type="text" value="<?php echo $model->zaruka;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Nákupní cena</td><td><input type="text" value="<?php echo $model->cena1;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Prodejní cena</td><td><input type="text" value="<?php echo $model->cena2;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Datum zakoupení</td><td><input type="text" value="<?php echo $model->datum;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Obchod</td><td><input type="text" value="<?php echo $model->obchod;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>DPH</td><td><input type="text" value="<?php echo $model->DPH;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                <td>Poznámka</td><td><textarea readonly class="form-control"><?php echo $model->pozn;?></textarea></td>
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
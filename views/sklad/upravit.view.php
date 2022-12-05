<h3 align="center">Upravit zboží</h3>
<form action="upravitZbozi.php" method="post">
    <div class="d-flex justify-content-center mb-3">
        <div class="d-inline-flex" id="reg">
            <table>
                <tr>
                    <td>ID</td><td><input type="text" name="id" value="<?php echo $model->id;?>" readonly class="form-control"></td>
                </tr>
                <tr>
                    <td>Název</td><td><input type="text" name="nazev" value="<?php echo $model->nazev;?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Množství</td><td><input type="number" name="mnozstvi" min="0" value="<?php echo $model->mnozstvi;?>" class="form-control">
                        <select name="jednotka" class="form-control">
                            <option value="ks" <?php if($model->jednotka == 'ks'){echo("selected");}?>>ks</option>
                            <option value="g"  <?php if($model->jednotka == 'g'){echo("selected");}?>>g</option>
                            <option value="m"  <?php if($model->jednotka == 'm'){echo("selected");}?>>m</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Seriové číslo</td><td><input type="text" name="sercis" value="<?php echo $model->sercis;?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Záruka</td><td><input type="number" name="zaruka" min="0" value="<?php echo $model->zaruka;?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Nákupní cena</td><td><input type="number" name="cena1" min="0" step=".001" value="<?php echo $model->cena1;?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Prodejní cena</td><td><input type="number" name="cena2" min="0" step=".001" value="<?php echo $model->cena2;?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Datum zakoupení</td><td><input type="date" name="datum" value="<?php echo $model->datum;?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Obchod</td><td><input type="text" name="obchod" value="<?php echo $model->obchod;?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>DPH</td><td><select name="DPH" value="<?php echo $model->DPH;?>">
                                        <option value="15" <?php if($model->DPH == '15'){echo("selected");}?>>15</option>
                                        <option value="12" <?php if($model->DPH == '12'){echo("selected");}?>>12</option>
                                    </select>%</td>
                </tr>
                <tr>
                    <td>Poznámka</td><td><textarea name="pozn" class="form-control"><?php echo $model->pozn;?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" name="zmenit" value="Změnit" id="reg-but">&nbsp;<input type="submit" name="zmenit" value="Zpět" id="reg-but"></td>
                </tr>
            </table>
        </div>
    </div>
</form>
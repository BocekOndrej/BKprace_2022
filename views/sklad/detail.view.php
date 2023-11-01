<div class="container">
<a href="pridatZbozi.php" id="regi" class="add-but btn">Přidat zboží</a>
<?php if ($model != null) { ?>
  <div class="row">
    <div class="col">            
        <div class="prehled-tab container text-center"> 
            <div class='row'><div class="col">Název</div><div class="col">Množství</div><div class="col">Datum zakoupení</div><div class="col">Obchod</div><div class="col"></div></div>
            <?php foreach($model["zbozi"] as $polozka) : ?>
                <div class='row'>
                <div class="col"><?= $polozka->nazev ?></div>
                <div class="col"><?= $polozka->mnozstvi ?> <?= $polozka->jednotka ?></div>
                <div class="col"><?= $polozka->datum ?></div>
                <div class="col"><?= $polozka->obchod ?></div>
                <div class="col"><a href="sklad.php?id=<?= $polozka->id ?>" id="reg-but" class="det-but btn">Detail</a></div>
                </div>
            <?php endforeach; ?>
        </div>   
    </div>
    <?php if(isset($model["polozka"])){ ?>                   
    <div class="col">
        <form action="sklad.php?id=<?= $model["polozka"]->id ?>" method="post" onsubmit="return confirmSubmit()">
            <div class="d-flex justify-content-center mb-3">
                <div class="d-inline-flex" id="reg">
                    <table>
                        <tr>
                            <td>ID</td><td><input type="text" name="id" value="<?php echo $model["polozka"]->id;?>" readonly class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Název</td><td><input type="text" name="nazev" value="<?php echo $model["polozka"]->nazev;?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Množství</td><td><input type="number" name="mnozstvi" min="0" value="<?php echo $model["polozka"]->mnozstvi;?>" class="form-control">
                                <select name="jednotka" class="form-control">
                                    <option value="ks" <?php if($model["polozka"]->jednotka == 'ks'){echo("selected");}?>>ks</option>
                                    <option value="g"  <?php if($model["polozka"]->jednotka == 'g'){echo("selected");}?>>g</option>
                                    <option value="m"  <?php if($model["polozka"]->jednotka == 'm'){echo("selected");}?>>m</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Seriové číslo</td><td><input type="text" name="sercis" value="<?php echo $model["polozka"]->sercis;?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Záruka</td><td><input type="number" name="zaruka" min="0" value="<?php echo $model["polozka"]->zaruka;?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Nákupní cena</td><td><input type="number" name="cena1" min="0" step=".001" value="<?php echo $model["polozka"]->cena1;?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Prodejní cena</td><td><input type="number" name="cena2" min="0" step=".001" value="<?php echo $model["polozka"]->cena2;?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Datum zakoupení</td><td><input type="date" name="datum" value="<?php echo $model["polozka"]->datum;?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Obchod</td><td><input type="text" name="obchod" value="<?php echo $model["polozka"]->obchod;?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>DPH</td><td><select name="DPH" value="<?php echo $model["polozka"]->DPH;?>">
                                                <option value="15" <?php if($model["polozka"]->DPH == '15'){echo("selected");}?>>15</option>
                                                <option value="12" <?php if($model["polozka"]->DPH == '12'){echo("selected");}?>>12</option>
                                            </select>%</td>
                        </tr>
                        <tr>
                            <td>Poznámka</td><td><textarea name="pozn" class="form-control"><?php echo $model["polozka"]->pozn;?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input type="submit" name="upravit" value="Upravit" id="reg-but">&nbsp;<button formaction="sklad.php" name="smazat" value="Smazat" id="reg-but">Smazat</button></td>
                        </tr>
                    </table>
                </div>
            </div>
        </form>
    </div>
    <?php } ?>
  </div>
</div>
<?php } else{ ?>
    <p class="display-1" style="text-align: center">Sklad je prázdný</p>
<?php } ?>  

<script>
        function confirmSubmit() {     
            confirmation = confirm("Opravdu chcete operaci provést?");
            return confirmation;
        }
</script>
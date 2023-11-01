<a href="pridatZakaznika.php" class="add-but btn">Přidat zákazníka</a>
<?php if ($model["zakaznici"] != null) { ?>
<div class="row">
    <div class="col">                            
        <div class="prehled-tab container text-center"> 
            <div class='row'><div class="col">ID</div><div class="col">Jméno</div><div class="col">Příjmení</div><div class="col">Firma</div><div class="col"></div><div class="col"></div></div>
            <?php foreach($model["zakaznici"] as $polozka) : ?>
                <div class='row'>
                <div class="col"><?= $polozka->id ?></div>
                <div class="col"><?= $polozka->jmeno ?></div>
                <div class="col"><?= $polozka->prijmeni ?></div>
                <div class="col"><?= $polozka->firma ?></div>
                <div class="col"><a href="zakaznici.php?id=<?= $polozka->id ?>" id="reg-but" class="det-but btn">Detail</a></div>
                </div>
            <?php endforeach; ?>
        </div>             
    </div>
    <?php if (isset($model["zakaznik"])) { ?>
    <div class="col">
        <form action="zakaznici.php?id=<?= $model["zakaznik"]->id ?>" method="post" onsubmit="return confirmSubmit()">
            <div class="d-flex justify-content-center mb-3">
                <div class="d-inline-flex" id="reg">
                    <table>
                            <tr>
                                <td>ID</td><td colspan="2"><input class="form-control" type="text" name="id" value="<?php echo $model["zakaznik"]->id;?>" readonly></td>
                            </tr>
                            <tr>
                                <td>Jméno</td><td colspan="2"><input class="form-control" type="text" name="jmeno" value="<?php echo $model["zakaznik"]->jmeno;?>"></td>
                            </tr>
                            <tr>
                                <td>Příjmení</td><td colspan="2"><input class="form-control" type="text" name="prijmeni" value="<?php echo $model["zakaznik"]->prijmeni;?>"></td>
                            </tr>
                            <tr>
                                <td>Firma</td><td colspan="2"><input class="form-control" type="text" name="firma" value="<?php echo $model["zakaznik"]->firma;?>"></td>
                            </tr>
                            <tr>
                                <td>IČO</td><td colspan="2"><input class="form-control" type="text" name="ico" value="<?php echo $model["zakaznik"]->ICO;?>"></td>
                            </tr>
                            <tr>
                                <td>Město</td><td colspan="2"><input class="form-control" type="text" name="mesto" value="<?php echo $model["zakaznik"]->mesto;?>"></td>
                            </tr>
                            <tr>
                                <td>Ulice a číslo popisné</td><td><input class="form-control" type="text" name="ulice" value="<?php echo $model["zakaznik"]->ulice;?>"></td>
                                <td><input class="form-control" type="number" name="cp" value="<?php echo $model["zakaznik"]->CP;?>"></td>
                            </tr>
                            <tr>
                                <td>PSČ</td><td><input class="form-control" type="number" name="psc" value="<?php echo $model["zakaznik"]->PSC;?>"></td>
                            </tr>
                            <tr>
                                <td>Telefoní číslo</td><td colspan="2"><input class="form-control" type="text" name="tel" value="<?php echo $model["zakaznik"]->tel;?>"></td>
                            </tr>
                            <tr>
                                <td>Email</td><td colspan="2"><input class="form-control" type="email" name="email" value="<?php echo $model["zakaznik"]->email;?>"></td>
                            </tr>
                            <tr>
                                <td>Poznámka</td><td colspan="2"><textarea class="form-control" name="pozn"><?php echo $model["zakaznik"]->pozn;?></textarea></td>
                            </tr> 
                            <tr>
                                <td colspan="2" align="center"><input type="submit" name="upravit" value="Upravit" id="reg-but">&nbsp;<button formaction="zakaznici.php" name="smazat" value="Smazat" id="reg-but">Smazat</button></td>
                            </tr>
                    </table>
                </div>
            </div>
        </form>
    </div>
    <?php } ?>
</div>
<?php } else{ ?>
    <p class="display-1" style="text-align: center">Žádné zakázky nenalezeny</p>
<?php } ?> 

<script>
        function confirmSubmit() {     
            confirmation = confirm("Opravdu chcete operaci provést?");
            return confirmation;
        }
</script>
        
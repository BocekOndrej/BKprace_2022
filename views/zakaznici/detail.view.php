<a href="pridatZakaznika.php" id="regi" class="btn">Přidat zákazníka</a>
<?php if ($model["zakaznici"] != null) { ?>
<div class="row">
    <div class="col">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">                             
                    <table class='w-100 sprava-tab'>
                    <tr class='radek-clanky'><th>ID</th><th>Jméno</th><th>Příjmení</th><th>Firma</th><th>IČO</th><th>Město</th><th>Ulice</th><th>ČP</th><th>PSČ</th><th>Telefon</th><th>Email</th><th>Poznámka</th><td></td><td></td></tr>
                    <?php foreach($model["zakaznici"] as $polozka) : ?>
                        <td><?= $polozka->id ?></td>
                        <td><?= $polozka->jmeno ?></td>
                        <td><?= $polozka->prijmeni ?></td>
                        <td><?= $polozka->firma ?></td>
                        <td><?= $polozka->ICO ?></td>
                        <td><?= $polozka->mesto ?></td>
                        <td><?= $polozka->ulice ?></td>
                        <td><?= $polozka->CP ?></td>
                        <td><?= $polozka->PSC ?></td>
                        <td><?= $polozka->tel ?></td>
                        <td><?= $polozka->email ?></td>
                        <td><?= $polozka->pozn ?></td>
                        <td><a href="zakaznici.php?id=<?= $polozka->id ?>" id="reg-but" class="btn">Detail</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>              
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($model["zakaznik"])) { ?>
    <div class="col">
        <form action="zakaznici.php?id=<?= $model["zakaznik"]->id ?>" method="post">
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
        
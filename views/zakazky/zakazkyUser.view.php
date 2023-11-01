<?php if ($model["zakazkyAll"] != null) { ?>
    <div class="row">
        <div class="col">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">                
                        <table class='w-100 sprava-tab'>
                        <tr class='radek-clanky'><th>ID</th><th>cena</th><th>jmeno zakaznika</th><th>prijmeni</th><th>zbozi</th></tr>
                        <?php foreach ($model["zakazkyAll"] as $zakazka){ ?>
                            <td><?= $zakazka->id ?></td>
                            <td><?= $zakazka->cena ?></td>
                            <td><?= $zakazka->objZakaznik->jmeno ?></td><td><?= $zakazka->objZakaznik->prijmeni ?></td>                           
                            <td> <?php foreach($zakazka->arrayZbozi as $zbozi){ echo($zbozi->nazev." ".$zbozi->mnozstvi."".$zbozi->jednotka."<br>");}?> </td>
                            <td><a href="zakazkyUser.php?id=<?= $zakazka->id ?>" id="reg-but" class="btn">Detail</a></td>
                            </tr>
                            <?php } ?>
                        </table>    
                    </div>
                </div>
            </div>
        </div>
    
        <?php if (isset($model["zakazka"])) { ?>
        <div class="col">
                <div class="d-flex justify-content-center mb-3">
                    <div id="reg">
                            <div class="row">
                                <div class="col">ID</div><div class="col"><input class="form-control" type="number" name="id" value="<?php echo $model["zakazka"]->id;?>" required readonly></div>
                            </div>            
                            <div class="row">
                                <div class="col">Datum začátku</div><div class="col"><input class="form-control" type="date" name="datum" value="<?php echo $model["zakazka"]->datum_zac;?>" required></div>
                            </div>
                            <div class="row">
                                <div class="col">Datum konce</div><div class="col"><input class="form-control" type="date" name="datum" value="<?php echo $model["zakazka"]->datum_konec;?>" required></div>
                            </div>
                            <div class="row">
                                <div class="col">Cena</div><div class="col"><input class="form-control" type="number" name="cena" value="<?php echo $model["zakazka"]->cena;?>" required></div>
                            </div>
                            <div class="row">
                                <div class="col">DPH</div><div class="col"><select name="dph">
                                                    <option value="15" <?php if($model["zakazka"]->dph == '15'){echo("selected");}?>>15</option>
                                                    <option value="12" <?php if($model["zakazka"]->dph == '12'){echo("selected");}?>>12</option>
                                                </select>%</div>
                            </div>
                            <div class="row">
                                <div class="col">Stav</div>
                                <div class="col"><select name="stav">
                                        <?php foreach ($model["stavy"] as $stav): ?>
                                            <option value="<?= $stav->id ?>" <?php if($model["zakazka"]->stav == $stav->id ){echo("selected");}?>><?= $stav->nazev ?></option>                                    
                                        <?php endforeach; ?>
                                    </select></div>
                            </div>
                            <div class="row">
                                <div class="col">Poznámka pro zákazníka</div><div class="col"><textarea class="form-control" name="pozn1"><?php echo $model["zakazka"]->pozn1;?></textarea></div>
                            </div>
                            <div id="zboziForm">
                                <div class="row">                   
                                    <div class="col">Zboží:</div>           
                                </div>
                            </div>

                    </div>
                </div>
        </div>
        <?php } ?>
    </div>

<?php } else{ ?>
    <p class="display-1" style="text-align: center">Žádné zakázky nenalezeny</p>
<?php } ?>

<script>
    let zboziZakazky = <?php echo json_encode($model["zakazka"]->arrayZbozi); ?>;
        zboziZakazky.forEach(function(zbozi){
            console.log();
            $("#zboziForm").append(`<div class="row"><div class="col"><input type="hidden" name="zboziId[]" value="${zbozi.id}"><input type="text" value="${zbozi.nazev}" readonly></div><div class="col"><input class="form-control" type="number" name="zboziPocet[]" value="${zbozi.mnozstvi}" readonly></div></div>`);
        });
</script>
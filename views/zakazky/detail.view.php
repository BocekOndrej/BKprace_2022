<a href="pridatZakazku.php" id="regi" class="btn">Přidat zakazku</a>
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
                            <td><a href="zakazky.php?id=<?= $zakazka->id ?>" id="reg-but" class="btn">Detail</a></td>
                            </tr>
                            <?php } ?>
                        </table>    
                    </div>
                </div>
            </div>
        </div>
    
        <?php if (isset($model["zakazka"])) { ?>
        <div class="col">
            <form action="zakazky.php?id=<?= $model["zakazka"]->id ?>" method="post">
                <div class="d-flex justify-content-center mb-3">
                    <div id="reg">
                            <div class="row">
                                <div class="col">ID</div><div class="col"><input class="form-control" type="number" name="id" value="<?php echo $model["zakazka"]->id;?>" required readonly></div>
                            </div>            
                            <div class="row">
                                <div class="col">Datum začátku</div><div class="col"><input class="form-control" type="date" name="datum_zac" value="<?php echo $model["zakazka"]->datum_zac;?>" required></div>
                            </div>
                            <div class="row">
                                <div class="col">Datum konce</div><div class="col"><input class="form-control" type="date" name="datum_konec" value="<?php echo $model["zakazka"]->datum_konec;?>"></div>
                            </div>
                            <div class="row">
                                <div class="col">Zákazník</div>
                                <div class="col"><select name="zakaznik">
                                        <?php foreach ($model["zakaznici"] as $zakaznik): ?>
                                            <option value="<?= $zakaznik->id ?>" <?php if($model["zakazka"]->objZakaznik->id == $zakaznik->id ){echo("selected");}?>><?= $zakaznik->jmeno ?> <?= $zakaznik->prijmeni ?></option>                                    
                                        <?php endforeach; ?>
                                    </select></div>
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
                            <div class="row">
                                <div class="col">Poznámka pro firmu</div><div class="col"><textarea class="form-control" name="pozn2"><?php echo $model["zakazka"]->pozn2;?></textarea></div>
                            </div>
                            <div id="zboziForm">
                                <div class="row">                   
                                    <div class="col">Zboží:</div>           
                                    <div class="col"><button class="addItemBtn btn btn-success">Přidat zboží ze skladu</button>
                                        <button id="reg-but" class="newItemBtn btn">Vytvořit nové zboží</button></div>
                                </div>
                            </div>
                            <div class="row">
                                <input type="checkbox" name="vratit" value="true">
                                <label for="vratit">Vrátit zboží do skladu při smazání</label><br>
                            </div>
                            <tr>
                                <td colspan="2" align="center"><input type="submit" name="upravit" value="Upravit" id="reg-but">&nbsp;<button formaction="zakazky.php" name="smazat" value="Smazat" id="reg-but">Smazat</button></td>
                            </tr>
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
        let $zboziKomponenta = '<div class="row"><div class="col">Zboží:</div><div class="col"><select name="zboziId[]"><?php foreach ($model["zbozi"] as $zbozi): ?><option value="<?= $zbozi->id ?>"><?= $zbozi->nazev ?></option><?php endforeach; ?></select></div><div class="col"><input class="form-control" type="number" name="zboziPocet[]" required></div><div class="col"><button class="delItemBtn btn btn-danger">Smazat polozku</button></div></div>';              
        let $newZboziKomponenta = '<div class="row"><div class="col">Nové zboží</div><div class="col"><div class="row"><div class="col">Název zboží</div><div class="col"><input class="form-control" type="text" name="newNazev[]" required></div></div><div class="row"><div class="col">Počet v zakázce</div><div class="col"><input class="form-control" type="number" min="0" value="0" name="newMnozstvi[]"></div><div class="col"><select name="newJednotka[]"><option value="ks">ks</option><option value="g">g</option><option value="m">m</option></select></div></div><div class="row"><div class="col">Seriové číslo</div><div class="col"><input class="form-control" type="text" name="sercis[]"></div></div><div class="row"><div class="col">Záruka</div><div class="col"><input class="form-control" type="number" min="0" name="zaruka[]" required></div><div class="col">Měsíců</div></div><div class="row"><div class="col">Nákupní cena</div><div class="col"><input class="form-control" type="number" min="0" step=".001" name="cena1[]" required></div></div><div class="row"><div class="col">Prodejní cena</div><div class="col"><input class="form-control" type="number" min="0" step=".001" name="cena2[]" required></div></div><div class="row"><div class="col">Datum zakoupení</div><div class="col"><input class="form-control" type="date" name="datumZbo[]" required></div></div><div class="row"><div class="col">DPH</div><div class="col"><select name="dphZbo[]"><option value="15">15</option><option value="12">12</option></select>%</div></div><div class="row"><div class="col">Zakoupeno</div><div class="col"><input class="form-control" type="text" name="obchod[]" required><button class="delNewItemBtn btn btn-danger">Smazat polozku</button></div></div></div></div>';
        
        let zboziZakazky = <?php echo json_encode($model["zakazka"]->arrayZbozi); ?>;
        zboziZakazky.forEach(function(zbozi){
            console.log();
            $("#zboziForm").prepend(`<div class="row"><div class="col">Zboží:</div><div class="col"><input type="hidden" name="zboziId[]" value="${zbozi.id}"><input type="text" value="${zbozi.nazev}"></div><div class="col"><input class="form-control" type="number" name="zboziPocet[]" value="${zbozi.mnozstvi}" required></div><div class="col"><button class="delItemBtn btn btn-danger">Smazat polozku</button></div></div>`);
        });

        $(document).ready(function(){
            $(".addItemBtn").click(function(e){
                e.preventDefault();
                $("#zboziForm").prepend($zboziKomponenta);
                
            });                
        });
        $(document).on('change', 'select[name="zboziId[]"]', function() {
                let zboziArray = <?php echo json_encode($model["zbozi"]); ?>;
                let selectedZboziId = $(this).val();             
                let zbozi = zboziArray.find(function (item) {
                    return item.id == selectedZboziId;
                });
                
                let $zboziPocet = $(this).closest('.row').find('input[name="zboziPocet[]"]');
                $zboziPocet.attr('max', zbozi.mnozstvi);
        });
        $(document).ready(function(){
            $(".newItemBtn").click(function(e){
                e.preventDefault();
                $("#zboziForm").prepend($newZboziKomponenta);
            });                
        });

        $(document).on('click', '.delNewItemBtn', function(e){
                e.preventDefault();
                let zbozi = $(this).parent().parent().parent().parent();
                $(zbozi).remove();             
        });

        $(document).on('click', '.delItemBtn', function(e){
                e.preventDefault();
                let zbozi = $(this).parent().parent();
                $(zbozi).remove();             
        });
        /*
        $("#zakazkaForm").submit(function(e){
            e.preventDefault();
            $("#submitBtn").val('Přidávání...');
            $.ajax({
                url: 'pridatZakazku.php',
                method: 'post',
                data: $(this).serialize()
            });
        });*/
    </script>
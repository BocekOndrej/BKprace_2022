<a href="pridatZakazku.php" class="add-but btn">Přidat zakazku</a>
<?php if ($model["zakazkyAll"] != null) { ?>
<div class="col-c">
<div class="filtry accordion" data-bs-theme="dark" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
        Filtrování
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <form action="">
            Řazení: <select>
                <?php foreach (get_object_vars($model["zakazkyAll"][0]) as $parametr => $value){ if($parametr == "id" || $parametr == "cena" || $parametr == "zakaznik"){?>
                    <option value="<?= $parametr . PHP_EOL; ?>"><?= $parametr . PHP_EOL; ?></option>                                    
                <?php }} ?>
            </select>
            Vyhledávání: <input type="text">
            <input type="submit" class="filtr-but" name="filtrovat" value="Filtrovat">
        </form>
        
        
      </div>
    </div>
  </div>
</div>
    <div class="row-c">
        <div>
            <div class="prehled-tab container text-center">                
                <div class='row'><div class="col">ID</div><div class="col">CENA</div><div class="col">STAV</div><div class="col">ZÁKAZNÍK</div><div class="col"></div></div>
                <?php foreach ($model["zakazkyAll"] as $zakazka){ ?>
                    <div class="row">
                    <div class="col"><?= $zakazka->id ?></div>
                    <div class="col"><?= $zakazka->cena ?></div>
                    <div class="col"><?= $zakazka->stav ?></div>
                    <div class="col"><?= $zakazka->objZakaznik->jmeno." ".$zakazka->objZakaznik->prijmeni ?></div>                           
                    <div class="col"><a href="zakazky.php?id=<?= $zakazka->id ?>" class="det-but btn">Detail</a></div>
                    </div>
                <?php } ?>    
            </div>
        </div>
    
        <?php if (isset($model["zakazka"])) { ?>
        <div>
            <form action="zakazky.php?id=<?= $model["zakazka"]->id ?>" method="post" onsubmit="return confirmSubmit()">
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
                                <div class="col"><select name="zakaznik" class="form-control">
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
                                            <option value="<?= $stav->id ?>" <?php if($model["zakazka"]->stav == $stav->nazev ){echo("selected");}?>><?= $stav->nazev ?></option>                                    
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
                                        <button id="addNewZbozi" class="newItemBtn btn">Vytvořit nové zboží</button></div>
                                </div>
                            </div>
                            <div class="row">
                                <input type="checkbox" name="vratit" value="true">
                                <label for="vratit">Vrátit zboží do skladu při smazání</label><br>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col"><input class="edit-but" type="submit" name="upravit" value="Upravit" id="edit-but">&nbsp;<button class="del-but" formaction="zakazky.php" name="smazat" value="Smazat" id="del-but">Smazat</button></div>
                            </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
        <div class="modal fade" id="newZboziModal" tabindex="-1" role="dialog" aria-labelledby="newZboziModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nové zboží</h5>
                </div>
                <div class="modal-body">
                    <form id="myForm">
                    <div class="row">
                        <div class="row">
                            <div class="col">Název zboží</div>
                            <div class="col-8"><input class="form-control" type="text" id="newNazevM"></div>
                        </div>
                        <div class="row">
                            <div class="col">Počet v zakázce</div>
                            <div class="col"><input class="form-control" type="number" min="0" value="0" id="newMnozstviM"></div>
                            <div class="col"><select id="newJednotkaM" class="form-control"><option value="ks">ks</option><option value="g">g</option><option value="m">m</option></select></div>
                        </div>
                        <div class="row">
                            <div class="col">Seriové číslo</div>
                            <div class="col"><input class="form-control" type="text" id="sercisM"></div>
                        </div>
                        <div class="row">
                            <div class="col">Záruka</div>
                            <div class="col"><input class="form-control" type="number" min="0" id="zarukaM" required></div>
                            <div class="col">Měsíců</div>
                        </div>
                        <div class="row">
                            <div class="col">Nákupní cena</div>
                            <div class="col"><input class="form-control" type="number" min="0" step=".001" id="cena1M" required></div>
                        </div>
                        <div class="row">
                            <div class="col">Prodejní cena</div>
                            <div class="col"><input class="form-control" type="number" min="0" step=".001" id="cena2M" required></div>
                        </div>
                        <div class="row">
                            <div class="col">Datum zakoupení</div>
                            <div class="col"><input class="form-control" type="date" id="datumZboM" required></div>
                        </div>
                        <div class="row">
                            <div class="col">DPH</div>
                            <div class="col"><select id="dphZboM" class="form-control"><option value="15">15</option><option value="12">12</option></select>%</div>
                        </div>
                        <div class="row">
                            <div class="col">Zakoupeno</div>
                            <div class="col"><input class="form-control" type="text" id="obchodM" required></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModal">Zpět</button>
                    <button type="button" class="btn btn-primary" id="saveModal">Vložit</button>
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

        function confirmSubmit() {     
            confirmation = confirm("Opravdu chcete operaci provést?");
            return confirmation;
        }

        let $zboziKomponenta = '<div class="row"><div class="col">Zboží:</div><div class="col"><select class="form-control" name="zboziId[]"><?php foreach ($model["zbozi"] as $zbozi): ?><option value="<?= $zbozi->id ?>"><?= $zbozi->nazev ?></option><?php endforeach; ?></select></div><div class="col"><input class="form-control" type="number" name="zboziPocet[]" required></div><div class="col"><button class="delItemBtn btn btn-danger">Smazat polozku</button></div></div>';              
        
        let zboziZakazky = <?php echo json_encode($model["zakazka"]->arrayZbozi); ?>;
        let zboziArray = <?php echo json_encode($model["zbozi"]); ?>;
        zboziZakazky.forEach(function(zbozi){
            let zboziSklad = zboziArray.find(function (item) {
                    return item.id == zbozi.id;
            });
            let zboziZak = zboziZakazky.find(function (item) {
                    return item.id == zbozi.id;
            });
            let selectedZboziMaxMnozstvi = zboziSklad.mnozstvi + zboziZak.mnozstvi;
            $("#zboziForm").prepend(`<div class="row"><div class="col">Zboží:</div><div class="col"><input type="hidden" name="zboziId[]" value="${zbozi.id}"><input type="text" class="form-control" value="${zbozi.nazev}"></div><div class="col"><input class="form-control" type="number" name="zboziPocet[]" value="${zbozi.mnozstvi}" max="${selectedZboziMaxMnozstvi}" required></div><div class="col"><button class="delItemBtn btn btn-danger">Smazat polozku</button></div></div>`);
        });

        $(document).ready(function(){
            $(".addItemBtn").click(function(e){
                e.preventDefault();
                $("#zboziForm").prepend($zboziKomponenta);
                
            }); 
            $("#addNewZbozi").click(function(e){
                e.preventDefault();
                $("#newZboziModal").modal("show");
                //$("#zboziForm").prepend($newZboziKomponenta);
            });
            $("#closeModal").click(function(e){
                e.preventDefault();
                $("#newZboziModal").modal("hide");
            });
            $("#saveModal").click(function() { 
                $("#zboziForm").prepend(`<div class="row"><div class="col">Zboží:</div><div class="col"><input class="form-control" type="text" name="newNazev[]" value="${$("#newNazevM").val()}" readonly></div></div><div class="row"><div class="col">Počet v zakázce</div><div class="col"><input class="form-control" type="number" value="${$("#newMnozstviM").val()}" name="newMnozstvi[]" readonly></div><div class="col"><input name="newJednotka[]" type="text" value="${$("#newJednotkaM").val()}" readonly></div></div><input type="hidden" name="sercis[]" value="${$("#sercisM").val()}"><input type="hidden" name="zaruka[]" value="${$("#zarukaM").val()}"><input type="hidden" name="cena1[]" value="${$("#cena1M").val()}"><input type="hidden" name="cena2[]" value="${$("#cena2M").val()}"><input type="hidden" name="datumZbo[]" value="${$("#datumZboM").val()}"><input name="dphZbo[]" type="hidden" value="${$("#dphZboM").val()}"><input type="hidden" name="obchod[]" value="${$("#obchodM").val()}">`);

                $("#newZboziModal").modal("hide");
                $("#myForm")[0].reset();
            });                  
        });
        $(document).on('change', 'select[name="zboziId[]"]', function() {
                
                let selectedZboziId = $(this).val();             
                let zbozi = zboziArray.find(function (item) {
                    return item.id == selectedZboziId;
                });
                
                let $zboziPocet = $(this).closest('.row').find('input[name="zboziPocet[]"]');
                $zboziPocet.attr('max', zbozi.mnozstvi);
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
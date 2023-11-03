<a href="pridatZakazku.php" class="add-but btn">Přidat zakazku</a>
<?php if ($model["zakazkyAll"] != null) {?>
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
        <form action="zakazky.php" method="post">
            Řazení: <select class="form-control" name="orderby">
                    <option value="id">ID</option>
                    <option value="cena">CENA</option>
                    <option value="stav">STAV</option>
                    <option value="zakaznik">ZÁKAZNÍK</option>
                    <option value="datum_zac">DATUM ZAČÁTKU</option>                                     
            </select>
            Vyhledávání: <input class="form-control" type="text" name="hledat">
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
                    <div class="col"><?= $zakazka->objStav->nazev ?></div>
                    <div class="col"><?= $zakazka->objZakaznik->jmeno." ".$zakazka->objZakaznik->prijmeni ?></div>                           
                    <div class="col"><button class="det-but btn" data-hidden-value="<?= $zakazka->id ?>">Detail</button></div>
                    </div>
                <?php } ?>  
            </div>
        </div>
    
        
        <div id="zbozi-detail" class="collapse">
            <form action="zakazky.php" method="post" onsubmit="return confirmSubmit()" data-bs-theme="dark">
                <div class="d-flex justify-content-center mb-3">
                    <div id="reg">
                            <div class="row" style="justify-content: end;">
                                <div class="col" style="max-width: fit-content;"><button type="button" id="detailClose" class="blue-but-outline btn">Zavřít</button></div>
                            </div>
                            <div class="row">
                                <div class="col">ID</div><div class="col"><input class="form-control" type="number" name="id" id="id" required readonly></div>
                            </div>            
                            <div class="row">
                                <div class="col">Datum začátku</div><div class="col"><input class="form-control" type="date" name="datum_zac" id="datum_zac" required></div>
                            </div>
                            <div class="row">
                                <div class="col">Datum konce</div><div class="col"><input class="form-control" type="date" name="datum_konec" id="datum_konec"></div>
                            </div>
                            <div class="row">
                                <div class="col">Zákazník</div>
                                <div class="col"><select id="zakaznik" name="zakaznik" class="form-select">
                                        <?php foreach ($model["zakaznici"] as $zakaznik): ?>
                                            <option value="<?= $zakaznik->id ?>"><?= $zakaznik->jmeno ?> <?= $zakaznik->prijmeni ?></option>                                    
                                        <?php endforeach; ?>
                                    </select></div>
                            </div>
                            <div class="row">
                                <div class="col">Cena</div><div class="col"><input class="form-control" type="number" id="cena" name="cena" required></div>
                            </div>
                            <div class="row">
                                <div class="col">DPH</div><div class="col input-group"><select class="form-select" id="dph" name="dph">
                                                    <option value="15">15</option>
                                                    <option value="12">12</option>
                                                </select><label for="dph" class="input-group-text">%</laber></div>
                            </div>
                            <div class="row">
                                <div class="col">Stav</div>
                                <div class="col"><select class="form-select" name="stav" id="stav">
                                        <?php foreach ($model["stavy"] as $stav): ?>
                                            <option value="<?= $stav->id ?>"><?= $stav->nazev ?></option>                                    
                                        <?php endforeach; ?>
                                    </select></div>
                            </div>
                            <div class="row">
                                <div class="col">Poznámka pro zákazníka</div><div class="col"><textarea class="form-control" name="pozn1" id="pozn1"></textarea></div>
                            </div>
                            <div class="row">
                                <div class="col">Poznámka pro firmu</div><div class="col"><textarea class="form-control" name="pozn2" id="pozn2"></textarea></div>
                            </div>
                            <div id="zboziForm" style="display:flex; flex-direction:column; gap: 0.3rem">
                                <div class="row" style="justify-content: center; gap: 0.5rem">                             
                                    <div class="col" style="max-width: fit-content;"><button id="addItemBtn" class="blue-but-outline btn">Přidat zboží ze skladu</button>
                                    <button id="addNewZbozi" class="blue-but-outline btn">Vytvořit nové zboží</button></div>
                                </div>
                            </div>
                            <div class="row">
                                <input type="checkbox" name="vratit" value="true">
                                <label for="vratit">Vrátit zboží do skladu při smazání</label><br>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col" style="max-width: fit-content;"><input class="edit-but btn" type="submit" name="upravit" value="Upravit" id="edit-but">&nbsp;<button class="del-but btn" formaction="zakazky.php" name="smazat" value="Smazat" id="del-but">Smazat</button></div>
                            </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
        <div class="modal fade" data-bs-theme="dark" id="newZboziModal" tabindex="-1" role="dialog" aria-labelledby="newZboziModal" aria-hidden="true">
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
                            <div class="col"><select id="dphZboM" class="form-select"><option value="15">15</option><option value="12">12</option></select>%</div>
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
        
    </div>

<?php } else{ ?>
    <p class="display-1" style="text-align: center">Žádné zakázky nenalezeny</p>
<?php } ?> 

<script>

        function confirmSubmit() {     
            confirmation = confirm("Opravdu chcete operaci provést?");
            return confirmation;
        }

        let $zboziKomponenta = `<div class="row"><div class="col-md-2">Zboží:</div><div class="col input-group"><select class="form-select" name="zboziId[]"><?php foreach ($model["zbozi"] as $zbozi): ?><option value="<?= $zbozi->id ?>"><?= $zbozi->nazev ?></option><?php endforeach; ?></select><input class="form-control" type="number" name="zboziPocet[]" required><button class="delItemBtn btn btn-danger">Smazat polozku</button></div></div>`;              
        let zakazkyAll = <?php echo json_encode($model["zakazkyAll"]); ?>;

        function viewDetail(id){
                const zakazka = zakazkyAll.find(obj => obj.id === id);
                $('#id').val(id);
                $('#datum_zac').val(zakazka.datum_zac);
                $('#datum_konec').val(zakazka.datum_konec);
                $('#zakaznik').val(zakazka.zakaznik);
                $('#cena').val(zakazka.cena);
                $('#dph').val(zakazka.dph);
                $('#stav').val(zakazka.stav);
                $('#pozn1').val(zakazka.pozn1);
                $('#pozn2').val(zakazka.pozn2);
                


                $('.zboziRow').remove();
                let zboziZakazky = zakazka.arrayZbozi;
                let zboziArray = <?php echo json_encode($model["zbozi"]); ?>;
                    zboziZakazky.forEach(function(zbozi){
                let zboziSklad = zboziArray.find(function (item) {
                    return item.id == zbozi.id;
                });
                let zboziZak = zboziZakazky.find(function (item) {
                    return item.id == zbozi.id;
                });
                let selectedZboziMaxMnozstvi = zboziSklad.mnozstvi + zboziZak.mnozstvi;
                
                $("#zboziForm").prepend(`<div class="zboziRow row"><div class="col-md-2">Zboží:</div><div class="col input-group"><input type="hidden" name="zboziId[]" value="${zbozi.id}"><input type="text" class="form-control" value="${zbozi.nazev}"><input class="form-control " type="number" name="zboziPocet[]" value="${zbozi.mnozstvi}" max="${selectedZboziMaxMnozstvi}" required><button class="delItemBtn btn btn-danger">Smazat polozku</button></div></div>`);              
                });
                $(document).ready(function(){
                    $("#zbozi-detail").collapse("show");
                });
        }

        let post = <?php echo json_encode($_POST); ?>;
        if(post.length != 0 && post.id != undefined && post.smazat == undefined){
            viewDetail(parseInt(post.id));
        }

        $(document).ready(function(){
            $("#addItemBtn").click(function(e){
                e.preventDefault();
                $("#zboziForm").prepend($zboziKomponenta);
                
            }); 
            $("#addNewZbozi").click(function(e){
                e.preventDefault();
                $("#newZboziModal").modal("show");
            });
            $("#closeModal").click(function(e){
                e.preventDefault();
                $("#newZboziModal").modal("hide");
            });
            $("#saveModal").click(function() { 
                $("#zboziForm").prepend(`<div class="row"><div class="col-md-2">Zboží:</div><div class="col input-group"><input class="form-control" type="text" name="newNazev[]" value="${$("#newNazevM").val()}" readonly><input class="form-control" type="number" value="${$("#newMnozstviM").val()}" name="newMnozstvi[]" readonly><input name="newJednotka[]" type="hidden" value="${$("#newJednotkaM").val()}"><input type="hidden" name="sercis[]" value="${$("#sercisM").val()}"><input type="hidden" name="zaruka[]" value="${$("#zarukaM").val()}"><input type="hidden" name="cena1[]" value="${$("#cena1M").val()}"><input type="hidden" name="cena2[]" value="${$("#cena2M").val()}"><input type="hidden" name="datumZbo[]" value="${$("#datumZboM").val()}"><input name="dphZbo[]" type="hidden" value="${$("#dphZboM").val()}"><input type="hidden" name="obchod[]" value="${$("#obchodM").val()}"><button class="delItemBtn btn btn-danger">Smazat polozku</button></div>`);

                $("#newZboziModal").modal("hide");
                $("#myForm")[0].reset();
            }); 
            $(".det-but").click(function() { 
                var idZak = $(this).data("hidden-value");
                viewDetail(idZak);
            });        

            $("#detailClose").click(function() {
                $("#zbozi-detail").collapse('hide');
            });         
        });
        $(document).on('change', 'select[name="zboziId[]"]', function() {
                
                let selectedZboziId = $(this).val();      
                let zboziArray = <?php echo json_encode($model["zbozi"]); ?>;       
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
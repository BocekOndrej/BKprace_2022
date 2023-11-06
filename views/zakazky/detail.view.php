<a href="pridatZakazku.php" class="add-but btn">Přidat zakazku</a>
<div class="wrapper">
<?php if ($model["zakazkyAll"] != null) {?>
<div class="row justify-content-center"> 
    <div class="col" style="max-width: 40rem;">
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
                    <input type="submit" class="filtr-but btn" name="filtrovat" value="Filtrovat">
                </form>
        
        
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
        <div class="media-wrapper row">
            <div class="col">
                <div class="prehled-tab container text-center">                
                    <div class='row header'><div class="col">ID</div><div class="col">CENA</div><div class="col">STAV</div><div class="col">ZÁKAZNÍK</div><div class="col"></div></div>
                    <?php foreach ($model["zakazkyAll"] as $zakazka){ ?>
                        <div class="row">
                        <div class="col"><?= $zakazka->id ?></div>
                        <div class="col"><?= $zakazka->cena ?></div>
                        <div class="col"><?= $zakazka->objStav->nazev ?></div>
                        <div class="col"><?= $zakazka->objZakaznik->jmeno." ".$zakazka->objZakaznik->prijmeni ?></div>                           
                        <div class="col"><button class="det-but btn" data-hidden-value="<?= $zakazka->id ?>">Detail</button></div>
                        </div>
                    <?php }
                        for($i = 0; $i < 30; $i++){
                    ?>  
                    <div class="row">
                        <div class="col"><?= $model["zakazkyAll"][2]->id ?></div>
                        <div class="col"><?= $model["zakazkyAll"][2]->cena ?></div>
                        <div class="col"><?= $model["zakazkyAll"][2]->objStav->nazev ?></div>
                        <div class="col"><?= $model["zakazkyAll"][2]->objZakaznik->jmeno." ".$model["zakazkyAll"][2]->objZakaznik->prijmeni ?></div>                           
                        <div class="col"><button class="det-but btn" data-hidden-value="<?= $model["zakazkyAll"][2]->id ?>">Detail</button></div>
                        </div>
                    <?php } ?>  
                </div>
            </div>

            <div id="zakazka-detail" class="col detail collapse sticky-top">
                <form action="zakazky.php" method="post" onsubmit="return confirmSubmit()" data-bs-theme="dark">
                    <div class="d-flex justify-content-center mb-3">
                        <div class="detail-form">
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
                                    <div id="zakaznikDiv" class="col">Zákazník</div>
                                    <div id="selectZakaznikDiv" class="col input-group"><select id="zakaznik" name="zakaznik" class="form-select">
                                            <?php foreach ($model["zakaznici"] as $zakaznik): ?>
                                                <option value="<?= $zakaznik->id ?>"><?= $zakaznik->jmeno ?> <?= $zakaznik->prijmeni ?></option>                                    
                                            <?php endforeach; ?>
                                        </select>
                                        <button id="addNewZakaznik" type="button" class="blue-but-outline btn">Vytvořit</button>
                                    </div>
                                    <div id="newZakaznikDiv" class="col input-group" style="display: none;">
                                        <input id="newZakaznikInput" class="form-control" type="text" readonly>
                                        <button id="removeNewZakaznik" type="button" class="blue-but-outline btn">Zrušit</button>
                                    </div>
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
                                <div class="row">
                                    <div class="col">Heslo</div><div class="col"><input class="form-control" type="text" name="heslo" id="heslo"></div>
                                </div>
                                <div id="zboziForm" style="display:flex; flex-direction:column; gap: 0.3rem">
                                </div>           
                                <div class="row" style="justify-content: center; gap: 0.5rem">                             
                                    <div class="col" style="max-width: fit-content;"><button type="button" id="addItemBtn" class="blue-but-outline btn">Přidat zboží ze skladu</button>
                                    <button type="button" id="addNewZbozi" class="blue-but-outline btn">Vytvořit nové zboží</button></div>
                                </div>
                                
                                <div class="row justify-content-center">
                                    <div class="col input-group" style="max-width: fit-content;">
                                        <div class="input-group-text">
                                            <input type="checkbox" name="vratit" value="true" checked>
                                        </div>
                                        <div class="input-group-text">
                                            <label for="vratit">Vrátit zboží do skladu při smazání</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col" style="max-width: fit-content;"><input class="edit-but btn" type="submit" name="upravit" value="Upravit" id="edit-but">&nbsp;<button class="del-but btn" formaction="zakazky.php" name="smazat" value="Smazat" id="del-but">Smazat</button></div>
                                </div>
                        </div>
                    </div>
                </form>
            </div>

        <div class="modal fade" data-bs-theme="dark" id="newZboziModal" tabindex="-1" role="dialog" aria-labelledby="newZboziModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="display-6 modal-title" id="exampleModalLabel">Nové zboží</h5>
                </div>
                <div class="modal-body">
                    <form>
                    
                        <div class="row">
                            <div class="col-md-5">Název zboží</div>
                            <div class="col"><input class="form-control" type="text" id="newNazevM"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">Počet v zakázce</div>                    
                            <div class="input-group col">
                                <input class="form-control" type="number" min="0" value="0" id="newMnozstviM">
                                <select id="newJednotkaM" class="form-select"><option value="ks">ks</option><option value="g">g</option><option value="m">m</option></select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">Seriové číslo</div>
                            <div class="col"><input class="form-control" type="text" id="sercisM"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">Záruka</div>
                            <div class="input-group col">
                                <input class="form-control" type="number" min="0" id="zarukaM" required>
                                <span class="input-group-text">Měsíců</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">Nákupní cena</div>
                            <div class="col"><input class="form-control" type="number" min="0" step=".001" id="cena1M" required></div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">Prodejní cena</div>
                            <div class="col"><input class="form-control" type="number" min="0" step=".001" id="cena2M" required></div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">Datum zakoupení</div>
                            <div class="col"><input class="form-control" type="date" id="datumZboM" required></div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">DPH</div>
                            <div class="input-group col">
                                <select id="dphZboM" class="form-select"><option value="15">15</option><option value="12">12</option></select>
                            <span class="input-group-text">%</span>       
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">Zakoupeno</div>
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

<div class="modal fade" data-bs-theme="dark" id="newZakaznikModal" tabindex="-1" role="dialog" aria-labelledby="newZakaznikModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="display-6 modal-title" id="exampleModalLabel">Nový Zákazník</h5>
                </div>
                <div class="modal-body">
                    <form id="newZakForm">
                        <div class="row">
                            <div class="col">Jméno</div><div class="col"> <input id="zakJmeno" class="form-control" type="text" name="jmeno" required></div>
                        </div>
                        <div class="row">
                            <div class="col">Příjmení</div><div class="col"> <input id="zakPrijmeni" class="form-control" type="text" name="prijmeni" required></div>
                        </div>
                        <div class="row">
                            <div class="col">Firma</div><div class="col"> <input id="firma" class="form-control" type="text" name="firma"></div>
                        </div>
                        <div class="row">
                            <div class="col">IČO</div><div class="col"> <input id="ico" class="form-control" type="text" name="ico"></div>
                        </div>
                        <div class="row">
                            <div class="col">Město</div><div class="col"> <input id="mesto" class="form-control" type="text" name="mesto"></div>
                        </div>
                        <div class="row">
                            <div class="col">Ulice a číslo popisné</div><div class="col"><input id="ulice" class="form-control" type="text" name="ulice"></div>
                            <div class="col"><input id="cp" class="form-control" type="number" name="cp"></div>
                        </div>
                        <div class="row">
                            <div class="col">PSČ</div><div class="col"><input id="psc" class="form-control" type="number" name="psc"></div>
                        </div>
                        <div class="row">
                            <div class="col">Telefoní číslo</div><div class="col"> <input id="tel" class="form-control" type="text" name="tel"></div>
                        </div>
                        <div class="row">
                            <div class="col">Email</div><div class="col"> <input id="email" class="form-control" type="email" name="email"></div>
                        </div>
                        <div class="row">
                            <div class="col">Poznámka</div><div class="col"> <textarea id="pozn" class="form-control" name="pozn"></textarea></div>
                        </div>                   
                        </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModalZakaznik">Zpět</button>
                    <button type="button" class="btn btn-primary" id="saveModalZakaznik">Vložit</button>
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

        let $zboziKomponenta = `<div class="zboziRow row"><div class="col-md-2">Zboží:</div><div class="col input-group"><select class="form-select" name="zboziId[]"><?php foreach ($model["zbozi"] as $zbozi){ if($zbozi->mnozstvi > 0){ ?><option value="<?= $zbozi->id ?>"><?= $zbozi->nazev ?></option><?php }}; ?></select><input class="form-control" type="number" name="zboziPocet[]" min="1" max="<?php echo $model["zbozi"][0]->mnozstvi ?>" required><button type="button" class="delItemBtn btn btn-danger">Smazat polozku</button></div></div>`;              
        let zakazkyAll = <?php echo json_encode($model["zakazkyAll"]); ?>;
        let post = <?php echo json_encode($_POST); ?>;
        insertValuesFiltry();
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
                $('#heslo').val(zakazka.heslo);
                


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
                
                $("#zboziForm").append(`<div class="zboziRow row"><div class="col-md-2">Zboží:</div><div class="col input-group"><input type="hidden" name="zboziId[]" value="${zbozi.id}"><input type="text" class="form-control" value="${zbozi.nazev}"><input class="form-control " type="number" name="zboziPocet[]" value="${zbozi.mnozstvi}" max="${selectedZboziMaxMnozstvi}" required><button type="button" class="delItemBtn btn btn-danger">Smazat polozku</button></div></div>`);              
                });
                $(document).ready(function(){
                    $("#zakazka-detail").collapse("show");
                });
        }
        insertValuesDetail();
        $(document).ready(function(){
            $("#addItemBtn").click(function(e){
                
                $("#zboziForm").append($zboziKomponenta);
                
            }); 
            $("#addNewZakaznik").click(function(e){
                
                $("#newZakaznikModal").modal("show");
            });
            $("#closeModalZakaznik").click(function(e){
                
                $("#newZakaznikModal").modal("hide");
            });
            $("#saveModalZakaznik").click(function(e){
                $("#selectZakaznikDiv").append(`
                        <div class="zakFormHidden">
                            <input type="text" name="jmeno" value="${$("#zakJmeno").val()}" hidden>                        
                            <input type="text" name="prijmeni" value="${$("#zakPrijmeni").val()}" hidden>                     
                            <input type="text" name="firma" value="${$("#firma").val()}" hidden>                 
                            <input type="text" name="ico" value="${$("#ico").val()}" hidden>                       
                            <input type="text" name="mesto" value="${$("#mesto").val()}" hidden>                     
                            <input type="text" name="ulice" value="${$("#ulice").val()}" hidden>
                            <input type="number" name="cp" value="${$("#cp").val()}" hidden>                      
                            <input type="number" name="psc" value="${$("#psc").val()}" hidden>                       
                            <input type="text" name="tel" value="${$("#tel").val()}" hidden>                       
                            <input type="email" name="email" value="${$("#email").val()}" hidden>                       
                            <textarea name="pozn" hidden>${$("#pozn").val()}</textarea>
                        </div>`);
                $("#newZakaznikInput").val($("#zakJmeno").val() +" "+ $("#zakPrijmeni").val());
                $("#newZakaznikModal").modal("hide");
                $("#selectZakaznikDiv").hide();
                $("#newZakaznikDiv").show();
            });
            $("#removeNewZakaznik").click(function(e){
                
                $('.zakFormHidden').remove();
                $("#newZakForm")[0].reset();
                $("#selectZakaznikDiv").show();
                $("#newZakaznikDiv").hide();
            });
            $("#addNewZbozi").click(function(e){
                
                $("#newZboziModal").modal("show");
            });
            $("#closeModal").click(function(e){
                
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
                $("#zakazka-detail").collapse('hide');
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
                
                let zbozi = $(this).parent().parent().parent().parent();
                $(zbozi).remove();             
        });

        $(document).on('click', '.delItemBtn', function(e){
                
                let zbozi = $(this).parent().parent();
                $(zbozi).remove();             
        });
        
    
        /*
        $("#zakazkaForm").submit(function(e){
            
            $("#submitBtn").val('Přidávání...');
            $.ajax({
                url: 'pridatZakazku.php',
                method: 'post',
                data: $(this).serialize()
            });
        });*/
    </script>
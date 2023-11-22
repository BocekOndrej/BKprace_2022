<h3 class="display-5" align="center">Přidat novou zakázku</h3>
<form action="pridatZakazku.php" method="post" data-bs-theme="dark">
    <div class="d-flex justify-content-center mb-3">
                        <div class="detail-form">         
                                <div class="row">
                                    <div class="col">Datum začátku</div><div class="col"><input class="form-control" type="date" name="datum_zac" id="datum_zac"></div>
                                </div>
                                <div class="row">
                                    <div class="col">Datum konce</div><div class="col"><input class="form-control" type="date" name="datum_konec" id="datum_konec"></div>
                                </div>
                                <div class="row">
                                    <div id="zakaznikDiv" class="col">Zákazník</div>
                                    <div id="selectZakaznikDiv" class="col input-group">
                                    <?php if (!empty($model["zakaznici"])) {?>
                                        <select id="zakaznik" name="zakaznik" class="form-select">
                                            <?php foreach ($model["zakaznici"] as $zakaznik): ?>
                                                <option value="<?= $zakaznik->id ?>"><?= $zakaznik->jmeno ?> <?= $zakaznik->prijmeni ?></option>                                    
                                            <?php endforeach; ?>
                                        </select>
                                        <?php }?>
                                        <button id="addNewZakaznik" type="button" class="blue-but-outline btn" style="padding: 0.1rem !important;"><i class="bi-plus" style="font-size: 2rem;"></i></button>
                                    </div>
                                    <div id="newZakaznikDiv" class="col input-group" style="display: none;">
                                        <input id="newZakaznikInput" class="form-control" type="text" readonly>
                                        <button id="removeNewZakaznik" type="button" class="red-but btn-danger btn" style="padding: 0.7rem !important;"><i class="bi-x-lg" style="font-size: 1rem;"></i></button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">Cena bez DPH</div><div class="col"><input class="form-control" type="number" id="cena" step=".01" name="cena" required></div>
                                </div>
                                <div class="row">
                                    <div class="col">Cena s DPH</div><div class="col"><input class="form-control" type="number" step=".01" id="cenaDPH" ></div>
                                </div>
                                <div class="row">
                                    <div class="col">DPH</div><div class="col input-group"><select class="form-select" id="dph" name="dph">
                                                        <option value="21">21</option>
                                                        <option value="15">15</option>
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
                                </div>           
                                <div class="row" style="justify-content: center; gap: 0.5rem">                             
                                    <div class="col" style="max-width: fit-content;">
                                    <?php if (!empty($model["zbozi"])) {?>
                                    <button type="button" id="addItemBtn" class="blue-but-outline btn">Přidat zboží ze skladu</button>
                                    <?php }?>
                                    <button type="button" id="addNewZbozi" class="blue-but-outline btn">Vytvořit nové zboží</button></div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col" style="max-width: fit-content;"><input class="edit-but btn" type="submit" name="pridat" value="Přidat" id="edit-but"></div>
                                </div>
                        </div>
                    </div>
    </form>

    <div class="modal fade" data-bs-theme="dark" id="newZboziModal" tabindex="-1" role="dialog" aria-labelledby="newZboziModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="display-6 modal-title" id="exampleModalLabel">Nové zboží</h5>
                </div>
            <div class="modal-body">
                <form id="myForm">
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
                            <select id="dphZboM" class="form-select"><option value="21">21</option><option value="15">15</option></select>
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
                    <button type="button" class="btn blue-but-outline" data-dismiss="modal" id="closeModal">Zpět</button>
                    <button type="button" class="btn blue-but" id="saveModal">Vložit</button>
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
                            <div class="col">Telefonní číslo</div><div class="col"> <input id="tel" class="form-control" type="text" name="tel"></div>
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
                    <button type="button" class="btn blue-but-outline" data-dismiss="modal" id="closeModalZakaznik">Zpět</button>
                    <button type="button" class="btn blue-but" id="saveModalZakaznik">Vložit</button>
                </div>
                </div>             
            </div>
        </div>


    <script>      
        //komponenta pro již existující zboží ze skladu
        let $zboziKomponenta = `<div class="zboziRow row"><div class="col-md-2">Zboží:</div><div class="col input-group"><select class="form-select" name="zboziId[]"><?php foreach ($model["zbozi"] as $zbozi): ?><option value="<?= $zbozi->id ?>"><?= $zbozi->nazev ?></option><?php endforeach; ?></select><input class="form-control" type="number" name="zboziPocet[]" max="<?php echo $model["zbozi"][0]->mnozstvi; ?>" required><button type="button" class="delItemBtn btn btn-danger">Smazat polozku</button></div></div>`;              
        
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
                    //vytvoření komponenty se skrytými daty pro tvorbu nového zákazníka
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
                    //vytvoření komponenty se skrytými daty pro tvorbu nového zboží
                    $("#zboziForm").prepend(`<div class="row"><div class="col-md-2">Zboží:</div><div class="col input-group"><input class="form-control" type="text" name="newNazev[]" value="${$("#newNazevM").val()}" readonly><input class="form-control" type="number" value="${$("#newMnozstviM").val()}" name="newMnozstvi[]" readonly><input name="newJednotka[]" type="hidden" value="${$("#newJednotkaM").val()}"><input type="hidden" name="sercis[]" value="${$("#sercisM").val()}"><input type="hidden" name="zaruka[]" value="${$("#zarukaM").val()}"><input type="hidden" name="cena1[]" value="${$("#cena1M").val()}"><input type="hidden" name="cena2[]" value="${$("#cena2M").val()}"><input type="hidden" name="datumZbo[]" value="${$("#datumZboM").val()}"><input name="dphZbo[]" type="hidden" value="${$("#dphZboM").val()}"><input type="hidden" name="obchod[]" value="${$("#obchodM").val()}"><button type="button" class="delItemBtn btn btn-danger">Smazat polozku</button></div>`);

                    $("#newZboziModal").modal("hide");
                    $("#myForm")[0].reset();
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
                dopocetDPH();
                $(document).on('click', '.delNewItemBtn', function(e){
                        
                        let zbozi = $(this).parent().parent().parent().parent();
                        $(zbozi).remove();             
                });

                $(document).on('click', '.delItemBtn', function(e){
                        
                        let zbozi = $(this).parent().parent();
                        $(zbozi).remove();             
                });
            });
    </script>



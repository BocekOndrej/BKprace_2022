<button id="addZbozi" class="add-but btn">Přidat zboží</button>
<?php if ($model != null) { ?>
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
                <form action="sklad.php" method="post">
                    Řazení: <select id="orderby" class="form-control" name="orderby">
                            <option value="id">ID</option>
                            <option value="nazev">NÁZEV</option>
                            <option value="datum">DATUM ZAKOUPENÍ</option>
                            <option value="obchod">OBCHOD</option>
                            <option value="cena2">PRODEJNÍ CENA</option>
                            
                    </select>
                    Vyhledávání: <input id="hledat" class="form-control" type="text" name="hledat">
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
            <div class='row header'><div class="col">Název</div><div class="col">Množství</div><div class="col">Datum zakoupení</div><div class="col">Obchod</div><div class="col">Prodejní cena</div><div class="col"></div></div>
            <?php foreach($model["zbozi"] as $polozka) : ?>
                <div class='row'>
                <div class="col"><?= $polozka->nazev ?></div>
                <div class="col"><?= $polozka->mnozstvi ?> <?= $polozka->jednotka ?></div>
                <div class="col"><?= $polozka->datum ?></div>
                <div class="col"><?= $polozka->obchod ?></div>
                <div class="col"><?= $polozka->cena2 ?></div>
                <div class="col"><button class="det-but btn" data-hidden-value="<?= $polozka->id ?>">Detail</button></div>
                </div>
            <?php endforeach; ?>
        </div>   
    </div>                  
    <div id="zbozi-detail" class="col detail collapse sticky-top">
        <form action="sklad.php" method="post" onsubmit="return confirmSubmit()" data-bs-theme="dark">
            <div class="d-flex justify-content-center mb-3">
                <div class="detail-form">
                    <div class="row" style="justify-content: end;">
                        <div class="col" style="max-width: fit-content;"><button type="button" id="detailClose" class="blue-but-outline btn">Zavřít</button></div>
                    </div>
                    <div class="row">
                        <div class="col">ID</div><div class="col-md-8"><input id="id" type="text" name="id" readonly class="form-control"></div>
                    </div>
                    <div class="row">
                        <div class="col">Název</div><div class="col-md-8"><input id="nazev" type="text" name="nazev" class="form-control"></div>
                    </div>
                    <div class="row">
                        <div class="col">Množství</div><div class="col-md-8">
                            <div class="input-group"><input id="mnozstvi" type="number" name="mnozstvi" min="0" class="form-control">
                                <select id="jednotka" name="jednotka" class="form-select">
                                    <option value="ks">ks</option>
                                    <option value="g" >g</option>
                                    <option value="m" >m</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">Seriové číslo</div><div class="col-md-8"><input id="sercis" type="text" name="sercis" class="form-control"></div>
                    </div>
                    <div class="row">
                        <div class="col">Záruka</div><div class="col-md-8"><input id="zaruka" type="number" name="zaruka" min="0" class="form-control"></div>
                    </div>
                    <div class="row">
                        <div class="col">Nákupní cena</div><div class="col-md-8"><input id="cena1" type="number" name="cena1" min="0" step=".001" class="form-control"></div>
                    </div>
                    <div class="row">
                        <div class="col">Prodejní cena</div><div class="col-md-8"><input id="cena2" type="number" name="cena2" min="0" step=".001" class="form-control"></div>
                    </div>
                    <div class="row">
                        <div class="col">Datum zakoupení</div><div class="col-md-8"><input id="datum" type="date" name="datum" class="form-control"></div>
                    </div>
                    <div class="row">
                        <div class="col">Obchod</div><div class="col-md-8"><input id="obchod" type="text" name="obchod" class="form-control"></div>
                    </div>
                    <div class="row">
                        <div class="col">DPH</div><div class="col-md-8">
                            <div class="input-group"><select class="form-select" id="dph" name="dph">
                                                <option value="15">15</option>
                                                <option value="12">12</option>
                                            </select><span class="input-group-text">%</span></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">Poznámka</div><div class="col-md-8"><textarea id="pozn" name="pozn" class="form-control"></textarea></div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col" style="max-width: fit-content;"><input class="edit-but btn" type="submit" name="upravit" value="Upravit" id="edit-but">&nbsp;<button class="del-but btn" formaction="sklad.php" name="smazat" value="Smazat" id="del-but">Smazat</button></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<div class="modal fade" data-bs-theme="dark" id="newZboziModal" tabindex="-1" role="dialog" aria-labelledby="newZboziModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="display-6 modal-title" id="exampleModalLabel">Nové Zboží</h5>
                </div>
                <div class="modal-body">
                    <form action="sklad.php" method="post">
                    <div class="row">
                            <div class="col-md-5">Název zboží</div>
                            <div class="col"><input class="form-control" type="text" name="nazev" ></div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">Počet v zakázce</div>                    
                            <div class="input-group col">
                                <input name="mnozstvi" class="form-control" type="number" min="0" value="0">
                                <select name="jednotka" class="form-select"><option value="ks">ks</option><option value="g">g</option><option value="m">m</option></select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">Seriové číslo</div>
                            <div class="col"><input name="sercis" class="form-control" type="text"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">Záruka</div>
                            <div class="input-group col">
                                <input name="zaruka" class="form-control" type="number" min="0" required>
                                <span class="input-group-text">Měsíců</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">Nákupní cena</div>
                            <div class="col"><input name="cena1" class="form-control" type="number" min="0" step=".001" required></div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">Prodejní cena</div>
                            <div class="col"><input name="cena2" class="form-control" type="number" min="0" step=".001" required></div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">Datum zakoupení</div>
                            <div class="col"><input name="datum" class="form-control" type="date" required></div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">DPH</div>
                            <div class="input-group col">
                                <select name="dph" class="form-select"><option value="15">15</option><option value="12">12</option></select>
                            <span class="input-group-text">%</span>       
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">Zakoupeno</div>
                            <div class="col"><input name="obchod" class="form-control" type="text" required></div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">Poznámka</div><div class="col"><textarea class="form-control" name="pozn"></textarea></div>
                        </div>                                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModal">Zpět</button>
                    <input type="submit" name="pridat" value="Vložit zboží" class="btn btn-primary" id="saveModal"></input>
                </div>
                </form>
                </div>             
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
        let post = <?php echo json_encode($_POST); ?>;
        insertValuesFiltry();
        let zbozi = <?php echo json_encode($model["zbozi"]); ?>;
        function viewDetail(id){
                const polozka = zbozi.find(obj => obj.id.toString() === id.toString());
                $('#id').val(id);
                $('#nazev').val(polozka.nazev);
                $('#mnozstvi').val(polozka.mnozstvi);
                $('#jednotka').val(polozka.jednotka);
                $('#sercis').val(polozka.sercis);
                $('#zaruka').val(polozka.zaruka);
                $('#cena1').val(polozka.cena1);
                $('#cena2').val(polozka.cena2);
                $('#date').val(polozka.date);
                $('#obchod').val(polozka.obchod);
                $('#dph').val(polozka.DPH);
                $('#pozn').val(polozka.pozn);
                             
                $(document).ready(function(){
                    $("#zbozi-detail").collapse("show");
                });
        }
        insertValuesDetail();
        $(document).ready(function(){
            

            $(".det-but").click(function() { 
                var id = $(this).data("hidden-value");
                viewDetail(id);
            });        
            $("#detailClose").click(function() {
                $("#zbozi-detail").collapse('hide');
            });  

            $("#addZbozi").click(function(e){
                e.preventDefault();
                $("#newZboziModal").modal("show");
            });
            $("#closeModal").click(function(e){
                e.preventDefault();
                $("#newZboziModal").modal("hide");
            });

        });
</script>
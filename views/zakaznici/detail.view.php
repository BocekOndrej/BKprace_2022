<button id="addZakaznik" class="add-but btn">Přidat zákazníka</button>
<?php if ($model["zakaznici"] != null) { ?>
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
                <form action="zakaznici.php" method="post">
                    Řazení: <select class="form-control" name="orderby">
                            <option value="id">ID</option>
                            <option value="jmeno">JMÉNO</option>
                            <option value="prijmeni">PŘÍJMENÍ</option>
                            <option value="firma">FIRMA</option>
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
            <div class='row header'><div class="col">ID</div><div class="col">Jméno</div><div class="col">Příjmení</div><div class="col">Firma</div><div class="col"></div></div>
            <?php foreach($model["zakaznici"] as $polozka) { ?>
                <div class='row'>
                <div class="col"><?= $polozka->id ?></div>
                <div class="col"><?= $polozka->jmeno ?></div>
                <div class="col"><?= $polozka->prijmeni ?></div>
                <div class="col"><?= $polozka->firma ?></div>
                <div class="col"><button class="det-but btn" data-hidden-value="<?= $polozka->id ?>">Detail</button></div>
                </div>
            <?php } ?>  
        </div>             
    </div>
        <div id="zakaznik-detail" class="col detail collapse sticky-top">
            <form action="zakaznici.php" method="post" onsubmit="return confirmSubmit()" data-bs-theme="dark">
                <div class="d-flex justify-content-center">
                    <div class="detail-form">
                        <div class="row" style="justify-content: end;">
                            <div class="col" style="max-width: fit-content;"><button type="button" id="detailClose" class="blue-but-outline btn">Zavřít</button></div>
                        </div>
                        <div class="row">
                            <div class="col">ID</div><div class="col"><input id="id" class="form-control" type="text" name="id" readonly></div>
                        </div>
                        <div class="row">
                            <div class="col">Jméno</div><div class="col"> <input id="jmeno" class="form-control" type="text" name="jmeno" required></div>
                        </div>
                        <div class="row">
                            <div class="col">Příjmení</div><div class="col"> <input id="prijmeni" class="form-control" type="text" name="prijmeni" required></div>
                        </div>
                        <div class="row">
                            <div class="col">Firma</div><div class="col"> <input id="firma" class="form-control" type="text" name="firma"></div>
                        </div>
                        <div id="icoDivDetail" class="collapse row">
                            <div class="col">IČO</div><div class="col"> <input id="ico" class="form-control" type="text" name="ico"></div>
                        </div>
                        <div class="row">
                            <div class="col">Město</div><div class="col"> <input id="mesto" class="form-control" type="text" name="mesto"></div>
                        </div>
                        <div id="adrDivDetail" class="collapse">
                            <div class="row">
                                <div class="col">Ulice a číslo popisné</div><div class="col"><input id="ulice" class="form-control" type="text" name="ulice"></div>
                                <div class="col"><input id="cp" class="form-control" type="number" name="cp"></div>
                            </div>
                            <div class="row">
                                <div class="col">PSČ</div><div class="col"><input id="psc" class="form-control" type="number" name="psc"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">Telefoní číslo</div><div class="col"><input id="tel" class="form-control" type="text" name="tel"></div>
                        </div>
                        <div class="row">
                            <div class="col">Email</div><div class="col"> <input id="email" class="form-control" type="email" name="email"></div>
                        </div>
                        <div class="row">
                            <div class="col">Poznámka</div><div class="col"><textarea id="pozn" class="form-control" name="pozn"></textarea></div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col" style="max-width: fit-content;"><input class="edit-but btn" type="submit" name="upravit" value="Upravit" id="edit-but">&nbsp;<button class="del-but btn" formaction="zakazky.php" name="smazat" value="Smazat" id="del-but">Smazat</button></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<div class="modal fade" data-bs-theme="dark" id="newZakaznikModal" tabindex="-1" role="dialog" aria-labelledby="newZakaznikModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="display-6 modal-title" id="exampleModalLabel">Nový Zákazník</h5>
                </div>
                <div class="modal-body">
                    <form action="zakaznici.php" method="post">
                        <div class="row">
                            <div class="col">Jméno</div><div class="col"> <input class="form-control" type="text" name="jmeno" required></div>
                        </div>
                        <div class="row">
                            <div class="col">Příjmení</div><div class="col"> <input class="form-control" type="text" name="prijmeni" required></div>
                        </div>
                        <div class="row">
                            <div class="col">Firma</div><div class="col"><input id="firmaAdd" class="form-control" type="text" name="firma"></div>
                        </div>
                        <div id="icoDiv" class="collapse row">
                            <div class="col">IČO</div><div class="col"> <input class="form-control" type="text" name="ico"></div>
                        </div>
                        <div class="row">
                            <div class="col">Město</div><div class="col"> <input id="mestoAdd" class="form-control" type="text" name="mesto"></div>
                        </div>
                        <div id="adrDiv" class="collapse">
                            <div class="row">
                                <div class="col">Ulice a číslo popisné</div><div class="col"><input class="form-control" type="text" name="ulice"></div>
                                <div class="col"><input class="form-control" type="number" name="cp"></div>
                            </div>
                            <div class="row">
                                <div class="col">PSČ</div><div class="col"><input class="form-control" type="number" name="psc"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">Telefoní číslo</div><div class="col"> <input class="form-control" type="text" name="tel"></div>
                        </div>
                        <div class="row">
                            <div class="col">Email</div><div class="col"> <input class="form-control" type="email" name="email"></div>
                        </div>
                        <div class="row">
                            <div class="col">Poznámka</div><div class="col"> <textarea class="form-control" name="pozn"></textarea></div>
                        </div>                   
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModal">Zpět</button>
                    <input type="submit" name="pridat" value="Vložit zákazníka" class="btn btn-primary" id="saveModal"></input>
                </div>
                </form>
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
        let post = <?php echo json_encode($_POST); ?>;
        insertValuesFiltry();
        let zakaznici = <?php echo json_encode($model["zakaznici"]); ?>;
        function viewDetail(id){
                const zakaznik = zakaznici.find(obj => obj.id.toString() === id.toString());
                $('#id').val(id);
                $('#jmeno').val(zakaznik.jmeno);
                $('#prijmeni').val(zakaznik.prijmeni);
                $('#firma').val(zakaznik.firma);
                $('#ico').val(zakaznik.ICO);
                $('#mesto').val(zakaznik.mesto);
                $('#ulice').val(zakaznik.ulice);
                $('#cp').val(zakaznik.CP);
                $('#psc').val(zakaznik.PSC);
                $('#tel').val(zakaznik.tel);
                $('#email').val(zakaznik.email);
                $('#pozn').val(zakaznik.pozn);
            
                $(document).ready(function(){
                    $("#zakaznik-detail").collapse("show");
                });

                if($("#mesto").val() != ""){
                    $("#adrDivDetail").collapse('show');   
                }else {
                    $("#adrDivDetail").collapse('hide');  
                }
                if($("#firma").val() != ""){
                    $("#icoDiv").collapse('show');   
                }else{
                    $("#icoDiv").collapse('hide');
                }
        }
        insertValuesDetail();
        

        $(document).ready(function(){

            $(".det-but").click(function() { 
                var id = $(this).data("hidden-value");
                viewDetail(id);
            });        
            $("#detailClose").click(function() {
                $("#zakaznik-detail").collapse('hide');
            });  

            $("#addZakaznik").click(function(e){
                e.preventDefault();
                $("#newZakaznikModal").modal("show");
            });
            $("#closeModal").click(function(e){
                e.preventDefault();
                $("#newZakaznikModal").modal("hide");
            });

            $(document).on('change', '#firmaAdd', function() {
                if($("#firmaAdd").val() != ""){
                    $("#icoDiv").collapse('show');   
                }
                else {
                    $("#icoDiv").collapse('hide'); 
                }      
            });
            $(document).on('change', '#mestoAdd', function() {
                if($("#mestoAdd").val() != ""){
                    $("#adrDiv").collapse('show');   
                }
                else {
                    $("#adrDiv").collapse('hide'); 
                }      
            });

            $(document).on('change', '#firma', function() {
                if($("#firma").val() != ""){
                    $("#icoDivDetail").collapse('show');   
                }
                else {
                    $("#icoDivDetail").collapse('hide'); 
                }      
            });
            $(document).on('change', '#mesto', function() {
                if($("#mesto").val() != ""){
                    $("#adrDivDetail").collapse('show');   
                }
                else {
                    $("#adrDivDetail").collapse('hide'); 
                }      
            });
        });


</script>
        
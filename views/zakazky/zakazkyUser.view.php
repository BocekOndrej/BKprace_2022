<?php if (!empty($model["zakazkyAll"])) { ?>
    <div class="media-wrapper row" style="margin-top: 2rem;">
            <div class="col">
                <div class="prehled-tab container text-center">                
                    <div class='row header mobile-col'><div class="col">ID</div><div class="col">CENA</div><div class="col">STAV</div><div class="col"></div></div>
                    <?php foreach ($model["zakazkyAll"] as $zakazka){ ?>
                        <div class="row mobile-col">
                        <div class="col"><?= $zakazka->id ?></div>
                        <div class="col"><?= $zakazka->cena ?></div>
                        <div class="col"><?= $zakazka->objStav->nazev ?></div>                          
                        <div class="col"><button class="det-but btn" data-hidden-value="<?= $zakazka->id ?>">Detail</button></div>
                        </div>
                    <?php } ?>  
                </div>
            </div>
    
            <div id="zakazka-detail" class="col detail collapse sticky-top">
                <form action="zakazky.php" method="post" onsubmit="return confirmSubmit()" data-bs-theme="dark">
                    <div class="d-flex justify-content-center mb-3">
                        <div class="detail-form">
                            <div class="row" style="justify-content: end;">
                                <div class="col" style="max-width: fit-content;"><button type="button" id="detailClose" class="red-but btn-danger btn" style="padding: 0.7rem !important;"><i class="bi-x-lg" style="font-size: 1rem;"></i></button></div>
                            </div>
                            <div class="row">
                                <div class="col">ID</div><div class="col"><input class="form-control" type="number" id="id" readonly></div>
                            </div>            
                            <div class="row">
                                <div class="col">Datum začátku</div><div class="col"><input class="form-control" type="date" id="datum_zac" readonly></div>
                            </div>
                            <div class="row">
                                <div class="col">Datum konce</div><div class="col"><input class="form-control" type="date" id="datum_konec" readonly></div>
                            </div>
                            <div class="row">
                                <div class="col">Cena</div><div class="col"><input class="form-control" type="number" id="cena" name="cena" readonly></div>
                            </div>
                            <div class="row">
                                <div class="col">Cena s DPH</div><div class="col"><input class="form-control" type="number" step=".01" id="cenaDPH" readonly></div>
                            </div>
                            <div class="row">
                                <div class="col">DPH</div><div class="col input-group"><input class="form-control" type="number" id="dph" readonly><label for="dph" class="input-group-text">%</laber></div>
                            </div>
                            <div class="row">
                                <div class="col">Stav</div>
                                <div class="col"><input class="form-control" type="text" id="stav" readonly></div>
                            </div>
                            <div class="row">
                                <div class="col">Poznámka pro zákazníka</div><div class="col"><textarea class="form-control" name="pozn1" id="pozn1" readonly></textarea></div>
                            </div>
                                <div id="zboziForm" style="display:flex; flex-direction:column; gap: 0.3rem">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
    </div>

<?php } else{ ?>
    <p class="display-1" style="text-align: center">Žádné zakázky nenalezeny</p>
<?php } ?>

<script>
        let zakazkyAll = <?php echo json_encode($model["zakazkyAll"]); ?>;
        //metoda vloží data do detailu a zobrazí ho
        function viewDetail(id){
                const zakazka = zakazkyAll.find(obj => obj.id.toString() === id.toString());
                $('#id').val(id);
                $('#datum_zac').val(zakazka.datum_zac);
                $('#datum_konec').val(zakazka.datum_konec);
                $('#zakaznik').val(zakazka.zakaznik);
                $('#cena').val(zakazka.cena);
                $('#dph').val(zakazka.dph);
                $('#stav').val(zakazka.objStav.nazev);
                $('#pozn1').val(zakazka.pozn1);
                $('#pozn2').val(zakazka.pozn2);
                $('#heslo').val(zakazka.heslo);
                


                $('.zboziRow').remove();
                let zboziZakazky = zakazka.arrayZbozi;
                    zboziZakazky.forEach(function(zbozi){   
                let zboziCenaMnozstvi = zbozi.cena2 * zbozi.mnozstvi;    
                $("#zboziForm").append(`<div class="zboziRow row"><div class="col-md-2">Zboží:</div><div class="col input-group"><input type="hidden" name="zboziId[]" value="${zbozi.id}"><input type="text" class="form-control" value="${zbozi.nazev}" readonly><input class="form-control " type="number" name="zboziPocet[]" value="${zbozi.mnozstvi}" readonly><span class="input-group-text">${zbozi.jednotka}</span><span style="min-width: 6rem;" name="zboziCena[]" class="zboziCena input-group-text">${zboziCenaMnozstvi.toString() + " Kč"}</span></div></div>`);              
                });
                let cenaDPH = $("#cena").val() * (($("#dph").val() / 100) + 1);
                $("#cenaDPH").val(cenaDPH.toFixed(2));

                $(document).ready(function(){
                    $("#zakazka-detail").collapse("show");
                });
        }
        $(document).ready(function(){
            $(".det-but").click(function() { 
                var idZak = $(this).data("hidden-value");
                viewDetail(idZak);
            });        

            $("#detailClose").click(function() {
                $("#zakazka-detail").collapse('hide');
            });         
        });

</script>
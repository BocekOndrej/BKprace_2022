<div class="index-wrapper">
<span class="display-4 text-center my-4">Zadejte číslo objednávky</span>
<form action="zakazkyGuest.php" method="post">
    <div class="input-wrapper my-4" data-bs-theme="dark">
        <div class="row justify-content-center">
            <div class="col-md-4" style="font-size: 30;">ID</div>
            <div class="col-md-8">
                <input class="form-control" type="text" name="id" required>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4" style="font-size: 30;">HESLO</div>
            <div class="col-md-8">
                <input class="form-control" type="text" name="heslo" required>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col" style="max-width: fit-content;">
                <input style="font-size: 20;" class="btn blue-but" type="submit" name="zobrazit" value="Zobrazit">
            </div>
        </div>
    </div>
</form>
<?php if (isset($model["zakazka"])) { ?>
    <div class="d-flex justify-content-center mb-3" data-bs-theme="dark">
        <div class="detail-guest" style="border-top: 0.1rem solid var(--modra);">       
            <div class="row">
                <div class="col">Datum začátku</div>
                <div class="col">
                    <input class="form-control" type="date" name="datum_zac" id="datum_zac"
                     value="<?php echo $model["zakazka"]->datum_zac;?>"readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">Datum konce</div>
                <div class="col">
                    <input class="form-control" type="date" name="datum_konec" id="datum_konec"
                     value="<?php echo $model["zakazka"]->datum_konec;?>"readonly>
                    </div>
            </div>
            <div class="row">
                <div class="col">Cena</div>
                <div class="col">
                    <input class="form-control" type="number" id="cena" name="cena"
                     value="<?php echo $model["zakazka"]->cena;?>"readonly>
                    </div>
            </div>
            <div class="row">
                <div class="col">Cena s DPH</div>
                <div class="col">
                    <input class="form-control" type="number" step=".01" id="cenaDPH" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">DPH</div>
                <div class="col input-group">
                    <input class="form-control" type="number" id="dph" name="dph"
                     value="<?php echo $model["zakazka"]->dph;?>" readonly>
                    <label for="dph" class="input-group-text">%</laber>
                </div>
            </div>
            <div class="row">
                <div class="col">Stav</div>
                <div class="col">
                    <input class="form-control" type="text" name="id" 
                    value="<?php echo $model["zakazka"]->objStav->nazev;?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">Poznámka pro zákazníka</div>
                <div class="col">
                    <textarea class="form-control" name="pozn1" id="pozn1" readonly>
                        <?php echo $model["zakazka"]->pozn1;?></textarea>
                    </div>
            </div>
            <div id="zboziForm" style="display:flex; flex-direction:column; gap: 0.3rem">
            </div>           
        </div>
    </div>
<?php } ?>
</div>
<script>
    let zboziZakazky = <?php echo json_encode($model["zakazka"]->arrayZbozi); ?>;
        zboziZakazky.forEach(function(zbozi){
            let zboziCenaMnozstvi = zbozi.cena2 * zbozi.mnozstvi;
            $("#zboziForm").append(`<div class="zboziRow row"><div class="col-md-2">Zboží:</div>
            <div class="col input-group">
            <input type="hidden" name="zboziId[]" value="${zbozi.id}">
            <input type="text" class="form-control" value="${zbozi.nazev}" readonly>
            <input class="form-control " type="number" name="zboziPocet[]" value="${zbozi.mnozstvi}" readonly>
            <span class="input-group-text">${zbozi.jednotka}</span>
            <span style="min-width: 6rem;" name="zboziCena[]" class="zboziCena input-group-text">
            ${zboziCenaMnozstvi.toString() + " Kč"}</span></div>
            </div>`);
        });
        
        let cenaDPH = $("#cena").val() * (($("#dph").val() / 100) + 1);
        $("#cenaDPH").val(cenaDPH.toFixed(2));
</script>
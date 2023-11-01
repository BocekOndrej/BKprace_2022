<form action="zakazkyGuest.php" method="post">
    <div class="row">
        <div class="col">ID</div><div class="col"><input class="form-control" type="text" name="id" required></div>
    </div>
    <div class="row">
        <div class="col">HESLO</div><div class="col"><input class="form-control" type="text" name="heslo" required></div>
    </div>
    <div class="row">
        <div class="col-2"><input type="submit" name="zobrazit" value="Zobrazit"></div>
    </div>
</form>
<?php if (isset($model["zakazka"])) { ?>
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
                                <div class="col">Cena</div><div class="col"><input class="form-control" type="number" name="cena" value="<?php echo $model["zakazka"]->cena;?>" readonly></div>
                            </div>
                            <div class="row">
                                <div class="col">DPH</div><div class="col"><input class="form-control" type="number" name="dph" value="<?php echo $model["zakazka"]->dph;?>" readonly></div>
                            </div>
                            <div class="row">
                                <div class="col">Stav</div><div class="col"><input class="form-control" type="text" name="id" value="<?php echo $model["zakazka"]->stav;?>" readonly></div>
                            </div>
                            <div class="row">
                                <div class="col">Poznámka pro zákazníka</div><div class="col"><textarea class="form-control" name="pozn1" readonly><?php echo $model["zakazka"]->pozn1;?></textarea></div>
                            </div>
                            <div id="zboziForm">
                                <div class="row">                   
                                    <div class="col">Zboží:</div>           
                                </div>
                            </div>
                    </div>
                </div>
        <?php } ?>
<script>
    let zboziZakazky = <?php echo json_encode($model["zakazka"]->arrayZbozi); ?>;
        zboziZakazky.forEach(function(zbozi){
            console.log();
            $("#zboziForm").append(`<div class="row"><div class="col"><input type="hidden" name="zboziId[]" value="${zbozi.id}"><input type="text" value="${zbozi.nazev}" readonly></div><div class="col"><input class="form-control" type="number" name="zboziPocet[]" value="${zbozi.mnozstvi}" readonly></div></div>`);
        });
</script>
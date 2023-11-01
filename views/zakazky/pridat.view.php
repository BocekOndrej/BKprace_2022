    <form action="pridatZakazku.php" method="POST" id="zakazkaForm">
        <div class="add-form">
        <h1 class="add-headline display-6">Přidat novou zakázku</h1>
            <div class="">            
                    <div class="row">
                        <div class="col">Datum začátku</div><div class="col"><input class="form-control" type="date" name="datum" required></div>
                    </div>
                    <div class="row">
                        <div class="col">Zákazník</div>
                        <div class="col"><select name="zakaznik" class="form-control">
                                <?php foreach ($model["zakaznici"] as $zakaznik): ?>
                                    <option value="<?= $zakaznik->id ?>"><?= $zakaznik->jmeno ?> <?= $zakaznik->prijmeni ?></option>                                    
                                <?php endforeach; ?>
                            </select></div>
                    </div>
                    <div class="row">
                        <div class="col">Cena</div><div class="col"><input class="form-control" type="number" name="cena" required></div>
                    </div>
                    <div class="row">
                        <div class="col">DPH</div><div class="col"><select name="dph">
                                            <option value="15">15</option>
                                            <option value="12">12</option>
                                        </select>%</div>
                    </div>
                    <div class="row">
                        <div class="col">Stav</div>
                        <div class="col"><select name="stav" class="form-control">
                                <?php foreach ($model["stavy"] as $stav): ?>
                                    <option value="<?= $stav->id ?>"><?= $stav->nazev ?></option>                                    
                                <?php endforeach; ?>
                            </select></div>
                    </div>
                    <div class="row">
                        <div class="col">Poznámka pro zákazníka</div><div class="col"><textarea class="form-control" name="pozn1"></textarea></div>
                    </div>
                    <div class="row">
                        <div class="col">Poznámka pro firmu</div><div class="col"><textarea class="form-control" name="pozn2"></textarea></div>
                    </div>
                    <div id="zboziForm">
                        <div class="row">                   
                            <div class="col">Zboží:</div>            
                            <div class="col"><button class="addItemBtn btn btn-success">Přidat zboží ze skladu</button>
                                <button id="reg-but" class="newItemBtn btn">Vytvořit nové zboží</button></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col"><input style="width:50%" type="submit" name="submit" value="Vložit do skladu" id="submitBtn"></div>
                    </div>
            </div>
        </div>
    </form>

    <script>      
        let $zboziKomponenta = '<div class="row"><div class="col">Zboží:</div><div class="col"><select name="zboziId[]"><?php foreach ($model["zbozi"] as $zbozi): ?><option value="<?= $zbozi->id ?>"><?= $zbozi->nazev ?></option><?php endforeach; ?></select></div><div class="col"><input class="form-control" type="number" name="zboziPocet[]" required></div><div class="col"><button class="delItemBtn btn btn-danger">Smazat polozku</button></div></div>';              
        let $newZboziKomponenta = '<div class="row"><div class="col">Nové zboží</div><div class="col"><div class="row"><div class="col">Název zboží</div><div class="col"><input class="form-control" type="text" name="newNazev[]" required></div></div><div class="row"><div class="col">Počet v zakázce</div><div class="col"><input class="form-control" type="number" min="0" value="0" name="newMnozstvi[]"></div><div class="col"><select name="newJednotka[]"><option value="ks">ks</option><option value="g">g</option><option value="m">m</option></select></div></div><div class="row"><div class="col">Seriové číslo</div><div class="col"><input class="form-control" type="text" name="sercis[]"></div></div><div class="row"><div class="col">Záruka</div><div class="col"><input class="form-control" type="number" min="0" name="zaruka[]" required></div><div class="col">Měsíců</div></div><div class="row"><div class="col">Nákupní cena</div><div class="col"><input class="form-control" type="number" min="0" step=".001" name="cena1[]" required></div></div><div class="row"><div class="col">Prodejní cena</div><div class="col"><input class="form-control" type="number" min="0" step=".001" name="cena2[]" required></div></div><div class="row"><div class="col">Datum zakoupení</div><div class="col"><input class="form-control" type="date" name="datumZbo[]" required></div></div><div class="row"><div class="col">DPH</div><div class="col"><select name="dphZbo[]"><option value="15">15</option><option value="12">12</option></select>%</div></div><div class="row"><div class="col">Zakoupeno</div><div class="col"><input class="form-control" type="text" name="obchod[]" required><button class="delNewItemBtn btn btn-danger">Smazat polozku</button></div></div></div></div>';
        
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
    </script>



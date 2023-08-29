<a href="pridatZakazku.php" id="regi" class="btn">Přidat zakazku</a>
<?php if ($model != null) { ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">                
                <table class='w-100 sprava-tab'>
                <tr class='radek-clanky'><th>ID</th><th>cena</th><th>jmeno zakaznika</th><th>prijmeni</th><th>heslo</th><th>zbozi1</th></tr>
                <?php foreach ($model as $zakazka): ?>
                    <td><?= $zakazka->id ?></td>
                    <td><?= $zakazka->cena ?></td>
                    <td><?= $zakazka->objZakaznik->jmeno ?></td><td><?= $zakazka->objZakaznik->prijmeni ?></td>
                    <td><?= $zakazka->heslo ?></td>
                    <td><?= $zakazka->arrayZbozi[0]->id ?><?= $zakazka->arrayZbozi[0]->nazev ?><?= $zakazka->arrayZbozi[0]->mnozstvi ?></td>
                    <td><a href="zakazka.php?id=<?= $zakazka->id ?>" id="reg-but" class="btn">Detail</a></td>
                    </tr>
                    <?php endforeach; ?>
                </table>    
                </div>
        </div>
    </div>
<?php } else{ ?>
    <p class="display-1" style="text-align: center">Žádné zakázky nenalezeny</p>
<?php } ?> 
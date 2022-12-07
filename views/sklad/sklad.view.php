<a href="pridatZbozi.php" id="regi" class="btn">Přidat zboží</a>
<?php if ($model != null) { ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">                
                <table class='w-100 sprava-tab'>
                <tr class='radek-clanky'><th>ID</th><th>Název</th><th>Množství</th><th>Seriové číslo</th><th>Prodej</th><th>Datum zakoupení</th><th>Obchod</th><th>Poznámka</th></tr>
                <?php foreach ($model as $polozka): ?>
                    <td><?= $polozka->id ?></td>
                    <td><?= $polozka->nazev ?></td>
                    <td><?= $polozka->mnozstvi ?> <?= $polozka->jednotka ?></td>
                    <td><?= $polozka->sercis ?></td>
                    <td><?= $polozka->cena2 ?></td>
                    <td><?= $polozka->datum ?></td>
                    <td><?= $polozka->obchod ?></td>
                    <td><?= $polozka->pozn ?></td>
                    <td><a href="sklad.php?id=<?= $polozka->id ?>" id="reg-but" class="btn">Detail</a></td>
                    </tr>
                    <?php endforeach; ?>
                </table>    
                </div>
        </div>
    </div>
<?php } else{ ?>
    <p class="display-1" style="text-align: center">Sklad je prázdný</p>
    <?php } ?>  
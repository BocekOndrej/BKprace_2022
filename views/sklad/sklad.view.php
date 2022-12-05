<a href="pridatZbozi.php" id="regi" class="btn">Přidat zboží</a>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">                
                <table class='w-100 sprava-tab'>
                <tr class='radek-clanky'><th>ID</th><th>Název</th><th>Množství</th><th>Jednotka</th><th>Seriové číslo</th><th>Záruka</th><th>Nákup</th><th>Prodej</th><th>Datum zakoupení</th><th>Obchod</th><th>DPH</th><th>Poznámka</th><td></td><td></td></tr>
                <?php foreach($model as $polozka) : ?>
                    <td><?= $polozka->id ?></td>
                    <td><?= $polozka->nazev ?></td>
                    <td><?= $polozka->mnozstvi ?></td>
                    <td><?= $polozka->jednotka ?></td>
                    <td><?= $polozka->sercis ?></td>
                    <td><?= $polozka->zaruka ?></td>
                    <td><?= $polozka->cena1 ?></td>
                    <td><?= $polozka->cena2 ?></td>
                    <td><?= $polozka->datum ?></td>
                    <td><?= $polozka->obchod ?></td>
                    <td><?= $polozka->DPH ?></td>
                    <td><?= $polozka->pozn ?></td>
                    <td><a href="smazatZbozi.php?id=<?= $polozka->id ?>" class="btn">Smazat</a></td>
                    <td><a href="upravitZbozi.php?id=<?= $polozka->id ?>" class="btn">Upravit</a></td>
                    </tr>
                    <?php endforeach; ?>
                </table>    
                </div>
        </div>
    </div>
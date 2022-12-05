<a href="pridatZakaznika.php" id="regi" class="btn">Přidat zákazníka</a>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">                             
                <table class='w-100 sprava-tab'>
                <tr class='radek-clanky'><th>ID</th><th>Jméno</th><th>Příjmení</th><th>Firma</th><th>IČO</th><th>Město</th><th>Ulice</th><th>ČP</th><th>PSČ</th><th>Telefon</th><th>Email</th><th>Poznámka</th><td></td><td></td></tr>
                <?php foreach($model as $polozka) : ?>
                    <td><?= $polozka->id ?></td>
                    <td><?= $polozka->jmeno ?></td>
                    <td><?= $polozka->prijmeni ?></td>
                    <td><?= $polozka->firma ?></td>
                    <td><?= $polozka->ICO ?></td>
                    <td><?= $polozka->mesto ?></td>
                    <td><?= $polozka->ulice ?></td>
                    <td><?= $polozka->CP ?></td>
                    <td><?= $polozka->PSC ?></td>
                    <td><?= $polozka->tel ?></td>
                    <td><?= $polozka->email ?></td>
                    <td><?= $polozka->pozn ?></td>
                    <td><a href="smazatZakaznika.php?id=<?= $polozka->id ?>" class="btn">Smazat</a></td>
                    <td><a href="upravitZakaznika.php?id=<?= $polozka->id ?>" class="btn">Upravit</a></td>
                    </tr>
                    <?php endforeach; ?>
                </table>              
                </div>
        </div>
    </div>
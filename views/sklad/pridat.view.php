<h3 align="center">Přidat nové zboží</h3>
    <form action="pridatZbozi.php" method="POST">
        <div class="d-flex justify-content-center mb-3">
            <div class="d-inline-flex" id="reg">
                <table border = 1 align=center>
                    <tr>
                        <td>Název zboží</td><td colspan="2"><input class="form-control" type="text" name="nazev" required></td>
                    </tr>
                    <tr>
                        <td>Počet</td><td ><input class="form-control" type="number" min="0" value="0" name="mnozstvi" required></td>
                        <td><select name="jednotka">
                                <option value="ks">ks</option>
                                <option value="g">g</option>
                                <option value="m">m</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td>Seriové číslo</td><td colspan="2"><input class="form-control" type="text" name="sercis" required></td>
                    </tr>
                    <tr>
                        <td>Záruka</td><td ><input class="form-control" type="number" min="0" name="zaruka" required></td><td>Měsíců</td>
                    </tr>
                    <tr>
                        <td>Nákupní cena</td><td colspan="2"><input class="form-control" type="number" min="0" step=".001" name="cena1" required></td>
                    </tr>
                    <tr>
                        <td>Prodejní cena</td><td colspan="2"><input class="form-control" type="number" min="0" step=".001" name="cena2" required></td>
                    </tr>
                    <tr>
                        <td>Datum zakoupení</td><td colspan="2"><input class="form-control" type="date" name="datum" required></td>
                    </tr>
                    <tr>
                        <td>DPH</td><td><select name="dph">
                                            <option value="15">15</option>
                                            <option value="12">12</option>
                                        </select>%</td>
                    </tr>
                    <tr>
                        <td>Zakoupeno</td><td colspan="2"><input class="form-control" type="text" name="obchod" required></td>
                    </tr>
                    <tr>
                        <td>Poznámka</td><td colspan="2"><textarea class="form-control" name="pozn"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="3" align=center style="padding-top:20px" ><input style="width:50%" type="submit" name="submit" value="Vložit do skladu" id="reg-but"></td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
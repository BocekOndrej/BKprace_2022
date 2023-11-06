<h3 align="center">Přidat nové zboží</h3>
    <form action="pridatZbozi.php" method="POST">
        <div class="d-flex justify-content-center mb-3">
            <div class="d-inline-flex" id="reg">
                <table border = 1 align=center>
                    <div class="row">
                        <div class="col">Název zboží</div><div class="col" colspan="2"><input class="form-control" type="text" name="nazev" required></div>
                    </div>
                    <div class="row">
                        <div class="col">Počet</div><div class="col" ><input class="form-control" type="number" min="0" value="0" name="mnozstvi" required></div>
                        <div class="col"><select name="jednotka">
                                <option value="ks">ks</option>
                                <option value="g">g</option>
                                <option value="m">m</option>
                            </select></div>
                    </div>
                    <div class="row">
                        <div class="col">Seriové číslo</div><div class="col" colspan="2"><input class="form-control" type="text" name="sercis"></div>
                    </div>
                    <div class="row">
                        <div class="col">Záruka</div><div class="col" ><input class="form-control" type="number" min="0" name="zaruka" required></div><div class="col">Měsíců</div>
                    </div>
                    <div class="row">
                        <div class="col">Nákupní cena</div><div class="col" colspan="2"><input class="form-control" type="number" min="0" step=".001" name="cena1" required></div>
                    </div>
                    <div class="row">
                        <div class="col">Prodejní cena</div><div class="col" colspan="2"><input class="form-control" type="number" min="0" step=".001" name="cena2" required></div>
                    </div>
                    <div class="row">
                        <div class="col">Datum zakoupení</div><div class="col" colspan="2"><input class="form-control" type="date" name="datum" required></div>
                    </div>
                    <div class="row">
                        <div class="col">DPH</div><div class="col"><select name="dph">
                                            <option value="15">15</option>
                                            <option value="12">12</option>
                                        </select>%</div>
                    </div>
                    <div class="row">
                        <div class="col">Zakoupeno</div><div class="col" colspan="2"><input class="form-control" type="text" name="obchod" required></div>
                    </div>
                    <div class="row">
                        <div class="col">Poznámka</div><div class="col" colspan="2"><textarea class="form-control" name="pozn"></textarea></div>
                    </div>
                    <div class="row">
                        <div class="col" colspan="3" align=center style="padding-top:20px" ><input style="width:50%" type="submit" name="submit" value="Vložit do skladu" id="reg-but"></div>
                    </div>
                </table>
            </div>
        </div>
    </form>
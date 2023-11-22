<div class="wrapper">
    <div class="row">
        <span class="display-4 text-center my-4">Kontakt</span>
    </div>
    <div class="row justify-content-center my-4">
        <div class="col-md-3" data-bs-theme="dark">
            <form id="contact-form" name="contact-form" action="kontakt.php" method="POST">
                <div class="row">
                    <div class="col input-group">
                        <div class="input-group-text">
                            <label for="email">Email</label>
                        </div>
                        <input type="text" id="email" name="email" class="form-control">
                            
                    </div>
                </div>
                <div class="row">
                    <div class="col input-group">
                        <div class="input-group-text">
                            <label for="predmet">Předmět</label>
                        </div>
                        <input type="text" id="predmet" name="predmet" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col input-group">
                        <div class="input-group-text">
                            <label for="predmet">Vaše zpráva</label>
                        </div>
                        <textarea type="text" id="zprava" name="zprava" rows="2" class="form-control md-textarea"></textarea>

                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col" style="max-width: fit-content;">
                        <input type="submit" class="blue-but btn" name="odeslat" value="Odeslat">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 text-center">
            <ul class="list-unstyled mb-0">
                <li><i class="bi-geo-alt-fill" style="font-size: 2rem; color: white;"></i>
                    <p>Sedlejov 81, 58862, Česká Republika</p>
                </li>

                <li><i class="bi-telephone-fill" style="font-size: 2rem; color: white;"></i>
                    <p>+420 777 666 555</p>
                </li>

                <li><i class="bi-envelope-fill" style="font-size: 2rem; color: white;"></i>
                    <p>kontakt@servisnifirma.cz</p>
                </li>
            </ul>
        </div>
    </div>
</div>
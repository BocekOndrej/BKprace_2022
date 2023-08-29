<h3 align="center">Přidat novou zakázku</h3>
    <form action="pridatZakazku.php" method="POST">
        <div class="d-flex justify-content-center mb-3">
            <div class="d-inline-flex" id="reg">
                <table border = 1 align=center>
                    <div id="show_item">
                    <tr>
                        <td>Zboží:</td>
                        <td><select name="zbozi">
                                <?php foreach ($model[1] as $zbozi): ?>
                                    <option value="<?= $zbozi->id ?>"><?= $zbozi->nazev ?></option>                                    
                                <?php endforeach; ?>
                            </select></td>
                        <td><button class="add_item_btn">Další položka</button></td>
                    </tr>
                    </div>
                    <tr>
                        <td colspan="3" align=center style="padding-top:20px" ><input style="width:50%" type="submit" name="submit" value="Vložit do skladu" id="reg-but"></td>
                    </tr>
                </table>
            </div>
        </div>
    </form>

    <script>                       
        $(document).ready(function(){
            $(".add_item_btn").click(function(e){
                e.preventDefault();
                $("#show_item").prepend('<tr><td>Zboží:</td><td><select name="zbozi"><?php foreach ($model[1] as $zbozi): ?><option value="<?= $zbozi->id ?>"><?= $zbozi->nazev ?></option><?php endforeach; ?></select></td><td><button class="_item_btn">Smazat polozku</button></td></tr>');
            });                
        });
    </script>
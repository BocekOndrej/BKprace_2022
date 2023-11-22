<?php
//Tady se nachazi funkce pouzivany celou appkou. 
//Pokud při zavolání header hází web chybu, je potřeba smazat sekci s JS scriptem smazat
//a vložit jí do hlavičky webu která se nachazi v layout.view.php pod ostatni scripty
function view($nazev,$model = ''){
    global $title;
    require(CESTA . "views/layout.view.php");
}

function lockAdmin(){
    if(!isset($_SESSION["role"])||$_SESSION["role"]!=2) header("location:../index.php");
}
function lockUser(){
    if(!isset($_SESSION["role"])||$_SESSION["role"]!=3) header("location:../index.php");
}

function sanitizeString($value){
    $temp = filter_var(trim($value),FILTER_SANITIZE_STRING);
    if($temp===false){
        return '';
    }
    return $temp;
}
function searchObjectsRecursive($objektyArray, $hledanyString) {
    $filtrovaneObjekty = array_filter($objektyArray, function($objekt) use ($hledanyString) {
        foreach ($objekt as $property => $value) {
            if (is_array($value)) {
                if (searchObjectsRecursive($value, $hledanyString)) {
                    return true;
                }
            } elseif (is_object($value)) {
                if (searchObjectsRecursive([$value], $hledanyString)) {
                    return true;
                }
            } elseif (stripos($value, $hledanyString) !== false) {
                return true;
            }
        }
        return false;
    });

    return $filtrovaneObjekty;
}
?>
<script>
    //Funkce která po filtrování vloží zadaný hodnoty zpět do tabulky s filtrama
    function insertValuesFiltry(){
        if(post.length != 0 && ( post.orderby != undefined || post.hledat != undefined)){
            $(document).ready(function(){
                $('#orderby').val(post.orderby);
                $('#hledat').val(post.hledat);
            });
        }
    }
    //po úpravě dat vyplní detail znova datama
    function insertValuesDetail(){ 
        if(post.length != 0 && post.id != undefined && post.smazat == undefined){
            viewDetail(parseInt(post.id));
        }
    }
    //vypočítává cenu zboží celkem
    function countCenaZbozi(){
        $(document).ready(function() {
            var celkem = 0;
            $('.zboziCena').each(function() {
                celkem += parseFloat($(this).text().replace(/[^\d.-]/g, ''));
            });
            $('#zboziCelkem').text(celkem.toString() + " Kč");
        });
    }
    //dopočítává ceny s a bez DPH jednu podle druhý navzájem, podle toho která se mění
    function dopocetDPH(){
        $(document).on('change', 'input[name="cena"]', function() {
            let cenaDPH = $("#cena").val() * (($("#dph").val() / 100) + 1);
            $("#cenaDPH").val(cenaDPH.toFixed(2));
        });
        $(document).on('change', 'select[name="dph"]', function() {
            let cenaDPH = $("#cena").val() * (($("#dph").val() / 100) + 1);
            $("#cenaDPH").val(cenaDPH.toFixed(2));
        });
        $(document).on('change', 'input[id="cenaDPH"]', function() {
            let cena = $("#cenaDPH").val() * (1 - ($("#dph").val() / 100));
            console.log("zxcasc");
            $("#cena").val(cena.toFixed(2));
        });
    }
    //počítá statistiky, když je zvolen týden, začína nedělí
    function spocitatStatistiky(rozmeziSelect){
        var zakazkyAktivni = zakazkyAll.filter(function (obj) {
            return obj.stav === 1 || obj.stav === 2;
        });
        var pocetAktivnich = zakazkyAktivni.length;
        $("#aktivni").text(pocetAktivnich);    
        var currentDate = new Date();
                    var zakazkyHotove = zakazkyAll.filter(function (obj) {
                    var objDate = new Date(obj.datum_konec);
                    switch (rozmeziSelect) {
                        case 'rok':
                            return objDate.getFullYear() === currentDate.getFullYear() && obj.stav === 3;
                        case 'mesic':
                            return objDate.getMonth() === currentDate.getMonth() &&
                             objDate.getFullYear() === currentDate.getFullYear() && obj.stav === 3;
                        case 'tyden':
                            var currentWeek = currentDate.getDate() - currentDate.getDay();
                            var objWeek = objDate.getDate() - objDate.getDay();
                            return objWeek === currentWeek && objDate.getFullYear() === currentDate.getFullYear() && obj.stav === 3;
                        case 'den':
                            return objDate.toDateString() === currentDate.toDateString() && obj.stav === 3;
                        default:
                            return false;
                    }
                });
                var pocetDokoncenych = zakazkyHotove.reduce(function (acc, obj) {
                    return acc + (obj.stav === 3 ? 1 : 0);
                }, 0);
                var celkemCenaDokoncenych = zakazkyHotove.reduce(function (acc, obj) {
                    let cenaDPH = obj.cena * (1 + (obj.dph / 100));
                    return acc + cenaDPH;
                }, 0);
                $("#hotovo").text(pocetDokoncenych);
                $("#cenaHotovo").text(celkemCenaDokoncenych.toFixed(2) + " Kč s DPH");
    }
</script>

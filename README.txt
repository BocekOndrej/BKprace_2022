Administrativní aplikace pro malou servisní firmu

Konfigurace aplikace pro localhost:
Přístup k databázi se nastavuje v souboru init/config.php. Server, jmeno DB a port jsou v config.php, login a heslo na databázi v souboru data/mysqlsdata.class.php.
Je důležité správně nastavit v config.php NAZEV_SLOZKY. Momentálně čte celou cestu nastaví do sebe název 3. složky, tak to bylo u mě na lokálu. U vás to bude nejspíš jinak,
je potřeba sem nastavit cestu od rootu až k aplikaci. Takže pokud je appka ve složce www/subdom/bp, a root je složka www tak v NAZEV_CESTY musí být /subdom/bp.
V souboru "bkprace.sql" naleznete zálohu databáze s již nekterými daty předvyplněnými. Heslo pro účet admin je admin, zákaznický účet je vytvořen pomocí tvorby 2 nových zakázek pro zákazníka.
zákazníkovi je na localhostu nastaveno heslo 123456789, generování je zakomentováno. 
Dále jsou kvůli absenci SMTP serveru zakomentovány všechny části posílající emaily. Tyto sekce jsou v souborech kontakt.php, zakazky/zakazky.php, zakazky/pridatZakazku.php.

APLIKACE JE SPUŠTĚNA NA DOMÉNĚ: bp.selitech.cz
Heslo k účtu admin je: H6TMnZwP
Heslo k účtu bocek04@student.vspj.cz je: 07eb6e13


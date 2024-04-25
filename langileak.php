<!DOCTYPE html>
<html lang="eu">

<head>
    <title>Intranet</title>
    <meta name="keywords" content="Elorrieta zinema, zinema, filmak, erreserbak, pelikulak">
    <meta name="author" content="Summer bath">
    <meta name="description"
        content="Elorrieta zinemaren webgunea. Hurrengo HTMLa Matrillu-gatik eginda dago zinema baterako.">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css">
    <link rel="shortcut icon" href="image/Schotify.png" type="image/x-icon">
    <link rel="icon" href="image/Schotify.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/9b73a90cb7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    session_start();

    $ruta_xml = "datuak/intra.xml";

    // XML fitxategiaren existentzia egiaztatu
    if (!file_exists($ruta_xml)) {
        die("XML fitxategia ez da existitzen.");
    }

    $xml = simplexml_load_file($ruta_xml);

    // XML fitxategiaren kargak ondo egin den egiaztatu
    if ($xml === false) {
        die("Ezinezkoa izan da XML fitxategia kargatzea.");
    }

    if (!isset($xml->departamentuak) || !isset($xml->rolak)) {
        die("XML fitxategiak espero den egitura ez dauka.");
    }

    $departamentos = $xml->departamentuak->departamentua;

    $roles = $xml->rolak->rol;

    // Aukerak erakutsi
    function imprimirOpciones($items)
    {
        foreach ($items as $item) {
            echo '<option value="' . $item['id'] . '">' . $item->izena . '</option>';
        }
    }

    // Departamentua eta rola aukeratuta badira, sesioan gorde
    if (isset($_GET['departamentua']) && isset($_GET['rolak'])) {
        $_SESSION['departamentua'] = $_GET['departamentua'];
        $_SESSION['rol'] = $_GET['rolak'];
    } else {
        $_SESSION['departamentua'] = "";
        $_SESSION['rol'] = "";
    }

    // XML fitxategiaren langileak erakutsi filtroaren arabera
    function langileakErakutsi($departamentua, $rol)
    {
        $xml = simplexml_load_file("datuak/intra.xml");
        if ($departamentua != "" && $rol != "") {
            $langileak = $xml->xpath("//langileak/langilea[departamentua = '$departamentua' and rola = '$rol']");
        } elseif ($departamentua != "") {
            $langileak = $xml->xpath("//langileak/langilea[departamentua = '$departamentua']");
        } elseif ($rol != "") {
            $langileak = $xml->xpath("//langileak/langilea[rola = '$rol']");
        } else {
            $langileak = $xml->xpath("//langileak/langilea");
        }
        foreach ($langileak as $langilea) {
            echo '<div class="lan"><img class="largazkia" src="' . $langilea->argazkia . '">
            <p>' . $langilea->izena . " " . $langilea->abizena1 . " " . $langilea->abizena2 . "</p>
            <p>" . $langilea->jaiotze_data . "</p>
            <p>" . $langilea->bizilekua->herrialdea . ", " . $langilea->bizilekua->probintzia . ", " . $langilea->bizilekua->herria . "
            <p>" . $langilea->telefonoak->mugikorra . "</div>";
        }
    }
    ?>
</head>


<body>
    <header>
        <nav>
            <img src="image/Schotify.png" alt="logoa">
            <ul>
                <li><a href="main.html">Hasiera</a></li>
                <li><a href="departamentuak.php">Departamentuak</a></li>
                <li><a href="langileak.php">Langileak</a></li>
            </ul>

        </nav>

    </header>


    <!-- Langileak ezarri era dinamiko batean filtroa aplikatzeko ahalmenarekin -->
    <main>
        <form id="filterForm">
            <select name="departamentua" id="departamentua">
                <option value="">Guztiak</option>
                <?php imprimirOpciones($departamentos); ?>
            </select>
            <select name="rolak" id="rolak">
                <option value="">Guztiak</option>
                <?php imprimirOpciones($roles); ?>
            </select>
            <button type="button" onclick=ArkeztuLangileak()>Filtrar</button>
        </form>
        <div class="grid-cont">
            <?php langileakErakutsi($_SESSION['departamentua'], $_SESSION['rol']) ?>
        </div>
    </main>



    <footer>
        <div class="container3">
            <div class="info-footer">
                <h4>Informazioa</h4>
                <ul>
                    <li>Agirre Lehendakariaren Etorb., 184</li>
                    <li>48015 - Bilbo</li>
                    <li>Autobusa: 70,46.</li>
                    <li>Metroa: San Ignazio, Asturias irteera</li>
                    <li> <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">
                            <img alt="Licencia Creative Commons" style="border-width:0"
                                src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png">
                        </a></li>
                </ul>
            </div>
            <div class="kontaktua">
                <h4>Kontaktua</h4>
                <i class="fa-solid fa-phone" style="color: #ffffff;"></i> 944 02 80 00
                <br>
                <i class="fa-solid fa-envelope"></i> schotify.contact@schotify.com
                <br>
                <a href="URL_de_Instagram" target="_blank">
                    <i class="fa-brands fa-instagram fa-sm" style="color: #ffffff;"></i>
                </a>

                <a href="URL_de_Twitter" target="_blank">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>

                <a href="URL_de_Facebook" target="_blank">
                    <i class="fa-brands fa-facebook"></i>
                </a>
            </div>


            <div class="mapa">
                <h4>Kokapena</h4>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5808.636528021377!2d-2.9667557!3d43.28665625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4e50774e8ca143%3A0x88bb341c60a9b44d!2sElorrieta%2C%2048015%20Bilbao%2C%20Vizcaya!5e0!3m2!1ses!2ses!4v1696938647128!5m2!1ses!2ses"
                    width="100" height="150" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </footer>
    <script>
        // Filtroa aplikatzeko funtzioa
        function ArkeztuLangileak() {
            var departamentua = document.getElementById("departamentua").value;
            var rol = document.getElementById("rolak").value;
            window.location.href = "<?php echo $_SERVER['PHP_SELF']; ?>?departamentua=" + departamentua + "&rolak=" + rol;
        }
    </script>
</body>


</html>
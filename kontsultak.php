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
    <link rel="shortcut icon" href="favicon-16x16.png" type="image/x-icon">
    <link rel="icon" href="favicon-16x16.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/9b73a90cb7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    // Ruta al archivo XML
    $ruta_xml = "datuak/intra.xml";

    // Comprobamos si el archivo XML existe
    if (!file_exists($ruta_xml)) {
        die("El archivo XML no existe.");
    }

    // Cargar el contenido del archivo XML
    $xml = simplexml_load_file($ruta_xml);

    // Comprobar si la carga del XML fue exitosa
    if ($xml === false) {
        die("Error al cargar el archivo XML.");
    }

    // Comprobar si existen los elementos departamentuak y rolak
    if (!isset($xml->departamentuak) || !isset($xml->rolak)) {
        die("El archivo XML no contiene la estructura esperada.");
    }

    // Extraer los departamentos
    $departamentos = $xml->departamentuak->departamentua;

    // Extraer los roles
    $roles = $xml->rolak->rol;

    // Función para imprimir opciones de desplegable
    function imprimirOpciones($items)
    {
        foreach ($items as $item) {
            echo '<option value="' . $item['id'] . '">' . $item->izena . '</option>';
        }
    }

    ?>

</head>


<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="image/Schotify.png" alt="logoa">
            </div>
        </div>
    </header>


    <hr>


    <nav>
        <ul>
            <li><a href="index.html">Hasiera</a></li>
            <li><a href="erregistroa.php">Langileen Erregistroa</a></li>
        </ul>

    </nav>


    <hr>


    <section>

        <form id="filterForm">
            <select name="departamentua" id="departamentua">
                <option value="">-</option>
                <?php imprimirOpciones($departamentos); ?>
            </select>
            <select name="rolak" id="rolak">
                <option value="">-</option>
                <?php imprimirOpciones($roles); ?>
            </select>
        </form>
        <div id="resultContainer">
        </div>
    </section>


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
                <i class="fa-solid fa-envelope"></i> elorrietazinema@gmail.com
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
        function handleFilterChange() {
            var departamento = document.getElementById('departamentua').value;
            var rol = document.getElementById('rolak').value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var xmlDoc = this.responseXML;
                    var employees = xmlDoc.getElementsByTagName('langilea');
                    var filteredEmployees = [];

                    for (var i = 0; i < employees.length; i++) {
                        var employee = employees[i];
                        var employeeDepartamento = employee.querySelector('departamentua').textContent;
                        var employeeRol = employee.querySelector('rola').textContent;

                        if ((departamento === '0' || employeeDepartamento === departamento) && (rol === '0' || employeeRol === rol)) {
                            filteredEmployees.push({
                                izena: employee.querySelector('izena').textContent,
                                abizena1: employee.querySelector('abizena1').textContent,
                                abizena2: employee.querySelector('abizena2').textContent
                            });
                        }
                    }

                    if (filteredEmployees.length > 0) {
                        displayEmployees(filteredEmployees);
                    } else {
                        document.getElementById('langileak').innerHTML = '<p>Ez dira langilerik aurkitu.</p>';
                    }
                }
            };
            xhr.open("GET", "datuak/intra.xml", true);
            xhr.send();
        }

    </script>
</body>


</html>
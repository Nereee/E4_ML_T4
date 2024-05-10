<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" version="5"></xsl:output>
    <xsl:param name="id_departamentua" />
    <xsl:param name="id_rola" />
    <xsl:template match="erakundea">
        <html lang="eu">

            <head>
                <title>Intraneteko langileak</title>
                <meta name="keywords" content="Langileak, Rolak, Departamentuak, Dinamikoa, Filtroa, Schotify" />
                <meta name="author" content="HEA" />
                <meta name="description"
                    content="langileak ikertzeko era dinamiko eta filtroak aplikatzeko ahalmenarekin" />
                <meta charset="UTF-8" />
                <link rel="stylesheet" href="style/style.css" />
                <link rel="shortcut icon" href="image/Schotify.png" type="image/x-icon" />
                <link rel="icon" href="image/Schotify.png" type="image/x-icon" />
                <script src="https://kit.fontawesome.com/9b73a90cb7.js" crossorigin="anonymous"></script>
                <meta name="viewport" content="width=device-width, initial-scale=1" />
            </head>


            <body>
                <header>
                    <nav>
                        <img src="image/Schotify.png" alt="logoa" />
                        <ul>
                            <li>
                                <a href="main.html">Hasiera</a>
                            </li>
                            <li>
                                <a href="departamentua.php">Departamentuak</a>
                            </li>
                            <li>
                                <a href="langile.php">Langileak</a>
                            </li>
                        </ul>

                    </nav>

                </header>


                <!-- Arukeztu rolak eta departamentuak -->
                <main>

                    <form id="filterForm" method="GET" action="langile.php">
                        <select name="departamentua" id="departamentua">
                            <option value="">Dpto: Guztiak</option>
                            <xsl:for-each select="departamentuak/departamentua">
                                <option>
                                    <xsl:attribute name="value">
                                        <xsl:value-of select="@id" />
                                    </xsl:attribute>
                                    <xsl:value-of select="izena" />
                                </option>
                            </xsl:for-each>
                        </select>
                        <select name="rolak" id="rolak">
                            <option value=" ">Rol: Guztiak</option>
                            <xsl:for-each select="rolak/rol ">
                                <option>
                                    <xsl:attribute name="value">
                                        <xsl:value-of select="@id" />
                                    </xsl:attribute>
                                    <xsl:value-of select="izena" />
                                </option>
                            </xsl:for-each>
                        </select>
                        <button type="submit">Filtratu</button>
                    </form>
                    <!-- Langileak filtratuta departamentua eta rola erabiliz -->
                    <div class="grid-cont">
                        <xsl:for-each select="langileak/langilea">
                            <xsl:if test='(rola = $id_rola and departamentua = $id_departamentua)'>
                                <div class="lan">
                                    <a href="{e-postak/lanekoa}" target="_blank">
                                        <img>
                                            <xsl:attribute name="src"><xsl:value-of
                                                    select="argazkia"></xsl:value-of></xsl:attribute>
                                            <xsl:attribute name="alt"><xsl:value-of
                                                    select="izena"></xsl:value-of></xsl:attribute>
                                        </img>
                                    </a>
                                    <p>
                                        <xsl:value-of select="izena"></xsl:value-of>
                                        <xsl:text> </xsl:text>
                                        <xsl:value-of select="abizena1"></xsl:value-of>
                                        <xsl:text> </xsl:text>
                                        <xsl:value-of select="abizena2"></xsl:value-of>
                                    </p>
                                    <p>Jaiotze data:<xsl:value-of select="jaoiotze_data"></xsl:value-of></p>
                                    <p>
                                        <xsl:value-of select="bizilekua/herrialdea"></xsl:value-of>
                                        <xsl:text> </xsl:text>
                                        <xsl:value-of select="bizilekua/probintzia"></xsl:value-of>
                                        <xsl:text> </xsl:text>
                                        <xsl:value-of select="bizilekua/herria"></xsl:value-of>
                                    </p>
                                    <p>
                                        <xsl:value-of select="telefonoak/mugikorra"></xsl:value-of>
                                    </p>
                                </div>
                            </xsl:if>
                        </xsl:for-each>
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
                                <li>
                                    <a rel="license"
                                        href="http://creativecommons.org/licenses/by-nc-sa/4.0/">
                                        <img alt="Licencia Creative Commons" style="border-width:0"
                                            src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" />
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="kontaktua">
                            <h4>Kontaktua</h4>
                <i class="fa-solid fa-phone" style="color: #ffffff;"></i>
        944 02 80 00 <br />
                            <i class="fa-solid fa-envelope"></i> schotify.contact@schotify.com <br />
                            <a
                                href="URL_de_Instagram" target="_blank">
                                <i class="fa-brands fa-instagram fa-sm" style="color: #ffffff;"></i>
                            </a>

                <a
                                href="URL_de_Twitter" target="_blank">
                                <i class="fa-brands fa-x-twitter"></i>
                            </a>

                <a
                                href="URL_de_Facebook" target="_blank">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                        </div>


                        <div class="mapa">
                            <h4>Kokapena</h4>
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5808.636528021377!2d-2.9667557!3d43.28665625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4e50774e8ca143%3A0x88bb341c60a9b44d!2sElorrieta%2C%2048015%20Bilbao%2C%20Vizcaya!5e0!3m2!1ses!2ses!4v1696938647128!5m2!1ses!2ses"
                                width="100" height="150" style="border:0;" allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </footer>
            </body>


        </html>
    </xsl:template>

</xsl:stylesheet>
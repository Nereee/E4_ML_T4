<?php
// Aldagaiak definitu
$arauak = new DOMDocument();

// XML fitxategiak kargatu
$arauak->load("style/departamentuak.xsl");

// XSLT prozesatzailea sortu
$datuak = new DOMDocument();
$datuak->load("datuak/intra.xml");

$proc = new XSLTProcessor();
$proc->importStylesheet($arauak);

echo $proc->transformToXml($datuak);
?>
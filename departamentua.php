<?php
$arauak = new DOMDocument();
$arauak->load("style/departamentuak.xsl");

$datuak = new DOMDocument();
$datuak->load("datuak/intra.xml");

$proc = new XSLTProcessor();
$proc->importStylesheet($arauak);

echo $proc->transformToXml($datuak);
?>

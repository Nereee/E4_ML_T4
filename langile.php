<?php

$id_rola = "";
$id_departamentua = "";


$arauak = new DOMDocument();
$arauak->load("style/langileak.xsl");

$datuak = new DOMDocument();
$datuak->load("datuak/intra.xml");

$proc = new XSLTProcessor();
$proc->importStylesheet($arauak);

if ($_GET['rolak'] !== NULL) {
    $proc->setParameter('', 'id_rola', $_GET['rolak']);
} else {
    $proc->setParameter('', 'id_rola', ' ');
}

if ($_GET['departamentua'] !== NULL) {
    $proc->setParameter('', 'id_departamentua', $_GET['departamentua']);
} else {
    $proc->setParameter('', 'id_departamentua', ' ');
}

echo $proc->transformToXML($datuak);
?>

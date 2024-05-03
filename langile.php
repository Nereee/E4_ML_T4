<?php

// Definir y asignar valores a las variables $id_rola y $id_departamentua
$id_rola = "";
$id_departamentua = "";

/* DOM dokumentu berri bat sortzen dugu XSLT arauekin eta XML datuekin */

$arauak = new DOMDocument();
$arauak->load("style/langileak.xsl");

$datuak = new DOMDocument();
$datuak->load("datuak/intra.xml");

/* Arau horiek aplikatzeko "motor" bat sortzen dugu. Transformazio-arauak kargatuko dizkizugu. Arau horiek aplikatuko dizkiogu dokumentuari */

$proc = new XSLTProcessor();
$proc->importStylesheet($arauak);

// Definir parámetros solo si las variables tienen un valor
if ($id_rola !== NULL) {
    $proc->setParameter('', 'id_rola', $id_rola);
} else {
    $proc->setParameter('', 'id_rola', '');
}

if ($id_departamentua !== NULL) {
    $proc->setParameter('', 'id_departamentua', $id_departamentua);
} else {
    $proc->setParameter('', 'id_departamentua', '');
}

echo $proc->transformToXML($datuak);
?>

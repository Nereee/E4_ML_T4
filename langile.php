<?php
// Aldagaiak definitu
$id_rola = "";
$id_departamentua = "";
$rolak = "";
$departamentua = "";

// XML fitxategiak kargatu
$arauak = new DOMDocument();
$arauak->load("style/langileak.xsl");

$arauakR = new DOMDocument();
$arauakR->load("style/langRol.xsl");

$arauakD = new DOMDocument();
$arauakD->load("style/langDep.xsl");

$arauakRD = new DOMDocument();
$arauakRD->load("style/langDepRol.xsl");

// XSLT prozesatzailea sortu
$datuak = new DOMDocument();
$datuak->load("datuak/intra.xml");

$proc = new XSLTProcessor();

// Parametroak ezarri
$var = $_SERVER['QUERY_STRING'];

// Parametroak jaso
if (strpos($var, 'rolak=') !== false) {
    $rolak = substr($var, strpos($var, 'rolak=') + 6);
}

if (strpos($var, 'departamentua=') !== false) {
    $departamentua = substr($var, strpos($var, 'departamentua=') + 14, 1);
}

// Ondo jaso diren parametroak tratatu
if ($departamentua == '&') {
    $departamentua = "";
}

if ($rolak == '+') {
    $rolak = "";
}

// Parametroak partekatu
$proc->setParameter('', 'id_rola', $rolak);
$proc->setParameter('', 'id_departamentua', $departamentua);

// XSLT fitxategiaren karga
if ($departamentua == "" and $rolak == "") {
    $proc->importStylesheet($arauak);
}
else if ($rolak == "") {
    $proc->importStylesheet($arauakD);
}
else if ($departamentua == "") {
    $proc->importStylesheet($arauakR);
}
else {
    $proc->importStylesheet($arauakRD);
}

echo $proc->transformToXML($datuak);

<?php
$id_rola = "";
$id_departamentua = "";
$rolak = "";
$departamentua = "";

$arauak = new DOMDocument();
$arauak->load("style/langileak.xsl");

$arauakR = new DOMDocument();
$arauakR->load("style/langRol.xsl");

$datuak = new DOMDocument();
$datuak->load("datuak/intra.xml");

$proc = new XSLTProcessor();

$var = $_SERVER['QUERY_STRING'];


if (strpos($var, 'rolak=') !== false) {
    $rolak = substr($var, strpos($var, 'rolak=') + 6);
}

if (strpos($var, 'departamentua=') !== false) {
    $departamentua = substr($var, strpos($var, 'departamentua=') + 14, 1);
}

echo $departamentua;
echo "|";
echo $rolak;

if ($departamentua == '&') {
    $departamentua = "";
}

if ($rolak == '+') {
    $rolak = "";
}

$proc->setParameter('', 'id_rola', $rolak);
$proc->setParameter('', 'id_departamentua', $departamentua);

if ($rolak == "" or $departamentua == "") {
    $proc->importStylesheet($arauak);
} else {  
    $proc->importStylesheet($arauakR);
}

echo $proc->transformToXML($datuak);

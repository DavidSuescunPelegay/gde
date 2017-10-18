<?php
//$_SESSION['RAIZ'] = $_SERVER['DOCUMENT_ROOT'] . 'gde';
//echo $_SERVER['DOCUMENT_ROOT'];
if ($_SERVER['SERVER_NAME'] == 'gdedavidsp.altervista.org') {
    $_SESSION['RAIZ'] = '/membri/gdedavidsp';//En caso de que el proyecto se ejecute en servidor
} else {
    $_SESSION['RAIZ'] = '';//En caso de que el proyecto se ejecute en localhost
}
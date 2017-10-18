<?php
$nombre='Javier Lasheras';
echo 'Mi nombre es '.$nombre.'<br>';
//constante
define('NOMBRE', 'Javier Lasheras');
echo 'Mi nombre es '.NOMBRE.'<br>';
echo "Mi nombre es $nombre<br>";

$nombres=array();
$nombres[]='Juan';
$nombres[]='Pedro';
$nombres[]='Ivan';
var_dump($nombres);

$nombres2=array('Sergio','Jonathan','Javier');
var_dump($nombres2);


foreach ($nombres as $indice=>$valor){
	echo "en la posición $indice el valor es $valor<br>";
}

$nombres3=array('Sergio'=>23,'Ivan'=>19, 'Javier'=>32);
$nombres3['Felipe']=21;
foreach ($nombres3 as $indice=>$valor){
	echo "en la posición $indice el valor es $valor<br>";
}

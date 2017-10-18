<?php session_start();

	$getPost=array_merge($_POST, $_GET);
	$nombreClase=$getPost['c'].'C';
	require_once $_SESSION['RAIZ'].'/controladores/'.$nombreClase.'.php';

	$controlador= new $nombreClase();
	$accion=$getPost['a'];
	$controlador->$accion($getPost);
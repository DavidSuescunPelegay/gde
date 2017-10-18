<?php session_start();

$error='';

if(!isset($_GET['id']) || $_GET['id']=='' || !isset($_GET['cod']) || $_GET['cod']=='' ){
	$error='Faltan datos de identificación del fichero.';
}else{
	require_once $_SESSION['RAIZ'].'/controladores/FicherosC.php';
	$cFicheros=new FicherosC();
	$filtros=array();
	$filtros['id_Fichero']=$_GET['id'];
	$filtros['nombre']=$_GET['cod'];
	$ficheros=$cFicheros->getFicheros($filtros);
	
	if(empty($ficheros)){
		$error='El fichero no ha sido encontrado.';
	}else{
		$fichero=$ficheros[0];
		if(!file_exists($fichero['url'].$fichero['nombre'].'.'.$fichero['ext'])){
			$error='El fichero no existe.'.$_SESSION['RAIZ'].'/'.$fichero['url'].$fichero['nombre'].'.'.$fichero['ext'];
		}else{
			// necesario para IE
			if( ini_get('zlib.output_compression') ) ini_set('zlib.output_compression', 'Off');
			
			switch( $fichero['ext'] ){
				case "pdf":  $ctype="application/pdf"; break;
				case "exe":  $ctype="application/octet-stream"; break;
				case "zip":  $ctype="application/zip"; break;
				case "doc":  $ctype="application/msword"; break;
				case "docx": $ctype="application/vnd.openxmlformats-officedocument.wordprocessingml.document"; break;
				case "xls":  $ctype="application/vnd.ms-excel"; break;
				case "xlsx": $ctype="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"; break;
				case "ppt":  $ctype="application/vnd.ms-powerpoint"; break;
				case "gif":  $ctype="image/gif"; break;
				case "png":  $ctype="image/png"; break;
				case "jpeg":
				case "jpg":  $ctype="image/jpg"; break;
				default:     $ctype="application/force-download";
			}
			header("Pragma: public"); // required
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: private",false); // necesario para algunos navegadores
			header("Content-Type: $ctype");
			header("Content-Disposition: attachment; filename=\"".$fichero['nombre'].'.'.$fichero['ext']."\";" );
			header("Content-Transfer-Encoding: binary");
			header("Content-Length: ".filesize($fichero['url'].$fichero['nombre'].'.'.$fichero['ext']));
			readfile($fichero['url'].$fichero['nombre'].'.'.$fichero['ext']);
		}
	}
}
if($error!=''){
	echo $error;
}


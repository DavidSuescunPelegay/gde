<?php session_start();
	require_once 'config.php';
// 	print_r($_POST);
// 	var_dump($_POST);
	$msj='';
	if( isset($_POST['login']) && isset($_POST['pass'])){
		
		require_once 'controladores/UsuariosC.php';
		$usuario=new UsuariosC();
		$res=$usuario->validarUsuario(array('login'=>$_POST['login'],
											'pass'=>$_POST['pass']));
// 		$para=array();
// 		$para['login']=$_POST['login'];
// 		$para['pass']=$_POST['pass'];
// 		$res=$usuario->validarUsuario($para);
		if( $res['valido']=='S'){
			$_SESSION['login']=$_POST['login'];
			header('location: app.php');
		}else{
			$msj=$res['msj'];
		}
	}
?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<title>Gestion de empresa</title>
	</head>
	<body>
		<span style="color:blue;"><?php echo $msj;?></span>
		<form action="index.php" method="post" class="formulario">
			<label for="login">Nombre:<br>
				<input name="login"  id="login"	value="" size="40">
			</label><br><br>
			<label for="pass">Contrase&ntilde;a:<br> 
				<input name="pass" id="pass" size="12" value="" 
			 		type="password">
			</label> <br><br>
			<center><button type="submit">Entrar</button></center>
		</form>

		<h4>Nombre: admin</h4>
		<h4>Contraseña: 123</h4>
	</body>
</html>	
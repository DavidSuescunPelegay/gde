<?php session_start();
require_once 'config.php';
$msj = '';
if (isset($_POST['login']) && isset($_POST['pass'])) {
    require_once 'controladores/UsuariosC.php';
    $usuario = new UsuariosC();
    $res = $usuario->validarUsuario(array('login' => $_POST['login'],
        'pass' => $_POST['pass']));
    if ($res['valido'] == 'S') {
        $_SESSION['login'] = $_POST['login'];
        header('location: app.php');
    } else {
        $msj = $res['msj'];
    }
}
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <title>Gestion de Empresa - David Suescun Pelegay</title>
    <link rel="icon" type="image/png"
          href="http://plainicon.com/dboard/userprod/2800_a1826/prod_thumb/plainicon.com-50298-256px-4b4.png"/>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<div class="divPrincipal">
    <form action="index.php" method="post" class="formulario">
        <div class="login-block">
            <label>Iniciar sesion</label><br><br>
            <input type="text" placeholder="Usuario" id="login" name="login"/>
            <input type="password" placeholder="Contraseña" id="pass" name="pass"/>
            <button type="submit">Entrar</button>
            <center>
                <span style="color:blue;">
                    <?php echo $msj; ?>
                </span>
            </center>
        </div>
    </form>
</div>
<footer>
    <div id="infoFooter">
        <center>Version del Proyecto: 2.1 - Ultima Actualizacion: Jueves, 08 de Diciembre de 2016 - <a
                    href="changelog.html">Accede al Changelog</a></center>
        <center>© David Suescun Pelegay - 2º SI - Desarrollo de Interfaces - CES San Valero</center>
    </div>
</footer>
</body>
</html>
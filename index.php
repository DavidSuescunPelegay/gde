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

//INICIO REDIRRECIONAMIENTO A app.php SI ESTAS LOGUEADO
if (isset($_SESSION['login'])) {
    header('Location: app.php');
}
//FIN REDIRRECIONAMIENTO A app.php SI ESTAS LOGUEADO
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <title>Gestion de Empresa - David Suescun Pelegay</title>
    <meta charset="UTF-8">
    <meta name="theme-color" content="#2E353D">
    <link rel="icon" type="image/png" href="images/favicon.png"/>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/index.css">

    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        function ocultarAviso() {
            document.getElementById("avisoNavegador").style.display = 'none';
        }
    </script>
</head>
<body>
<?php
$avisoNavegador = '<div id="avisoNavegador" class="alert alert-warning alert-dismissible fade in col-lg-2 col-md-6 col-sm-12 col-xs-12" role="alert" onclick="ocultarAviso()">';
if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) {
    $avisoNavegador .= '<button type="button" class="btn btn-danger">';
    $avisoNavegador .= '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
    $avisoNavegador .= '</button>';
    $avisoNavegador .= '&nbsp &nbsp';
    $avisoNavegador .= 'Internet Explorer. <br>';
    $avisoNavegador .= 'Recomendable usar <b>Google Chrome</b>';
} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== false) {
    $avisoNavegador .= '<button type="button" class="btn btn-danger">';
    $avisoNavegador .= '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
    $avisoNavegador .= '</button>';
    $avisoNavegador .= '&nbsp &nbsp';
    $avisoNavegador .= 'Internet Explorer. <br>';
    $avisoNavegador .= 'Recomendable usar <b>Google Chrome</b>';
} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== false) {
    $avisoNavegador .= '<button type="button" class="btn btn-danger">';
    $avisoNavegador .= '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
    $avisoNavegador .= '</button>';
    $avisoNavegador .= '&nbsp &nbsp';
    $avisoNavegador .= 'Mozilla Firefox. <br>';
    $avisoNavegador .= 'Recomendable usar <b>Google Chrome</b>';
} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false) {
    $avisoNavegador .= '<button type="button" class="btn btn-success">';
    $avisoNavegador .= '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
    $avisoNavegador .= '</button>';
    $avisoNavegador .= '&nbsp &nbsp';
    $avisoNavegador .= 'Estas utilizando Google Chrome. ';
} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false) {
    $avisoNavegador .= '<button type="button" class="btn btn-danger">';
    $avisoNavegador .= '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
    $avisoNavegador .= '</button>';
    $avisoNavegador .= '&nbsp &nbsp';
    $avisoNavegador .= 'Opera Mini. <br>';
    $avisoNavegador .= 'Recomendable usar <b>Google Chrome</b>';
} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== false) {
    $avisoNavegador .= '<button type="button" class="btn btn-danger">';
    $avisoNavegador .= '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
    $avisoNavegador .= '</button>';
    $avisoNavegador .= '&nbsp &nbsp';
    $avisoNavegador .= 'Opera. <br>';
    $avisoNavegador .= 'Recomendable usar <b>Google Chrome</b>';
} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== false) {
    $avisoNavegador .= '<button type="button" class="btn btn-danger">';
    $avisoNavegador .= '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
    $avisoNavegador .= '</button>';
    $avisoNavegador .= '&nbsp &nbsp';
    $avisoNavegador .= 'Safari. <br>';
    $avisoNavegador .= 'Recomendable usar <b>Google Chrome</b>';
} else {
    $avisoNavegador .= '<button type="button" class="btn btn-danger">';
    $avisoNavegador .= '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
    $avisoNavegador .= '</button>';
    $avisoNavegador .= '&nbsp &nbsp';
    $avisoNavegador .= 'Otro navegador. <br>';
    $avisoNavegador .= 'Recomendable usar <b>Google Chrome</b>';
}
$avisoNavegador .= '</b>';
$avisoNavegador .= '</div>';

echo $avisoNavegador;
?>
<div class="divPrincipal">
    <form action="index.php" method="post" class="formulario">
        <div class="login-block">
            <label>Iniciar sesion</label><br><br>
            <input type="text" placeholder="Usuario" id="login" name="login"/>
            <input type="password" placeholder="Contraseña" id="pass" name="pass"/>
            <button type="submit">Entrar</button>
            <p style="text-align: center">
                <span style="color:blue;">
                    <?php echo $msj; ?>
                </span>
            </p>
        </div>
    </form>
</div>
<footer>
    <div id="infoFooter">
        <p style="text-align: center">Version del Proyecto: 3.6 - Ultima Actualizacion: Lunes, 20 de Febrero de 2017 -
            <a href="changelog.html" style="color: #FFFFFF;">Accede al Changelog</a>
            <br>
            © David Suescun Pelegay - 2º SI - Desarrollo de Interfaces - CES San Valero
        </p>
    </div>
</footer>
</body>
</html>

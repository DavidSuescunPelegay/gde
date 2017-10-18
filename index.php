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
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <meta charset="UTF-8">

    <title>Gestion de empresa</title>
    <style type="text/css">
        body {
            background: url('images/Eor57Ae.jpg') no-repeat fixed center center;
            background-size: cover;
            font-family: Montserrat;
        }

        .divPrincipal {
            position: absolute;
            left: 50%;
            top: 50%;
            margin: -100px 0 0 -150px;
        }

        .login-block {
            width: 320px;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            border-top: 5px solid #ff656c;
            margin: 0 auto;
        }

        .login-block h1 {
            text-align: center;
            color: #000;
            font-size: 18px;
            text-transform: uppercase;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .login-block input {
            width: 100%;
            height: 42px;
            box-sizing: border-box;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            font-size: 14px;
            font-family: Montserrat;
            padding: 0 20px 0 50px;
            outline: none;
        }

        .login-block input:active, .login-block input:focus {
            border: 1px solid #ff656c;
        }

        .login-block button {
            width: 100%;
            height: 40px;
            background: #ff656c;
            box-sizing: border-box;
            border-radius: 5px;
            border: 1px solid #e15960;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            font-family: Montserrat;
            outline: none;
            cursor: pointer;
        }

        .login-block button:hover {
            background: #ff7b81;
        }
    </style>
</head>
<body>
<div class="divPrincipal">
    <form action="index.php" method="post" class="formulario">
        <div class="login-block">
            <label>Iniciar sesion</label><br><br>
            <input type="text" placeholder="Usuario" id="login" name="login"/>
            <input type="password" placeholder="Contraseña" id="pass" name="pass"/>
            <button type="submit">Entrar</button>
            <center><span style="color:blue;"><?php echo $msj; echo "<br>"; echo 'Acceso para clase y pruebas:'; echo "<br>"; echo 'Usuario: <strong>admin</strong>'; echo '<br>'; echo 'Contraseña: <strong>123</strong>'; ?></span></center>
        </div>
    </form>
</div>
<footer>
    <div style="position: fixed; bottom: 0; background-color: #eaeaea; width: 100%;">
        <center>© David Suescun Pelegay - 2º SI - Desarrollo de Interfaces - CES San Valero</center>
    </div>
</footer>
</body>
</html>
<?php session_start();
//ob_start();
require_once 'config.php';
require_once 'php/FirePHPCore/fb.php';
if (!isset($_SESSION['login'])) {
    header('location: index.php');
}
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/jquery-1.12.3.min.js"></script>
    <link rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/app.css">

    <script type="text/javascript">
        /*Funcion que cierra sesion*/
        function logout() {
            window.location = "index.php";
        }
    </script>

    <!--Importacion de la hoja de JavaScript-->
    <?php
    if (isset($_GET['c']) && $_GET['c'] != '') {
        if (file_exists('js/' . $_GET['c'] . '.js')) {
            echo '<script type="text/javascript" src="js/' . $_GET['c'] . '.js"></script>';
        }
    }
    ?>
</head>
<body>
<div class="row col-lg-2" style="margin: 1%; height: 100%; position: fixed;">
    <button data-toggle="collapse" data-target="#misDatos" class="btn btn-info">Abrir/Cerrar Datos</button>
    <div class="" style="margin-bottom: 10%;">
        <div id="misDatos" style="margin-bottom: 10%;" class="col-lg-12 collapse in">
            <fieldset>
                <legend>Mis Datos</legend>
                <?php
                $usuario = $_SESSION['login'];
                $conexion = mysqli_init();
                if (!$conexion) {
                    die("mysqli_init failed");
                }

                if (!mysqli_real_connect($conexion, "127.0.0.1", "root", "", "gde")) {
                    die("Connect Error: " . mysqli_connect_error());
                }

                $sql = 'SELECT * FROM usuarios WHERE login="' . $usuario . '"';

                $resultado = mysqli_query($conexion, $sql);

                $fila = mysqli_fetch_array($resultado);

                echo 'Bienvenido ' . $fila['nombre'] . ', estos son tus datos: ';

                echo '<br><br>';

                echo '<table border="1px #000 solid" style="width: 100%">';
                echo '<tr><td>';
                echo 'ID Usuario';
                echo '</td><td>';
                echo $fila['id_Usuario'];
                echo '</td></tr>';
                echo '<tr><td>';
                echo 'Nombre';
                echo '</td><td>';
                echo $fila['nombre'];
                echo '</td></tr>';
                echo '<tr><td>';
                echo 'Apellido 1';
                echo '</td><td>';
                echo $fila['apellido_1'];
                echo '</td></tr>';
                echo '<tr><td>';
                echo 'Apellido 2';
                echo '</td><td>';
                echo $fila['apellido_2'];
                echo '</td></tr>';
                echo '<tr><td>';
                echo 'Usuario';
                echo '</td><td>';
                echo $fila['login'];
                echo '</td></tr>';
                echo '<tr><td>';
                echo 'Activo';
                echo '</td><td>';
                echo $fila['activo'];
                echo '</td></tr>';
                echo '</table>';

                mysqli_close($conexion);
                ?>
            </fieldset>
        </div>
    </div>


    <button data-toggle="collapse" data-target="#misNotificaciones" class="btn btn-info">Abrir/Cerrar Notificaciones
    </button>
    <div class="" style="margin-bottom: 10%;">
        <div id="misNotificaciones" style="margin-bottom: 10%;" class="col-lg-12 collapse in">
            <fieldset>
                <legend>Mis Notificaciones</legend>
                <span id="notificaciones" style="color: #ff0000">No tienes notificaciones pendientes</span>
            </fieldset>
        </div>
    </div>

    <button data-toggle="collapse" data-target="#datosConexion" class="btn btn-info">Abrir/Cerrar Datos de Conexion
    </button>
    <div style="margin-bottom: 0%;">
        <div id="datosConexion" class="col-lg-12 collapse in">
            <fieldset>
                <legend>Mis Datos de Conexion</legend>
                <span id="divPrueba" style="color: #000000">
                    <?php
                    $ipAdress = "<b>Direccion IP:</b> $_SERVER[REMOTE_ADDR]";
                    echo $ipAdress;
                    ?>
                    <br>
                    <?php
                    $serverName = "<b>Nombre del Servidor:</b> $_SERVER[SERVER_NAME]";
                    echo $serverName;
                    ?>
                    <br>
                    <br>
                </span>
                <button onclick="logout()">Logout</button>
            </fieldset>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-10 hidden-xs">
            logo
        </div>
        <div class="col-lg-8 col-md-8 hidden-sm hidden-xs">
            <h1>Gestion de Empresa</h1>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs text-right">
            logout
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php
            require_once 'controladores/MenusC.php';
            $objMenu = new MenusC();
            $objMenu->getVistaMenu();
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php
            if (isset($_GET['c']) && $_GET['c'] != '') {
                $controlador = $_GET['c'] . 'C';
                if (file_exists('controladores/' . $controlador . '.php')) {
                    require_once 'controladores/' . $controlador . '.php';
                    $objModulo = new $controlador();
                    $objModulo->getVistaPrincipal();

                } else {
                    echo 'Modulo no encontrado';
                }
            }
            ?>
            <br>
            <br>
        </div>
    </div>
</div>
<footer>
    <div class="col-lg-12" style="position: fixed; bottom: 0; background-color: #cbcbcb;">
        <center>© David Suescun Pelegay - 2º SI - Desarrollo de Interfaces - CES San Valero</center>
    </div>
</footer>
</body>
</html>
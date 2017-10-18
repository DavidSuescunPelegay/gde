<?php session_start();
//ob_start();
require_once 'config.php';
require_once 'php/FirePHPCore/fb.php';
if (!isset($_SESSION['login'])) {
    header('location: index.php');
}

require_once 'controladores/UsuariosC.php';

//INICIO CARGA DATOS BARRA LATERAL
$datosUsuario = new UsuariosC();
$datosUsuario->datosUsuario($_SESSION['login']);
//FIN CARGA DATOS BARRA LATERAL

//INICIO CARGA PERMISOS DEL USUARIO
$permisosUsuario = new UsuariosC();
$permisosUsuario->getDatosPermisosPorUsuario($_SESSION['login']);
//FIN CARGA PERMISOS DEL USUARIO
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <title>Gestion de Empresa - David Suescun Pelegay</title>
    <link rel="icon" type="image/png"
          href="http://plainicon.com/dboard/userprod/2800_a1826/prod_thumb/plainicon.com-50298-256px-4b4.png"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">

    <script src="js/jquery-3.1.1.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

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
    if (isset($_GET['d']) && $_GET['d'] != '') {
        if (file_exists('js/' . $_GET['d'] . '.js')) {
            echo '<script type="text/javascript" src="js/' . $_GET['d'] . '.js"></script>';
        }
    }
    ?>

    <!--Importacion de la libreria jQuery UI-->
    <link rel="stylesheet" href="jquery-ui-1.12.1.custom/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!--Importacion de la libreria Simple Autocomplete-->
    <link rel="stylesheet" href="js/simpleautocomplete/simpleAutoComplete.css">
    <script src="js/simpleautocomplete/simpleAutoComplete.js"></script>
    <script src="js/simpleautocomplete/simpleAutoCompleteBase.js"></script>
</head>
<body>
<div class="container col-lg-2 hidden-md hidden-sm hidden-xs" style="margin: 1%; height: 100%; position: fixed;">
    <button data-toggle="collapse" data-target="#misDatos" class="btn btn-info">Abrir/Cerrar Datos</button>
    <div style="margin-bottom: 10%;">
        <div id="misDatos" style="margin-bottom: 10%;" class="col-lg-12 collapse in">
            <fieldset>
                <legend>Mis Datos</legend>
                <?php
                $html = 'Bienvenido ' . $_SESSION['datosUsuario'][0]['nombre'] . ', estos son tus datos: ';
                $html .= '<table border="1px #000 solid" style="width: 100%">';
                $html .= '<tr>';
                $html .= '<td>ID Usuario</td>';
                $html .= '<td>' . $_SESSION['datosUsuario'][0]['id_Usuario'] . '</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<td>Nombre</td>';
                $html .= '<td>' . $_SESSION['datosUsuario'][0]['nombre'] . '</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<td>Apellido 1</td>';
                $html .= '<td>' . $_SESSION['datosUsuario'][0]['apellido_1'] . '</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<td>Apellido 2</td>';
                $html .= '<td>' . $_SESSION['datosUsuario'][0]['apellido_2'] . '</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<td>Usuario</td>';
                $html .= '<td>' . $_SESSION['datosUsuario'][0]['login'] . '</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<td>Activo</td>';
                $html .= '<td>' . $_SESSION['datosUsuario'][0]['activo'] . '</td>';
                $html .= '</tr>';
                $html .= '</table>';
                echo $html;
                ?>
            </fieldset>
        </div>
    </div>


    <button data-toggle="collapse" data-target="#misNotificaciones" class="btn btn-info">Abrir/Cerrar Notificaciones
    </button>
    <div style="margin-bottom: 10%;">
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
                <span id="divMisDatosDeConexion" style="color: #000000">
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
            </fieldset>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-10 hidden-xs">

        </div>
        <div class="col-lg-8 col-md-8 hidden-sm hidden-xs">
            <h1>Gestion de Empresa</h1>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs text-right">
            <button class="btn btn-warning" title="Cerrar sesion" onclick="logout()"><span
                        class="glyphicon glyphicon-off" aria-hidden="true"></span></button>
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

            if (isset($_GET['d']) && $_GET['d'] != '') {
                $controlador = $_GET['d'] . 'C';
                if (file_exists('controladores/' . $controlador . '.php')) {
                    require_once 'controladores/' . $controlador . '.php';
                    $objModulo = new $controlador();
                    $objModulo->getVistaPermisosPorId($_GET['opcion']);
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
<a href="#top">
    <center>
        <div style="position: fixed; bottom: 5%; right: 5%; height: 50px; width: 50px; background-color: #eaeaea;">
            Subir arriba
        </div>
    </center>
</a>
<footer>
    <div id="infoFooter">
        <center>Version del Proyecto: 2.1 - Ultima Actualizacion: Jueves, 08 de Diciembre de 2016 - <a
                    href="changelog.html">Accede al Changelog</a></center>
        <center>© David Suescun Pelegay - 2º SI - Desarrollo de Interfaces - CES San Valero</center>
    </div>
</footer>
</body>
</html>
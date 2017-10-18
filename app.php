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
    <meta charset="UTF-8">
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!--Importacion de la libreria Simple Autocomplete-->
    <link rel="stylesheet" href="js/simpleautocomplete/simpleAutoComplete.css">
    <script src="js/simpleautocomplete/simpleAutoComplete.js"></script>
    <script src="js/simpleautocomplete/simpleAutoCompleteBase.js"></script>
</head>
<body>
<div class="container col-lg-2 hidden-md hidden-sm hidden-xs" style="margin: 1%; height: 100%; position: fixed;">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="http://simpleicon.com/wp-content/uploads/user1.png"
                 class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                <?php
                $nombreCompleto = '';
                $nombreCompleto .= $_SESSION['datosUsuario'][0]['nombre'] . ' ';
                $nombreCompleto .= $_SESSION['datosUsuario'][0]['apellido_1'];
                echo $nombreCompleto;
                ?>
            </div>
            <div class="profile-usertitle-job">
                Gestion de Empresa
            </div>
        </div>
        <div class="profile-userbuttons">
            <button type="button" class="btn btn-danger btn-sm" onclick="logout()">Cerrar Sesion</button>
        </div>
        <div class="profile-usermenu">
            <ul class="nav">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingA">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseA"
                                   aria-expanded="true" aria-controls="collapseA">
                                    <i class="glyphicon glyphicon-home"></i>
                                    Inicio
                                </a>
                            </h4>
                        </div>
                        <div id="collapseA" class="panel-collapse collapse in" role="tabpanel"
                             aria-labelledby="collapseA">
                            <div class="panel-body">

                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingB">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseB" aria-expanded="false" aria-controls="collapseB">
                                    <i class="glyphicon glyphicon-user"></i>
                                    Mis Datos </a>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseB" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="headingB">
                            <div class="panel-body">
                                <?php
                                $html = '<table border="0px #000 solid" style="width: 100%">';
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
                                if ($_SESSION['datosUsuario'][0]['activo'] == 'S') {
                                    $html .= '<td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>';
                                }
                                if ($_SESSION['datosUsuario'][0]['activo'] == 'N') {
                                    $html .= '<td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>';
                                }
                                $html .= '</tr>';
                                $html .= '</table>';
                                echo $html;
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingC">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseC" aria-expanded="false" aria-controls="collapseC">
                                    <i class="glyphicon glyphicon-cloud"></i>
                                    Mis Datos de Conexion </a>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseC" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="headingC">
                            <div class="panel-body">
                                <?php
                                $ipAdress = "<b>Direccion IP:</b> $_SERVER[REMOTE_ADDR]";
                                echo $ipAdress;
                                ?>
                                <br>
                                <?php
                                $serverName = "<b>Nombre del Servidor:</b> $_SERVER[SERVER_NAME]";
                                echo $serverName;
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingD">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseD" aria-expanded="false" aria-controls="collapseD">
                                    <i class="glyphicon glyphicon-tasks"></i>
                                    Mis Notificaciones </a>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseD" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="headingD">
                            <div class="panel-body">
                                <div id="misNotificaciones" style="margin-bottom: 10%;" class="col-lg-12 collapse in">
                                    <span id="notificaciones"
                                          style="color: #ff0000">No tienes notificaciones pendientes</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingE">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseE" aria-expanded="false" aria-controls="collapseE">
                                    <i class="glyphicon glyphicon-wrench"></i>
                                    Ayuda </a>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseE" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="headingE">
                            <div class="panel-body">
                                    Navega por los menus y haz modificaciones, si no se muestran datos, probablemente no tengas permiso para ver esa pantalla.
                            </div>
                        </div>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 hidden-sm hidden-xs">
            <center><h1>Gestion de Empresa</h1></center>
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
        <center>Version del Proyecto: 2.2 - Ultima Actualizacion: Martes, 13 de Diciembre de 2016 - <a
                    href="changelog.html">Accede al Changelog</a></center>
        <center>© David Suescun Pelegay - 2º SI - Desarrollo de Interfaces - CES San Valero</center>
    </div>
</footer>
</body>
</html>

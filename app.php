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

    <!--Importacion de las librerias de Bootstrap y jQuery-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

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
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <?php if ($_SERVER['SERVER_NAME'] == 'gdedavidsp.altervista.org') { ?>
    <link rel="stylesheet" href="js/simpleautocomplete/simpleAutoComplete.css">
        <script src="js/simpleautocomplete/simpleAutoCompleteWeb.js"></script>
        <script src="js/simpleautocomplete/simpleAutoCompleteBaseWeb.js"></script>
    <?php }else{ ?>
    <link rel="stylesheet" href="js/simpleautocomplete/simpleAutoComplete.css">
        <script src="js/simpleautocomplete/simpleAutoComplete.js"></script>
        <script src="js/simpleautocomplete/simpleAutoCompleteBase.js"></script>
    <?php } ?>

    <!--Importacion de la libreria AjaxUpload-->
    <script src="js/ajaxupload/AjaxUpload.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" id="barraSuperior">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" id="logoPrincipal" href="#">GESTION DE EMPRESA</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php
            require_once 'controladores/MenusC.php';
            $objMenu = new MenusC();
            $objMenu->getVistaMenu();
            ?>
        </div>
    </div>
</nav>
<div class="container-fluid" style="margin-top: 2.5%">
    <div class="row">
        <div class="col-lg-2 hidden-md hidden-sm hidden-xs" id="barraLateral" style="position: fixed">
            <div class="profile-sidebar">
                <div class="profile-userpic">
                    <?php
                    if ($_SESSION['datosUsuario'][0]['foto_de_Perfil'] == null) {
                        ?>
                        <img src="http://simpleicon.com/wp-content/uploads/user1.png"
                             class="img-responsive" alt="" style="background-color: #FFFFFF">
                        <?php
                    } else {
                        ?>
                        <img src="<?php echo $_SESSION['datosUsuario'][0]['foto_de_Perfil']; ?>"
                             class="img-responsive" alt="" style="background-color: #FFFFFF">
                        <?php
                    }
                    ?>
                    <input type="hidden" id="id_Usuario" value="<?php echo $_SESSION['id_Usuario'] ?>">
                </div>
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        <?php
                        $nombreCompleto = '';
                        $nombreCompleto .= $_SESSION['datosUsuario'][0]['nombre'];
                        $nombreCompleto .= ' ';
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
                        <div class="panel-group" id="accordionLateral" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading itemsPanel" role="tab" id="headingA">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordionLateral"
                                           href="#collapseA"
                                           aria-expanded="true" aria-controls="collapseA">
                                            <i class="glyphicon glyphicon-home"></i>
                                            Inicio
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseA" class="panel-collapse collapse in" role="tabpanel"
                                     aria-labelledby="collapseA">
                                    <div class="panel-body itemsContent">
                                        GDE - Gestion de Empresa. <br><i>Gestiona tu empresa facilmente</i><br>
                                        Autor: David Suescun Pelegay
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading itemsPanel" role="tab" id="headingB">
                                    <h4 class="panel-title itemsContent">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                           data-parent="#accordionLateral"
                                           href="#collapseB" aria-expanded="false" aria-controls="collapseB">
                                            <i class="glyphicon glyphicon-user"></i>
                                            Mis Datos </a>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseB" class="panel-collapse collapse" role="tabpanel"
                                     aria-labelledby="headingB">
                                    <div class="panel-body itemsContent">
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
                                <div class="panel-heading itemsPanel" role="tab" id="headingC">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                           data-parent="#accordionLateral"
                                           href="#collapseC" aria-expanded="false" aria-controls="collapseC">
                                            <i class="glyphicon glyphicon-cloud"></i>
                                            Mis Datos de Conexion </a>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseC" class="panel-collapse collapse" role="tabpanel"
                                     aria-labelledby="headingC">
                                    <div class="panel-body itemsContent">
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
                                <div class="panel-heading itemsPanel" role="tab" id="headingD">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                           data-parent="#accordionLateral"
                                           href="#collapseD" aria-expanded="false" aria-controls="collapseD">
                                            <i class="glyphicon glyphicon-tasks"></i>
                                            Mis Notificaciones </a>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseD" class="panel-collapse collapse" role="tabpanel"
                                     aria-labelledby="headingD">
                                    <div class="panel-body itemsContent">
                                        <div id="misNotificaciones" style="margin-bottom: 10%;"
                                             class="col-lg-12 collapse in">
                                    <span id="notificaciones"
                                          style="color: #ff0000">No tienes notificaciones pendientes</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading itemsPanel" role="tab" id="headingE">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                           data-parent="#accordionLateral"
                                           href="#collapseE" aria-expanded="false" aria-controls="collapseE">
                                            <i class="glyphicon glyphicon-wrench"></i>
                                            Ayuda </a>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseE" class="panel-collapse collapse" role="tabpanel"
                                     aria-labelledby="headingE">
                                    <div class="panel-body itemsContent">
                                        Navega por los menus y haz modificaciones, si no se muestran datos,
                                        probablemente no
                                        tengas permiso para ver esa pantalla.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="cuerpoPrincipal">
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
    </div>
</div>

<a href="#top">
    <center>
        <div style="position: fixed; bottom: 5%; right: 5%; height: 20px; width: 20px; background-color: #eaeaea; border-radius: 100%;">
            <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
        </div>
    </center>
</a>
<footer>
    <div id="infoFooter">
        <center>Version del Proyecto: 3.2 - Ultima Actualizacion: Miercoles, 04 de Enero de 2017 - <a
                    href="changelog.html">Accede al Changelog</a></center>
        <center>© David Suescun Pelegay - 2º SI - Desarrollo de Interfaces - CES San Valero</center>
    </div>
</footer>
</body>
</html>

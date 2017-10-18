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
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            barra inferior
        </div>
    </div>

</div>
</body>
</html>
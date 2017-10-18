<?php
require_once $_SESSION['RAIZ'] . 'controladores/Controlador.php';
require_once $_SESSION['RAIZ'] . 'vistas/Vista.php';
require_once $_SESSION['RAIZ'] . 'modelos/MenusM.php';

class MenusC extends Controlador
{
    private $modelo;

    public function MenusC()
    { //constructor del objeto
        parent::Controlador(); //ejecuta el constructor padre
        $this->modelo = new MenusM();
    }

    public function getVistaMenu()
    {
        $menu = $this->modelo->getDatosMenu();
        $vista = new Vista();
        $vista->render($_SESSION['RAIZ'] . '/vistas/Menu/MenuV.php', $menu);
    }

    public function getDatosMenu()
    {
        $menu = $this->modelo->getDatosMenu();

        $vista = new Vista();
        $vista->render($_SESSION['RAIZ'] . '/vistas/Menu/MenuV.php', $menu);
    }

    public function getVistaPrincipal()
    {
        $menu = $this->modelo->getDatosMenu();

        $vista = new Vista();
        $vista->render($_SESSION['RAIZ'] . '/vistas/Menu/MenuGestionV.php', $menu);
    }

    public function insertarMenu($datos)
    {
        for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
            if ($_SESSION['permisos'][$i]['id_Permiso'] == 7) {
                echo json_encode($this->modelo->insertarMenu($datos));
            }
        }
    }

    public function modificarMenu($datos)
    {
        for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
            if ($_SESSION['permisos'][$i]['id_Permiso'] == 8) {
                $resultado = $this->modelo->guardarMenu($datos);
            }
        }
    }

    public function eliminarMenu($datos)
    {
        for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
            if ($_SESSION['permisos'][$i]['id_Permiso'] == 9) {
                $resultado = $this->modelo->eliminarMenu($datos);
            }
        }
    }

    public function autoCompleteUsuarios($parametros)
    {
        if (isset($parametros['query']) && $parametros['query'] != "") {
            //Descomponer lo escrito en palabras
            $texto = mb_strtoupper(utf8_decode(urldecode($parametros['query'])));
            $parametros['palabras'] = explode(' ', $texto);
            $parametros['filas'] = $this->modelo->getUsuariosAutocomplete($parametros);
            $vista = new Vista();
            $vista->render($_SESSION['RAIZ'] . '/vistas/Usuarios/UsuariosAutocompleteV.php', $parametros);
        }
    }
}

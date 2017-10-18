<?php
require_once $_SESSION['RAIZ'] . 'controladores/Controlador.php';
require_once $_SESSION['RAIZ'] . 'vistas/Vista.php';
require_once $_SESSION['RAIZ'] . 'modelos/RolesM.php';

class RolesC extends Controlador
{
    private $modelo;

    public function RolesC()
    { //constructor del objeto
        parent::Controlador(); //ejecuta el constructor padre
        $this->modelo = new RolesM();
    }

    public function getVistaPrincipal()
    {
        $lista = $this->modelo->getRoles();
        $vista = new Vista();
        $vista->render($_SESSION['RAIZ'] . '/vistas/Roles/RolesV.php', $lista);
    }

    public function insertarRol($datos)
    {
        for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
            if ($_SESSION['permisos'][$i]['id_Permiso'] == 17) {
                $resultado = $this->modelo->insertarRol($datos);
            }
        }
    }

    public function modificarRol($datos)
    {
        for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
            if ($_SESSION['permisos'][$i]['id_Permiso'] == 18) {
                $resultado = $this->modelo->modificarRol($datos);
            }
        }
    }

    public function eliminarRol($datos)
    {
        for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
            if ($_SESSION['permisos'][$i]['id_Permiso'] == 19) {
                $resultado = $this->modelo->eliminarRol($datos);
            }
        }
    }
}
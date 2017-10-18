<?php
require_once $_SESSION['RAIZ'] . 'controladores/Controlador.php';
require_once $_SESSION['RAIZ'] . 'vistas/Vista.php';
require_once $_SESSION['RAIZ'] . 'modelos/PermisosM.php';

class PermisosC extends Controlador
{
    private $modelo;

    public function PermisosC()
    { //constructor del objeto
        parent::Controlador(); //ejecuta el constructor padre
        $this->modelo = new PermisosM();
    }

    public function getVistaPrincipal()
    {
        $lista = $this->modelo->getPermisos();
        $vista = new Vista();
        $vista->render($_SESSION['RAIZ'] . '/vistas/Permisos/PermisosV.php', $lista);
    }

    public function insertarPermiso($datos)
    {
        for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
            if ($_SESSION['permisos'][$i]['id_Permiso'] == 12) {
                $resultado = $this->modelo->insertarPermiso($datos);
            }
        }
    }

    public function modificarPermiso($datos)
    {
        for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
            if ($_SESSION['permisos'][$i]['id_Permiso'] == 13) {
                $resultado = $this->modelo->modificarPermiso($datos);
            }
        }
    }

    public function eliminarPermiso($datos)
    {
        for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
            if ($_SESSION['permisos'][$i]['id_Permiso'] == 14) {
                $resultado = $this->modelo->eliminarPermiso($datos);
            }
        }
    }

    public function mostrarPermisosAsociados($datos)
    {
        $lista = $this->modelo->getPermisosPorId();
        $vista = new Vista();
        $vista->render($_SESSION['RAIZ'] . '/vistas/Permisos/PermisosV.php', $lista);
    }

    public function getVistaPermisosPorId($datos)
    {
        $lista = $this->modelo->getPermisosPorId($datos);
        $vista = new Vista();
        $vista->render($_SESSION['RAIZ'] . '/vistas/Permisos/PermisosFiltradosV.php', $lista);
    }
}
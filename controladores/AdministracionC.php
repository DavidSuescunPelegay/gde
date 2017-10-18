<?php
require_once $_SESSION['RAIZ'] . '/controladores/Controlador.php';
require_once $_SESSION['RAIZ'] . '/vistas/Vista.php';
require_once $_SESSION['RAIZ'] . '/modelos/AdministracionM.php';

class AdministracionC extends Controlador
{
    private $modelo;

    public function AdministracionC()
    { //constructor del objeto
        parent::Controlador(); //ejecuta el constructor padre
        $this->modelo = new AdministracionM();
    }

    public function getVistaPrincipal()
    {
        $resultado = $this->modelo->getRoles();
        $vista = new Vista();
        $vista->render($_SESSION['RAIZ'] . '/vistas/Administracion/AdministracionV.php', $resultado);
    }

    public function getDatosPermisos($datos)
    {
        $resultado = $this->modelo->getDatosPermisos($datos);
        $vista = new Vista();
        $vista->render($_SESSION['RAIZ'] . '/vistas/Administracion/AdministracionPermisosV.php', $resultado);
    }

    public function getDatosRoles($datos)
    {
        $resultado = $this->modelo->getDatosRoles($datos);
        $vista = new Vista();
        $vista->render($_SESSION['RAIZ'] . '/vistas/Administracion/AdministracionRolesV.php', $resultado);
    }

    public function insertarPermisoUsuario($datos)
    {
        for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
            if ($_SESSION['permisos'][$i]['id_Permiso'] == 22) {
                $resultado = $this->modelo->insertarPermisoUsuario($datos);
            }
        }
    }

    public function eliminarPermisoUsuario($datos)
    {
        for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
            if ($_SESSION['permisos'][$i]['id_Permiso'] == 24) {
                $resultado = $this->modelo->eliminarPermisoUsuario($datos);
            }
        }
    }

    public function insertarPermisoRol($datos)
    {
        for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
            if ($_SESSION['permisos'][$i]['id_Permiso'] == 22) {
                $resultado = $this->modelo->insertarPermisoRol($datos);
            }
        }
    }

    public function eliminarPermisoRol($datos)
    {
        for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
            if ($_SESSION['permisos'][$i]['id_Permiso'] == 24) {
                $resultado = $this->modelo->eliminarPermisoRol($datos);
            }
        }
    }

    public function insertarRolUsuario($datos)
    {
        for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
            if ($_SESSION['permisos'][$i]['id_Permiso'] == 22) {
                $resultado = $this->modelo->insertarRolUsuario($datos);
            }
        }
    }

    public function eliminarRolUsuario($datos)
    {
        for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
            if ($_SESSION['permisos'][$i]['id_Permiso'] == 24) {
                $resultado = $this->modelo->eliminarRolUsuario($datos);
            }
        }
    }
}

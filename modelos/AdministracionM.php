<?php
require_once $_SESSION['RAIZ'] . '/modelos/Modelo.php';
require_once $_SESSION['RAIZ'] . '/modelos/ClaseBD.php';

class AdministracionM extends Modelo
{
    private $BD;

    public function AdministracionM()
    {
        parent::Modelo();
        $this->BD = new ClaseBD();
    }

    public function getPermisos()
    {
        $SQL = "SELECT * FROM permisos ORDER BY permiso ASC";
        $datos = $this->BD->executeQuery($SQL);
        return $datos;
    }

    public function getRoles()
    {
        $SQL = "SELECT * FROM roles ORDER BY rol ASC";
        $datos = $this->BD->executeQuery($SQL);
        return $datos;
    }

    public function getDatosPermisos($datos)
    {
        $id_Usuario = '';
        $id_Rol = '';
        extract($datos);

        $SQLCompleto = "SELECT * FROM permisos ORDER BY id_Permiso";
        if ($id_Usuario != 0) {
            $SQLTablaIntermedia = "SELECT * FROM permisousuario WHERE id_Usuario='$id_Usuario'";
        }
        if ($id_Rol != 0) {
            $SQLTablaIntermedia = "SELECT * FROM permisorol WHERE id_Rol='$id_Rol'";
        }

        $resultadoSQLCompleto = $this->BD->executeQuery($SQLCompleto);
        $resultadoSQLIntermedia = $this->BD->executeQuery($SQLTablaIntermedia);

        $datosParaVista[0] = $resultadoSQLCompleto;
        $datosParaVista[1] = $resultadoSQLIntermedia;

        /*
        if ($id_Usuario != 0) {
            foreach ($resultadoSQLIntermedia as $item) {
                $datosParaVista[1][$item['id_Permiso']] = $item;
            }
        }
        if ($id_Rol != 0) {
            foreach ($resultadoSQLIntermedia as $item) {
                $datosParaVista[1][$item['id_Rol']] = $item;
            }
        }
        */

        return $datosParaVista;
    }

    public function getDatosRoles($datos)
    {
        $productosFiltrados = '';
        $parametrosFiltrados = '';
        $id_Usuario = '';
        $id_Rol = '';

        extract($datos);

        $SQLCompleto = "SELECT * FROM roles ORDER BY id_Rol";
        $SQLTablaIntermedia = "SELECT * FROM rolusuario WHERE id_Usuario='$id_Usuario'";

        $resultadoSQLCompleto = $this->BD->executeQuery($SQLCompleto);
        $resultadoSQLIntermedia = $this->BD->executeQuery($SQLTablaIntermedia);

        $datosParaVista[0] = $resultadoSQLCompleto;
        //$datosParaVista[1] = $resultadoSQLIntermedia;


        foreach ($resultadoSQLIntermedia as $item) {
            $datosParaVista[1][$item['id_Rol']] = $item;
        }


        return $datosParaVista;
    }

    public function insertarPermisoUsuario($datos)
    {
        $id_Permiso = '';
        $id_Usuario = '';

        extract($datos);

        $SQL = "INSERT INTO permisousuario (id_Permiso, id_Usuario) VALUES ('$id_Permiso', '$id_Usuario')";
        $resultado = $this->BD->executeInsert($SQL);

        console . log($SQL);

        return $resultado;
    }

    public function eliminarPermisoUsuario($datos)
    {
        $id_Permiso = '';
        $id_Usuario = '';

        extract($datos);

        $SQL = "DELETE FROM permisousuario WHERE id_Permiso='$id_Permiso' AND id_Usuario='$id_Usuario'";
        $resultado = $this->BD->executeDelete($SQL);

        return $resultado;
    }

    public function insertarPermisoRol($datos)
    {
        $id_Permiso = '';
        $id_Rol = '';

        extract($datos);

        $SQL = "INSERT INTO permisorol (id_Permiso, id_Rol) VALUES ('$id_Permiso', '$id_Rol')";
        $resultado = $this->BD->executeInsert($SQL);
    }

    public function eliminarPermisoRol($datos)
    {
        $id_Permiso = '';
        $id_Rol = '';

        extract($datos);

        $SQL = "DELETE FROM permisorol WHERE id_Permiso='$id_Permiso' AND id_Rol='$id_Rol'";
        $resultado = $this->BD->executeDelete($SQL);
    }

    public function insertarRolUsuario($datos)
    {
        $id_Rol = '';
        $id_Usuario = '';

        extract($datos);

        $SQL = "INSERT INTO rolusuario (id_Rol, id_Usuario) VALUES ('$id_Rol', '$id_Usuario')";
        $resultado = $this->BD->executeInsert($SQL);
    }

    public function eliminarRolUsuario($datos)
    {
        $id_Rol = '';
        $id_Usuario = '';

        extract($datos);

        $SQL = "DELETE FROM rolusuario WHERE id_Rol='$id_Rol' AND id_Usuario='$id_Usuario'";
        $resultado = $this->BD->executeDelete($SQL);
    }
}

<?php
require_once $_SESSION['RAIZ'] . '/modelos/Modelo.php';
require_once $_SESSION['RAIZ'] . '/modelos/ClaseBD.php';

class PermisosM extends Modelo
{
    private $BD;

    public function PermisosM()
    {
        parent::Modelo();
        $this->BD = new ClaseBD();
    }

    public function getPermisos()
    {
        $datos = array();

        //Antigua sentencia
        //$SQL = "SELECT permisos.id_Permiso, permisos.id_Opcion, menus.texto, permisos.num_Permiso, permisos.permiso FROM permisos, menus WHERE permisos.id_Opcion=menus.id_Opcion ORDER BY id_Permiso ASC";

        //Nueva sentencia (INNER JOIN)
        $SQL="SELECT permisos.id_Permiso, permisos.id_Opcion, menus.texto, permisos.num_Permiso, permisos.permiso FROM permisos INNER JOIN menus ON permisos.id_Opcion=menus.id_Opcion ORDER BY id_Permiso ASC";

        $res = $this->BD->executeQuery($SQL);
        $datos[0] = $res;

        $SQL = "SELECT id_Opcion, texto FROM menus ORDER BY id_Opcion ASC";
        $res = $this->BD->executeQuery($SQL);
        $datos[1] = $res;

        return $datos;
    }

    public function insertarPermiso($datos)
    {
        $id_Opcion = '';
        $num_Permiso = '';
        $permiso = '';

        extract($datos);

        $SQL = "INSERT INTO permisos (id_Opcion, num_Permiso, permiso) VALUES ('$id_Opcion', '$num_Permiso', '$permiso')";

        $res = $this->BD->executeInsert($SQL);

        return $res;
    }

    public function modificarPermiso($datos)
    {
        $id_Permiso = '';
        $id_Opcion = '';
        $num_Permiso = '';
        $permiso = '';

        extract($datos);

        $SQL = "UPDATE permisos SET id_Opcion='$id_Opcion', num_Permiso='$num_Permiso', permiso='$permiso' WHERE id_Permiso='" . $id_Permiso . "'";

        $res = $this->BD->executeUpdate($SQL);

        return $res;
    }

    public function eliminarPermiso($datos)
    {
        $id_Permiso = '';

        extract($datos);

        $SQL = "DELETE FROM permisos WHERE id_Permiso='$id_Permiso'";

        $res = $this->BD->executeDelete($SQL);

        $this->borrarPermisoUsuarioAsociados($id_Permiso);//Llamada a la funcion que borra los permisos asociados de la tabla permisousuario

        return $res;
    }

    public function borrarPermisoUsuarioAsociados($id_Permiso)
    {
        $SQL = "DELETE FROM permisousuario WHERE id_Permiso='$id_Permiso'";
        $res = $this->BD->executeDelete($SQL);
    }

    public function getPermisosPorId($datos)
    {
        $SQL = "SELECT permisos.id_Permiso, permisos.id_Opcion, menus.texto, permisos.num_Permiso, permisos.permiso FROM permisos, menus WHERE permisos.id_Opcion=menus.id_Opcion AND permisos.id_Opcion='$datos'";
        $res = $this->BD->executeQuery($SQL);
        $resultado[0] = $res;

        $SQL = "SELECT id_Opcion, texto FROM menus ORDER BY id_Opcion ASC";
        $res = $this->BD->executeQuery($SQL);
        $resultado[1] = $res;

        return $resultado;
    }
}

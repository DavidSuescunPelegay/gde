<?php
require_once '/modelos/Modelo.php';
require_once '/modelos/ClaseBD.php';

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
        $SQL = "SELECT * FROM permisos ORDER BY id_Permiso";
        $datos = $this->BD->executeQuery($SQL);

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
        echo $SQL;

        $res = $this->BD->executeDelete($SQL);

        return $res;
    }
}

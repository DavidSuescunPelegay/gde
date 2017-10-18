<?php
require_once $_SESSION['RAIZ'] . 'modelos/Modelo.php';
require_once $_SESSION['RAIZ'] . 'modelos/ClaseBD.php';

class RolesM extends Modelo
{
    private $BD;

    public function RolesM()
    {
        parent::Modelo();
        $this->BD = new ClaseBD();
    }

    public function getRoles()
    {
        $datos = array();
        $SQL = "SELECT * FROM roles ORDER BY id_Rol";
        $datos = $this->BD->executeQuery($SQL);

        return $datos;
    }

    public function insertarRol($datos)
    {
        $id_Rol = '';
        $rol = '';

        extract($datos);

        fb::log($datos);

        $SQL = "INSERT INTO roles (rol) VALUES ('$rol')";

        $res = $this->BD->executeInsert($SQL);

        return $res;
    }

    public function modificarRol($datos)
    {
        $id_Rol = '';
        $rol = '';

        extract($datos);

        $SQL = "UPDATE roles SET rol='$rol' WHERE id_Rol='$id_Rol'";

        $res = $this->BD->executeUpdate($SQL);

        return $res;
    }

    public function eliminarRol($datos)
    {
        $id_Rol = '';
        $rol = '';

        extract($datos);

        $SQL = "DELETE FROM roles WHERE id_Rol='$id_Rol'";

        $res = $this->BD->executeDelete($SQL);

        $this->borrarRolUsuarioAsociados($id_Rol);//Llamada a la funcion que borra los roles asociados de la tabla rolusuario

        return $res;
    }

    public function borrarRolUsuarioAsociados($id_Rol)
    {
        $SQL1 = "DELETE FROM rolusuario WHERE id_Rol='$id_Rol'";
        $res = $this->BD->executeDelete($SQL1);

        $SQL2 = "DELETE FROM permisorol WHERE id_Rol='$id_Rol'";
        $res = $this->BD->executeDelete($SQL2);
    }

    public function getRolesAutocomplete($filtros)
    {
        if (isset($filtros['query']) && $filtros['query'] != "") {
            $SQL = "SELECT id_Rol, rol FROM roles WHERE 1=1 ";
            foreach ($filtros['palabras'] as $npal => $palabra) {
                $SQL .= "AND CONCAT_WS(' ', rol) LIKE '%" . $palabra . "%'";
            }
            $SQL .= ' ORDER BY rol LIMIT 0,' . $filtros['numEle'];
            $res = $this->BD->executeQuery($SQL);
        }
        return $res;
    }
}

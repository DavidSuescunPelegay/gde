<?php
require_once $_SESSION['RAIZ'] . '/modelos/Modelo.php';
require_once $_SESSION['RAIZ'] . '/modelos/ClaseBD.php';

class MenusM extends Modelo
{
    private $BD;

    public function MenusM()
    {
        parent::Modelo();
        $this->BD = new ClaseBD();
    }

    public function getDatosMenu()
    {
        $menu = array();
        $SQL = "SELECT * FROM menus
				ORDER BY id_Opcion, id_Padre, orden";
        $res = $this->BD->executeQuery($SQL);

        if (!empty($res)) {
            foreach ($res as $opcion) {
                $id_Opcion = $opcion['id_Opcion'];
                if ($opcion['id_Padre'] == 0) {
                    //padre o uno principal
                    $menu[0][$id_Opcion] = $opcion;
                } else {
                    //hijo
                    $id_Padre = $opcion['id_Padre'];
                    $menu[0][$id_Padre]['subOpciones'][$id_Opcion] = $opcion;
                }
            }
        }

        $SQL = "SELECT id_Opcion, texto FROM menus ORDER BY id_Opcion ASC";
        $res = $this->BD->executeQuery($SQL);
        $menu[1] = $res;

        return $menu;
    }

    public function insertarMenu($datos)
    {
        $id_Opcion = '';
        $texto = '';
        $url = '';
        $id_Padre = '';
        $orden = '';

        extract($datos);

        $SQL = "INSERT INTO menus (texto, url, id_Padre, orden) VALUES ('$texto', '$url', '$id_Padre', '$orden')";
        $id_Opcion = $this->BD->executeInsert($SQL);

        $this->insertarPermisosAsociados($id_Opcion, $texto);

        return $id_Opcion;
    }

    public function insertarPermisosAsociados($id_Opcion, $texto)
    {
        /*INICIO GENERACION TEXTOS DEL PERMISO*/
        $textoPermiso1 = 'Consultar ' . $texto;
        $textoPermiso2 = 'Insertar ' . $texto;
        $textoPermiso3 = 'Modificar ' . $texto;
        $textoPermiso4 = 'Eliminar ' . $texto;
        $textoPermiso5 = 'Pruebas ' . $texto;
        /*FIN GENERACION TEXTOS DEL PERMISO*/


        /*INICIO GENERACION SENTENCIAS DE INSERCION AUTOMATICA DE LOS 4 PERMISOS PREDETERMINADOS*/
        $insercionPermiso1 = "INSERT INTO permisos (id_Opcion, num_Permiso, permiso) VALUES ('$id_Opcion', '1', '$textoPermiso1')";
        $insercionPermiso2 = "INSERT INTO permisos (id_Opcion, num_Permiso, permiso) VALUES ('$id_Opcion', '2', '$textoPermiso2')";
        $insercionPermiso3 = "INSERT INTO permisos (id_Opcion, num_Permiso, permiso) VALUES ('$id_Opcion', '3', '$textoPermiso3')";
        $insercionPermiso4 = "INSERT INTO permisos (id_Opcion, num_Permiso, permiso) VALUES ('$id_Opcion', '4', '$textoPermiso4')";
        $insercionPermiso5 = "INSERT INTO permisos (id_Opcion, num_Permiso, permiso) VALUES ('$id_Opcion', '5', '$textoPermiso4')";
        /*FIN GENERACION SENTENCIAS DE INSERCION AUTOMATICA DE LOS 4 PERMISOS PREDETERMINADOS*/

        /*INICIO EJECUCION SENTENCIAS DE INSERCION AUTOMATICA DE LOS 4 PERMISOS PREDETERMINADOS*/
        $resultadoInsercionPermiso1 = $this->BD->executeInsert($insercionPermiso1);
        $resultadoInsercionPermiso2 = $this->BD->executeInsert($insercionPermiso2);
        $resultadoInsercionPermiso3 = $this->BD->executeInsert($insercionPermiso3);
        $resultadoInsercionPermiso4 = $this->BD->executeInsert($insercionPermiso4);
        $resultadoInsercionPermiso5 = $this->BD->executeInsert($insercionPermiso5);
        /*FIN EJECUCION SENTENCIAS DE INSERCION AUTOMATICAS DE LOS 4 PERMISOS PREDETERMINADOS*/
    }

    public function guardarMenu($datos)
    {
        $id_Opcion = '';
        $texto = '';
        $url = '';
        $id_Padre = '';
        $orden = '';

        extract($datos);

        $SQL = "UPDATE menus SET texto='$texto', url='$url', id_Padre='$id_Padre', orden='$orden' ";

        $SQL .= "WHERE id_Opcion='" . $id_Opcion . "'";

        $numFilasModificadas = $this->BD->executeUpdate($SQL);

        $this->modificarPermisosAsociados($id_Opcion, $texto);

        return $numFilasModificadas;
    }

    public function modificarPermisosAsociados($id_Opcion, $texto)
    {
        /*INICIO GENERACION TEXTOS DEL PERMISO*/
        $textoPermiso1 = 'Consultar ' . $texto;
        $textoPermiso2 = 'Insertar ' . $texto;
        $textoPermiso3 = 'Modificar ' . $texto;
        $textoPermiso4 = 'Eliminar ' . $texto;
        $textoPermiso5 = 'Pruebas ' . $texto;
        /*FIN GENERACION TEXTOS DEL PERMISO*/


        /*INICIO GENERACION SENTENCIAS DE MODIFICACION AUTOMATICA DE LOS 4 PERMISOS PREDETERMINADOS*/
        $modificacionPermiso1 = "UPDATE permisos SET permiso='$textoPermiso1' WHERE id_Opcion='$id_Opcion' AND permiso LIKE 'Consultar%'";
        $modificacionPermiso2 = "UPDATE permisos SET permiso='$textoPermiso2' WHERE id_Opcion='$id_Opcion' AND permiso LIKE 'Insertar%'";
        $modificacionPermiso3 = "UPDATE permisos SET permiso='$textoPermiso3' WHERE id_Opcion='$id_Opcion' AND permiso LIKE 'Modificar%'";
        $modificacionPermiso4 = "UPDATE permisos SET permiso='$textoPermiso4' WHERE id_Opcion='$id_Opcion' AND permiso LIKE 'Eliminar%'";
        $modificacionPermiso5 = "UPDATE permisos SET permiso='$textoPermiso5' WHERE id_Opcion='$id_Opcion' AND permiso LIKE 'Pruebas%'";
        /*FIN GENERACION SENTENCIAS DE MODIFICACION AUTOMATICA DE LOS 4 PERMISOS PREDETERMINADOS*/

        /*INICIO EJECUCION SENTENCIAS DE MODIFICACION AUTOMATICA DE LOS 4 PERMISOS PREDETERMINADOS*/
        $resultadoModificacionPermiso1 = $this->BD->executeUpdate($modificacionPermiso1);
        $resultadoModificacionPermiso2 = $this->BD->executeUpdate($modificacionPermiso2);
        $resultadoModificacionPermiso3 = $this->BD->executeUpdate($modificacionPermiso3);
        $resultadoModificacionPermiso4 = $this->BD->executeUpdate($modificacionPermiso4);
        $resultadoModificacionPermiso5 = $this->BD->executeUpdate($modificacionPermiso5);
        /*FIN EJECUCION SENTENCIAS DE MODIFICACION AUTOMATICAS DE LOS 4 PERMISOS PREDETERMINADOS*/
    }

    public function eliminarMenu($datos)
    {
        $id_Opcion = '';
        $texto = '';
        $url = '';
        $id_Padre = '';
        $orden = '';

        extract($datos);

        $SQL = "DELETE FROM menus WHERE id_Opcion='" . $id_Opcion . "'";

        $id_Opcion = $this->BD->executeDelete($SQL);

        $this->eliminarPermisosAsociados($id_Opcion);

        return $id_Opcion;
    }

    public function eliminarPermisosAsociados($id_Opcion)
    {
        /*INICIO GENERACION SENTENCIAS DE ELIMINACION AUTOMATICA DE LOS 4 PERMISOS PREDETERMINADOS*/
        $eliminacionPermiso = "DELETE FROM permisos WHERE id_Opcion='$id_Opcion'";
        /*FIN GENERACION SENTENCIAS DE ELIMINACION AUTOMATICA DE LOS 4 PERMISOS PREDETERMINADOS*/

        /*INICIO EJECUCION SENTENCIAS DE ELIMINACION AUTOMATICA DE LOS 4 PERMISOS PREDETERMINADOS*/
        $resultadoEliminacionPermisos = $this->BD->executeDelete($eliminacionPermiso);
        /*FIN EJECUCION SENTENCIAS DE ELIMINACION AUTOMATICAS DE LOS 4 PERMISOS PREDETERMINADOS*/
    }

    public function getUsuariosAutocomplete($filtros)
    {
        if (isset($filtros['query']) && $filtros['query'] != "") {
            $SQL = "SELECT id_Usuario, nombre, apellido_1, apellido_2 FROM usuarios WHERE 1=1 ";
            foreach ($filtros['palabras'] as $npal => $palabra) {
                $SQL .= "AND CONCAT_WS(' ', nombre, apellido_1, apellido_2) LIKE '%" . $palabra . "%'";
            }
            $SQL .= ' ORDER BY apellido_1, apellido_2, nombre LIMIT 0,' . $filtros['numEle'];
            $res = $this->BD->executeQuery($SQL);
        }
        return $res;
    }
}

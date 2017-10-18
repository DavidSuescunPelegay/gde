<?php
require_once $_SESSION['RAIZ'] . 'modelos/Modelo.php';
require_once $_SESSION['RAIZ'] . 'modelos/ClaseBD.php';

class FicherosM extends Modelo
{
    private $BD;

    public function FicherosM()
    {
        parent::Modelo();
        $this->BD = new ClaseBD();
    }

    public function insertarFichero($datos)
    {
        $id_Usuario = '';
        $url = '';
        $nombre = '';
        $nombre_Original = '';
        $parametros = '';
        $ext = '';
        extract($datos);

        $SQL = "INSERT INTO ficheros SET
                id_Usuario='$id_Usuario',
                url='$url',
                nombre='$nombre',
                nombre_Original='$nombre_Original',
                ext='$ext',
                parametros='$parametros' ";

        $id = $this->BD->executeInsert($SQL);
        return $id;
    }

    public function findAll($filtros)
    {
        $id_Usuario = '';
        $url = '';
        $nombre = '';
        $nombre_Original = '';
        $parametros = '';
        $ext = '';
        $id_Fichero = '';
        extract($filtros);

        $SQL = "SELECT * FROM ficheros WHERE 1=1 AND activo='S' ";
        if ($id_Usuario) {
            $SQL .= "AND id_Usuario='$id_Usuario' ";
        }
        if ($parametros) {
            $SQL .= "AND parametros='$parametros' ";
        }
        if ($id_Fichero) {
            $SQL .= "AND id_Fichero='$id_Fichero' ";
        }
        if ($nombre) {
            $SQL .= "AND nombre='$nombre' ";
        }

        $filas = $this->BD->executeQuery($SQL);

        return $filas;
    }

    public function establecerFotoPerfil($datos)
    {
        $id_Fichero = '';
        extract($datos);

        $id_Usuario = $_SESSION['id_Usuario'];

        $SQL = "UPDATE usuarios SET foto_de_Perfil='$id_Fichero' WHERE id_Usuario='$id_Usuario'";

        $res = $this->BD->executeUpdate($SQL);

        return $res;
    }

    public function desestablecerFotoPerfil($datos){
        $id_Usuario='';
        extract($datos);

        $id_Usuario_Session = $_SESSION['id_Usuario'];

        if ($id_Usuario==$id_Usuario_Session){
            $SQL = "UPDATE usuarios SET foto_de_Perfil=NULL WHERE id_Usuario='$id_Usuario_Session'";

            $res=$this->BD->executeUpdate($SQL);

            return $res;
        }

        return null;
    }

    public function desactivarFichero($datos){
        $id_Fichero='';
        extract($datos);

        $SQL = "UPDATE ficheros SET activo='N' WHERE id_Fichero='$id_Fichero'";

        $res = $this->BD->executeUpdate($SQL);

        return $res;
    }
}
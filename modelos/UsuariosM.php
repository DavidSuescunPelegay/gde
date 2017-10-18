<?php
require_once $_SESSION['RAIZ'] . 'modelos/Modelo.php';
require_once $_SESSION['RAIZ'] . 'modelos/ClaseBD.php';

class UsuariosM extends Modelo
{
    private $BD;

    public function UsuariosM()
    {
        parent::Modelo();
        $this->BD = new ClaseBD();
    }

    public function validarUsuario($campos)
    {
        $login = '';
        $pass = '';
        extract($campos);

        $login = addslashes($login);
        $pass = MD5($pass);

        $SQL = "SELECT * FROM usuarios
				WHERE login='" . $login . "' 
					AND pass='" . $pass . "' 
					AND activo='S' ";
        $res = $this->BD->executeQuery($SQL);
        if (sizeof($res) > 0) {
            return $res[0];
        } else {
            return array();
        }
    }

    public function datosUsuario($login)
    {
        $SQL = "SELECT * FROM usuarios WHERE login='$login'";
        $res = $this->BD->executeQuery($SQL);

        return $res;
    }

    public function fotoUsuario($id_Fichero)
    {
        $SQL = "SELECT CONCAT(url,nombre,ext) FROM ficheros WHERE id_Fichero='$id_Fichero'";

        $res = $this->BD->executeQuery($SQL);

        return $res[0]['CONCAT(url,nombre,ext)'];
    }

    public function getDatosPermisosPorUsuario($login)
    {
        $SQLencontarId = "SELECT id_Usuario FROM usuarios WHERE login='$login'";
        $resEncontrarId = $this->BD->executeQuery($SQLencontarId);
        $id_Usuario = $resEncontrarId[0]['id_Usuario'];
        $_SESSION['id_Usuario'] = $id_Usuario;

        $SQL = "SELECT * FROM permisousuario WHERE id_Usuario=$id_Usuario";
        $res = $this->BD->executeQuery($SQL);

        return $res;
    }

    public function findAll($datos)
    {
        $id_Usuario = '';
        $nombre = '';
        $login = '';
        $activo = '';

        extract($datos);

        $SQL = "SELECT * FROM usuarios
				WHERE 1=1 ";

        if ($id_Usuario != '') {
            $SQL .= " AND id_Usuario='" . $id_Usuario . "'";
        }
        if ($nombre != '') {
            $SQL .= " AND ( nombre LIKE '%" . $nombre . "%' 
							OR apellido_1 LIKE '%" . $nombre . "%'
							OR apellido_2 LIKE '%" . $nombre . "%'
						) ";
        }
        if ($login != '') {
            if ($login == 'S') {
                $SQL .= " AND login = '" . $login . "' ";
            } else {
                $SQL .= " AND login LIKE '%" . $login . "%' ";
            }
        }
        if ($activo !== '') {
            $SQL .= "AND activo = '" . $activo . "' ";
        }

        $SQL .= " ORDER BY apellido_1, apellido_2, nombre";

        $filas = $this->BD->executeQuery($SQL);
        return $filas;
    }

    public function getDatosUsuarioPorId($id_Usuario)
    {
        $SQL = "SELECT * FROM usuarios
					WHERE id_Usuario='" . $id_Usuario . "' ";
        $res = $this->BD->executeQuery($SQL);
        return $res[0];
    }

    public function insertUsuario($datos)
    {
        $nombre = '';
        $apellido_1 = '';
        $apellido_2 = '';
        $login = '';
        $pass = '';
        $activo = 'N';
        extract($datos);
        $pass = md5($pass);

        $SQL = "INSERT INTO usuarios SET
				nombre='$nombre',
				apellido_1='$apellido_1',
				apellido_2='$apellido_2',
				login='$login',
				pass='$pass',
				activo='$activo' ";
        $id = $this->BD->executeInsert($SQL);
        return $id;
    }

    public function updateUsuario($datos)
    {
        $id_Usuario = '';
        $nombre = '';
        $apellido_1 = '';
        $apellido_2 = '';
        $login = '';
        $pass = '';
        $actualizarPass = 'N';
        $activo = 'N';
        extract($datos);
        $pass = md5($pass);

        $SQL = "UPDATE usuarios SET
				nombre='$nombre',
				apellido_1='$apellido_1',
				apellido_2='$apellido_2',
				login='$login', ";
        if ($actualizarPass == 'S') {
            $SQL .= "pass='$pass', ";
        }
        $SQL .= "activo='$activo' 
				WHERE id_Usuario='" . $id_Usuario . "' ";
        $numFilasModificadas = $this->BD->executeUpdate($SQL);
        return $numFilasModificadas;
    }

    public function activarDesactivarUsuario($datos)
    {
        $id_Usuario = '';
        $activo = 'N';
        extract($datos);

        $SQL = "UPDATE usuarios SET
				activo='$activo' 
				WHERE id_Usuario='" . $id_Usuario . "' ";
        $numFilasModificadas = $this->BD->executeUpdate($SQL);
        return $numFilasModificadas;
    }

    public function subirFichero($url)
    {
        fb::log($url);
        $id_Usuario = $_SESSION['datosUsuario'][0]['id_Usuario'];
        $SQL = "UPDATE usuarios SET img='$url' WHERE id_Usuario='$id_Usuario'";
        fb::log($SQL);
    }

    public function getUsuariosAutocomplete($filtros)
    {
        $res = '';
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
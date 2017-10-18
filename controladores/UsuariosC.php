<?php
require_once $_SESSION['RAIZ'] . '/controladores/Controlador.php';
//include '/controladores/Controlador.php';
require_once $_SESSION['RAIZ'] . '/modelos/UsuariosM.php';
require_once $_SESSION['RAIZ'] . '/vistas/Vista.php';

class UsuariosC extends Controlador
{
    private $modelo;

    public function UsuariosC()
    { //constructor del objeto
        parent::Controlador(); //ejecuta el constructor padre
        $this->modelo = new UsuariosM();
    }

    public function validarUsuario($datos)
    {
        $validacion = $this->modelo->validarUsuario($datos);

        if (!empty($validacion)) {
            $respuesta['valido'] = 'S';
            $respuesta['msj'] = '';
        } else {
            $respuesta['valido'] = 'N';
            $respuesta['msj'] = 'Datos incorrectos';
        }
        $respuesta['datos'] = $validacion;
        return $respuesta;
    }

    public function datosUsuario($login)
    {
        $datosUsuario = $this->modelo->datosUsuario($login);
        $_SESSION['datosUsuario'] = $datosUsuario;
    }

    public function getDatosPermisosPorUsuario($login)
    {
        $permisosPorUsuario = $this->modelo->getDatosPermisosPorUsuario($login);
        $_SESSION['permisos'] = $permisosPorUsuario;
    }

    public function getVistaPrincipal()
    {
        $vista = new Vista();
        $vista->render($_SESSION['RAIZ'] . '/vistas/Usuarios/UsuariosV.php');
    }

    public function getVistaResultadosBusqueda($datos)
    {
        $filas = $this->modelo->findAll($datos);
        $vista = new Vista();
        $vista->render($_SESSION['RAIZ'] . '/vistas/Usuarios/UsuariosBusquedaV.php', $filas);
    }

    public function getDatosUsuario($datos)
    {
        $usuario = $this->modelo->getDatosUsuarioPorId($datos['id_Usuario']);

        $usuario['nombre'] = utf8_encode($usuario['nombre']);
        $usuario['apellido_1'] = utf8_encode($usuario['apellido_1']);
        $usuario['apellido_2'] = utf8_encode($usuario['apellido_2']);
        $usuario['login'] = utf8_encode($usuario['login']);

        echo json_encode($usuario);
    }

    public function guardarUsuario($datos)
    {
        for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
            if ($_SESSION['permisos'][$i]['id_Permiso'] == 2 || $_SESSION['permisos'][$i]['id_Permiso'] == 3) {
                $respuesta['correcto'] = 'S';
                $respuesta['tipoError'] = '';
                if ($datos['id_Usuario'] == 0) {
                    $respuesta['msj'] = utf8_encode('Se ha guardado el nuevo usuario.');
                } else {
                    $respuesta['msj'] = utf8_encode('Se han guardado los cambios del usuario.');
                }
                //comprobar que no se repite el login
                $filas = $this->modelo->findAll(array('login' => $datos['login'],
                    'loginEXACTO' => 'S', 'activo' => ''));
                if (!empty($filas) && $filas[0]['id_Usuario'] != $datos['id_Usuario']) {
                    $respuesta['correcto'] = 'N';
                    $respuesta['tipoError'] = 'loginReptido';
                    $respuesta['msj'] = utf8_encode('Login repetido, elija otro.');
                } else {
                    if ($datos['id_Usuario'] == 0) { //nuevo
                        $resul = $this->modelo->insertUsuario($datos);
                        if ($resul < 1) {
                            $respuesta['correcto'] = 'N';
                            $respuesta['tipoError'] = 'errorGuardar';
                            $respuesta['msj'] = utf8_encode('Error al guardar.');

                        }
                    } else { //modificacion
                        if (isset($datos['pass']) && $datos['pass'] != '') $datos['actualizarPass'] = 'S';

                        $resul = $this->modelo->updateUsuario($datos);
                        if ($resul != 1) {
                            $respuesta['correcto'] = 'N';
                            $respuesta['tipoError'] = 'errorModificar';
                            $respuesta['msj'] = utf8_encode('Error al modificar.');

                        }
                    }
                }

                echo json_encode($respuesta);
            }
        }
    }

    public function activarDesactivar($datos)
    {
        for ($i = 0; $i < count($_SESSION['permisos']); $i++) {
            if ($_SESSION['permisos'][$i]['id_Permiso'] == 4) {
                $respuesta['correcto'] = 'S';
                $respuesta['tipoError'] = '';
                if ($datos['activo'] == 'S') {
                    $respuesta['msj'] = utf8_encode('Se ha activado el usuario.');
                } else {
                    $respuesta['msj'] = utf8_encode('Se ha desactivado el usuario.');
                }
                $resul = $this->modelo->activarDesactivarUsuario($datos);
                if ($resul != 1) {
                    $respuesta['correcto'] = 'N';
                    $respuesta['tipoError'] = 'errorModificar';
                    $respuesta['msj'] = utf8_encode('Error al cambiar el estado del usuario.');

                }
                echo json_encode($respuesta);
            }
        }
    }

    public function autoCompleteUsuarios($parametros)
    {
        if (isset($parametros['query']) && $parametros['query'] != "") {
            //Descomponer lo escrito en palabras
            $texto = mb_strtoupper(utf8_decode(urldecode($parametros['query'])));
            $parametros['palabras'] = explode(' ', $texto);
            $parametros['filas'] = $this->modelo->getUsuariosAutocomplete($parametros);
            $vista = new Vista();
            $vista->render($_SESSION['RAIZ'] . '/vistas/Usuarios/UsuariosAutocompleteV.php', $parametros);
        }
    }

    public function subirFichero($parametros)
    {
        $tipo = '';
        $id_Usuario = $_SESSION['datosUsuario'][0]['id_Usuario'];//Obligatorio
        $fichero = array();
        extract($parametros);

        var_dump($parametros);
        fb::log($parametros);

        $ficheroTemporal = $fichero['tmp_name'];
        $carpetaDestino = $_SESSION['RAIZ'] . "ficheros\\fotosUsuarios\\";
        $nombreFichero = substr('00000000000', 0, 11 - strlen((string)$id_Usuario)) . $id_Usuario . '.' . pathinfo($fichero['name'],  PATHINFO_EXTENSION);

        $ficheroDestino = $carpetaDestino . $nombreFichero;

        try{
            if (copy($ficheroTemporal, $ficheroDestino)) {
                echo 'Imagen guardada';
                $this->modelo->subirFichero($ficheroDestino);
            } else {
                echo 'Error';
            }
        }catch (Exception $ex){
            echo 'Exception';
        }

    }
}

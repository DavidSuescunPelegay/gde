<?php
require_once $_SESSION['RAIZ'] . '/controladores/Controlador.php';
require_once $_SESSION['RAIZ'] . '/modelos/FicherosM.php';
require_once $_SESSION['RAIZ'] . '/vistas/Vista.php';

class FicherosC extends Controlador
{
    private $modelo;

    public function FicherosC()
    { //constructor del objeto
        parent::Controlador(); //ejecuta el constructor padre
        $this->modelo = new FicherosM();
    }

    public function getVistaPrincipal()
    {
        $datosParaGestion['id_Usuario'] = $_SESSION['datosUsuario'][0]['id_Usuario'];

        $datos[0] = $this->getVistaFotosUsuarios($datosParaGestion);
        $datos[1] = $this->getVistaDocumentosUsuarios($datosParaGestion);

        $vista = new Vista();
        $vista->render($_SESSION['RAIZ'] . '/vistas/Ficheros/FicherosV.php', $datos);
    }

    public function guardarFichero($datos)
    {
        return $this->modelo->insertarFichero($datos);
    }

    public function subirFoto($parametros)
    {
        $tipo = ' ';
        $id_Usuario = ''; //obligatorio
        $fichero = array();
        extract($parametros);

        $ficheroTemporal = $fichero['tmp_name'];
        $carpetaDestino = $_SESSION['RAIZ'] . 'ficheros/fotosUsuarios/';
        $fichCod = str_pad($id_Usuario, 11, '0', STR_PAD_LEFT) . '_';
        $fichExt = '.' . pathinfo($fichero['name'], PATHINFO_EXTENSION);

        //Para subir varias fotos el mismo usuario
        $contador = 0;
        do {
            $contador++;
            $fichNum = str_pad($contador, 4, '0', STR_PAD_LEFT); //Numero de 4 digitos
            $nombreFichero = $fichCod . $fichNum . $fichExt;
        } while (file_exists($carpetaDestino . $nombreFichero));

        $ficheroDestino = $carpetaDestino . $nombreFichero;

        if (move_uploaded_file($ficheroTemporal, $ficheroDestino)) {
            $datos = array();
            $datos['id_Usuario'] = $id_Usuario;
            $datos['url'] = 'ficheros/fotosUsuarios/';
            $datos['nombre'] = $fichCod . $fichNum;
            $datos['nombre_Original'] = pathinfo($fichero['name'], PATHINFO_EXTENSION);
            $datos['ext'] = $fichExt;
            $datos['parametros'] = 'FotoUsuario';

            $id = $this->guardarFichero($datos);

            echo 'ok';
        } else {
            echo 'error';
        }

    }

    public function getVistaFotosUsuarios($datos)
    {
        $id_Usuario = $datos['id_Usuario'];

        $filtros = array();
        $filtros['id_Usuario'] = $id_Usuario;
        $filtros['parametros'] = 'FotoUsuario';

        $ficheros = $this->modelo->findAll($filtros);

        if ($ficheros) {
            /*
            $vista = new Vista();
            $vista->render($_SESSION['RAIZ'] . '/vistas/Ficheros/FicherosV.php', $ficheros);
            */
            return $ficheros;
        }

    }

    //Para los documentos
    //FUNCION PARA SUBIR FICHEROS
    public function subirDocumento($parametros)
    {
        $id_Usuario = ''; //obligatorio
        $fichero = array();
        extract($parametros);

        $ficheroTemporal = $fichero['tmp_name'];
        $carpetaDestino = $_SESSION['RAIZ'] . 'ficheros/docsUsuarios/';
        //$fichCod = sha1($fichero['name']);
        //$fichCod = str_pad($id_Usuario, 11, '0', STR_PAD_LEFT) . '_';
        $fichExt = '.' . pathinfo($fichero['name'], PATHINFO_EXTENSION);

        $contador = 0;
        do {
            $contador++;
            $fichNum = str_pad($contador, 4, '0', STR_PAD_LEFT); //Numero de 4 digitos
            $nombreFichero = $fichNum;
        } while (file_exists($carpetaDestino . $nombreFichero));

        $nombreFichero = $fichero['name'];
        $ficheroDestino = $carpetaDestino . $nombreFichero;

        if (move_uploaded_file($ficheroTemporal, $ficheroDestino)) {
            $datos = array();
            $datos['id_Usuario'] = $id_Usuario;
            $datos['url'] = 'ficheros/docsUsuarios/';
            //$datos['nombre'] = $fichCod . $contador;
            //$datos['nombre'] = $fichCod;
            $datos['nombre'] = $nombreFichero;
            $datos['nombre_Original'] = pathinfo($fichero['name'], PATHINFO_EXTENSION);
            $datos['ext'] = $fichExt;
            $datos['parametros'] = 'DocumentoUsuario';

            $id = $this->guardarFichero($datos);

            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function getVistaDocumentosUsuarios($datos)
    {
        $id_Usuario = $datos['id_Usuario'];

        $filtros = array();
        $filtros['id_Usuario'] = $id_Usuario;
        $filtros['parametros'] = 'DocumentoUsuario';

        $ficheros = $this->modelo->findAll($filtros);

        if ($ficheros) {
            /*
            $vista = new Vista();
            $vista->render($_SESSION['RAIZ'] . '/vistas/Ficheros/FicherosV.php', $ficheros);
            */
            return $ficheros;
        }
    }

    public function establecerFotoPerfil($datos)
    {
        $res = $this->modelo->establecerFotoPerfil($datos);
    }

    public function desactivarFichero($datos)
    {
        $res = $this->modelo->desactivarFichero($datos);
    }
}
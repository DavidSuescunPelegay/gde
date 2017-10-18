$(document).ready(function () {
//INICIO CARGA FOTO USUARIO
    new AjaxUpload('#subirFoto', {
            action: 'AjaxC.php',
            name: 'fichero',
            onSubmit: function (file, ext) {
                if (!(ext && /^(jpg|JPG|png|PNG|gif|GIF)$/.test(ext))) {
                    alert("Deben ser imagenes jpg, png o gif");
                    return false;
                } else {
                    this.setData({
                        c: 'Usuarios',
                        a: 'subirFichero',
                        tipo: 'fotoUsuario',
                    });
                }
            },
            onComplete: function (file, respuesta) {

            }
        }
    );
    //FIN CARGA FOTO USUARIO
});
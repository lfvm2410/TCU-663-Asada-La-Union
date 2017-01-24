<?php

  /*
  // Clase logica intermediaria entre el controlador y la data del index, tiene como objetivo validar
  // reglas de negocio y gestionar los llamados hacia la data
  */

	class indexlogic extends logica{

    private $indexData;
    private $indexValidation;

		public function __construct(){

      $this->indexData = new indexData();
      $this->indexValidation = new indexValidation();

		}

    /*
    // Metodo encargado de guardar los archivos adjuntos
    */

    public function guardarArchivosAdjuntos($archivoDisponibilidadHidrica, $archivoArregloPagos){

      if ($this->indexValidation->validarArchivoAdjunto($archivoDisponibilidadHidrica) &&
          $this->indexValidation->validarArchivoAdjunto($archivoArregloPagos)) {

        if (move_uploaded_file($archivoDisponibilidadHidrica['tmp_name'], 
                               RUTA_ARCHIVOS_ADJUNTOS."disponibilidadHidrica.pdf") &&
            move_uploaded_file($archivoArregloPagos['tmp_name'], RUTA_ARCHIVOS_ADJUNTOS."arregloPagos.pdf")) {
          
          echo "true";

        }else{

          echo "false";

        }
          
      }else{

        echo "false";

      }

    }

    /*
    // Metodo encargado de retornar la información para la página de presentación
    */
      
    public function obtenerInformacionPaginaPresentacion(){

      $informacionPaginaPresentacion = $this->indexData->obtenerInformacionPaginaPresentacion();

      print_r(json_encode($informacionPaginaPresentacion));

    }

    /*
    // Metodo encargado de retornar las imagenes (nombres) y la información de la asada
    */

    public function obtenerInformacionImagenesPaginaPresentacion(){

      $informacionAsada = $this->indexData->obtenerInformacionPaginaPresentacion();

      $imagenes = scandir(RUTA_IMAGENES_PAGINA_PRESENTACION);

      if ($imagenes != false) {

        // Se limpia el array de imagenes

        $imagenesLimpias = array();

        foreach ($imagenes as $imagen) {
          
          if (!$this->indexValidation->verificarCadenasIguales($imagen,".") &&
              !$this->indexValidation->verificarCadenasIguales($imagen,"..")) {

            $imagenesLimpias[] = $imagen;

          }

        }

        print_r(json_encode(array('informacionAsada' => $informacionAsada, 'imagenes' => $imagenesLimpias)));
        
      }else{

        print_r(json_encode("false"));
        
      }

    }

    /*
    // Metodo encargado de guardar la informacion de la pagina de presentacion
    */

    public function guardarInformacionPaginaPresentacion($quienesSomos, $mision, $vision, $valores, $listaImagenes){

      if ($this->indexValidation->validarCamposTexto($quienesSomos, 250) && 
          $this->indexValidation->validarCamposTexto($mision, 250) &&
          $this->indexValidation->validarCamposTexto($vision, 250) && 
          $this->indexValidation->validarCamposTexto($valores, 250) &&
          $this->indexValidation->validarListaImagenes($listaImagenes)) {

        if ($this->indexData->guardarInformacionPaginaPresentacion($quienesSomos, $mision, $vision, $valores, $listaImagenes)) {

          echo "true";
        
        }else{

          echo "false";

        }
        
      }else{

        echo "false";

      }

    }

    /*
    // Metodo encargado para descargar un archivo adjunto por los administradores
    */

    public function descargarArchivoAdjunto($nombreArchivo){

      if ($this->indexValidation->validarCamposTextoRequeridos($nombreArchivo)) {
              
        $file = basename($nombreArchivo);
        $path = RUTA_ARCHIVOS_ADJUNTOS.$file;
        $type = '';
   
        if (is_file($path)) {
        
          $size = filesize($path);
       
          if (function_exists('mime_content_type')) {
         
            $type = mime_content_type($path);
         
          } else if (function_exists('finfo_file')) {
         
            $info = finfo_open(FILEINFO_MIME);
         
            $type = finfo_file($info, $path);
         
            finfo_close($info);
         
          }
         
          if ($type == '') {
         
            $type = "application/force-download";
          
          }

           // Define los headers

          header("Content-Type: $type");
          header("Content-Disposition: attachment; filename=$file");
          header("Content-Transfer-Encoding: binary");
          header("Content-Length: " .$size);

          // Descargar el archivo
           
          readfile($path);

        }else{

          header('Location: '.URL."error/notFound");

          exit;

        }

      }else{

        header('Location: '.URL.'error/badRequest');

        exit;

      }

    }

    /*
    //Metodo encargado de obtener el personal de la asada
    */

    public function obtenerPersonalAsada(){

      $personaData = new personaData();

      $listaPersonalAsada = $personaData->obtenerPersonalAsada();

      print_r(json_encode($listaPersonalAsada));

    }

    /*
    // Metodo encargado de enviar el correo electrónico con la sugerencia
    */
 
    private function enviarCorreoElectronico($asunto, $comentario, $correoElectronico){

      $personaData = new personaData();

      $listaCorreosElectronicos = $personaData->obtenerCorreoElectronicoPorTipoUsuario("Administrador");

      $correosElectronicos = "";

      foreach ($listaCorreosElectronicos as $correo) {

        $correosElectronicos .= $correo['correoElectronico'];

        if ($correo !== end($listaCorreosElectronicos)) {

          $correosElectronicos .= ",";
        
        }
          
      }

      if (!empty($correosElectronicos)) {
        
        $mensaje = '<html>
          <head>
            <title>'.$asunto.'</title>
          </head>
          <body>
            <p>Una persona con el correo electrónico: <strong>'.$correoElectronico.'</strong> ha escrito una sugerencia para la ASADA.</p>
            <p><strong>La sugerencia es la siguiente:</strong></p>
            <p>'.$comentario.'</p>
          </body>
        </html>';
     
        $cabeceras = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $cabeceras .= 'From: Sistema de control ASADA La Unión <noreply@sisconasadalaunion.com>'. "\r\n";


        // Se envia el correo a los administradores
        if(mail($correosElectronicos, utf8_decode($asunto), utf8_decode($mensaje), $cabeceras)) {

          echo "true";

        }else{

          echo "Ha ocurrido un error al tratar de enviar la sugerencia, inténtelo de nuevo";

        } 

      }else{

        echo "No se encontraron administradores registrados en el sistema, por lo tanto, la sugerencia no se ha podido enviar";

      }
        
    }

    /*
    //Metodo encargado de enviar una sugerencia al correo electrónico de los administradores
    */

    public function enviarSugerencia($asunto, $comentario, $correoElectronico){

      $patternCorreoElectronico = "/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";

      if ($this->indexValidation->validarCamposTexto($asunto, 25) && 
          $this->indexValidation->validarCamposTexto($comentario, 250) &&
          $this->indexValidation->validarCamposTextoRegex($correoElectronico, 30, $patternCorreoElectronico)) {

        $this->enviarCorreoElectronico($asunto, $comentario, $correoElectronico);

      }else{

        echo "Para enviar la sugerencia, es necesario que se respeten las validaciones establecidas en el formulario";

      }

    }

	}

?>
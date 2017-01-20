<?php

  /*
  // Clase logica intermediaria entre el controlador y la data del index, tiene como objetivo validar
  // reglas de negocio y gestionar los llamados hacia la data
  */

	class indexlogic extends logica{

    private $indexValidation;

		public function __construct(){

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
    // Metodo encargado de guardar la informacion de la pagina de presentacion
    */

    public function guardarInformacionPaginaPresentacion($quienesSomos, $mision, $vision, $valores, $listaImagenes){

      if ($this->indexValidation->validarCamposTexto($quienesSomos, 250) && 
          $this->indexValidation->validarCamposTexto($mision, 250) &&
          $this->indexValidation->validarCamposTexto($vision, 250) && 
          $this->indexValidation->validarCamposTexto($valores, 250) &&
          $this->indexValidation->validarListaImagenes($listaImagenes)) {

        array_map('unlink', glob(RUTA_ARCHIVOS_ADJUNTOS."*"));
        
        echo "true";

      }else{

        echo "false";

      }


    }

	}

?>
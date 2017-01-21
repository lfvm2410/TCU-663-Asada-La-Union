<?php

  /*
  // Clase logica intermediaria entre el controlador y la data de tarifa, tiene como objetivo validar
  // reglas de negocio y gestionar los llamados hacia la data
  */

	class tarifaLogic extends logica{

    private $tarifaData;
    private $tarifaValidation;
    private $abonadoAsadaValidation;
    private $servicioValidation;

		public function __construct(){

		  $this->tarifaData = new tarifaData();
      $this->tarifaValidation = new tarifaValidation();
      $this->abonadoAsadaValidation = new abonadoAsadaValidation();
      $this->servicioValidation = new servicioValidation();
			
		}

    /*
    // Método encargado de armar los elementos del combobox de rango de abonados
    */

    public function formatearComboBoxRangosAbonadosAsada(){

      $abonadoAsadaData = new abonadoAsadaData();

      $this->formatearOptionsCombobox($abonadoAsadaData->obtenerRangosAbonadosAsada());

    }

    /*
    // Metodo encargado de gestionar el registro de una tarifa
    */

    public function registrarTarifa(tarifa $tarifa){

      if ($this->abonadoAsadaValidation->validarIdAbonadoAsada($tarifa->getIdAbonadoAsada()) &&
          $this->tarifaValidation->validarCamposTexto($tarifa->getNombre(), 16) &&
          $this->tarifaValidation->validarDescripcion($tarifa->getIdAbonadoAsada(), $tarifa->getDescripcion()) &&
          $this->servicioValidation->validarTipoServicio($tarifa->getTipoServicio()) &&
          $this->tarifaValidation->validarCamposNumericosDecimales($tarifa->getMonto())) {

        if ($this->tarifaData->registrarTarifa($tarifa)) {

          echo "true";
          
        }else{

          echo "false";

        }    

      }else{

        echo "false";

      }

    }

    /*
    // Metodo encargado de gestionar la edición de una tarifa
    */

    public function editarTarifa(tarifa $tarifa, $descripcionActual){

      if ($this->tarifaValidation->validarCamposNumericosEnteros($tarifa->getIdTarifa()) &&
          $this->abonadoAsadaValidation->validarIdAbonadoAsada($tarifa->getIdAbonadoAsada()) &&
          $this->tarifaValidation->validarCamposTexto($tarifa->getNombre(), 16) &&
          $this->tarifaValidation->validarDescripcionEnEdicion($tarifa->getIdAbonadoAsada(), $descripcionActual, $tarifa->getDescripcion()) &&
          $this->servicioValidation->validarTipoServicio($tarifa->getTipoServicio()) &&
          $this->tarifaValidation->validarCamposNumericosDecimales($tarifa->getMonto())) {

        if ($this->tarifaData->editarTarifa($tarifa)) {

          echo "true";
          
        }else{

          echo "false";

        }    

      }else{

        echo "false";

      }

    }

    /*
    // Metodo encargado de obtener una tarifa por su id
    */

    public function obtenerTarifaPorId($idTarifa){

      if ($this->tarifaValidation->validarCamposNumericosEnteros($idTarifa)) {

          $tarifa = $this->tarifaData->obtenerTarifaPorId($idTarifa);

          if ($this->tarifaValidation->validarArray($tarifa)) {
              
            print_r(json_encode($tarifa));
                  
          }else{

            print_r(json_encode("false"));

          }

      }else{

          print_r(json_encode("false"));

      }

    }

    /*
    // Metodo encargado de formatear las opciones para el combobox de descripcion
    */
    public function formatearComboBoxDescripcion(){

      $listaDescripciones = $this->tarifaData->obtenerDescripcionesTarifas();

      $optionsList = "<option value=''>Seleccione</option>";

        foreach ($listaDescripciones as $descripcion) {

          if (strcmp($descripcion, '1 a 10') == 0 || strcmp($descripcion, '11 a 30') == 0 || 
              strcmp($descripcion, '31 a 60') == 0 || strcmp($descripcion, 'Más de 60') == 0) {

            $optionsList .= "<option value='".$descripcion."'>"
                              .$descripcion." metros cúbicos</option>";
            
          }else{

            $optionsList .= "<option value='".$descripcion."'>"
                              .$descripcion."</option>";


          }

        }               
            
      print_r(json_encode(array("optionsList" => $optionsList)));

    }

    /*
    //Metodo encargado de comprobar la existencia de una descripcion para un abonado
    */

    public function comprobarExistenciaDescripcionPorAbonado($idAbonadoAsada, $descripcion){

      if ($this->abonadoAsadaValidation->validarIdAbonadoAsada($idAbonadoAsada) &&
          $this->tarifaValidation->validarCampoDescripcion($descripcion)) {

          if ($this->tarifaData->comprobarExistenciaDescripcionPorAbonado($idAbonadoAsada, $descripcion)) {

              echo "<div id='msjDescripcion' class='alert alert-danger' data-descripcion='false'>
                        <strong><span class='glyphicon glyphicon-remove'></span></strong> 
                        Ya existe una descripción con este nombre para el rango de abonados seleccionado,
                        para proceder debe cambiar tal descripción
                    </div>";

          }else{

              echo "<div id='msjDescripcion' class='alert alert-success' data-descripcion='true'>
                        <strong><span class='glyphicon glyphicon-ok'></span></strong> 
                        Descripción disponible para ser registrada a nombre del rango de abonados seleccionado
                      </div>";

          }

      }else{

            echo "<div id='msjDescripcion' class='alert alert-danger' data-descripcion='false'>
                    <strong><span class='glyphicon glyphicon-remove'></span></strong> 
                    Ha ocurrido un error al tratar de verificar la descripción para el rango de abonados seleccionado
                  </div>";

      }

    }

    /*
    //Metodo encargado de comprobar la existencia de una descripcion para un abonado, cuando se esta editando una tarifa
    */

    public function comprobarExistenciaDescripcionPorAbonadoEnEdicion($idAbonadoAsada, $descripcionActual, $descripcionNueva){

      if ($this->abonadoAsadaValidation->validarIdAbonadoAsada($idAbonadoAsada) &&
          $this->tarifaValidation->validarCampoDescripcion($descripcionActual) &&
          $this->tarifaValidation->validarCampoDescripcion($descripcionNueva)) {

          if ($this->tarifaData->comprobarExistenciaDescripcionPorAbonadoEnEdicion($idAbonadoAsada, $descripcionActual, $descripcionNueva)) {

              echo "<div id='msjDescripcion' class='alert alert-danger' data-descripcion='false'>
                        <strong><span class='glyphicon glyphicon-remove'></span></strong> 
                        Ya existe una descripción con este nombre para el rango de abonados seleccionado,
                        para proceder debe cambiar tal descripción
                    </div>";

          }else{

              echo "<div id='msjDescripcion' class='alert alert-success' data-descripcion='true'>
                        <strong><span class='glyphicon glyphicon-ok'></span></strong> 
                        Descripción disponible para ser registrada a nombre del rango de abonados seleccionado
                      </div>";

          }

      }else{

            echo "<div id='msjDescripcion' class='alert alert-danger' data-descripcion='false'>
                    <strong><span class='glyphicon glyphicon-remove'></span></strong> 
                    Ha ocurrido un error al tratar de verificar la descripción para el rango de abonados seleccionado
                  </div>";

      }

    }

	}

?>
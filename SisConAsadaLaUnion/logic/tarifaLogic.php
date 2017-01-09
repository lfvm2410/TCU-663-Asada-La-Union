<?php

  /*
  // Clase logica intermediaria entre el controlador y la data de tarifa, tiene como objetivo validar
  // reglas de negocio y gestionar los llamados hacia la data
  */

	class tarifaLogic extends logica{

    private $tarifaData;
    private $servicioValidation;

		public function __construct(){

		  $this->tarifaData = new tarifaData();
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
          $this->abonadoAsadaValidation->validarCamposTexto($tarifa->getNombre(), 16) &&
          $this->servicioValidation->validarTipoServicio($tarifa->getTipoServicio()) &&
          $this->abonadoAsadaValidation->validarCamposNumericosDecimales($tarifa->getMonto())) {

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

    public function editarTarifa(tarifa $tarifa){

      if ($this->abonadoAsadaValidation->validarCamposNumericosEnteros($tarifa->getIdTarifa()) &&
          $this->abonadoAsadaValidation->validarIdAbonadoAsada($tarifa->getIdAbonadoAsada()) &&
          $this->abonadoAsadaValidation->validarCamposTexto($tarifa->getNombre(), 16) &&
          $this->servicioValidation->validarTipoServicio($tarifa->getTipoServicio()) &&
          $this->abonadoAsadaValidation->validarCamposNumericosDecimales($tarifa->getMonto())) {

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

      if ($this->abonadoAsadaValidation->validarCamposNumericosEnteros($idTarifa)) {

          $tarifa = $this->tarifaData->obtenerTarifaPorId($idTarifa);

          if ($this->abonadoAsadaValidation->validarArray($tarifa)) {
              
            print_r(json_encode($tarifa));
                  
          }else{

            print_r(json_encode("false"));

          }

      }else{

          print_r(json_encode("false"));

      }

    }

	}

?>
<?php

    /*
   // Clase logica intermediaria entre el controlador y la data de abonadoAsada, tiene como objetivo validar
   // reglas de negocio y gestionar los llamados hacia la data
   */

	class abonadoAsadaLogic extends logica{

		private $abonadoAsadaData;
		private $abonadoAsadaValidation;

		public function __construct(){

			$this->abonadoAsadaData = new abonadoAsadaData();
			$this->abonadoAsadaValidation = new abonadoAsadaValidation();
			
		}

		/*
	    // Metodo encargado de gestionar el registro de un abonado
	    */

	    public function registrarAbonado(abonadoAsada $abonadoAsada){

	      if ($this->abonadoAsadaValidation->validarCamposTexto($abonadoAsada->getRango(), 16)) {

	        if ($this->abonadoAsadaData->registrarAbonado($abonadoAsada)) {

	          echo "true";
	          
	        }else{

	          echo "false";

	        }    

	      }else{

	        echo "false";

	      }

	    }

	    /*
	    // Metodo encargado de gestionar la edicion de un abonado
	    */

	    public function editarAbonado(abonadoAsada $abonadoAsada){

	      if ($this->abonadoAsadaValidation->validarIdAbonadoAsada($abonadoAsada->getIdAbonadoAsada()) &&
	      	  $this->abonadoAsadaValidation->validarCamposTexto($abonadoAsada->getRango(), 16)) {

	        if ($this->abonadoAsadaData->editarAbonado($abonadoAsada)) {

	          echo "true";
	          
	        }else{

	          echo "false";

	        }    

	      }else{

	        echo "false";

	      }

	    }

	    /*
    	// Metodo encargado de obtener un abonado por su id
    	*/

	    public function obtenerAbonadoPorId($idAbonadoAsada){

	      if ($this->abonadoAsadaValidation->validarCamposNumericosEnteros($idAbonadoAsada)) {

	          $abonadoAsada = $this->abonadoAsadaData->obtenerAbonadoPorId($idAbonadoAsada);

	          if ($this->abonadoAsadaValidation->validarArray($abonadoAsada)) {
	              
	            print_r(json_encode($abonadoAsada));
	                  
	          }else{

	            print_r(json_encode("false"));

	          }

	      }else{

	          print_r(json_encode("false"));

	      }

	    }

	}

?>
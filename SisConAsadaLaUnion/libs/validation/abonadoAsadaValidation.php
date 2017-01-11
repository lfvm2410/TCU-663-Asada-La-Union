<?php 

	/*
	*Clase encargada de contener todos los métodos necesarios para la validación de datos referentes a abonadoAsada
	*/
	
	class abonadoAsadaValidation extends generalValidation{

		private $abonadoAsadaData;
		
		public function __construct(){

			parent::__construct();

			$this->abonadoAsadaData = new abonadoAsadaData();

		}
		
		/*
		//Metodo encargado de validar el identificador de un registro de abonado de asada
		*/

		public function validarIdAbonadoAsada($idAbonadoAsada){

			if ($this->validarCamposNumericosEnteros($idAbonadoAsada)) {
				
				$rangosAbonadosAsada = $this->abonadoAsadaData->obtenerRangosAbonadosAsada();

				foreach ($rangosAbonadosAsada as $rangoAbonadoAsada) {

			    	$llavesRangoAbonadoAsada = array_keys($rangoAbonadoAsada);

			    	if ($idAbonadoAsada == $rangoAbonadoAsada[$llavesRangoAbonadoAsada[0]]) {

			    		return true;
			    		
			    	}

		    	}  

			}

			return false;

		}

	}

?>
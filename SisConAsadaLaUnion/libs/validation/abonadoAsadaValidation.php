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

		/*
        // Metodo encargado de validar el atributo de rango de abonados
		*/

		// A tomar en cuenta: Máximo de 16 caracteres, no nulo y unique

		public function validarRangoAbonados($rangoAbonados){

			$estadoRangoAbonados = false;

			if ($this->validarCamposTexto($rangoAbonados, 16)) {
				
				if (!$this->abonadoAsadaData->comprobarExistenciaRangoAbonados($rangoAbonados)) {

					$estadoRangoAbonados = true;

				}

			}

			return $estadoRangoAbonados;
		}

		/*
        // Metodo encargado de validar el atributo de rango de abonados que se encuentra en edición
		*/

		// A tomar en cuenta: Máximo de 16 caracteres, no nulo y unique

		public function validarRangoAbonadosEnEdicion($rangoAbonadosActual, $rangoAbonadosNuevo){

			$estadoRangoAbonados = false;

			if ($this->validarCamposTexto($rangoAbonadosActual, 16) &&
				$this->validarCamposTexto($rangoAbonadosNuevo, 16)) {
				
				if (!$this->abonadoAsadaData->comprobarExistenciaCampoEnEdicion("tbAbonadoAsada","rango_AbonadoAsada",$rangoAbonadosActual,$rangoAbonadosNuevo)) {

					$estadoRangoAbonados = true;

				}

			}

			return $estadoRangoAbonados;
		}

	}

?>
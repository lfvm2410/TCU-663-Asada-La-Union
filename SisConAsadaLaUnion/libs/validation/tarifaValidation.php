<?php 

	/*
	*Clase encargada de contener todos los métodos necesarios para la validación de datos referentes a tarifa
	*/
	
	class tarifaValidation extends generalValidation{

		private $tarifaData;
		
		public function __construct(){

			parent::__construct();

			$this->tarifaData = new tarifaData();

		}
		
		/*
		// Metodo encargado de validar que el campo referentes a un descripcion sea valido
		*/

		public function validarCampoDescripcion($descripcion){

			$estadoDescripcion = false;

			if ($this->validarCamposTextoRequeridos($descripcion)) {
				
				$listaDescripciones = $this->tarifaData->obtenerDescripcionesTarifas();

        		foreach ($listaDescripciones as $descripcionTemp) {

        			if (strcmp($descripcion, $descripcionTemp) == 0) {

        				return true;
        			}
        
        		}

			}

			return $estadoDescripcion;

		}

		/*
		// Metodo encargado de validar si una descripción, antes de ser registrada
		*/

		public function validarDescripcion($idAbonadoAsada, $descripcion){

			$estadoDescripcion = false;

			if ($this->validarCampoDescripcion($descripcion)) {

				if (!$this->tarifaData->comprobarExistenciaDescripcionPorAbonado($idAbonadoAsada, $descripcion)) {
					
					$estadoDescripcion = true;

				}
				
			}

			return $estadoDescripcion;

		}

		/*
		// Metodo encargado de validar si una descripción, antes de ser editada
		*/

		public function validarDescripcionEnEdicion($idAbonadoAsada, $descripcionActual, $descripcionNueva){

			$estadoDescripcionEnEdicion = false;

			if ($this->validarCampoDescripcion($descripcionActual) &&
				$this->validarCampoDescripcion($descripcionNueva)) {

				if (!$this->tarifaData->comprobarExistenciaDescripcionPorAbonadoEnEdicion($idAbonadoAsada, $descripcionActual, $descripcionNueva)) {
					
					$estadoDescripcionEnEdicion = true;

				}
				
			}

			return $estadoDescripcionEnEdicion;

		}

	}

?>
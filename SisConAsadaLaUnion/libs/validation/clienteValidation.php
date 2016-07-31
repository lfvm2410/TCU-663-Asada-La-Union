<?php 

	/*
	*Clase encargada de contener todos los métodos necesarios para la validación de datos referentes a clientes
	*/

	class clienteValidation{
		
		public function __construct(){}

		/*
        //Metodo encargado de validar el atributo numero de plano
		*/

		//A tomar en cuenta: no nulo, maximo 16 caracteres, no repetido

		public function validarNumPlano($numeroPlano, clienteData $clienteData){

			$estadoNumPlano = false;

			if (strlen($numeroPlano) <= 16 && !is_null($numeroPlano) && !empty($numeroPlano)) {
				
				if (!$clienteData->comprobarExistenciaNumeroPlano($numeroPlano)) {

					$estadoNumPlano = true;
				}

			}
			
			return $estadoNumPlano;

		}

		/*
        //Metodo encargado de validar el atributo numero de plano para consulta select con ajax
		*/

		//A tomar en cuenta: no nulo, maximo 16 caracteres

		public function validarNumPlanoAjax($numeroPlano){

			$estadoNumPlano = false;

			if (strlen($numeroPlano) <= 16 && !is_null($numeroPlano) && !empty($numeroPlano)) {
			
				$estadoNumPlano = true;
				
			}
			
			return $estadoNumPlano;

		}

	}

?>
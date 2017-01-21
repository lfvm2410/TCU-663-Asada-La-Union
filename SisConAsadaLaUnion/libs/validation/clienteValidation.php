<?php 

	/*
	*Clase encargada de contener todos los métodos necesarios para la validación de datos referentes a clientes
	*/

	class clienteValidation extends generalValidation{
		
		public function __construct(){

			parent::__construct();

		}

		/*
        //Metodo encargado de validar el atributo numero de plano
		*/

		/*A tomar en cuenta: no nulo, maximo 16 caracteres, no repetido
		**Nota: si se excede de 16 caracteres o si es nulo o vacío igual se deja pasar, 
		**para que antes de registrar el cliente se verifique esto por aparte
		*/

		public function validarNumPlano($numeroPlano, clienteData $clienteData){

			$estadoNumPlano = false;

			if ($this->validarCamposTexto($numeroPlano,16)) {
				
				if (!$clienteData->comprobarExistenciaNumeroPlano($numeroPlano)) {

					$estadoNumPlano = true;
				
				}

			}else{

				$estadoNumPlano = true;
			}
			
			return $estadoNumPlano;

		}

		/*
        //Metodo encargado de validar el atributo numero de plano que se encuentra en edicion
		*/

		/*A tomar en cuenta: no nulo, maximo 16 caracteres, no repetido
		**Nota: si se excede de 16 caracteres o si es nulo o vacío igual se deja pasar, 
		**para que antes de registrar el cliente se verifique esto por aparte
		*/

		public function validarNumPlanoEnEdicion($numeroPlanoActual, $numeroPlanoNuevo, clienteData $clienteData){

			$estadoNumPlano = false;

			if ($this->validarCamposTexto($numeroPlanoActual,16) && $this->validarCamposTexto($numeroPlanoNuevo,16)) {
				
				if (!$clienteData->comprobarExistenciaCampoEnEdicion("tbCliente","numeroPlano_Cliente",$numeroPlanoActual,$numeroPlanoNuevo)) {

					$estadoNumPlano = true;
				
				}

			}else{

				$estadoNumPlano = true;
			}
			
			return $estadoNumPlano;

		}

		/*
		//Metodo encargado de validar el metodo de busqueda de clientes a consultar
		*/

		public function validarMetodoBusquedaClientes($metodo){

			$estadoMetodo = false;

			if (strcmp($metodo, "obtenerClientes") == 0 || strcmp($metodo, "obtenerClientesCedulaNombre") == 0) {

				$estadoMetodo = true;
				
			}

			return $estadoMetodo;

		}

	}

?>
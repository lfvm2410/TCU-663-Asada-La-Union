<?php 

	/*
	*Clase encargada de contener todos los métodos necesarios para la validación de datos referentes a los productos
	*/

	class productoValidation extends generalValidation{
		
		public function __construct(){

			parent::__construct();

		}

		/*
		//Metodo encargado de validar el metodo de busqueda de productos a consultar
		*/

		public function validarMetodoBusquedaProductos($metodo){

			$estadoMetodo = false;

			if (strcmp($metodo, "obtenerProductos") == 0 || strcmp($metodo, "obtenerProductosNombre") == 0) {

				$estadoMetodo = true;
				
			}

			return $estadoMetodo;

		}

	}

?>
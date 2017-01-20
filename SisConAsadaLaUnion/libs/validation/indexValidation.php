<?php 

	/*
	*Clase encargada de contener todos los métodos necesarios para la validación de datos referentes al index
	*/
	
	class indexValidation extends generalValidation{
		
		public function __construct(){

			parent::__construct();

		}

		/*
		// Metodo encargado de validar un archivo adjunto
		*/

		public function validarArchivoAdjunto($archivo){

			$estadoArchivo = false;

			if ($archivo['error'] == 0 &&
				$this->verificarCadenasIguales($archivo['type'], "application/pdf")) {
				
				$estadoArchivo = true;

			}

			return $estadoArchivo;

		}

		/*
		// Metodo encargado de validar una lista de imagenes
		*/

		public function validarListaImagenes($listaImagenes){

			$cantidadImagenes = count($listaImagenes['name']);
			$cantidadMegaBytes = 1024*(1024*2);

			if(!file_exists($listaImagenes['tmp_name'][0]) || !is_uploaded_file($listaImagenes['tmp_name'][0])) {
   				 
				return true;

			}else{

				for($i = 0; $i < $cantidadImagenes; $i++) {

					if ($listaImagenes['error'][$i] != 0 ||
						!($this->verificarCadenasIguales($listaImagenes['type'][$i], "image/jpg") ||
						  $this->verificarCadenasIguales($listaImagenes['type'][$i], "image/jpeg") ||
						  $this->verificarCadenasIguales($listaImagenes['type'][$i], "image/png")) ||
						$listaImagenes['size'][$i] > $cantidadMegaBytes) {

						return false;
						
					}

				}

				return true;

			}

		}		
		
	}

?>
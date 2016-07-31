<?php

    /*
    // Clase base usada por todos los controladores, con el fin de implementar mvc
    */

	class controlador{

		public function __construct(){

			$this->vista = new vista();
			
			$this->cargarLogica();

		}

		private function cargarLogica(){

			$logica = str_replace("Controller", "Logic", get_class($this));
			
			$path = LOGIC.$logica.".php";

			if (file_exists($path)) {

				require_once $path;
				
				$this->logica = new $logica();
			
			}

		}

		/*
        //Método encargado de redirigir a página de error a solicitudes no autorizadas por la url
		*/

		public function redireccionActividadNoAutorizada(){

			header('Location: '.URL.'error/forbidden');

        	exit;
        	
		}

	}
?>
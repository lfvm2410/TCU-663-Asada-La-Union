<?php

	class controlador{

		function __construct(){

			$this->vista = new vista();
			
			$this->cargarModelo();

		}

		function cargarModelo(){

			$modelo = str_replace("Controller", "Data", get_class($this));
			
			$path = "models/".$modelo.".php";

			if (file_exists($path)) {

				require_once $path;
				
				$this->modelo = new $modelo();
			
			}

		}
	}
?>
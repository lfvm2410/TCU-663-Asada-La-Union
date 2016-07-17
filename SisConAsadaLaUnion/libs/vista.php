<?php

    /*
    // Clase base usada por todos las vistas, con el fin de implementar mvc
    */

	class vista{
		
		public function render($controlador, $vista){

			$controlador = get_class($controlador);

			$controlador = str_replace("Controller", "", $controlador);

			require_once './views/'.$controlador.'/'.$vista.'.php';
		}
	}

?>
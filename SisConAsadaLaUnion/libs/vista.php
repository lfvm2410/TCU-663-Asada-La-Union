<?php

	class vista{
		
		function render($controlador, $vista){

			$controlador = get_class($controlador);

			$controlador = str_replace("Controller", "", $controlador);

			require_once './views/'.$controlador.'/'.$vista.'.php';
		}
	}

?>
<?php

    /*
    // Clase base usada por todos las vistas, con el fin de implementar mvc
    */

	class vista{
		
		public function render($controlador, $vista, $titulo = ''){

			$controlador = get_class($controlador);

			$controlador = str_replace("Controller", "", $controlador);

			$path = './views/'.$controlador.'/'.$vista.'.php';

			if(file_exists($path)){
            	
            	if ($titulo != "") {
                	
                	$this->titulo = $titulo;
            	
            	}
            
           		require_once './views/'.$controlador.'/'.$vista.'.php';
        	
        	}else{

           		 header('Location: '.URL.'error/notFound');

        		 exit;
        
        	 }

		}
	}

?>
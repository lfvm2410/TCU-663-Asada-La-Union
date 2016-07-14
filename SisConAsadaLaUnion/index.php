<?php

	require_once "config.php";

	$url = (isset($_GET['url'])) ? $_GET['url']: "index/index";

	$url = explode("/",$url);

	$controlador = (isset($url[0])) ? $url[0]."Controller" : "IndexController";

	$metodo = (isset($url[1]) && $url[1] != null) ? $url[1] : "index";

	$parametros = (isset($url[2]) && $url[2] != null) ? $url[2] : null;

	/*
    //Funcion de autocarga de clases para no utilizar includes
	*/

	spl_autoload_register(function($class){

      if (file_exists(LIBS.$class.".php")) {

      	 require_once LIBS.$class.".php";
      
      }elseif (file_exists(DOMAIN.$class.".php")) {

      	 require_once DOMAIN.$class.".php";

      }else{ 
           
         if (file_exists(MODELS.$class.".php")) {

      	 	require_once MODELS.$class.".php";
      		
      	 }
      
      }
	
	});

	$path = './controllers/'.$controlador.'.php';

	if (file_exists($path)) {

			require_once $path;

			$controlador = new $controlador();

		     if (method_exists($controlador,$metodo)) {
             	
		     	if ($parametros != null) {

		     		$controlador->{$metodo}($parametros);

		     	}else{

                    $controlador->{$metodo}();

		     	}
	    
			}else{

				//Crear pagina de error para redireccionar hacia ahí

		        echo "Error no existe método";
			}
	    
	}else{

		//Crear pagina de error para redireccionar hacia ahí

		echo "Error no existe controlador";
	}
?>
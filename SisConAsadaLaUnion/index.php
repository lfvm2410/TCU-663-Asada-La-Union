<?php

	require_once("config.php");

	$url = (isset($_GET['url'])) ? $_GET['url']: "indexController/index";

	$url = explode("/",$url);

	if (isset($url[0])) {

	    $controlador = $url[0];

	}

	if (isset($url[1])) {

		if ($url[1] != '') {

			$metodo = $url[1];

		}
  
	}

	if (isset($url[2])) {

		if ($url[2] != '') {

			$parametros = $url[2];

		}
	    
	}

	/*
    //Funcion de autocarga de clases para no utilizar includes
	*/

	spl_autoload_register(function($class){

      if (file_exists(LIBS.$class.".php")) {

      	 require_once LIBS.$class.".php";
      }

      if (file_exists(DOMAIN.$class.".php")) {

      	 require_once DOMAIN.$class.".php";
      }

      if (file_exists(MODELS.$class.".php")) {

      	 require_once MODELS.$class.".php";
      }

	});

	$path = './controllers/'.$controlador.'.php';

	if (file_exists($path)) {

		require_once $path;

		$controlador = new $controlador();

		if (isset($metodo)) {

		     if (method_exists($controlador,$metodo)) {
		     	
		     	if (isset($parametros)) {

		     		$controlador->{$metodo}($parametros);

		     	}else{

                    $controlador->{$metodo}();

		     	}
	    
			}   
	    
		}else{

			$controlador->index();
		}

	}else{

		//Crear pagina de error para redireccionar hacia ahí

		echo "Error";
	}
?>
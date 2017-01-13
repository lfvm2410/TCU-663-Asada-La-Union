<?php

    /*
    // Clase para controladora de las operaciones sobre la página principal del sitio web
    */

	class indexController extends controlador{

		public function __construct(){

			parent::__construct();
		}

		/*
        // Metodo(s) encargado(s) de gestionar las posibles vistas de la página principal del sitio web
		*/

		public function index(){ 
	
			$this->vista->render($this,'index','ASADA La Unión');

		}

		public function adjuntarArchivosForm(){

			if ($this->verificarSessionIniciada()) {

				$this->vista->render($this,'adjuntarArchivos','Adjuntar archivos');
            
          	}else{

            	$this->redireccionActividadNoAutorizada();

          	}

		}

		/*
		// Metodo encargado de guardar los archivos adjuntos en el servidor
		*/

		public function guardarArchivosAdjuntos(){

			if ($this->verificarSessionIniciada() && isset($_FILES['disponibilidaHidrica']) && 
				isset($_FILES['arregloPagos'])) {

				$archivoDisponibilidadHidrica = $_FILES['disponibilidaHidrica'];
				$archivoArregloPagos = $_FILES['arregloPagos'];

				$this->logica->guardarArchivosAdjuntos($archivoDisponibilidadHidrica, $archivoArregloPagos);

          	}else{

            	$this->redireccionActividadNoAutorizada();

          	}

		}

	}

?>
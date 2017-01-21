<?php

    /*
    // Clase controladora de las operaciones sobre la página principal del sitio web
    */

	class indexController extends controlador{

		public function __construct(){

			parent::__construct();
		}

		/*
        // Metodo(s) encargado(s) de gestionar las posibles vistas de la página principal del sitio web
		*/

		public function index(){ 
	
			$this->vista->render($this,'index','Bienvenidos al sitio web ASADA La Unión');

		}

		public function actualizarPaginaPresentacionForm(){

			if ($this->verificarSessionIniciada()) {

				$this->vista->render($this,'actualizarPaginaPresentacion','Actualizar página de presentación');
            
          	}else{

            	$this->redireccionActividadNoAutorizada();

          	}

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

		/*
		// Metodo encargado de guardar la información que contendrá la página principal de la ASADA
		*/

		public function guardarInformacionPaginaPresentacion(){

			if ($this->verificarSessionIniciada() && isset($_POST['quienesSomos']) && isset($_POST['mision']) &&
				isset($_POST['vision']) && isset($_POST['valores']) && isset($_FILES['imagenesPantallaPresentacion'])) {

				$quienesSomos = trim($_POST['quienesSomos']);
				$mision = trim($_POST['mision']);
				$vision = trim($_POST['vision']);
				$valores = trim($_POST['valores']);
				$listaImagenes = $_FILES['imagenesPantallaPresentacion'];

				$this->logica->guardarInformacionPaginaPresentacion($quienesSomos, $mision, $vision, $valores, $listaImagenes);

          	}else{

            	$this->redireccionActividadNoAutorizada();

          	}

		}

		/*
      	//Metodo encargado de obtener la información actual de la página de presentación
      	*/

      	public function obtenerInformacionPaginaPresentacion(){

	        header("Content-Type: application/json");

	        if ($this->verificarSessionIniciada()) {

	          $this->logica->obtenerInformacionPaginaPresentacion();

	        }else{

	          $this->redireccionActividadNoAutorizada();

	        }

      	}

      	/*
      	//Metodo encargado de retornar las imagenes (nombres) y la información de la asada
      	*/

      	public function obtenerInformacionImagenesPaginaPresentacion(){

	        header("Content-Type: application/json");
	        
	        $this->logica->obtenerInformacionImagenesPaginaPresentacion();

      	}

	}

?>
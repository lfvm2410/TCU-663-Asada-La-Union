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

		public function contacto(){ 
	
			$this->vista->render($this,'contacto','Contacto');

		}

		public function inicio(){

			if ($this->verificarSessionIniciada()) {

				$this->vista->render($this,'inicio','Bienvenidos al sistema de control ASADA La Unión');
            
          	}else{

            	$this->redireccionActividadNoAutorizada();

          	}

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

      	/*
		//Metodo encargado de recibir una solicitud para la descarga de un archivo
      	*/

      	public function descargarArchivoAdjunto(){

      		if (isset($_GET['nombreArchivo'])) {

				$nombreArchivo = trim($_GET['nombreArchivo']);

				$this->logica->descargarArchivoAdjunto($nombreArchivo);

          	}else{

            	$this->redireccionActividadNoAutorizada();

          	}

      	}

      	/*
		//Metodo encargado de obtener el personal de la asada para la pagina de contacto
      	*/

      	public function obtenerPersonalAsada(){

      		header("Content-Type: application/json");

      		$this->logica->obtenerPersonalAsada();

      	}

      	/*
      	// Metodo encargado de traer los telefonos de una persona por su id y redireccionarlos a la vista
      	*/

      	public function consultarTelefonosPersonaPorId(){

        	header("Content-Type: application/json");

          	if (isset($_POST['idPersona'])) {

            	$idPersona = trim($_POST['idPersona']);

            	$telefonoLogic = new telefonoLogic();

            	$telefonoLogic->formatearTelefonosDePersonaPorId($idPersona);
            
          	}else{

            	$this->redireccionActividadNoAutorizada();

          	}
      
      	}

      	/*
      	// Metodo encargado de enviar una sugerencia por correo electronico
      	*/

      	public function enviarSugerencia(){

          	if (isset($_POST['asunto']) && isset($_POST['comentario']) && isset($_POST['correoElectronico'])) {

          		$asunto = $_POST['asunto'];
          		$comentario = $_POST['comentario'];
          		$correoElectronico = $_POST['correoElectronico'];

          		$this->logica->enviarSugerencia($asunto, $comentario, $correoElectronico);
            
          	}else{

            	$this->redireccionActividadNoAutorizada();

          	}
      
      	}

	}

?>
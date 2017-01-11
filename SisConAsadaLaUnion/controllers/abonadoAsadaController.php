<?php

	/*
	// Clase controladora de las operaciones sobre un abonado
	*/

	class abonadoAsadaController extends controlador{
		
		  public function __construct(){

        	parent::__construct();

     	}

      /*
      // Metodos para mostrar las vistas asociadas a este controlador
      */

      public function index(){

        if ($this->verificarSessionIniciada()) {

          //Temporal, mientras se define la vista principal del controlador

          header('Location: '.URL);

          exit;
            
        }else{

          $this->redireccionActividadNoAutorizada();

        }

      }

      public function registrarRangoAbonadosForm(){

        if ($this->verificarSessionIniciada()) {

          $this->vista->render($this,'registrarRangoAbonados','Registrar rango de abonados');
            
        }else{

          $this->redireccionActividadNoAutorizada();

        }
  
      }

      public function consultarInformacionRangosAbonados(){

        if ($this->verificarSessionIniciada()) {

          $this->vista->render($this,'consultarInformacionRangosAbonados','Consultar información de los rangos de abonados');
            
        }else{

          $this->redireccionActividadNoAutorizada();

        }

      }

      /*
      // Metodo encargado de registrar un abonado
      */

      public function registrarAbonado(){

        if ($this->verificarSessionIniciada() && isset($_POST['rangoAbonados'])) {

          $rangoAbonados = $_POST['rangoAbonados'];

          $abonadoAsada = new abonadoAsada(0, $rangoAbonados, null);

          $this->logica->registrarAbonado($abonadoAsada);
         
        }else{

          $this->redireccionActividadNoAutorizada();

        }

      }

      /*
      // Metodo encargado de editar un abonado
      */

      public function editarAbonado(){

        if ($this->verificarSessionIniciada() && isset($_POST['idAbonadoAsada']) &&
            isset($_POST['rangoAbonados'])) {

          $idAbonadoAsada = $_POST['idAbonadoAsada'];
          $rangoAbonados = $_POST['rangoAbonados'];

          $abonadoAsada = new abonadoAsada($idAbonadoAsada, $rangoAbonados, null);

          $this->logica->editarAbonado($abonadoAsada);
         
        }else{

          $this->redireccionActividadNoAutorizada();

        }

      }

      /*
      // Metodo encargado de consultar la totalidad de páginas sobre los abonados
      */

      public function consultarTotalidadPaginasAbonados(){

        header("Content-Type: application/json");

        if ($this->verificarSessionIniciada() && isset($_POST['permisoConsultaTotalPaginas']) && 
            isset($_POST['filtroBusqueda'])) {

          $permisoConsultaTotalPaginas = trim($_POST['permisoConsultaTotalPaginas']);

          $filtroBusqueda = trim($_POST['filtroBusqueda']);

          $this->logica->obtenertotalidadPaginas(TOTAL_ABONADOSASADA, $permisoConsultaTotalPaginas, $filtroBusqueda, LIMITE_REGISTROS, "Si");

        }else{

          $this->redireccionActividadNoAutorizada();
           
        }

      }

      /*
      // Metodo encargado de consultar los abonados
      */

      public function consultarAbonados(){

        header("Content-Type: application/json");

        if ($this->verificarSessionIniciada() && isset($_POST['paginaActual']) && 
            isset($_POST['filtroBusqueda'])) {

          $paginaActual = trim($_POST['paginaActual']);

          $filtroBusqueda = trim($_POST['filtroBusqueda']);

          $cadenaAtributos = "id_AbonadoAsada,rango_AbonadoAsada,fechaModificacion_AbonadoAsada";
            
          $cadenaAcciones = "Elegir,Editar";

          $this->logica->elaborarPaginacionRegistros($cadenaAtributos, $cadenaAcciones, false, PAGINACION_ABONADOSASADA, 
                                                     $filtroBusqueda, $paginaActual, LIMITE_REGISTROS, "Si");
          
        }else{

          $this->redireccionActividadNoAutorizada();
           
        }

      }

      /*
      // Metodo encargado de obtener un abonado por su id
      */

      public function obtenerAbonadoPorId(){

          header("Content-Type: application/json");

          if ($this->verificarSessionIniciada() && isset($_POST['idAbonadoAsada'])) {

            $idAbonadoAsada = trim($_POST['idAbonadoAsada']);
            
            $this->logica->obtenerAbonadoPorId($idAbonadoAsada);
            
          }else{

            $this->redireccionActividadNoAutorizada();

          }
      
      } 

	}

?>
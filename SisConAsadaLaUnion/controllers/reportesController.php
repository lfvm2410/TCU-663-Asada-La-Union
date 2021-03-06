<?php

    /*
    // Clase controladora de las operaciones sobre los reportes a generar
    */

	  class reportesController extends controlador{
		
    		public function __construct(){

    			parent::__construct();
    			
    		}

        /*
    	  // Metodos para mostrar las vistas asociadas a este controlador
    	  */

      	public function index(){

          if ($this->verificarSessionIniciada()) {

            //Temporal, mientras se define la vista principal del controlador

            header('Location: '.URL.'index/inicio');

            exit;
            
          }else{

            $this->redireccionActividadNoAutorizada();

          }

      	}

      	public function controlDeConsumo(){

          if ($this->verificarSessionIniciada()) {

            $this->vista->render($this,'controlDeConsumo','Control de consumo');
            
          }else{

            $this->redireccionActividadNoAutorizada();

          }

      	}

        public function consumoMensual(){

          $this->vista->render($this,'consumoMensual','Consumo mensual');
            
        }

      	/*
     	  // Metodo encargado de consultar la totalidad de páginas sobre el reporte de control de consumo
     	  */

      	public function consultarTotalidadPaginasControlConsumo(){

        	header("Content-Type: application/json");

        	if ($this->verificarSessionIniciada() && isset($_POST['permisoConsultaTotalPaginas']) && 
            	isset($_POST['filtroBusqueda'])) {

          		$permisoConsultaTotalPaginas = trim($_POST['permisoConsultaTotalPaginas']);

          		$filtroBusqueda = trim($_POST['filtroBusqueda']);

          		$this->logica->obtenertotalidadPaginas(TOTAL_CONTROLCONSUMO, $permisoConsultaTotalPaginas, $filtroBusqueda, LIMITE_REGISTROS, "Si");

        	}else{

          		$this->redireccionActividadNoAutorizada();
         
        	}	

      	}

      	/*
      	// Metodo encargado de generar el reporte de control de consumo
     	  */

      	public function generarReporteControlConsumo(){

	        header("Content-Type: application/json");

	        if ($this->verificarSessionIniciada() && isset($_POST['paginaActual']) && 
	            isset($_POST['filtroBusqueda'])) {

	          $paginaActual = trim($_POST['paginaActual']);

	          $filtroBusqueda = trim($_POST['filtroBusqueda']);

	          $cadenaAtributos = "numeroNis_ServicioAgua,cedula_Persona,nombre_Cliente,promedioConsumo_LecturaMedidor,ultimaLectura_LecturaMedidor,fechaUltimaLectura_LecturaMedidor,porcentajeIncrementoDecremento_LecturaMedidor";

	          $this->logica->elaborarPaginacionRegistros($cadenaAtributos, "", false, PAGINACION_CONTROLCONSUMO, 
	                            						 $filtroBusqueda, $paginaActual, LIMITE_REGISTROS, "Si");
	        
	        }else{

	          $this->redireccionActividadNoAutorizada();
	         
	        }

      	}

        /*
        // Metodo encargado de consultar la totalidad de páginas sobre el reporte de consumo mensual
        */

        public function consultarTotalidadPaginasConsumoMensual(){

          header("Content-Type: application/json");

          if (isset($_POST['permisoConsultaTotalPaginas']) && isset($_POST['filtroBusqueda'])) {

              $permisoConsultaTotalPaginas = trim($_POST['permisoConsultaTotalPaginas']);

              $filtroBusqueda = trim($_POST['filtroBusqueda']);

              $this->logica->obtenertotalidadPaginas(TOTAL_CONSUMOMENSUAL, $permisoConsultaTotalPaginas, $filtroBusqueda, LIMITE_REGISTROS_CONSUMOMENSUAL, "Si");

          }else{

              $this->redireccionActividadNoAutorizada();
         
          } 

        }

        /*
        // Metodo encargado de generar el reporte de consumo mensual
        */

        public function generarReporteConsumoMensual(){

          header("Content-Type: application/json");

          if (isset($_POST['paginaActual']) && isset($_POST['filtroBusqueda'])) {

            $paginaActual = trim($_POST['paginaActual']);

            $filtroBusqueda = trim($_POST['filtroBusqueda']);

            $cadenaAtributos = "numeroNis_ServicioAgua,nombreCompleto_Cliente,cantidadMetrosCubicos_LecturaMedidor,fechaCaptura_Lectura,periodoCobro_Lectura,mesAlCobro_Lectura,fechaVencimiento_Factura,tipo_Factura,estado_Factura,montoPorLectura_Lectura,montoTotal_Factura";

            $this->logica->elaborarPaginacionRegistros($cadenaAtributos, "", false, PAGINACION_CONSUMOMENSUAL, 
                                           $filtroBusqueda, $paginaActual, LIMITE_REGISTROS_CONSUMOMENSUAL, "Si");
          
          }else{

            $this->redireccionActividadNoAutorizada();
           
          }

        }

	 }

?>
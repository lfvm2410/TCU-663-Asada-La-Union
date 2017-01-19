<?php

	/*
	// Clase controladora de las operaciones sobre una tarifa
	*/

	class tarifaController extends controlador{
		
		  public function __construct(){

        	parent::__construct();

     	}

      /*
      // Metodos para mostrar las vistas asociadas a este controlador
      */

      public function index(){

        if (true) {

          //Temporal, mientras se define la vista principal del controlador

          header('Location: '.URL);

          exit;
            
        }else{

          $this->redireccionActividadNoAutorizada();

        }

      }

      public function registrarTarifaForm(){

        if (true) {

          $this->vista->render($this,'registrarTarifa','Registrar tarifa');
            
        }else{

          $this->redireccionActividadNoAutorizada();

        }
  
      }

      public function consultarInformacionTarifas(){

        if (true) {

          $this->vista->render($this,'consultarInformacionTarifas','Consultar información de tarifas');
            
        }else{

          $this->redireccionActividadNoAutorizada();

        }

      }

      /*
      //Metodo encargado de llenar el combobox de rango de asada
      */

      public function llenarComboRangoAsada(){

        header("Content-Type: application/json");

        if (true) {

          $this->logica->formatearComboBoxRangosAbonadosAsada();

        }else{

          $this->redireccionActividadNoAutorizada();

        }

      }

      /*
      // Metodo encargado de registrar una tarifa
      */

      public function registrarTarifa(){

        if (true && isset($_POST['rangoAbonados']) && 
            isset($_POST['nombreTarifa']) && isset($_POST['descripcionTarifa']) && 
            isset($_POST['tipoServicio']) && isset($_POST['montoTarifa'])) {

          $idAbonadoAsada = $_POST['rangoAbonados'];
          $descripcion = $_POST['descripcionTarifa'];
          $nombre = $_POST['nombreTarifa'];
          $tipoServicio = $_POST['tipoServicio'];
          $monto = $_POST['montoTarifa'];

          $tarifa = new tarifa(0, $nombre, $descripcion, $tipoServicio, $monto, null, $idAbonadoAsada);

          $this->logica->registrarTarifa($tarifa);
         
        }else{

          $this->redireccionActividadNoAutorizada();

        }

      }

      /*
      // Metodo encargado de editar una tarifa
      */

      public function editarTarifa(){

        if (true && isset($_POST['idTarifa']) &&
            isset($_POST['descripcionActual']) && isset($_POST['rangoAbonados']) && 
            isset($_POST['descripcionTarifa']) && isset($_POST['nombreTarifa']) && 
            isset($_POST['tipoServicio']) && isset($_POST['montoTarifa'])) {

          $idTarifa = $_POST['idTarifa'];
          $descripcionActual = $_POST['descripcionActual'];
          $idAbonadoAsada = $_POST['rangoAbonados'];
          $nombre = $_POST['nombreTarifa'];
          $descripcionNueva = $_POST['descripcionTarifa'];
          $tipoServicio = $_POST['tipoServicio'];
          $monto = $_POST['montoTarifa'];

          $tarifa = new tarifa($idTarifa, $nombre, $descripcionNueva, $tipoServicio, $monto, null, $idAbonadoAsada);

          $this->logica->editarTarifa($tarifa, $descripcionActual);
         
        }else{

          $this->redireccionActividadNoAutorizada();

        }

      }

     /*
     // Metodo encargado de consultar la totalidad de páginas sobre las tarifas
     */

      public function consultarTotalidadPaginasTarifas(){

        header("Content-Type: application/json");

        if (true && isset($_POST['permisoConsultaTotalPaginas']) && 
            isset($_POST['filtroBusqueda'])) {

          $permisoConsultaTotalPaginas = trim($_POST['permisoConsultaTotalPaginas']);

          $filtroBusqueda = trim($_POST['filtroBusqueda']);

          $this->logica->obtenertotalidadPaginas(TOTAL_TARIFAS, $permisoConsultaTotalPaginas, $filtroBusqueda, LIMITE_REGISTROS,
                                                 "Si");

        }else{

          $this->redireccionActividadNoAutorizada();
         
        }

      }

      /*
      // Metodo encargado de consultar las tarifas
      */

      public function consultarTarifas(){

        header("Content-Type: application/json");

        if (true && isset($_POST['paginaActual']) && 
            isset($_POST['filtroBusqueda'])) {

          $paginaActual = trim($_POST['paginaActual']);

          $filtroBusqueda = trim($_POST['filtroBusqueda']);

          $cadenaAtributos = "id_Tarifa,rango_AbonadoAsada,nombre_Tarifa,descripcion_Tarifa,tipoServicio_Tarifa,monto_Tarifa,fechaModificacion_Tarifa";
          
          $cadenaAcciones = "Elegir,Editar";

          $this->logica->elaborarPaginacionRegistros($cadenaAtributos, $cadenaAcciones, false, PAGINACION_TARIFAS, 
                            $filtroBusqueda, $paginaActual, LIMITE_REGISTROS, "Si");
        
        }else{

          $this->redireccionActividadNoAutorizada();
         
        }

      }

      /*
      // Metodo encargado de obtener una tarifa por su id
      */

      public function obtenerTarifaPorId(){

          header("Content-Type: application/json");

          if (true && isset($_POST['idTarifa'])) {

            $idTarifa = trim($_POST['idTarifa']);
            
            $this->logica->obtenerTarifaPorId($idTarifa);
            
          }else{

            $this->redireccionActividadNoAutorizada();

          }
      
      } 

      /*
      // Metodo encargado de llenar el combobox de descripcion
      */

      public function llenarComboDescripcion(){

          header("Content-Type: application/json");

          if (true) {
            
            $this->logica->formatearComboBoxDescripcion();
            
          }else{

            $this->redireccionActividadNoAutorizada();

          }
      
      }

      /*
      // Metodo para verificar si una descripcion existe para un abonado
      */

      public function verificarDescripcionExistente(){

        if (true && isset($_POST['idAbonadoAsada']) &&
            isset($_POST['descripcion'])) {

            $idAbonadoAsada = trim($_POST['idAbonadoAsada']);
            $descripcion = trim($_POST['descripcion']);

            $this->logica->comprobarExistenciaDescripcionPorAbonado($idAbonadoAsada, $descripcion);

        }else{

            $this->redireccionActividadNoAutorizada();
         
        }
    
      }

      /*
      // Metodo para verificar si una descripcion existe para un abonado, al momento de editar una tarifa
      */

      public function verificarDescripcionExistenteEnEdicion(){

        if (true && isset($_POST['idAbonadoAsada']) &&
            isset($_POST['descripcionActual']) && isset($_POST['descripcionNueva'])) {

            $idAbonadoAsada = trim($_POST['idAbonadoAsada']);
            $descripcionActual = trim($_POST['descripcionActual']);
            $descripcionNueva = trim($_POST['descripcionNueva']);

            $this->logica->comprobarExistenciaDescripcionPorAbonadoEnEdicion($idAbonadoAsada, $descripcionActual, $descripcionNueva);

        }else{

            $this->redireccionActividadNoAutorizada();
         
        }
    
      }

	}

?>
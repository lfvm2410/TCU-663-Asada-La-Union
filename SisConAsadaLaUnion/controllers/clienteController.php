<?php

/*
// Clase para controladora de las operaciones sobre el cliente
*/

    class clienteController extends controlador{

      private $personaLogic;
      
      public function __construct(){

        parent::__construct();

        $this->personaLogic = new personaLogic();

      }

    /*
    // Metodos para mostrar las vistas asociadas a este controlador
    */

      public function index(){

      //Temporal, mientras se define la vista principal del controlador

        header('Location: '.URL);

        exit;

      }

      public function registrarClienteForm(){
  
          $this->vista->render($this,'registrarCliente','Registrar cliente');

      }
    
    /*
    ** Metodo para registrar un cliente
    */

      public function registrarCliente(){

         if (isset($_POST['cedulaCliente']) && isset($_POST['nombreCliente']) && isset($_POST['apellidosCliente']) &&
             isset($_POST['correoCliente']) && isset($_POST['tipoTel1Cliente']) && isset($_POST['numTel1Cliente']) &&
             isset($_POST['tipoTel2Cliente']) && isset($_POST['numTel2Cliente']) && isset($_POST['direccionCliente']) &&
             isset($_POST['numPlanoCliente'])) {

        	  $cedula = trim($_POST['cedulaCliente']);
            $nombre = trim($_POST['nombreCliente']);
            $apellidos = trim($_POST['apellidosCliente']);
            $correoElectronico = trim($_POST['correoCliente']);
            $telefono1 = new telefono(0,trim($_POST['tipoTel1Cliente']),trim($_POST['numTel1Cliente']));
            $telefono2 = new telefono(0,trim($_POST['tipoTel2Cliente']),trim($_POST['numTel2Cliente']));
            $direccion = trim($_POST['direccionCliente']);
            $numeroPlano = trim($_POST['numPlanoCliente']); 

            $cliente = new cliente(0,$cedula,$nombre,$apellidos,$correoElectronico,$direccion,
          	                   0,$numeroPlano,"Si");

            $this->logica->registrarCliente($cliente,$telefono1,$telefono2);

         }else{

            $this->redireccionActividadNoAutorizada();
         
         }

       }

    /*
    // Metodo para verificar si una cédula existe
    */

      public function verificarCedulaExistente(){

        if (isset($_POST['valor'])) {

          $cedula = trim($_POST['valor']);

          $this->personaLogic->comprobarExistenciaCedula($cedula);

        }else{

          $this->redireccionActividadNoAutorizada();
         
        }
    
      }

    /*
    // Metodo para verificar si una cédula existe
    */

      public function verificarCorreoElectronicoExistente(){

        if (isset($_POST['valor'])) {

          $correoElectronico = trim($_POST['valor']);

          $this->personaLogic->comprobarExistenciaCorreoElectronico($correoElectronico);

        }else{

          $this->redireccionActividadNoAutorizada();
         
        }

      }

    /*
    // Metodo para verificar si un número de plano existe
    */

      public function verificarNumeroPlanoExistente(){

        if (isset($_POST['valor'])) {

          $numeroPlano = trim($_POST['valor']);

          $this->logica->comprobarExistenciaNumeroPlano($numeroPlano);
          
        }else{

          $this->redireccionActividadNoAutorizada();
         
        }

      }

  }

?>
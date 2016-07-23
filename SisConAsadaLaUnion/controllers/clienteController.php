<?php

/*
// Clase para controladora de las operaciones sobre el cliente
*/

    class clienteController extends controlador
    {
      
      public function __construct(){

        parent::__construct();

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

      	  $cedula = $_POST['cedulaCliente'];
          $nombre = $_POST['nombreCliente'];
          $apellidos = $_POST['apellidosCliente'];
          $correoElectronico = $_POST['correoCliente'];
          $telefono1 = new telefono(0,$_POST['tipoTel1Cliente'],$_POST['numTel1Cliente']);
          $telefono2 = new telefono(0,$_POST['tipoTel2Cliente'],$_POST['numTel2Cliente']);
          $direccion = $_POST['direccionCliente'];
          $numeroPlano = $_POST['numPlanoCliente']; 

          $cliente = new cliente(0,$cedula,$nombre,$apellidos,$correoElectronico,$direccion,
        	                   0,$numeroPlano);

          $this->logica->registrarCliente($cliente,$telefono1,$telefono2);

       }

    /*
    // Metodo para verificar si una cédula existe
    */

      public function verificarCedulaExistente(){

        $cedula = $_POST['valor'];

        $personaLogic = new personaLogic();

        $personaLogic->comprobarExistenciaCedula($cedula);
    
      }

  }

?>
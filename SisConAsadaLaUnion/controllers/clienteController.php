<?php

    class clienteController extends controlador
    {
      
      function __construct(){

      parent::__construct();

    }

    /*
    // Metodos para mostrar las vistas asociadas a este controlador
    */

    function registrarClienteForm(){
  
    $this->vista->render($this,'registrarCliente');

    }

    /*
    ** Metodo para registrar un cliente
    */

    function registrarCliente(){

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

        $dataTelefono = new telefonoData();

        $dataTelefono->setTelefonoALista($telefono1);
        $dataTelefono->setTelefonoALista($telefono2);

        $listaTelefonos = $dataTelefono->getListaTelefonos(); 

        if ($this->modelo->registrarCliente($cliente,$listaTelefonos)) {
             
            echo "true";

        }else{

            echo "false";

        }
    }

    /*
    // Metodo para verificar si una cédula existe
    */

    function verificarCedulaExistente(){

      $cedula = $_POST['valor'];

      $dataPersona = new personaData();

      if ($dataPersona->comprobarExistenciaCedula($cedula)) {
        
         echo "<div class='alert alert-danger'>
               <strong><span class='glyphicon glyphicon-remove'></span></strong> 
                    La cédula digitada ya existe, debe cambiarla
              </div>";
      
      }else{

         echo "<div class='alert alert-success'>
               <strong><span class='glyphicon glyphicon-ok'></span></strong> 
                    Cédula disponible para ser registrada
              </div>";

      }
    
    }

  }

?>
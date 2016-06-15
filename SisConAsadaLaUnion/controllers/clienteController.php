    <?php

    include_once("../domain/cliente.php");
    include_once("../domain/telefono.php");
    include_once("../models/clienteData.php");
    include_once("../models/personaData.php");
    include_once("../models/telefonoData.php");

    /*
    ** Metodo principal
    */

    function principal(){

        if (isset($_POST['metodo']) && !empty($_POST['metodo'])) {

               $_POST['metodo']();

           }
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
        
        $dataCliente = new clienteData();

        $dataTelefono = new telefonoData();

        $dataTelefono->setTelefonoALista($telefono1);
        $dataTelefono->setTelefonoALista($telefono2);

        $listaTelefonos = $dataTelefono->getListaTelefonos(); 
        
        $resultadoRegistroCliente = $dataCliente->registrarCliente($cliente,$listaTelefonos);

        if ($resultadoRegistroCliente) {
             
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

      $existenciaCedula = $dataPersona->comprobarExistenciaCedula($cedula);

      if ($existenciaCedula) {
        
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

    principal();

    ?>
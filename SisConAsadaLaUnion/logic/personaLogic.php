<?php

  /*
  // Clase logica intermediaria entre el controlador y la data de la persona, tiene como objetivo validar
  // reglas de negocio y gestiona los llamados hacia la data
  */

	class personaLogic{

		private $personaData;

		public function __construct(){

			$this->personaData = new personaData();

		}

    /*
    // Método encargado de gestionar la comprobación de una cédula existente en la base de datos, mediando entre controlador y data
    */

		public function comprobarExistenciaCedula($cedula){

         	if ($this->personaData->comprobarExistenciaCedula($cedula)) {

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
<?php

   /*
   // Clase logica intermediaria entre el controlador y la data del lectura, tiene como objetivo validar
   // reglas de negocio y gestiona los llamados hacia la data
   */

   class lecturaLogic extends logica{

   	private $lecturaData;

   	public function __construct(){

		$this->lecturaData  = new lecturaData();
	  }

      public function registrarLectura(lecturaMedidor $lectura){

         if ($this->lecturaData->registrarLectura($lectura)) {
            echo "true";
         }
         else
         {
            echo "false";
         }
      }

      public function editarLectura($idLectura, $cantMtosCub)
      {
         if ($this->lecturaData-> editarLectura($idLectura, $cantMtosCub)) {
            echo "true";
         }
         else
         {
            echo "false";
         }
      }
}
?>
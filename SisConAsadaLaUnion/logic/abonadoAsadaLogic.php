<?php

    /*
   // Clase logica intermediaria entre el controlador y la data de abonadosAsada, tiene como objetivo validar
   // reglas de negocio y gestionar los llamados hacia la data
   */

	class abonadoAsadaLogic extends logica{

		public function __construct(){

			$this->abonadoAsadaData = new abonadoAsadaData();
			
		}
		
	}

?>
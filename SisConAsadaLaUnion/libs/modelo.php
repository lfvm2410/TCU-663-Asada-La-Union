<?php

	class modelo{
		
		function __construct(){

		$this->baseDatos = new conexionBaseDatos(DB_HOST,DB_USER,DB_PASS,DB_BASE);
			
		}
	}

?>
<?php

	class indexController extends controlador{

		function __construct(){

			parent::__construct();
		}

		function index(){ 
	
		$this->vista->render($this,'index');

		}

	}

?>
<?php
	
	define('SERVER', 'https://localhost');
	define('URL', '/SisConAsadaLaUnion/');
	define('LIBS', 'libs/');
	define('DOMAIN', 'libs/domain/');
	define('XML', $_SERVER['DOCUMENT_ROOT'].URL."storage/xml/");
	define('VALIDATION', 'libs/validation/');
	define('LOGIC', 'logic/');
	define('MODELS', 'models/');
	define('COMPONENTS', 'views/components/');

	//Codigos para paginacion de registros dinamica
	define('LIMITE_REGISTROS', 10);	
	define('PAGINACION_USUARIOS', 1);
	define('TOTAL_USUARIOS', 2);
	define('PAGINACION_TARIFAS', 5);
	define('TOTAL_TARIFAS', 6);
	define('PAGINACION_ABONADOSASADA', 7);
	define('TOTAL_ABONADOSASADA', 8);

	//Ruta para guardar archivos adjuntos
	define('RUTA_ARCHIVOS_ADJUNTOS', $_SERVER['DOCUMENT_ROOT'].URL."public/assets/files/");

	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '1234');
	define('DB_BASE', 'BDASADA_LaUnion');
	
?>
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
	define('LIMITE_REGISTROS_CONSUMOMENSUAL', 12);	
	define('PAGINACION_USUARIOS', 1);
	define('TOTAL_USUARIOS', 2);
	define('PAGINACION_SERVICIOS', 3);
	define('TOTAL_SERVICIOS', 4);
	define('PAGINACION_TARIFAS', 5);
	define('TOTAL_TARIFAS', 6);
	define('PAGINACION_ABONADOSASADA', 7);
	define('TOTAL_ABONADOSASADA', 8);
	define('PAGINACION_LECTURAS', 9);
	define('TOTAL_LECTURAS', 10);
	define('PAGINACION_CONTROLCONSUMO', 11);
	define('TOTAL_CONTROLCONSUMO', 12);
	define('PAGINACION_CONSUMOMENSUAL', 13);
	define('TOTAL_CONSUMOMENSUAL', 14);

	//Ruta para guardar archivos adjuntos
	define('RUTA_ARCHIVOS_ADJUNTOS', $_SERVER['DOCUMENT_ROOT'].URL."public/assets/files/");

	//Ruta para guardar las imagenes de la página de presentación
	define('RUTA_IMAGENES_PAGINA_PRESENTACION', $_SERVER['DOCUMENT_ROOT'].URL."public/assets/imagesPresentacion/");

	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '1234');
	define('DB_BASE', 'BDASADA_LaUnion');
	
?>
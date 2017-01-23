<?php include COMPONENTS.'header.php';?>
</head>
	<body>
		<?php include COMPONENTS.'encabezadoError.php';?>
		<div class="container" style="padding-top: 5%">
			<h3 class="text-center" style="color: red;"><strong>Error 500 - Internal Server Error (Error Interno Del Servidor)</strong></h3>
			<a href="<?php print URL;?>login" style="color: #337ab7 !important;"><h4 class="text-center" style="margin-top:2.5%;">Iniciar sesión</h4></a> 
			<a href="<?php print URL;?>index" style="color: #337ab7 !important;"><h4 class="text-center" style="margin-top:2.5%;">Página principal</h4></a> 
		</div>
		<?php include COMPONENTS.'pie.php';?>
	</body>
</html>
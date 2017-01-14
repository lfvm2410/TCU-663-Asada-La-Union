<?php include COMPONENTS.'header.php';?>
	<link href="<?php print URL;?>public/css/encabezado.css" rel="stylesheet"/>
	<script src="<?php print URL;?>public/js/encabezado.js" type="text/javascript"></script>
</head>
	<body>
		<div id="presentacionEncabezado">
			<a href="<?php print URL;?>index"><img id="logoAsada" src="<?php print URL;?>public/assets/images/LogoAsadaUnion.png"/></a>
			<h1><em>Sistema de control ASADA La Unión</em></h1>
			<h4><em>!Cuidamos tu agua!</em></h4>
		</div>
		<div class="container" style="padding-top: 5%">
			<h3 class="text-center" style="color: red;"><strong>Error 500 - Internal Server Error (Error Interno Del Servidor)</strong></h3>
			<a href="<?php print URL;?>login" style="color: #337ab7 !important;"><h4 class="text-center" style="margin-top:2.5%;">Iniciar sesión</h4></a> 
			<a href="<?php print URL;?>index" style="color: #337ab7 !important;"><h4 class="text-center" style="margin-top:2.5%;">Página principal</h4></a> 
		</div>
		<?php include COMPONENTS.'pie.php';?>
	</body>
</html>
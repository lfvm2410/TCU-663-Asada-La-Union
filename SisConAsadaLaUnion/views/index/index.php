<?php include COMPONENTS.'header.php';?>
	<link href="<?php print URL;?>public/css/encabezado.css" rel="stylesheet"/>
	<script src="<?php print URL;?>public/js/encabezado.js" type="text/javascript"></script>
	<script src="<?php print URL;?>public/js/index.js" type="text/javascript"></script>
</head>
<body>
<style type="text/css">
	h3, p{
		color:#00ABFF !important;
	}
</style>
	<div id="presentacionEncabezado">
		<a href="<?php print URL;?>"><img id="logoAsada" src="<?php print URL;?>public/assets/images/LogoAsadaUnion.png"/></a>
		<h1><em>Bienvenidos al sitio web ASADA La Unión</em></h1>
		<h4><em>¡Cuidamos tu agua!</em></h4>
	</div>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#acolapsar">
					<span class="sr-only">Navegación responsiva</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div id="acolapsar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li>
						<a href="<?php print URL;?>login">Control interno</a>
					</li>
					<li class="dropdown">
						<a href="<?php print URL;?>index/descargarArchivoAdjunto/?nombreArchivo=disponibilidadHidrica.pdf">Formulario de disponibilidad hídrica</a>
					</li>
					<li class="dropdown">
						<a href="<?php print URL;?>index/descargarArchivoAdjunto/?nombreArchivo=arregloPagos.pdf">Formulario de arreglo de pagos</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<br>
		<div class="col-md-12">
			<div id="carousel-1" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carousel-1" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-1" data-slide-to="1"></li>
					<li data-target="#carousel-1" data-slide-to="2"></li>
					<li data-target="#carousel-1" data-slide-to="3"></li>
				</ol>
				<div class="carousel-inner" role="listbox">
					<div id="item1" class="item active"></div>
					<div id="item2" class="item"></div>
					<div id="item3" class="item"></div>
					<div id="item4" class="item"></div>
				</div>
				<a href="#carousel-1" class="left carousel-control" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Anterior</span>
				</a>
				<a href="#carousel-1" class="right carousel-control" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Siguiente</span>
				</a>
			</div>
		</div>
	</div>
<?php include COMPONENTS.'pie.php';?>
</body>
</html>
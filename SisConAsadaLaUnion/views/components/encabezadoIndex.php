<link href="<?php print URL;?>public/css/encabezado.css" rel="stylesheet"/>
<script src="<?php print URL;?>public/js/encabezado.js" type="text/javascript"></script>
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
					<a href="<?php print URL;?>">Inicio</a>
				</li>
				<li>
					<a href="<?php print URL;?>login">Control interno</a>
				</li>
				<li>
					<a href="<?php print URL;?>">Consumo</a>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown">Descargas<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php print URL;?>index/descargarArchivoAdjunto/?nombreArchivo=disponibilidadHidrica.pdf">Formulario de disponibilidad hídrica</a></li>
						<li><a href="<?php print URL;?>index/descargarArchivoAdjunto/?nombreArchivo=arregloPagos.pdf">Formulario de arreglo de pagos</a></li>			
					</ul>
				</li>
				<li>
					<a href="<?php print URL;?>">Contacto</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
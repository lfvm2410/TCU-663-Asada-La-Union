<link href="<?php print URL;?>public/css/encabezado.css" rel="stylesheet"/>
<script src="<?php print URL;?>public/js/encabezado.js" type="text/javascript"></script>
<div id="presentacionEncabezado">
	<a href="#"><img id="logoAsada" src="<?php print URL;?>public/assets/images/LogoAsadaUnion.png"/></a>
	<h1><em>Sistema de control ASADA La Unión</em></h1>
	<h4><em>!Cuidamos tu agua!</em></h4>
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
			<li><a href="#"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">Desplegar<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#">Link</a></li>
					<li><a href="#">Lonk</a></li>
					<li><a href="#">Lank</a></li>
					<li><a href="#">Lenk</a></li>
					<li><a href="#">Lunk</a></li>		
				</ul>
			</li>
		    
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Hola, Luis Fernando<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#">Link</a></li>
					<li><a href="#">Lonk</a></li>
					<li><a href="#">Lank</a></li>
					<li><a href="#">Lenk</a></li>
					<li><a href="#">Lunk</a></li>
				</ul>
			</li>
			<li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesión</a></li>
        </ul>
	</div>
	</div>
</nav>
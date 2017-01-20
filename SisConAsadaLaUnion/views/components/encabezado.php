<link href="<?php print URL;?>public/css/encabezado.css" rel="stylesheet"/>
<script src="<?php print URL;?>public/js/encabezado.js" type="text/javascript"></script>
<div id="presentacionEncabezado">
	<a href="<?php print URL;?>"><img id="logoAsada" src="<?php print URL;?>public/assets/images/LogoAsadaUnion.png"/></a>
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
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">Presentación<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="<?php print URL;?>">Ir a página de presentación</a></li>
					<li><a href="<?php print URL;?>index/actualizarPaginaPresentacionForm">Actualizar página de presentación</a></li>
					<li><a href="<?php print URL;?>index/adjuntarArchivosForm">Adjuntar archivos</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">Personas<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="<?php print URL;?>persona/registrarPersonaForm">Registrar persona</a></li>
					<li><a href="<?php print URL;?>persona/consultarInformacionPersonas">Consultar información de personas</a></li>			
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">Clientes<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="<?php print URL;?>cliente/registrarClienteForm">Registrar cliente</a></li>
					<li><a href="<?php print URL;?>cliente/consultarInformacionClientes">Consultar información de clientes</a></li>	
					<li><a href="<?php print URL;?>cliente/activarClientes">Activar clientes</a></li>		
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">Servicios<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#">Registrar servicio a cliente</a></li>
					<li><a href="#">Actualizar servicio de cliente</a></li>
					<li><a href="#">Consultar información de los servicios de clientes</a></li>			
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">Abonados<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="<?php print URL;?>abonadoAsada/registrarRangoAbonadosForm">Registrar rango de abonados</a></li>
					<li><a href="<?php print URL;?>abonadoAsada/consultarInformacionRangosAbonados">Consultar información de los rangos de abonados</a></li>
					<li><a href="<?php print URL;?>abonadoAsada/rangoAbonadosActualAsadaForm">Rango de abonados actual de la ASADA</a></li>			
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">Tarifas<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="<?php print URL;?>tarifa/registrarTarifaForm">Registrar tarifa</a></li>
					<li><a href="<?php print URL;?>tarifa/consultarInformacionTarifas">Consultar información sobre las tarifas</a></li>			
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">Productos<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="<?php print URL;?>producto/registrarProductoForm">Registrar producto</a></li>
					<li><a href="<?php print URL;?>producto/consultarInformacionProductos">Consultar información sobre los productos</a></li>			
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">Reportes<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="<?php print URL;?>reportes/controlDeConsumo">Control de consumo</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Mi cuenta <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#">Información personal</a></li>
					<li><a href="<?php print URL;?>login/cerrarSession"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesión</a></li>
				</ul>
			</li>
		</ul>
	</div>
	</div>
</nav>
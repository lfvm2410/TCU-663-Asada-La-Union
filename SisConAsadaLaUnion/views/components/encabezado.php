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
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">Presentación<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#">Ir a página de presentación</a></li>
					<li><a href="#">Actualizar página de presentación</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">Usuarios<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#">Registrar usuario</a></li>
					<li><a href="#">Consultar información de usuarios</a></li>			
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">Colaboradores<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#">Registrar colaborador</a></li>
					<li><a href="#">Actualizar colaborador</a></li>
					<li><a href="#">Consultar información de colaboradores</a></li>
					<li><a href="#">Eliminar colaborador</a></li>			
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">Clientes<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="<?php print URL;?>cliente/registrarClienteForm">Registrar cliente</a></li>
					<li><a href="<?php print URL;?>cliente/consultarInformacionClientes">Consultar información de clientes</a></li>	
					<li><a href="#">Activar cliente</a></li>		
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
				<a class="dropdown-toggle" data-toggle="dropdown">Lecturas<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#">Registrar lectura</a></li>
					<li><a href="#">Actualizar lectura</a></li>
					<li><a href="#">Consultar información de lecturas capturadas</a></li>			
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">Abonados<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#">Registrar rango de abonados</a></li>
					<li><a href="#">Actualizar rango de abonados</a></li>
					<li><a href="#">Consultar los rangos de abonados del sistema</a></li>			
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">Tarifas<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#">Registrar tarifa</a></li>
					<li><a href="#">Actualizar tarifa</a></li>
					<li><a href="#">Consultar información sobre las tarifas</a></li>			
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">Productos<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#">Registrar producto</a></li>
					<li><a href="#">Actualizar producto</a></li>
					<li><a href="#">Consultar información sobre los productos</a></li>
					<li><a href="#">Eliminar producto</a></li>			
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">Reportes<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#">Metros cúbicos consumidos en el mes actual</a></li>
					<li><a href="#">Metros cúbicos consumidos en meses anteriores</a></li>	
					<li><a href="#">Reporte de fugas</a></li>
					<li><a href="#">Reporte de medidores</a></li>	
				</ul>
			</li>
			<li><a href="#">Configuración</a></li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Mi cuenta<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#">Información personal</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesión</a></li>
				</ul>
			</li>
		</ul>
	</div>
	</div>
</nav>
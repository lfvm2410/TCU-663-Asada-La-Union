<?php include COMPONENTS.'header.php';?>
	<link href="<?php print URL;?>public/css/loginForm.css" type="text/css" rel="stylesheet"/>
	<script src="<?php print URL;?>public/js/login.js" type="text/javascript"></script>
</head>
<body>
<div class="container" style="margin-top:6.3%; width:44%;">
	<div class="row">
		<div class="col-sd-12">
			<img class="img-responsive img-thumbnail center-block" src="<?php print URL;?>public/assets/templates/HeaderLogin.jpg" width="600px"/>
		</div>
	</div>
</div>
<div class="container" style="margin-top:2%; width:44%;">
	<form class="form-horizontal" action="" method="post" name="loginForm" id="idLoginForm">
			<div class="form-group">
			    <label  id="idLblNombreUsuario" for="idNombreUsuario">Usuario:</label> 
			    <input type="text" class="form-control" name="nombreUsuario" id="idNombreUsuario" maxlength="15" 
			        placeholder="Ingrese su nombre de usuario" required/>
			</div>
			<div class="form-group">
			    <label  id="idLblConUsu" for="idContraseniaUsuario">Contraseña:</label> 
			    <input type="password" class="form-control" name="contraseniaUsuario" id="idContraseniaUsuario" maxlength="15" 
			        placeholder="Ingrese su contraseña" required/>
			</div>  
			<div class="form-group" style="margin-top:7.6%;">
			    <input type="submit" class="btn btn-info center-block" id="idBtnIniciarSesion" value="Iniciar sesión"/>
			</div>
 	</form>
 	<a href="#"><h5 class="text-center" style="margin-top:5.6%;">¡Olvide mi contraseña!</h5></a> 
</div>
<footer class="footer">
	<div class="container pie">
		<div class="col-md-4 pieCol">
		    <h4>ASADA La Unión, Guápiles</h4>
		    <hr>
			<a href="<?php print URL;?>index/index"><h5>Quiénes somos</h5></a>
			<h5 style="">&copy Copyright 2016. Todos los derechos reservados.</h5>
		</div>
		<div class="col-md-4 pieCol">
			<h4>Redes sociales y contacto</h4>
			<hr>
			<a href="#"><img class="col-md-3 img-responsive img-round" src="<?php print URL;?>public/assets/images/FbLogo.png" width="38px"/></a>
			<a href="#"><img class="col-md-3 img-responsive img-round" src="<?php print URL;?>public/assets/images/GoogleLogo.png" width="38px"/></a>
			<a href="#"><img class="col-md-3 img-responsive img-round" src="<?php print URL;?>public/assets/images/TelefonoLogo.png" width="38px"/></a>
		</div>
		<div class="col-md-4 pieCol">
			<h4>Desarrolladores</h4>
			<hr>
			<a><h5>Danny Araya Moya</h5></a>
			<a><h5>Alexander Gamboa Salazar</h5></a>
			<a><h5>Luis Fernando Vargas Ménendez</h5></a>
		</div>
	</div>
</footer>
</body>
</html>
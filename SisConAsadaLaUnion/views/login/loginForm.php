<?php include COMPONENTS.'header.php';?>
	<link href="<?php print URL;?>public/css/loginForm.css" type="text/css" rel="stylesheet"/>
	<script src="<?php print URL;?>public/js/operacionesGenerales.js" type="text/javascript"></script>
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
 	<a id="idOlvidoContrasenia"><h5 class="text-center" style="margin-top:5.6%;">¡Olvide mi contraseña!</h5></a> 
</div>
<div id="idRecuperarContrasenia" class="container table-responsive" title="Recuperar contraseña" style="display:none;">
    <div class="container" style="margin-top:2%; width:80%;">
      <form class="form-horizontal" action="" method="post" name="recuperarContraseniaForm" id="idRecuperarContraseniaForm">
         <div class="form-group">
            <label id="idLblCorreoElectronico" for="idCorreoElectronico">Correo electrónico:</label>  
            <input type="email" class="form-control" name="correoElectronico" id="idCorreoElectronico"
            pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$" maxlength="30" 
            placeholder="Ingrese el correo electrónico asociado a su cuenta para recuperar su contraseña" required/> 
         </div>
         <div class="form-group">
            <input type="submit" class="btn btn-primary center-block" id="idBtnRecuperarContrasenia" value="Recuperar contraseña"/>
         </div>
     </form>
    </div>
</div>
<footer class="footer">
	<div class="container pie">
		<div class="col-md-4 pieCol">
		    <h4>ASADA La Unión, Guápiles</h4>
		    <hr>
			<a href="<?php print URL;?>"><h5>Quiénes somos</h5></a>
			<h5 style="">&copy Copyright 2017. Todos los derechos reservados.</h5>
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
			<a href="https://www.linkedin.com/in/alexander-gamboa-salazar-73a800121"><h5>Alexander Gamboa Salazar</h5></a>
			<a href="https://www.linkedin.com/in/luis-fernando-vargas-men%C3%A9ndez-1a2959136"><h5>Luis Fernando Vargas Ménendez</h5></a>
		</div>
	</div>
</footer>
</body>
</html>
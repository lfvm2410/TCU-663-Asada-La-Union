<?php include COMPONENTS.'header.php';?>
	<link href="<?php print URL;?>public/css/loginForm.css" type="text/css" rel="stylesheet"/>
	<script src="<?php print URL;?>public/js/restablecerContrasenia.js" type="text/javascript"></script>
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
	<h4 class="text-center"><strong>Restablecer contraseña</strong></h4>
	<form class="form-horizontal" action="" method="post" name="restablecerContraseniaForm" id="idRestablecerContraseniaForm">
		<input  type="hidden" name="idUsuarioSistema" value="<?php echo $_GET['idUsuarioSistema'] ?>"/>
		<input  type="hidden" name="token" value="<?php echo $_GET['token'] ?>"/>
        <div class="form-group">
        	<label id="idLblNuevaContrasenia" for="idNuevaContrasenia">Nueva contraseña:</label>  
        	<input type="password" class="form-control" name="nuevaContrasenia" id="idNuevaContrasenia" maxlength="15" 
        	pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Ingrese su nueva contraseña" required/> 
        </div>
        <h5 class="row">*Nota: La contraseña a ingresar debe contener al menos 8 caracteres, 1 letra mayúscula, 1 letra minúscula y 1 número</h5>
        <div class="form-group">
	    	<label id="idLblConfirmarNuevaContrasenia" for="idConfirmarNuevaContrasenia">Confirmar nueva contraseña:</label>  
	    	<input type="password" class="form-control" name="confirmarNuevaContrasenia" id="idConfirmarNuevaContrasenia" maxlength="15" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Ingrese su nueva contraseña otra vez para confirmar" required/> 
	    </div>
        <div class="row" id="mensajeVerificacionContrasenias"></div>
    	<div class="form-group">
        	<input type="submit" class="btn btn-info center-block" id="idBtnRecuperarContrasenia" value="Restablecer contraseña"/>
        </div>
 	</form>
 <a href="<?php print URL;?>login"><h5 class="text-center" style="margin-top:5.6%;">¡Volver al inicio de sesión!</h5></a> 
</div>
<footer class="footer">
	<div class="container pie">
		<div class="col-md-4 pieCol">
		    <h4>ASADA La Unión, Guápiles</h4>
		    <hr>
			<a href="#"><h5>Quiénes somos</h5></a>
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
			<a href="#"><h5>Alexander Gamboa Salazar</h5></a>
			<a href="#"><h5>Luis Fernando Vargas Ménendez</h5></a>
		</div>
	</div>
</footer>
</body>
</html>
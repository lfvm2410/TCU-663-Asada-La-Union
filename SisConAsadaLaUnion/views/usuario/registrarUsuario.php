<?php include COMPONENTS.'header.php';?>
    <link href="<?php print URL;?>public/css/datepickerStyle.css" rel="stylesheet"/>
    <script src="<?php print URL;?>public/js/registrarUsuarioOperaciones.js" type="text/javascript"></script>
</head>
<body>
<?php include COMPONENTS.'encabezado.php';?>
<h4 class="text-center"><strong>Registrar usuario</strong></h4>
<div class="container" style="margin-top:2%; width:30%;">
  <form class="form-horizontal" action="" method="post" name="registrarUsuarioForm" id="idRegistrarUsuarioForm">
     <div class="form-group">
        <label  id="idLblCedUsuario" for="idCedulaUsuario">Cédula:</label> 
        <input type="text" class="form-control" name="cedulaUsuario" id="idCedulaUsuario" maxlength="16"
        pattern="^[0-9]*$" placeholder="Ingrese la cédula del usuario" required/>
     </div>
     <div class="row" id="mensajeVerificacionCedula"></div>
     <div class="form-group">
        <label  id="idLblNomUsuario" for="idNombreUsuario">Nombre:</label> 
        <input type="text" class="form-control" name="nombreUsuario" id="idNombreUsuario" maxlength="30" 
        placeholder="Ingrese el nombre del usuario" required/>
     </div>
     <div class="form-group">
        <label id="idLblApellidosUsuario" for="idApellidosUsuario">Apellidos:</label>  
        <input type="text" class="form-control" name="apellidosUsuario" id="idApellidosUsuario" maxlength="30"
        placeholder="Ingrese los apellidos del usuario" required/>
     </div>
     <div class="form-group">
        <label id="idLblFechaNacimientoUsuario" for="idFechaNacimientoUsuario">Fecha de nacimiento:</label>  
        <input type="text" class="form-control" name="fechaNacimientoUsuario" id="idFechaNacimientoUsuario"
        placeholder="Ingrese la fecha de nacimiento del usuario" required readonly/>
     </div>
     <div class="form-group">
        <label id="idLblCorreoUsuario" for="idCorreoUsuario">Correo electrónico:</label>  
        <input type="email" class="form-control" name="correoUsuario" id="idCorreoUsuario"
        pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$" maxlength="30" 
        placeholder="Ingrese el correo electrónico del usuario" required/> 
     </div>
     <div class="row" id="mensajeVerificacionCorreo"></div>
     <div class="form-group">
        <label id="idLblNombreUsuarioSistema" for="idNombreUsuarioSistema">Nombre de usuario:</label>  
        <input type="text" class="form-control" name="nombreUsuarioSistema" id="idNombreUsuarioSistema" maxlength="15" 
        placeholder="Ingrese el nombre de usuario de acceso al sistema" required/> 
     </div>
     <div class="row" id="mensajeVerificacionNombreUsuario"></div>
     <div class="form-group">
        <label id="idLblContraseniaUsuario" for="idContraseniaUsuario">Contraseña:</label>  
        <input type="password" class="form-control" name="contraseniaUsuario" id="idContraseniaUsuario" maxlength="15" 
         pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Ingrese la contraseña del usuario" required/> 
     </div>
     <h5 class="row">*Nota: La contraseña a ingresar debe contener al menos 8 caracteres, 1 letra mayúscula, 1 letra minúscula y 1 número</h5>
     <div class="form-group" id="idConfirmarContraseniaGroup">
        <label id="idLblConfirmarContraseniaUsuario" for="idConfirmarContraseniaUsuario">Confirmar contraseña:</label>  
        <input type="password" class="form-control" name="confirmarContraseniaUsuario" id="idConfirmarContraseniaUsuario"maxlength="15"
        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Ingrese la contraseña del usuario nuevamente" required/> 
     </div>
     <div class="row" id="mensajeVerificacionContrasenias"></div>
     <div class="form-group">
        <label id="idLblTel1Usuario" for="idTipoTel1Usuario">Teléfono 1:</label>
        <select class="form-control" name="tipoTel1Usuario" id="idTipoTel1Usuario" required>
             <option value="">Seleccione</option>
             <option value="Fijo">Fijo</option>
             <option value="Móvil">Móvil</option>
        </select>
        <input type="text" class="form-control" name="numTel1Usuario" id="idNumTel1Usuario" minlength="8" maxlength="8" 
        pattern="^[0-9]{8}$" placeholder="Ingrese un número de teléfono" required/> 
     </div>
     <div class="form-group">
        <label id="idLblTel2Usuario" for="idTipoTel2Usuario">Teléfono 2 (Opcional):</label>
        <select class="form-control" name="tipoTel2Usuario" id="idTipoTel2Usuario">
             <option value="">Seleccione</option>
             <option value="Fijo">Fijo</option>
             <option value="Móvil">Móvil</option>
        </select>
        <input type="text" class="form-control" name="numTel2Usuario" id="idNumTel2Usuario" minlength="8" maxlength="8"
        pattern="^[0-9]{8}$" placeholder="Ingrese un número de teléfono"/>
     </div>
     <div class="form-group">
        <label id="idLblDirUsuario" for="idDireccionUsuario">Dirección:</label> 
        <textarea class="form-control" name="direccionUsuario" rows="2" id="idDireccionUsuario" maxlength="300" 
        placeholder="Ingrese la dirección del usuario" required></textarea>
     </div>
     <div class="form-group">
        <label id="idLblPuestoUsuario" for="idPuestoUsuario">Puesto:</label>  
        <input type="text" class="form-control" name="puestoUsuario" id="idPuestoUsuario" maxlength="15"
        placeholder="Ingrese el puesto de trabajo que desempeña el usuario" required/>
     </div>
      <div class="form-group">
        <label id="idLblDescPuestoUsuario" for="idDescripcionPuestoUsuario">Descripción del puesto:</label> 
        <textarea class="form-control" name="descripcionPuestoUsuario" rows="2" id="idDescripcionPuestoUsuario" maxlength="50" 
        placeholder="Ingrese la descripción del puesto de trabajo que desempeña el usuario" required></textarea>
     </div>
     <div class="form-group">
        <input type="submit" class="btn btn-primary center-block" id="idBtnRegistrarUsuario" value="Registrar"/>
     </div>
 </form>
</div>
<?php include COMPONENTS.'pie.php';?>
</body>
</html>
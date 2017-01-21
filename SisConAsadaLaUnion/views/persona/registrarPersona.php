<?php include COMPONENTS.'header.php';?>
    <link href="<?php print URL;?>public/css/datepickerStyle.css" rel="stylesheet"/>
    <script src="<?php print URL;?>public/js/operacionesGenerales.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/validacionesPersonas.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/registrarPersonaOperaciones.js" type="text/javascript"></script>
</head>
<body>
<?php include COMPONENTS.'encabezado.php';?>
<h4 class="text-center"><strong>Registrar persona</strong></h4>
<div class="container" style="margin-top:2%; width:30%;">
  <form class="form-horizontal" action="" method="post" name="registrarPersonaForm" id="idRegistrarPersonaForm">
    <div class="form-group">
        <label id="idLblPerfilPersona" for="idPerfilPersona">Perfil:</label>
        <select class="form-control" name="perfilPersona" id="idPerfilPersona" required>
             <option value="">Seleccione</option>
             <option value="Administrador">Administrador</option>
             <option value="Colaborador">Colaborador</option>
        </select>
     </div>
     <div id="seccionFormularioPersona">
         <div class="form-group">
            <label  id="idLblCedPersona" for="idCedulaPersona">Cédula:</label> 
            <input type="text" class="form-control" name="cedulaPersona" id="idCedulaPersona" maxlength="16"
            pattern="^[0-9]*$" placeholder="Ingrese la cédula de la persona" required/>
         </div>
         <div class="row" id="mensajeVerificacionCedula"></div>
         <div class="form-group">
            <label  id="idLblNomPersona" for="idNombrePersona">Nombre:</label> 
            <input type="text" class="form-control" name="nombrePersona" id="idNombrePersona" maxlength="30" 
            placeholder="Ingrese el nombre de la persona" required/>
         </div>
         <div class="form-group">
            <label id="idLblApellidosPersona" for="idApellidosPersona">Apellidos:</label>  
            <input type="text" class="form-control" name="apellidosPersona" id="idApellidosPersona" maxlength="30"
            placeholder="Ingrese los apellidos de la persona" required/>
         </div>
         <div class="form-group">
            <label id="idLblFechaNacimientoPersona" for="idFechaNacimientoPersona">Fecha de nacimiento:</label>  
            <input type="text" class="form-control" name="fechaNacimientoPersona" id="idFechaNacimientoPersona"
            placeholder="Ingrese la fecha de nacimiento de la persona" required readonly/>
         </div>
         <div class="form-group">
            <label id="idLblCorreoPersona" for="idCorreoPersona">Correo electrónico:</label>  
            <input type="email" class="form-control" name="correoPersona" id="idCorreoPersona"
            pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$" maxlength="30" 
            placeholder="Ingrese el correo electrónico de la persona" required/> 
         </div>
         <div class="row" id="mensajeVerificacionCorreo"></div>
         <div id="seccionUsuarioSistema">
             <div class="form-group">
                <label id="idLblNombreUsuarioPersona" for="idNombreUsuarioPersona">Nombre de usuario:</label>  
                <input type="text" class="form-control" name="nombreUsuarioPersona" id="idNombreUsuarioPersona" maxlength="15" 
                placeholder="Ingrese el nombre de usuario de acceso al sistema"/> 
             </div>
             <div class="row" id="mensajeVerificacionNombreUsuario"></div>
             <div class="form-group">
                <label id="idLblContraseniaPersona" for="idContraseniaPersona">Contraseña:</label>  
                <input type="password" class="form-control" name="contraseniaPersona" id="idContraseniaPersona" maxlength="15" 
                 pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Ingrese la contraseña de la persona"/> 
             </div>
             <h5 class="row">*Nota: La contraseña a ingresar debe contener al menos 8 caracteres, 1 letra mayúscula, 1 letra minúscula y 1 número</h5>
             <div class="form-group" id="idConfirmarContraseniaGroup">
                <label id="idLblConfirmarContraseniaPersona" for="idConfirmarContraseniaPersona">Confirmar contraseña:</label>  
                <input type="password" class="form-control" name="confirmarContraseniaPersona" id="idConfirmarContraseniaPersona"maxlength="15"
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Ingrese la contraseña de la persona nuevamente"/> 
             </div>
             <div class="row" id="mensajeVerificacionContrasenias"></div>
         </div>
         <div class="form-group">
            <label id="idLblTel1Persona" for="idTipoTel1Persona">Teléfono 1:</label>
            <select class="form-control" name="tipoTel1Persona" id="idTipoTel1Persona" required>
                 <option value="">Seleccione</option>
                 <option value="Fijo">Fijo</option>
                 <option value="Móvil">Móvil</option>
            </select>
            <input type="text" class="form-control" name="numTel1Persona" id="idNumTel1Persona" minlength="8" maxlength="8" 
            pattern="^[0-9]{8}$" placeholder="Ingrese un número de teléfono" required/> 
         </div>
         <div class="form-group">
            <label id="idLblTel2Persona" for="idTipoTel2Persona">Teléfono 2 (Opcional):</label>
            <select class="form-control" name="tipoTel2Persona" id="idTipoTel2Persona">
                 <option value="">Seleccione</option>
                 <option value="Fijo">Fijo</option>
                 <option value="Móvil">Móvil</option>
            </select>
            <input type="text" class="form-control" name="numTel2Persona" id="idNumTel2Persona" minlength="8" maxlength="8"
            pattern="^[0-9]{8}$" placeholder="Ingrese un número de teléfono"/>
         </div>
         <div class="form-group">
            <label id="idLblDirPersona" for="idDireccionPersona">Dirección:</label> 
            <textarea class="form-control" name="direccionPersona" rows="2" id="idDireccionPersona" maxlength="300" 
            placeholder="Ingrese la dirección de la persona" required></textarea>
         </div>
         <div class="form-group">
            <label id="idLblPuestoPersona" for="idPuestoPersona">Puesto:</label>  
            <input type="text" class="form-control" name="puestoPersona" id="idPuestoPersona" maxlength="15"
            placeholder="Ingrese el puesto de trabajo que desempeña la persona" required/>
         </div>
          <div class="form-group">
            <label id="idLblDescPuestoPersona" for="idDescripcionPuestoPersona">Descripción del puesto:</label> 
            <textarea class="form-control" name="descripcionPuestoPersona" rows="2" id="idDescripcionPuestoPersona" maxlength="50" 
            placeholder="Ingrese la descripción del puesto de trabajo que desempeña la persona" required></textarea>
         </div>
         <div class="form-group">
            <input type="submit" class="btn btn-primary center-block" id="idBtnRegistrarPersona" value="Registrar"/>
         </div>
     </div>
 </form>
</div>
<?php include COMPONENTS.'pie.php';?>
</body>
</html>
<?php include COMPONENTS.'header.php';?>
	<link href="<?php print URL;?>public/css/paginacion.css" rel="stylesheet"/>
    <link href="<?php print URL;?>public/css/datepickerStyle.css" rel="stylesheet"/>
    <script src="<?php print URL;?>public/js/esimakin-twbs-pagination-4a2f5ff/jquery.twbsPagination.min.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/paginacion.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/operacionesGenerales.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/validacionesPersonas.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/consultarInfoPersonasOperaciones.js" type="text/javascript"></script>
</head>
<body>
<?php include COMPONENTS.'encabezado.php';?>
<h4 class="text-center"><strong>Consultar información de personas</strong></h4>
<div class="container">
    <div class="form-inline form-group">
      <label id="idLblBuscarPersona" for="buscar">Buscar:</label>
      <input type="text" class="form-control" id="buscar" placeholder="Buscar por cédula, nombre o apellidos" maxlength="1000"/>
    </div>
</div>
<div class="container table-responsive">
  <table id="tablaPersonas" class="table table-striped table-condensed table-bordered table-hover">
    <thead>
        <tr class="info">
            <th>Acciones</th>
            <th>Cédula</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Correo electrónico</th>
            <th>Dirección</th>
            <th>Puesto</th>
            <th>Descripción</th>
            <th>Números de teléfono</th>
        </tr>
    </thead>
    <tbody id="cuerpoTablaPersonas"></tbody>
</table>
</div>
<center>
    <ul id="paginacion" class="pagination"></ul>
</center>
<div class="container">
    <button class="btn btn-info pull-right" onclick="window.print();">Imprimir</button>
</div>
<div id="verNumsTel" class="container table-responsive" title="Números de teléfono"></div>
<div id="editarPersona" class="container table-responsive" title="Editar persona" style="display:none;">
    <div class="container" style="margin-top:2%; width:80%;">
        <form class="form-horizontal" action="" method="post" name="editarPersonaForm" id="idEditarPersonaForm">
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
                <input type="submit" class="btn btn-primary center-block" id="idBtnEditarPersona" value="Actualizar información"/>
            </div>
         </form>
    </div>
</div>
<?php include COMPONENTS.'pie.php';?>
</body>
</html>
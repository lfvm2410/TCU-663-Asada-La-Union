<?php include COMPONENTS.'header.php';?>
	<link href="<?php print URL;?>public/css/consultarInformacionClientes.css" rel="stylesheet"/>
    <script src="<?php print URL;?>public/js/esimakin-twbs-pagination-4a2f5ff/jquery.twbsPagination.min.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/consultarInfoClientesOperaciones.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/editarClienteOperaciones.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/anularClienteOperaciones.js" type="text/javascript"></script>
</head>
<body>
<?php include COMPONENTS.'encabezado.php';?>
<h4 class="text-center"><strong>Consultar información de clientes</strong></h4>
<div class="container">
    <div class="form-inline form-group">
      <label id="idLblBuscarCliente" for="buscarCliente">Buscar:</label>
      <input type="text" class="form-control" id="buscarCliente" placeholder="Introduzca una cédula o un nombre" maxlength="30"/>
    </div>
</div>
<div class="container table-responsive">
  <table id="tablaClientes" class="table table-striped table-condensed table-bordered table-hover">
    <thead>
        <tr class="info">
            <th>Acciones</th>
            <th>Cédula</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Correo electrónico</th>
            <th>Dirección</th>
            <th>Número de plano</th>
            <th>Números de teléfono</th>
        </tr>
    </thead>
    <tbody id="cuerpoTablaClientes"></tbody>
</table>
</div>
<center>
    <ul id="paginacion" class="pagination"></ul>
</center>
<div id="verNumsTel" class="container table-responsive" title="Números de teléfono"></div>
<div id="editarCliente" class="container table-responsive" title="Editar cliente" style="display:none;">
    <div class="container" style="margin-top:2%; width:80%;">
      <form class="form-horizontal" action="" method="post" name="editarClienteForm" id="idEditarClienteForm">
         <div class="form-group">
            <label  id="idLblCedCli" for="idCedulaCliente">Cédula:</label> 
            <input type="text" class="form-control" name="cedulaCliente" id="idCedulaCliente" maxlength="16"
            pattern="^[0-9]*$" placeholder="Ingrese la cédula del cliente" required/>
         </div>
         <div class="row" id="mensajeVerificacionCedula"></div>
         <div class="form-group">
            <label  id="idLblNomCli" for="idNombreCliente">Nombre:</label> 
            <input type="text" class="form-control" name="nombreCliente" id="idNombreCliente" maxlength="30" 
            placeholder="Ingrese el nombre del cliente" required/>
         </div>
         <div class="form-group">
            <label id="idLblApellidosCli" for="idApellidosCliente">Apellidos:</label>  
            <input type="text" class="form-control" name="apellidosCliente" id="idApellidosCliente" maxlength="30"
            placeholder="Ingrese los apellidos del cliente" required/>
         </div>
         <div class="form-group">
            <label id="idLblCorreoCli" for="idCorreoCliente">Correo electrónico:</label>  
            <input type="email" class="form-control" name="correoCliente" id="idCorreoCliente"
            pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$" maxlength="30" 
            placeholder="Ingrese el correo electrónico del cliente" required/> 
         </div>
         <div class="row" id="mensajeVerificacionCorreo"></div>
         <div class="form-group">
            <label id="idLblTel1Cli" for="idTipoTel1Cliente">Teléfono 1:</label>
            <select class="form-control" name="tipoTel1Cliente" id="idTipoTel1Cliente" required>
                 <option value="">Seleccione</option>
                 <option value="Fijo">Fijo</option>
                 <option value="Móvil">Móvil</option>
            </select>
            <input type="text" class="form-control" name="numTel1Cliente" id="idNumTel1Cliente" minlength="8" maxlength="8" 
            pattern="^[0-9]{8}$" placeholder="Ingrese un número de teléfono" required/> 
         </div>
         <div class="form-group">
            <label id="idLblTel2Cli" for="idTipoTel2Cliente" for="idNumTel2Cliente">Teléfono 2 (Opcional):</label>
            <select class="form-control" name="tipoTel2Cliente" id="idTipoTel2Cliente">
                 <option value="">Seleccione</option>
                 <option value="Fijo">Fijo</option>
                 <option value="Móvil">Móvil</option>
            </select>
            <input type="text" class="form-control" name="numTel2Cliente" id="idNumTel2Cliente" minlength="8" maxlength="8"
            pattern="^[0-9]{8}$" placeholder="Ingrese un número de teléfono"/>
         </div>
         <div class="form-group">
            <label id="idLblDirCli" for="idDireccionCliente">Dirección:</label> 
            <textarea class="form-control" name="direccionCliente" rows="2" id="idDireccionCliente" maxlength="300" 
            placeholder="Ingrese la dirección del cliente" required></textarea>
         </div>
         <div class="form-group">
            <label id="idLblNumPlanoCli" for="idNumPlanoCliente">Número de plano (Opcional):</label> 
            <input type="text" class="form-control" name="numPlanoCliente" id="idNumPlanoCliente" maxlength="16" 
            placeholder="Ingrese el número de plano de la propiedad del cliente"/>
         </div>
         <div class="row" id="mensajeVerificacionPlano"></div>
         <div class="form-group">
            <input type="submit" class="btn btn-primary center-block" id="idBtnEditarCliente" value="Actualizar información"/>
         </div>
     </form>
    </div>
</div>
<?php include COMPONENTS.'pie.php';?>
</body>
</html>
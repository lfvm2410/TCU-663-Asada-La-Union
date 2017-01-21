<?php include COMPONENTS.'header.php';?>
    <link href="<?php print URL;?>public/css/paginacion.css" rel="stylesheet"/>
    <script src="<?php print URL;?>public/js/esimakin-twbs-pagination-4a2f5ff/jquery.twbsPagination.min.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/paginacion.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/operacionesGenerales.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/validacionesTarifas.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/consultarInfoTarifasOperaciones.js" type="text/javascript"></script>
</head>
<body>
<?php include COMPONENTS.'encabezado.php';?>
<h4 class="text-center"><strong>Consultar información sobre las tarifas</strong></h4>
<div class="container">
    <div class="form-inline form-group">
      <label id="idLblBuscarTarifa" for="buscar">Buscar:</label>
      <input type="text" class="form-control" id="buscar" placeholder="Buscar por rango de abonados, nombre, descripción o tipo de servicio" 
       maxlength="1000" style="width: 41.5% !important;"/>
    </div>
</div>
<div class="container table-responsive">
  <table id="tablaTarifas" class="table table-striped table-condensed table-bordered table-hover">
    <thead>
        <tr class="info">
            <th>Acciones</th>
            <th>Rango de abonados</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Tipo de servicio</th>
            <th>Monto</th>
            <th>Fecha de modificación (D/M/A H:M:S AM/PM)</th>
        </tr>
    </thead>
    <tbody id="cuerpoTablaTarifas"></tbody>
</table>
</div>
<center>
    <ul id="paginacion" class="pagination"></ul>
</center>
<div class="container">
    <button class="btn btn-info pull-right" onclick="window.print();">Imprimir</button>
</div>
<div id="editarTarifa" class="container table-responsive" title="Editar tarifa" style="display:none;">
    <div class="container" style="margin-top:2%; width:80%;">
        <form class="form-horizontal" action="" method="post" name="editarTarifaForm" id="idEditarTarifaForm">
            <div class="form-group">
                <label id="idLblRangoAbonados" for="idRangoAbonados">Rango de abonados:</label>
                <select class="form-control combo" name="rangoAbonados" id="idRangoAbonados" required>
                     <option value="">Seleccione</option>
                </select>
             </div>
             <div class="form-group">
                <label  id="idLblNombreTarifa" for="idNombreTarifa">Nombre:</label> 
                <input type="text" class="form-control" name="nombreTarifa" id="idNombreTarifa" maxlength="16" 
                placeholder="Ingrese el nombre de la tarifa" required/>
             </div>
             <div class="form-group">
                <label id="idLblDescripción" for="idDescripcionTarifa">Descripción:</label>
                <select class="form-control combo" name="descripcionTarifa" id="idDescripcionTarifa" required>
                     <option value="">Seleccione</option>
                </select>
             </div>
             <div class="row" id="mensajeVerificacionDescripcion"></div>
             <div class="form-group">
                <label id="idLblTipoServicio" for="idTipoServicio">Tipo de servicio:</label>
                <select class="form-control" name="tipoServicio" id="idTipoServicio" required>
                     <option value="">Seleccione</option>
                     <option value="Domipre">Domipre</option>
                     <option value="Endomipre">Endomipre</option>
                </select>
             </div>
             <div class="form-group">
                <label id="idLblMontoTarifa" for="idMontoTarifa">Monto:</label>  
                <input type="number" class="form-control" name="montoTarifa" id="idMontoTarifa" step="any" min="0.01" max="999999999999.99" placeholder="Ingrese el monto para la tarifa" required/>
             </div>
             <div class="form-group">
                <input type="submit" class="btn btn-primary center-block" id="idBtnEditarTarifa" value="Actualizar información"/>
             </div>
        </form>      
    </div>
</div>
<?php include COMPONENTS.'pie.php';?>
</body>
</html>
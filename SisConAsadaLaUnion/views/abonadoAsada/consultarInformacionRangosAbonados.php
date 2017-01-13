<?php include COMPONENTS.'header.php';?>
    <link href="<?php print URL;?>public/css/paginacion.css" rel="stylesheet"/>
    <script src="<?php print URL;?>public/js/esimakin-twbs-pagination-4a2f5ff/jquery.twbsPagination.min.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/paginacion.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/operacionesGenerales.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/consultarInfoRangosAbonadosOperaciones.js" type="text/javascript"></script>
</head>
<body>
<?php include COMPONENTS.'encabezado.php';?>
<h4 class="text-center"><strong>Consultar información de los rangos de abonados</strong></h4>
<div class="container">
    <div class="form-inline form-group">
      <label id="idLblBuscarRangosAbonados" for="buscar">Buscar:</label>
      <input type="text" class="form-control" id="buscar" placeholder="Búsqueda por rango de abonados" maxlength="1000"/>
    </div>
</div>
<div class="container table-responsive">
  <table id="tablaRangosAbonados" class="table table-striped table-condensed table-bordered table-hover">
    <thead>
        <tr class="info">
            <th>Acciones</th>
            <th>Rango de abonados</th>
            <th>Fecha de modificación (D/M/A H:M:S AM/PM)</th>
        </tr>
    </thead>
    <tbody id="cuerpoTablaRangosAbonados"></tbody>
</table>
</div>
<center>
    <ul id="paginacion" class="pagination"></ul>
</center>
<div id="editarRangoAbonados" class="container table-responsive" title="Editar rango de abonados" style="display:none;">
    <div class="container" style="margin-top:2%; width:80%;">
        <form class="form-horizontal" action="" method="post" name="editarRangoAbonadosForm" id="idEditarRangoAbonadosForm">
            <div class="form-group">
                <label id="idLblRangoAbonados" for="idRangoAbonados">Rango de abonados:</label>
                <input type="text" class="form-control" name="rangoAbonados" id="idRangoAbonados" maxlength="16" 
                placeholder="Ingrese el rango de abonados" required/>
            </div>
            <div class="row" id="mensajeVerificacionRangoAbonados"></div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary center-block" id="idBtnEditarRangoAbonados" 
                value="Actualizar información"/>
            </div>
        </form>      
    </div>
</div>
<?php include COMPONENTS.'pie.php';?>
</body>
</html>
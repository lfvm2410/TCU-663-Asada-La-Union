<?php include COMPONENTS.'header.php';?>
    <link href="<?php print URL;?>public/css/paginacion.css" rel="stylesheet"/>
    <script src="<?php print URL;?>public/js/esimakin-twbs-pagination-4a2f5ff/jquery.twbsPagination.min.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/paginacion.js" type="text/javascript"></script>
</head>
<body>
<?php include COMPONENTS.'encabezado.php';?>
<script type="text/javascript">

     $(document).on("ready", function () {

        var direccionCantidadPaginas = "/SisConAsadaLaUnion/reportes/consultarTotalidadPaginasControlConsumo";

        var direccionConsultaRegistros = "/SisConAsadaLaUnion/reportes/generarReporteControlConsumo";

        var idFiltroBusqueda = $("#buscar");

        var idCuerpoTabla = $("#cuerpoTablaControlDeConsumo");

        var colspan = 7;

        crearListaPaginasPaginacion(direccionCantidadPaginas,direccionConsultaRegistros,1,idFiltroBusqueda.val().trim(),idCuerpoTabla,colspan);

        buscarRegistrosPorFiltro(direccionCantidadPaginas,direccionConsultaRegistros,idFiltroBusqueda,idCuerpoTabla,colspan);

    });

</script>
<h4 class="text-center"><strong>Control de consumo</strong></h4>
<div class="container">
    <div class="form-inline form-group">
      <label id="idLblBusqueda" for="buscar">Buscar:</label>
      <input type="text" class="form-control" id="buscar" placeholder="Buscar por número de NIS, cédula, nombre, apellidos y estado de servicio" maxlength="1000" style="width: 43.6% !important;"/>
    </div>
</div>
<div class="container table-responsive">
  <table id="tablaControlDeConsumo" class="table table-striped table-condensed table-bordered table-hover">
    <thead>
        <tr class="info">
            <th>Número de NIS</th>
            <th>Cédula del cliente</th>
            <th>Nombre y apellidos del cliente</th>
            <th>Promedio de consumo (metros cúbicos)</th>
            <th>Última lectura (metros cúbicos)</th>
            <th>Fecha de última lectura (D/M/A H:M:S AM/PM)</th>
            <th>Variación porcentual</th>
        </tr>
    </thead>
    <tbody id="cuerpoTablaControlDeConsumo"></tbody>
</table>
</div>
<center>
    <ul id="paginacion" class="pagination"></ul>
</center>
<div class="container">
    <button class="btn btn-info pull-right" onclick="window.print();">Imprimir</button>
</div>
<?php include COMPONENTS.'pie.php';?>
</body>
</html>
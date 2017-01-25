<?php include COMPONENTS.'header.php';?>
    <link href="<?php print URL;?>public/css/paginacion.css" rel="stylesheet"/>
    <script src="<?php print URL;?>public/js/esimakin-twbs-pagination-4a2f5ff/jquery.twbsPagination.min.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/paginacion.js" type="text/javascript"></script>
</head>
<body>
<?php include COMPONENTS.'encabezadoIndex.php';?>
<script type="text/javascript">

     $(document).on("ready", function () {

        var direccionCantidadPaginas = "/SisConAsadaLaUnion/reportes/consultarTotalidadPaginasConsumoMensual";

        var direccionConsultaRegistros = "/SisConAsadaLaUnion/reportes/generarReporteConsumoMensual";

        var idFiltroBusqueda = $("#buscar");

        var idCuerpoTabla = $("#cuerpoTablaConsumoMensual");

        var colspan = 11;

        buscarRegistrosPorFiltro(direccionCantidadPaginas,direccionConsultaRegistros,idFiltroBusqueda,idCuerpoTabla,colspan);

    });

</script>
<h4 class="text-center"><strong>Consumo mensual</strong></h4>
<div class="container">
    <div class="form-inline form-group">
      <label id="idLblBusqueda" for="buscar">Buscar:</label>
      <input type="text" class="form-control" id="buscar" placeholder="Buscar por número de NIS" maxlength="1000"/>
    </div>
</div>
<div class="container table-responsive">
  <table id="tablaConsumoMensual" class="table table-striped table-condensed table-bordered table-hover">
    <thead>
        <tr class="info">
            <th>Número de NIS</th>
            <th>Nombre y apellidos del cliente</th>
            <th>Cantidad de metros cúbicos</th>
            <th>Fecha de lectura (D/M/A H:M:S AM/PM)</th>
            <th>Período de cobro (D/M/A - D/M/A)</th>
            <th>Mes al cobro</th>
            <th>Fecha de vencimiento de factura (D/M/A)</th>
            <th>Tipo de factura</th>
            <th>Estado de factura</th>
            <th>Total de lectura</th>
            <th>Total de factura</th>
        </tr>
    </thead>
    <tbody id="cuerpoTablaConsumoMensual"></tbody>
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
<?php include COMPONENTS.'header.php';?>
	<link href="<?php print URL;?>public/css/paginacion.css" rel="stylesheet"/>
    <script src="<?php print URL;?>public/js/esimakin-twbs-pagination-4a2f5ff/jquery.twbsPagination.min.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/paginacion.js" type="text/javascript"></script>
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
<script type="text/javascript">  
    $(document).on("ready", function () {

        var direccionCantidadPaginas = "/SisConAsadaLaUnion/persona/consultarTotalidadPaginasPersonas";

        var direccionConsultaRegistros = "/SisConAsadaLaUnion/persona/consultarPersonas";

        var idFiltroBusqueda = $("#buscar");

        var idCuerpoTabla = $("#cuerpoTablaPersonas");

        var colspan = 9;

        crearListaPaginasPaginacion(direccionCantidadPaginas,direccionConsultaRegistros,1,idFiltroBusqueda.val().trim(),idCuerpoTabla,colspan);

        buscarRegistrosPorFiltro(direccionCantidadPaginas,direccionConsultaRegistros,idFiltroBusqueda,idCuerpoTabla,colspan);
    
     });
</script>
<?php include COMPONENTS.'pie.php';?>
</body>
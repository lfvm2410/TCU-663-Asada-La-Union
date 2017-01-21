<?php include COMPONENTS.'header.php';?>
    <link href="<?php print URL;?>public/css/paginacion.css" rel="stylesheet"/>
    <script src="<?php print URL;?>public/js/esimakin-twbs-pagination-4a2f5ff/jquery.twbsPagination.min.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/paginacion.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/operacionesGenerales.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/consultarInfoServiciosOperaciones.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).on("ready", function(){
            var direccionCantidadPaginas = "/SisConAsadaLaUnion/servicio/consultarTotalidadPaginasServicios";
            var direccionConsultarServicios = "/SisConAsadaLaUnion/servicio/consultarServicios";
            var idFiltroBusqueda = $('#buscar');
            var idCuerpoTabla = $('#cuerpoTablaServicio');
            var colspan = 9;

            crearListaPaginasPaginacion(direccionCantidadPaginas, direccionConsultarServicios, 1, idFiltroBusqueda.val().trim(), idCuerpoTabla, colspan);

            buscarRegistrosPorFiltro(direccionCantidadPaginas, direccionConsultarServicios, idFiltroBusqueda, idCuerpoTabla, colspan);

            crearVentanaModal($("#editarServicio"),600,600,"false");
            crearVentanaModal($("#verLecturas"),800,600,"false");
        
            ejecutarAccionSeleccionada(idFiltroBusqueda,direccionCantidadPaginas,direccionConsultarServicios,idCuerpoTabla,colspan);
        });
    </script>
</head>
<body>
<?php include COMPONENTS.'encabezado.php';?>
<h4 class="text-center"><strong>Consultar información de servicios</strong></h4>
<div class="container">
    <div class="form-inline form-group">
      <label id="idLblBuscarServicio" for="buscar">Buscar:</label>
      <input type="text" class="form-control" id="buscar" placeholder="Introduzca un Número de NIS" maxlength="30"/>
    </div>
</div>
<div class="container table-responsive">
  <table id="tablaServicio" class="table table-striped table-condensed table-bordered table-hover">
    <thead>
        <tr class="info">
            <th>Acciones</th>
            <th>Número de NIS</th>
            <th>Estado</th>
            <th>Tipo de Servicio</th>
            <th>Fecha de Modificación</th>
            <th>Cliente</th>
        </tr>
    </thead>
    <tbody id="cuerpoTablaServicio"></tbody>
</table>
</div>
<center>
    <ul id="paginacion" class="pagination"></ul>
</center>
<div class="container">
    <button class="btn btn-info pull-right" onclick="window.print();">Imprimir</button>
</div>
<div id="editarServicio" class="container table-responsive" title="Editar servicio" style="display:none;">
    <div class="container" style="margin-top:2%; width:80%;">
        <form class="form-horizontal" action="" method="post" name="idEditarServicioForm" id="idEditarServicioForm">
        
            <input type="number" name="idServicio" id="idServicio" style="display: none;">
            <div class="form-group">
                <label>Cliente</label>
                <input class="form-control" type="text" name="idCliente" id="idCliente"  readonly="readonly" required/>
            </div>
            <div class="form-group">
                <label class="idLblnumNIS">Número de NIS</label>
                <input class="form-control" type="text" id="idnumNIS" name="idnumNIS" maxlength="16" readonly="readonly" required/>
            </div>
            <div class="form-group">
                <label>Tipo de Servicio</label>
                <select id="tipoServicio" name="tipoServicio" class="form-control" required>
                    <option value="">Seleccionar</option>
                    <option value="Domipre">Domipre</option>
                    <option value="Endomipre">Endomipre</option>
                </select>
            </div>
            <div class="form-group">
                <label>Estado</label>
                <select id="cbEstado" name="cbEstado" class="form-control" required>
                    <option value="">Seleccionar</option>
                    <option value="Funcionando">Funcionando</option>
                    <option value="Suspendido">Suspendido</option>
                </select>
            </div>
            <div class="form-group">
                <label>Fecha última modificación</label>
                <input type="text" name="fecModificacion" id="fecModificacion" class="form-control">
            </div>
            <div>
                <input type="submit" class="btn btn-primary center-block" id="idBtnEditarCliente" value="Guardar"/>
            </div>
        </form>
    </div>
</div>
<div id="dialogLecturas" style="display: none;" title="Consultar información de lecturas">
    <iframe id="idIframe" title="La pinga de herodes" width="100%" height="100%"></iframe>
</div>
<?php include COMPONENTS.'pie.php';?>    
</body>
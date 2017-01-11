<?php include COMPONENTS.'header.php';?>
	<link href="<?php print URL;?>public/css/consultarInformacionClientes.css" rel="stylesheet"/>
    <script src="<?php print URL;?>public/js/esimakin-twbs-pagination-4a2f5ff/jquery.twbsPagination.min.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/activarClientesOperaciones.js" type="text/javascript"></script>
</head>
<body>
<?php include COMPONENTS.'encabezado.php';?>
<h4 class="text-center"><strong>Activar clientes</strong></h4>
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
            <th>Activar</th>
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
<?php include COMPONENTS.'pie.php';?>
</body>
</html>
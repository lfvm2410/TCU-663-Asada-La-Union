<?php include COMPONENTS.'header.php';?>
	<link href="<?php print URL;?>public/css/consultarInformacionClientes.css" rel="stylesheet"/>
    <script src="<?php print URL;?>public/js/consultarInfoClientesOperaciones.js" type="text/javascript"></script>
</head>
<body>
<?php include COMPONENTS.'encabezado.php';?>
<div class="container table-responsive">
  <table id="tablaClientes" class="table table-striped table-condensed table-bordered table-hover">
    <thead>
        <tr class="info">
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
    <ul class="pagination" id="paginacion"></ul>
</center>
<div id="verNumsTel" class="container table-responsive" title="Números de teléfono"></div>
<?php include COMPONENTS.'pie.php';?>
</body>
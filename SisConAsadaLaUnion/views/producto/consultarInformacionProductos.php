<?php include COMPONENTS.'header.php';?>
	<link href="<?php print URL;?>public/css/consultarInformacionProductos.css" rel="stylesheet"/>
    <script src="<?php print URL;?>public/js/esimakin-twbs-pagination-4a2f5ff/jquery.twbsPagination.min.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/consultarInfoProductosOperaciones.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/editarProductoOperaciones.js" type="text/javascript"></script>
     <script src="<?php print URL;?>public/js/eliminarProductoOperaciones.js" type="text/javascript"></script>
</head>
<body>
<?php include COMPONENTS.'encabezado.php';?>
<h4 class="text-center"><strong>Consultar información sobre los productos</strong></h4>
<div class="container">
    <div class="form-inline form-group">
      <label id="idLblBuscarProducto" for="buscarProducto">Buscar:</label>
      <input type="text" class="form-control" id="buscarProducto" placeholder="Introduzca el nombre del producto a buscar" maxlength="30"/>
    </div>
</div>
<div class="container table-responsive">
  <table id="tablaProductos" class="table table-striped table-condensed table-bordered table-hover">
    <thead>
        <tr class="info">
            <th>Acciones</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Fecha de modificación (D/M/A H:M:S AM/PM)</th>
        </tr>
    </thead>
    <tbody id="cuerpoTablaProductos"></tbody>
</table>
</div>
<center>
    <ul id="paginacion" class="pagination"></ul>
</center>
<div class="container">
    <button class="btn btn-info pull-right" onclick="window.print();">Imprimir</button>
</div>
<div id="editarProducto" class="container table-responsive" title="Editar producto" style="display:none;">
    <div class="container" style="margin-top:2%; width:80%;">
      <form class="form-horizontal" action="" method="post" name="editarProductoForm" id="idEditarProductoForm">
         <div class="form-group">
            <label  id="idLblNombreProducto" for="idNombreProducto">Nombre:</label> 
            <input type="text" class="form-control" name="nombreProducto" id="idNombreProducto" maxlength="30" 
            placeholder="Ingrese el nombre del producto" required/>
         </div>
         <div class="form-group">
            <label  id="idLblDescripcionProducto" for="idDescripcionProducto">Descripción:</label>
            <textarea class="form-control" name="descripcionProducto" rows="2" id="idDescripcionProducto" maxlength="60" 
            placeholder="Ingrese la descripción del producto" required></textarea>
         </div>
         <div class="form-group">
            <label id="idLblCantidadProducto" for="idCantidadProducto">Cantidad:</label>  
            <input type="number" class="form-control" name="cantidadProducto" id="idCantidadProducto" min="1" max="2147483647"
            placeholder="Ingrese la cantidad disponible del producto" required/>
         </div>
         <div class="form-group">
            <input type="submit" class="btn btn-primary center-block" id="idBtnEditarProducto" value="Actualizar información"/>
         </div>
     </form>
    </div>
</div>
<?php include COMPONENTS.'pie.php';?>
</body>
</html>
<?php include COMPONENTS.'header.php';?>
    <script src="<?php print URL;?>public/js/registrarProductoOperaciones.js" type="text/javascript"></script>
</head>
<body>
<?php include COMPONENTS.'encabezado.php';?>
<h4 class="text-center"><strong>Registrar producto</strong></h4>
<div class="container" style="margin-top:2%; width:30%;">
  <form class="form-horizontal" action="" method="post" name="registrarProductoForm" id="idRegistrarProductoForm">
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
        <input type="submit" class="btn btn-primary center-block" id="idBtnRegistrarProducto" value="Registrar"/>
     </div>
 </form>
</div>
<?php include COMPONENTS.'pie.php';?>
</body>
</html>
<?php include COMPONENTS.'header.php';?>
    <script src="<?php print URL;?>public/js/operacionesGenerales.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/validacionesTarifas.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/rangoAbonadosActualAsada.js" type="text/javascript"></script>
</head>
<body>
<?php include COMPONENTS.'encabezado.php';?>
<h4 class="text-center"><strong>Rango de abonados actual de la ASADA</strong></h4>
<div class="container" style="margin-top:2%; width:30%;">
  <form class="form-horizontal" action="" method="post" name="registrarRangoAbonadosActualAsadaForm" 
   id="idRegistrarRangoAbonadosActualAsadaForm">
    <div class="form-group">
        <label id="idLblRangoAbonadosActualAsada" for="idRangoAbonadosActualAsada">Rango de abonados actual de la ASADA:
        </label>
        <select class="form-control combo" name="rangoAbonadosActualAsada" id="idRangoAbonadosActualAsada" required>
             <option value="">Seleccione</option>
        </select>
    </div>
    <div class="form-group">
      <input type="submit" class="btn btn-primary center-block" id="idBtnGuardarRangoAbonadosActualAsada" value="Guardar"/>
    </div>
 </form>
</div>
<?php include COMPONENTS.'pie.php';?>
</body>
</html>
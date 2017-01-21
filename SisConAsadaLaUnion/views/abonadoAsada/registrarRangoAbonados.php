<?php include COMPONENTS.'header.php';?>
    <script src="<?php print URL;?>public/js/operacionesGenerales.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/registrarRangoAbonadosOperaciones.js" type="text/javascript"></script>
</head>
<body>
<?php include COMPONENTS.'encabezado.php';?>
<h4 class="text-center"><strong>Registrar rango de abonados</strong></h4>
<div class="container" style="margin-top:2%; width:30%;">
  <form class="form-horizontal" action="" method="post" name="registrarRangoAbonadosForm" id="idRegistrarRangoAbonadosForm">
    <div class="form-group">
        <label id="idLblRangoAbonados" for="idRangoAbonados">Rango de abonados:</label>
        <input type="text" class="form-control" name="rangoAbonados" id="idRangoAbonados" maxlength="16" 
        placeholder="Ingrese el rango de abonados" required/>
    </div>
    <div class="row" id="mensajeVerificacionRangoAbonados"></div>
    <div class="form-group">
      <input type="submit" class="btn btn-primary center-block" id="idBtnRegistrarRangoAbonados" value="Registrar"/>
    </div>
 </form>
</div>
<?php include COMPONENTS.'pie.php';?>
</body>
</html>
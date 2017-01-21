<?php include COMPONENTS.'header.php';?>
    <script src="<?php print URL;?>public/js/operacionesGenerales.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/validacionesTarifas.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/registrarTarifaOperaciones.js" type="text/javascript"></script>
</head>
<body>
<?php include COMPONENTS.'encabezado.php';?>
<h4 class="text-center"><strong>Registrar tarifa</strong></h4>
<div class="container" style="margin-top:2%; width:30%;">
  <form class="form-horizontal" action="" method="post" name="registrarTarifaForm" id="idRegistrarTarifaForm">
     <div class="form-group">
        <label id="idLblRangoAbonados" for="idRangoAbonados">Rango de abonados:</label>
        <select class="form-control combo" name="rangoAbonados" id="idRangoAbonados" required>
             <option value="">Seleccione</option>
        </select>
     </div>
     <div class="form-group">
        <label  id="idLblNombreTarifa" for="idNombreTarifa">Nombre:</label> 
        <input type="text" class="form-control" name="nombreTarifa" id="idNombreTarifa" maxlength="16" 
        placeholder="Ingrese el nombre de la tarifa" required/>
     </div>
     <div class="form-group">
        <label id="idLblDescripción" for="idDescripcionTarifa">Descripción:</label>
        <select class="form-control combo" name="descripcionTarifa" id="idDescripcionTarifa" required>
             <option value="">Seleccione</option>
        </select>
     </div>
     <div class="row" id="mensajeVerificacionDescripcion"></div>
     <div class="form-group">
        <label id="idLblTipoServicio" for="idTipoServicio">Tipo de servicio:</label>
        <select class="form-control" name="tipoServicio" id="idTipoServicio" required>
             <option value="">Seleccione</option>
             <option value="Domipre">Domipre</option>
             <option value="Endomipre">Endomipre</option>
        </select>
     </div>
     <div class="form-group">
        <label id="idLblMontoTarifa" for="idMontoTarifa">Monto:</label>  
        <input type="number" class="form-control" name="montoTarifa" id="idMontoTarifa" step="any" min="0.01" max="999999999999.99"
        placeholder="Ingrese el monto para la tarifa" required/>
     </div>
     <div class="form-group">
        <input type="submit" class="btn btn-primary center-block" id="idBtnRegistrarTarifa" value="Registrar"/>
     </div>
 </form>
</div>
<?php include COMPONENTS.'pie.php';?>
</body>
</html>
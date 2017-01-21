<?php include COMPONENTS.'header.php';?>
    <script src="<?php print URL;?>public/js/operacionesGenerales.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/actualizarPaginaPresentacionOperaciones.js" type="text/javascript"></script>
</head>
<body>
<?php include COMPONENTS.'encabezado.php';?>
<h4 class="text-center"><strong>Actualizar página de presentación</strong></h4>
<div class="container" style="margin-top:2%; width:30%;">
  <form class="form-horizontal" enctype="multipart/form-data" action="" method="post" name="actualizarPaginaPresentacionForm" 
   id="idActualizarPaginaPresentacionForm">
     <div class="form-group">
        <label id="idLblQuienesSomos" for="idQuienesSomos">¿Quiénes somos?</label>
        <textarea class="form-control" name="quienesSomos" rows="4" id="idQuienesSomos" 
        placeholder="Ingrese la descripción general de la ASADA" maxlength="250" required></textarea>
     </div>
     <div class="form-group">
        <label id="idLblMision" for="idMision">Misión:</label>
        <textarea class="form-control" name="mision" rows="4" id="idMision" 
        placeholder="Ingrese la misión de la ASADA" maxlength="250" required></textarea>
     </div>
     <div class="form-group">
        <label id="idLblVision" for="idVision">Visión:</label>
        <textarea class="form-control" name="vision" rows="4" id="idVision" 
        placeholder="Ingrese la visión de la ASADA" maxlength="250" required></textarea>
     </div>
     <div class="form-group">
        <label id="idLblValores" for="idValores">Valores:</label>
        <textarea class="form-control" name="valores" rows="4" id="idValores" 
        placeholder="Ingrese los valores de la ASADA" maxlength="250" required></textarea>
     </div>
     <div class="form-group">
        <label id="idLblImagenesPantallaPresentacion" for="idImagenesPantallaPresentacion">Imágenes para la página de presentación:
        </label>
        <input type="file" class="form-control" name="imagenesPantallaPresentacion[]" id="idImagenesPantallaPresentacion" multiple 
        accept="image/jpg, image/jpeg, image/png" max="4"/>
     </div>
     <div class="row" id="idVistaPrevia" data-validacion="true"></div>
     <div class="row" id="idMensajeEspera"></div>
     <div class="form-group">
        <input type="submit" class="btn btn-primary center-block" id="idBtnActualizarInformacion" value="Actualizar información"/>
     </div>
 </form>
</div>
<?php include COMPONENTS.'pie.php';?>
</body>
</html>
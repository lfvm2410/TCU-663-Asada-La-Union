<?php include COMPONENTS.'header.php';?>
    <script src="<?php print URL;?>public/js/operacionesGenerales.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/adjuntarArchivosOperaciones.js" type="text/javascript"></script>
</head>
<body>
<?php include COMPONENTS.'encabezado.php';?>
<h4 class="text-center"><strong>Adjuntar archivos</strong></h4>
<div class="container" style="margin-top:2%; width:30%;">
  <form class="form-horizontal" enctype="multipart/form-data" action="" method="post" name="adjuntarArchivosForm" 
   id="idAdjuntarArchivosForm">
     <div class="form-group">
        <label id="idLblDisponibilidadHidrica" for="idDisponibilidadHidrica">Adjuntar disponibilidad hídrica:</label> 
        <input type="file" class="form-control" name="disponibilidaHidrica" id="idDisponibilidadHidrica" 
         accept="application/pdf" required/>
     </div>
     <div class="form-group">
        <label id="idLblArregloPagos" for="idArregloPagos">Adjuntar arreglo de pagos</label>
        <input type="file" class="form-control" name="arregloPagos" id="idArregloPagos" 
         accept="application/pdf" required/>
     </div>
     <div class="row" id="idMensajeEspera"></div>
     <div class="form-group">
        <input type="submit" class="btn btn-primary center-block" id="idBtnGuardarArchivos" value="Guardar archivos"/>
     </div>
 </form>
</div>
<?php include COMPONENTS.'pie.php';?>
</body>
</html>
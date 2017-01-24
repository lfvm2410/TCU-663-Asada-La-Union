<?php include COMPONENTS.'header.php';?>
	<style type="text/css">

		/*tablaPersonaAsada cell style*/

		#tablaPersonalAsada th, #tablaPersonalAsada td { 
     		border-top: none !important; 
 		}

		/*Tr header style*/

		.info th{
			background-color: #00ABFF !important;
    		color: #FFFFFF; 
		}

		/*Hover de table*/

		.table-hover>tbody>tr:hover {
    		background-color: #00ABFF;
    		color: #FFFFFF;
		}

		/*JQuery dialog style*/

		.ui-widget-header{
			background: none;
			background-color: #00ABFF;
		}

		/*JQuery dialog title style*/

		.ui-dialog-title{
			color: #FFFFFF;
		}

		/*JQuery dialog button style*/

		.ui-dialog-titlebar-close{
			background-image: url("/SisConAsadaLaUnion/public/assets/images/cerrar.png");
			background-size: 100% 100%;
			background-color: #FFFFFF;
		}
		
	</style>
	<script src="<?php print URL;?>public/js/operacionesGenerales.js" type="text/javascript"></script>
	<script src="<?php print URL;?>public/js/contacto.js" type="text/javascript"></script>
</head>
<body>
<?php include COMPONENTS.'encabezadoIndex.php';?>
<h4 class="text-center"><strong>Contacto</strong></h4>
<div class="container table-responsive">
  <h4><strong>Información sobre el personal de la ASADA</strong></h4>
  <table id="tablaPersonalAsada" class="table" width="100%"></table>
</div>
<a id="idEnviarSugerencia" style="color: #337ab7 !important;">
	<h5 class="text-center" style="color: #337ab7 !important; margin-top:5.6%;">Enviar sugerencia</h5>
</a>
<div id="verNumsTel" class="container table-responsive" title="Números de teléfono"></div>
<div id="idEnviarSugerenciaModal" class="container table-responsive" title="Enviar sugerencia" style="display:none;">
    <div class="container" style="margin-top:2%; width:80%;">
      <form class="form-horizontal" action="" method="post" name="enviarSugerenciaForm" id="idEnviarSugerenciaForm">
      	 <div class="form-group">
            <label id="idLblAsunto" for="idAsunto">Asunto:</label>  
            <input type="text" class="form-control" name="asunto" id="idAsunto" maxlength="25" 
             placeholder="Ingrese el asunto de la sugerencia" required/> 
         </div>
         <div class="form-group">
            <label id="idLblAsunto" for="idComentario">Comentario:</label>  
            <textarea class="form-control" name="comentario" id="idComentario" rows="4" maxlength="250" 
         	placeholder="Ingrese el comentario de la sugerencia" required></textarea>
         </div>
         <div class="form-group">
            <label id="idLblCorreoElectronico" for="idCorreoElectronico">Correo electrónico:</label>  
            <input type="email" class="form-control" name="correoElectronico" id="idCorreoElectronico"
            pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$" maxlength="30" 
            placeholder="Ingrese su correo electrónico" required/> 
         </div>
         <div class="form-group">
            <input type="submit" class="btn btn-primary center-block" id="idBtnEnviarSugerencia" value="Enviar sugerencia"/>
         </div>
       </form>
    </div>
</div>
<?php include COMPONENTS.'pie.php';?>
</body>
</html>
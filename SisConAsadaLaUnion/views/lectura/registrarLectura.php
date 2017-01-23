<?php include COMPONENTS.'header.php';?>
<link href="<?php print URL;?>public/css/paginacion.css" rel="stylesheet"/>
    <script src="<?php print URL;?>public/js/esimakin-twbs-pagination-4a2f5ff/jquery.twbsPagination.min.js" type="text/javascript"></script>
    <script src="<?php print URL;?>public/js/paginacion.js" type="text/javascript"></script>
<script type="text/javascript">

        var direccionCantidadPaginas;
        var direccionConsultarServicios;
        var idFiltroBusqueda;
        var idCuerpoTabla;
        var colspan;
        var indicadorEditar = 0;
        var idLecturaEditar = 0;

        $(document).on("ready", function(){

            var idForm = $("#idRegistrarLecturaForm");
            var idServicio = $("#idServicioLec").attr("data-idServicio");
            direccionCantidadPaginas = "/SisConAsadaLaUnion/lectura/consultarTotalidadPaginasLecturas";
            direccionConsultarServicios = "/SisConAsadaLaUnion/lectura/consultarLecturas";
            idFiltroBusqueda = $('#idServicioLec');
            idCuerpoTabla = $('#cuerpoTablaLectura');
            colspan = 9;

            crearListaPaginasPaginacion(direccionCantidadPaginas, direccionConsultarServicios, 1, idServicio, idCuerpoTabla, colspan);

            cargarDatosServicio(idServicio);
            activarEnvioDatos(idForm,idServicio,direccionCantidadPaginas,direccionConsultarServicios,idCuerpoTabla,colspan);

            ejecutarAccionSeleccionada(idFiltroBusqueda,direccionCantidadPaginas,direccionConsultarServicios,idCuerpoTabla,colspan)
        });

        function cargarDatosServicio($idServicio)
        {
            $.ajax({
                  url: "/SisConAsadaLaUnion/servicio/obtenerServicioPorID",
                  type: "POST",
                  data: { idServicio : $idServicio },
                  dataType: "json",
                  success: function(respuesta)
                  {

                    if (respuesta != "false") 
                    {
                      var idServicioActual = 0;
                      var numNISActual = "";

                      $("#idnumNISLec").val(respuesta.numeroNIS);
                      $("#idClienteLec").val(respuesta.cliente);
                      $("#idServicioLec").val(respuesta.idServicio);
                    }
                    else
                    {
                      alertify.error("Ha ocurrido un error al tratar de cargar la información del servicio seleccionado");
                    }
                  },
                  error: function(error)
                  {

                    alertify.error("Error de conexión al tratar de cargar la información del servicio seleccionado");

                  }
          });
        }

        function activarEnvioDatos(idForm,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan)
        {

            idForm.on('submit', function(e){

              e.preventDefault(); 

              var descripcionTexto;
              var url;

              if (indicadorEditar == 0) 
              {
                url = "/SisConAsadaLaUnion/lectura/registrarLectura";
                descripcionTexto = " el registro ";  
              }
              else if (indicadorEditar == 1)
              {
                url = "/SisConAsadaLaUnion/lectura/editarLectura";
                descripcionTexto = " la edición ";
              }

              if (confirmarTransaccion('¿Está seguro de proceder con'+descripcionTexto+'de la lectura?')) 
              {

                var datosFormulario = idForm.serialize();

                enviarFormularioLectura(idForm,url,datosFormulario,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan);

              }

            });
        }

        function enviarFormularioLectura(idForm,url,datosFormulario,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan){

            $.ajax({
              url:  url,
              type: "POST",
              data: datosFormulario,
              success: function(respuesta)
              {

                  if (respuesta == "true")
                  {
                      
                      if (indicadorEditar == 1) 
                      {
                        alertify.success("Lectura editada con éxito");
                      }
                      else
                      {
                        alertify.success("Lectura registrada con éxito");
                      }
                      
                      indicadorEditar = 0;
                      $("#idLecturaSeleccionado").val("");
                      $("#cantidadMetrosCubicos").val("");

                      actualizarTablaLecturas("Update",$('#tablaServicio tr').length,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan);

                  }
                  else
                  {
                    
                      alertify.error("Ha ocurrido un error al tratar de registrar la lectura, inténtelo de nuevo");

                  }

              },
              error: function(error)
              {

                  alertify.error("Error de conexión al tratar de registrar la lectura, inténtelo de nuevo");
              }
            });
        }

        function confirmarTransaccion(mensaje) {

           return confirm(mensaje);
        }

        function limpiarCamposForm(idForm){

          idForm.each (function(){
          
            this.reset();

          });
        }
  /*
  // Metodo encargado de actualizar la tabla de acuerdo a la acción que ejecute el usuario
  */
  function actualizarTablaLecturas(accionEjecutada,cantidadFilasTabla,idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan) {

   if (accionEjecutada == "Delete") {

    cantidadFilasTabla = cantidadFilasTabla - 2;
      
   }else if (accionEjecutada == "Update") {

    cantidadFilasTabla = cantidadFilasTabla - 1;
  
   }

   if ($("#paginacion").html().length > 0) {

    $("#paginacion").twbsPagination('destroy');
                
   }

   var busqueda = idFiltroBusqueda;

   if(cantidadFilasTabla == 0 && paginaActualGlb > 1){

      paginaActualGlb--;

   }

   crearListaPaginasPaginacion(direccionCantidadPaginas,direccionConsultaRegistros,paginaActualGlb,busqueda,idCuerpoTabla,colspan);

  }

  function ejecutarAccionSeleccionada(idFiltroBusqueda,direccionCantidadPaginas,direccionConsultaRegistros,idCuerpoTabla,colspan){

    $("#tablaServicio").on("change", ".form-control.acciones", function(e){

      var accion = $(this).val();

      if (accion == "Editar")
      {
        var idForm = $("#idRegistrarLecturaForm");
        var idLectura = $(this).attr("data-identificador");

        indicadorEditar = 1;
        idLecturaEditar = idLectura;

        $(this).parents("tr").find("td").each(function(index){

          if (index == 1) 
          {
            $("#cantidadMetrosCubicos").val($(this).html());
          }
        });

        $("#idLecturaSeleccionado").val(idLectura);

        $(this).closest('select').val("");
      }

    });
  }
</script>
</head>
<body>
<h4 class="text-center"><strong>Consultar información de lecturas</strong></h4>
<div class="container">
	<div id="verLecturas" class="container table-responsive" title="Lecturas">
    <form class="form-horizontal" action="" method="post" name="idRegistrarLecturaForm" id="idRegistrarLecturaForm">
        <input type="number" name="idServicioLec" id="idServicioLec" style="display: none;" data-idServicio="<?php echo $_POST['idServicio'];?>">
        <input type="number" name="idLecturaSeleccionado" id="idLecturaSeleccionado" style="display: none;">
        <div class="form-group">
            <label>Cliente</label>
            <input class="form-control" type="text" name="idClienteSLec" id="idClienteLec"  readonly="readonly" required/>
        </div>
        <div class="form-group">
                <label class="idLblnumNIS">Número de NIS</label>
                <input class="form-control" type="text" id="idnumNISLec" name="idnumNIS" maxlength="16" readonly="readonly" required/>
            </div>    
        <div class="form-group">
            <label class="lblCantidadMetrosCubicos">Cantidad Metros Cúbicos</label>
            <input type="decimal" id="cantidadMetrosCubicos" name="cantidadMetrosCubicos" class="form-control" required/>
        </div>
        <div>
        <input type="submit" class="btn btn-primary center-block" id="idBtnRegistrarLectura" value="Guardar"/>
        </div>
    </form>
        <div class="container table-responsive">
            <table id="tablaServicio" class="table table-striped table-condensed table-bordered table-hover">
                <thead>
                    <tr class="info">
                        <th>Acciones</th>
                        <th>Cantidad Metros Cúbicos</th>
                        <th>Fecha Ingreso</th>
                        <th>Fecha Modificación</th>
                    </tr>
                </thead>
                <tbody id="cuerpoTablaLectura"></tbody>
            </table>
        </div>
        <center>
        <ul id="paginacion" class="pagination"></ul>
        </center>
        <div class="container">
        <button class="btn btn-info pull-right" onclick="window.print();">Imprimir</button>
        </div>
</div>
</div>
</body>

<?php include COMPONENTS.'header.php';?>
    <script src="<?php print URL;?>public/js/registrarServicioOperaciones.js" type="text/javascript"></script>
</head>
<body>
<?php include COMPONENTS.'encabezado.php';?>
<h4 class="text-center"><strong>Registrar servicio</strong></h4>
<div class="container" style="margin-top:2%; width:30%;">
    <form class="form-horizontal" action="" method="post" name="RegistrarServicioForm" id="idRegistrarServicioForm">
        <div class="form-group">
        <label class="control-label">Cliente</label>
        <select id='cbCliente' name='cbCliente' class='form-control'>
        <?php foreach ($_POST['listaClientes'] as $cliente)
                    echo "<option value=".$cliente["id"].">".$cliente["nombre"]."</option>";
        ?>
        </select>
        </div>
        <div class="form-group">
            <label class="idLblnumNIS">Número de NIS</label>
            <input class="form-control" type="text" id="idnumNIS" name="idnumNIS" maxlength="16" 
            placeholder="Ingrese el Númro de NIS" required/>
            <div class="row" id="mensajeVerificacionNumNIS"></div>
        </div>
        <div class="form-group">
            <label>Tipo de Servicio</label>
            <select id="tipoServicio" name="tipoServicio" class="form-control" required>
                <option value="">Seleccionar</option>
                <option value="Domipre">Domipre</option>
                <option value="Endomipre">Endomipre</option>
            </select>
        </div>
        <div class="form-group">
            <label>Estado</label>
            <select id="cbEstado" name="cbEstado" class="form-control" required>
                <option value="">Seleccionar</option>
                <option value="Funcionando">Funcionando</option>
                <option value="Suspendido">Suspendido</option>
            </select>
        </div>
        <div>
            <input type="submit" class="btn btn-primary center-block" id="idBtnRegistrarCliente" value="Registrar"/>
        </div>
    </form>
</div>
<?php include COMPONENTS.'pie.php';?>
</body>
</html>
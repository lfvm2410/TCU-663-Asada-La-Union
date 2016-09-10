<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Servicio</title>
    <script src="../js/jquery-1.12.0.js" type="text/javascript"></script>
    <script src="../css/bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../js/alertify.js-0.3.11/lib/alertify.js"></script>
    <script src="../js/alertify.js-0.3.11/lib/alertify.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-3.3.6-dist/css/bootstrap.min.css">
    <link href="../js/alertify.js-0.3.11/themes/alertify.bootstrap.css" rel="stylesheet" />
    <link href="../js/alertify.js-0.3.11/themes/alertify.core.css" rel="stylesheet" />
    <link href="../js/alertify.js-0.3.11/themes/alertify.default.css" rel="stylesheet" />
    <script src="../js/registrarClienteOperaciones.js" type="text/javascript"></script>
</head>
<body>
<div class="container" style="margin-top:2%; width:30%;">
    <form class="form-horizontal" action="" method="post" name="registrarClienteForm" id="idRegistrarClienteForm">
        <div class="form-group">
            <label  id="idLblCedula" for="idCedulaCliente">Dígite el número de cédula:</label> 
            <input type="text" class="form-control" name="cedulaCliente" id="idCedulaCliente" maxlength="30" 
            placeholder="Ingrese la cédula del cliente" required/>
            <br/>
            <input type="button" class="btn btn-primary" id="idBtnBuscarCliente" value="Buscar Cliente"/>
        </div>
    </form>
</div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Cliente</title>
    <script src="../css/bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-3.3.6-dist/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="margin-top:2%; width:30%;">
  <form class="form-horizontal" action="" method="post" name="registrarClienteForm" id="idRegistrarClienteForm">
     <div class="form-group">
        <label  id="idLblCedCli" for="idCedulaCliente">Cédula:</label> 
        <input type="number" class="form-control" name="cedulaCliente" id="idCedulaCliente" maxlength="16" 
        placeholder="Ingrese la cédula del cliente" required/>
     </div>
     <div class="form-group">
        <label  id="idLblNomCli" for="idNombreCliente">Nombre:</label> 
        <input type="text" class="form-control" name="nombreCliente" id="idNombreCliente" maxlength="30" 
        placeholder="Ingrese el nombre del cliente" required/>
     </div>
     <div class="form-group">
        <label id="idLblApellidosCli" for="idApellidosCliente">Apellidos:</label>  
        <input type="text" class="form-control" name="apellidosCliente" id="idApellidosCliente" maxlength="30"
        placeholder="Ingrese los apellidos del cliente" required/>
     </div>
     <div class="form-group">
        <label id="idLblCorreoCli" for="idCorreoCliente">Correo electrónico:</label>  
        <input type="email" class="form-control" name="correoCliente" id="idCorreoCliente"
        pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$" maxlength="30" 
        placeholder="Ingrese el correo electrónico del cliente" required/> 
     </div>
     <div class="form-group">
        <label id="idLblDirCli" for="idDireccionCliente">Dirección:</label> 
        <textarea class="form-control" name="direccionCliente" rows="2" id="idDireccionCliente" maxlength="300" 
        placeholder="Ingrese la dirección del cliente" required></textarea>
     </div>
     <div class="form-group">
        <label id="idLblNumPlanoCli" for="idNumPlanoCliente">Número de plano:</label> 
        <input type="text" class="form-control" name="numPlanoCliente" id="idNumPlanoCliente" maxlength="16" 
        placeholder="Ingrese el número de plano de la propiedad del cliente" required/>
     </div>
     <div class="form-group">
        <input type="submit" class="btn btn-primary" id="idBtnRegistrarCliente" value="Registrar"/>
     </div>
 </form>
</div>
</body>
</html>
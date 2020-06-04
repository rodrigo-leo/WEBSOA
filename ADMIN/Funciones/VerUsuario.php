<?php
require_once("../../nusoap/lib/nusoap.php");
$serverURL = 'http://localhost/dashboard/itqNet/ADMIN/serverA.php';
$cliente = new nusoap_client("$serverURL?wsdl", 'wsdl');
$var = $_GET['id'];

$admin = $cliente->call(
    'detalleUser',
    array('id' => $var),
    "uri:$serverURL"
);
$res = json_decode($admin, true);

$id = $res[0];
$nombre = $res[1];
$correo = $res[2];
$pwd = $res[3];
$tel = $res[4];
$estado = $res[5];

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../../CSS/bootstrap.css">
<script src="../../JS/jquery.js"></script>
<script src="../../JS/bootstrap.js"></script>

<div class="container">
    <h1 class="text-center">Detalle de Usuario</h1>
    <div class="mr-auto ml-auto">
        <div class="card" style="">
            <div class="card-body">
                <fieldset>
                    <div class="form-group">
                        <div class="col-md-8">  
                            <label for="fID">ID:*</label>
                            <input type="text" name="fID" id="fID" placeholder="ID" class="form-control" disabled value='<?php echo $id; ?>'>
                        </div>
                        <div class="col-md-8">  
                            <label for="fNombre">Nombre del usuario:*</label>
                            <input type="text" name="fNombre" id="fNombre" placeholder="Nombre" class="form-control" require value='<?php echo $nombre; ?>'>
                        </div>
                        <div class="col-md-8">  
                            <label for="fNombre">Clave:*</label>
                            <input type="text" name="fNombre" id="fNombre" placeholder="Nombre" class="form-control" disabled value='<?php echo $pwd; ?>'>
                        </div>
                        <div class="col-md-8">  
                            <label for="fCorreo">Correo:*</label>
                            <input type="text" name="fCorreo" id="fCorreo" placeholder="Correo" class="form-control" require value='<?php echo $correo; ?>'>
                        </div>
                        <div class="col-md-8">  
                            <label for="fTel">Telefono:*</label>
                            <input type="text" name="fTel" id="fTel" placeholder="Telefono" class="form-control" require value='<?php echo $tel; ?>'>
                        </div>
                        <div class="col-md-8">  
                            <label for="fNombre">Estado:*</label>
                            <input type="text" name="fNombre" id="fNombre" placeholder="Nombre" class="form-control" require value='<?php echo $estado; ?>'>
                        </div>
                    </div>
                </fieldset>
            </div>
            <!--
            <div class="card-footer">
                <a href="#" class="btn btn-primary">Editar</a>
            </div>
            -->
        </div>
        <div>
            <br>
            <a href="../usuarios.php" class="btn btn-primary">Regresar</a>
        </div>
    </div>
</div>
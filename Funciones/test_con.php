<?php
/*
$to = "rodrigoiggtz@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: Jonathan <soa.itq@gmail.com>" . "\r\n" .
"CC: jonathancggs@gmail.com";

if(mail($to,$subject,$txt,$headers)){
    echo 'correo enviado';
}else{
    echo 'hubo un problema para enviar el correo';
}

<?php
require_once("../nusoap/lib/nusoap.php");

$serverURL = 'http://localhost/dashboard/itqNet/php/server2.php';
$cliente = new nusoap_client("$serverURL?wsdl", 'wsdl');

$servicios = $cliente->call(
    "listaServicios",
    array('servicio' => 'user'),
    "uri:$serverURL"
);
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../CSS/bootstrap.css">
<script src="../JS/jquery.js"></script>
<script src="../JS/bootstrap.js"></script>
<div class="container-fluid">
    <div class="text-center">
        <h2>Paquetes de internet</h2>
    </div>
    <br>
    <div>
        <div>
            <table class="table table-dark table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scooe="col">Nombre</th>
                        <th scooe="col">precio</th>
                        <th scooe="col">detalles</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                            $res = json_decode($servicios, true);
                            if (is_array($res) || is_object($res))
                            {
                                foreach($res as $valor){
                                    echo '<tr>';
                                    echo '<td>'.$valor['nombre'].'</td>';
                                    echo '<td>'.$valor['precio'].'</td>';
                                    echo '<td>'.$valor['descripción'].'</td>';
                                    echo '</tr>';
                                }

                            }
                        
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



*/
require_once("../nusoap/lib/nusoap.php");

$serverURL = 'http://localhost/dashboard/itqNet/php/server2.php';

$cliente = new nusoap_client("$serverURL?wsdl", 'wsdl');
$nombre_usuario = 'palomo';
    $admin = $cliente->call(
        'Admin',
        array('user' => $nombre_usuario),
        "uri:$serverURL"
    );
    echo '<br><br>'.$admin.' fin';
?>
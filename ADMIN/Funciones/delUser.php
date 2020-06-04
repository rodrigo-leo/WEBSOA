<?php
require_once("../../nusoap/lib/nusoap.php");
$serverURL = 'http://localhost/dashboard/itqNet/ADMIN/serverA.php';
$cliente = new nusoap_client("$serverURL?wsdl", 'wsdl');

$var = $_GET['id'];

$delUs = $cliente->call(
    'eliminarUser',
    array('id' => $var),
    "uri:$serverURL"
);

echo $delUs;

if($delUs == true){
    header('location: http://localhost/dashboard/itqNet/ADMIN/usuarios.php');
}else{
    echo 'Hubo un error al eliminar el usuario';
}
//del Use
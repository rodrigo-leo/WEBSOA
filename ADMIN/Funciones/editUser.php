<?php
require_once("../../nusoap/lib/nusoap.php");
$serverURL = 'http://localhost/dashboard/itqNet/ADMIN/serverA.php';
$cliente = new nusoap_client("$serverURL?wsdl", 'wsdl');

$id = $_GET['id'];
$nombre = $_GET['nombre'];
$clave = $_GET['clave'];
$correo = $_GET['correo'];
$telefono = $_GET['telefono'];
$estado = $_GET['estado'];

$ediUs = $cliente->call(
    'editarUser',
    array(
        'id' => $id,
        'nombre' => $nombre,
        'clave' => $clave,
        'correo' => $correo,
        'telefono' => $telefono,
        'estado' => $estado),
    "uri:$serverURL"
);

if($ediUs == true){
    header('location: http://localhost/dashboard/itqNet/ADMIN/usuarios.php');
}else{
    echo 'Hubo un error al editar el usuario';
}

?>
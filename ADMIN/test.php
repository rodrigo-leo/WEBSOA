<?php
require_once("../nusoap/lib/nusoap.php");

$serverURL = 'http://localhost/dashboard/itqNet/ADMIN/serverA.php';

$cliente = new nusoap_client("$serverURL?wsdl", 'wsdl');

//$nombre_usuario = 'palomo';
    $admin = $cliente->call(
        'listaUsers',
        array('user' => 'admin'),
        "uri:$serverURL"
    );
    $res = json_decode($admin, true);
    foreach($res as $val){
        print_r($val);
    }
    //echo '<br><br>'.$res;
?>
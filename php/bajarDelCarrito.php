<?php
    require_once("../nusoap/lib/nusoap.php");
    $serverURL = 'http://localhost/dashboard/itqNet/php/server2.php';
    $cliente = new nusoap_client("$serverURL?wsdl", 'wsdl');
    
    $id_User=$_GET['id_User'];
    $id_Servicio=$_GET['id_Servicio'];
    
    $bajarServicio = $cliente->call(
        'bajarServicio',
        array('id_User' => $id_User, 'id_Servicio' => $id_Servicio),
        "uri:$serverURL"
    );
    //echo $cliente;
    switch($bajarServicio){
        case 1:
            header("location: http://localhost/dashboard/itqNet/html/miCarrito.php?id_User=$id_User");
        break;
        case -1:
            echo "El servicio ya se encuentra dado de baja";
        break;
        default:
        echo "no se puede realizar la acción solicitada en este momento";
    }

?>
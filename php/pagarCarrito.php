<?php
    require_once("../nusoap/lib/nusoap.php");
    $serverURL = 'http://localhost/dashboard/itqNet/php/server2.php';
    $cliente = new nusoap_client("$serverURL?wsdl", 'wsdl');
    
    $id_User=$_GET['id_User'];
    $id_Servicio=$_GET['id_Servicio'];

    $comprarCarrito = $cliente->call(
        'comprarCarrito',
        array('id_User' => $id_User, 'id_Servicio' => $id_Servicio),
        "uri:$serverURL"
    );

    switch($comprarCarrito){
        case 1:
            echo "compra realizada";
            header("location: http://localhost/dashboard/itqNet/html/Inicio.php?id_User=$id_User");
        break;
        case -1:
            echo "El carrito se encuentra vacio";
        break;
        default:
            echo "error al tratar de realizar la solicitud";
    }

    ?>
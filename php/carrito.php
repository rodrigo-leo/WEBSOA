<?php
    require_once("../nusoap/lib/nusoap.php");
    $serverURL = 'http://localhost/dashboard/itqNet/php/server2.php';
    $cliente = new nusoap_client("$serverURL?wsdl", 'wsdl');
    $estadoSolicitud = true;

    $id_User=$_GET['id_User'];
    $id_Servicio=$_GET['id_Servicio'];

    //id_user
    $estado_Id_User= $cliente->call(
        "comprobar_Vacio",
        array('entrada' => $id_User),
        "uri:$serverURL"
    );
    if($estado_Id_User == true){
        $GLOBALS['estadoSolicitud'] = false;
        echo "<br>EL id de usaurio se encuentra vacío";
    }

    $estado_Id_User = $cliente->call(
        'comprobar_Numero_Existente',
        array('entrada' => $id_User),
        "uri:$serverURL"
    );
    if($estado_Id_User == false){
        $GLOBALS['estadoSolicitud'] = false;
        echo '<br>Compruebe el número del codigo contenga solo digitos';
    }

    //id_servicio
    $estado_Id_Servicio= $cliente->call(
        "comprobar_Vacio",
        array('entrada' => $id_Servicio),
        "uri:$serverURL"
    );
    if($estado_Id_Servicio == true){
        $GLOBALS['estadoSolicitud'] = false;
        echo "<br>EL id del servicio encuentra vacío";
    }

    $estado_Id_Servicio = $cliente->call(
        'comprobar_Numero_Existente',
        array('entrada' => $id_Servicio),
        "uri:$serverURL"
    );
    if($estado_Id_Servicio == false){
        $GLOBALS['estadoSolicitud'] = false;
        echo '<br>Compruebe el número del codigo contenga solo digitos';
    }

    if($estadoSolicitud==true && $id_User > 0 && $id_Servicio >0){
        $agregarServicio = $cliente->call(
            'agregarServicioCarrito',
            array('user_id' => $id_User, 'servicio_id' => $id_Servicio),
            "uri:$serverURL"
        );
        switch($agregarServicio){
            case 2:
                echo "El nuevo servicio ha sido dado de alta en el carrito";
            break;
            case 1:
                echo "El servicio ha sido registrado en el carrito de nuevo";
                header("location: http://localhost/dashboard/itqNet/html/Inicio.php?id_User=$id_User");
            break;
            case -1:
                echo "El servicio ya se encuentra en el carrito";
            break;
            default:
                echo "No se puede realizar la operación en este momento";
        }
    }
    
?>
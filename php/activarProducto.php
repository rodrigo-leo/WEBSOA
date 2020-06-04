<?php
    require_once("../nusoap/lib/nusoap.php");

    $serverURL = 'http://localhost/dashboard/itqNet/php/server2.php';
    $cliente = new nusoap_client("$serverURL?wsdl", 'wsdl');
    $estado_Peticion = true;

    $codigo = htmlentities($_POST['codigo']);

    static $longitud_codigo = 6;
    Static $estado_Producto = "no disponible";

    //codigo 
    $estado_Codigo = $cliente->call(
        "comprobar_Vacio",
        array('entrada' => $codigo),
        "uri:$serverURL"
    );
    if($estado_Codigo == true){
        $GLOBALS['estado_Peticion'] = false;
        echo "<br>El codigo del producto no puede estar vacio";
    }

    $estado_Codigo = $cliente->call(
        "comprobar_Intervalo_De_Longitud",
        array('entrada' => $codigo, 'longitud_min' => $longitud_codigo, 'longitud_max' => $longitud_codigo),
        "uri:$serverURL"
    );
    if($estado_Codigo == false){
        $GLOBALS['estado_Peticion'] = false;
        echo "<br>El codigo consta de 6 digitos";
    }

    $estado_Codigo = $cliente->call(
        'comprobar_Numero_Existente',
        array('entrada' => $codigo),
        "uri:$serverURL"
    );
    if($estado_Codigo == false){
        $GLOBALS['estado_Peticion'] = false;
        echo '<br>Compruebe el número del codigo contenga solo digitos';
    }
    
    if($estado_Peticion){
        $producto_No_Disponible = $cliente->call(
            'activarServicio',
            array('codigo' => $codigo),
            "uri:$serverURL"
        );
        switch($producto_No_Disponible){
            case 1:
                echo"El articulo $codigo ha sido activado en inventario";
            break;
            case -1:
                echo"El articulo $codigo  ya se encontraba Activado del inventario";
            break;
            case -2:
                echo "El articulo $codigo no se encuentra en el inventario";
            break;
            default:
                echo"NO se puede realizar la accion solicitada";
        }
    }
?>
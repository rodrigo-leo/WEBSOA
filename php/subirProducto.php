<?php
    require_once("../nusoap/lib/nusoap.php");

    $serverURL = 'http://localhost/dashboard/itqNet/php/server2.php';
    $cliente = new nusoap_client("$serverURL?wsdl", 'wsdl');
    $estado_Peticion = true;

    $codigo = htmlentities($_POST['codigo']);
    $nombre = htmlentities($_POST['producto']);
    $precio = htmlentities($_POST['precio']);

    static $longitud_Codigo = 6;
    static $longitud_Min_Nombre = 1;
    static $longitud_Max_Nombre = 50;
    static $longitud_Min_Precio = 1;
    static $longitud_Max_Precio = 12;
    Static $estado_Producto = "disponible";

    //codigo del producto
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
        array('entrada' => $codigo, 'longitud_min' => $longitud_Codigo, 'longitud_max' => $longitud_Codigo),
        "uri:$serverURL"
    );
    if($estado_Codigo == false){
        $GLOBALS['estado_Peticion'] = false;
        echo "<br>El codigo $codigo consta de 6 digitos";
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

    //nombre del producto
    $estado_Nombre = $cliente->call(
        "comprobar_Vacio",
        array('entrada' => $nombre),
        "uri:$serverURL"
    );
    if($estado_Nombre == true){
        $GLOBALS['estado_Peticion'] = false;
        echo "<br>El nombre del producto no puede estar vacio";
    }

    $estado_Nombre = $cliente->call(
        "comprobar_Intervalo_De_Longitud",
        array('entrada' => $nombre, 'longitud_min' => $longitud_Min_Nombre, 'longitud_max' => $longitud_Max_Nombre),
        "uri:$serverURL"
    );
    if($estado_Nombre == false){
        $GLOBALS['estado_Peticion'] = false;
        echo "<br>El nombre $nombre debe contener $longitud_Min_Nombre y $longitud_Max_Nombre caracteres";
    }

    //precio del producto
    $estado_Precio = $cliente->call(
        "comprobar_Vacio",
        array('entrada' => $precio),
        "uri:$serverURL"
    );
    if($estado_Precio == true){
        $GLOBALS['estado_Peticion'] = false;
        echo "<br>El precio del producto no puede estar vacio";
    }

    $estado_Precio = $cliente->call(
        "comprobar_Intervalo_De_Longitud",
        array('entrada' => $precio, 'longitud_min' => $longitud_Min_Precio, 'longitud_max' => $longitud_Max_Precio),
        "uri:$serverURL"
    );
    if($estado_Nombre == false){
        $GLOBALS['estado_Peticion'] = false;
        echo "<br>el precio del producto es incorrecto";
    }

    $estado_Precio = $cliente->call(
        'comprobar_Numero_Existente',
        array('entrada' => $precio),
        "uri:$serverURL"
    );
    if($estado_Precio == false){
        $GLOBALS['estado_Peticion'] = false;
        echo '<br>Compruebe el precio del producto contenga solo digitos';
    }

    if($estado_Peticion){
        $producto_Abilitado = $cliente->call(
            'habilitar_Producto',
            array('codigo' => $codigo,'nombre' => $nombre,'precio' => $precio),
            "uri:$serverURL"
        );
        //echo $cliente;
        switch($producto_Abilitado){
            case 1:
                echo 'Se actualizo el estado del producto a disponible';
            break;
            case 2:
                echo 'Se ha creado el producto en el inventario';
            break;
            case -1:
                echo 'El producto ya se encuentra dado de alta';
            break;
            case -2:
                echo 'el producto existe en el registro, pero no puede ser dado';
            break;
            default:
                echo 'No se pudo realizar el registro del producto';
        }
    }
?>
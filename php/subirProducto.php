<?php
    require_once("../nusoap/lib/nusoap.php");

    $serverURL = 'http://localhost/dashboard/itqNet/php/server2.php';
    $cliente = new nusoap_client("$serverURL?wsdl", 'wsdl');
    $estado_Peticion = true;

    $codigo = htmlentities($_POST['codigo']);
    $nombre = htmlentities($_POST['producto']);
    $precio = htmlentities($_POST['precio']);
    $detalles = htmlentities($_POST['detalles']);
    $nombre_img = $_FILES['imagen']['name'];
    $tipo = $_FILES['imagen']['type'];
    $tamano = $_FILES['imagen']['size'];


    static $longitud_Codigo = 6;
    static $longitud_Min_Nombre = 1;
    static $longitud_Max_Nombre = 50;
    static $longitud_Min_Precio = 1;
    static $longitud_Max_Precio = 12;
    Static $estado_Producto = "disponible";
    Static $tamaño_Max_Imagen = 10;//10MB

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

    $estado_Precio = $cliente->call(
        "comprobar_Intervalo_De_Valor",
        array('entrada' => $precio, 'longitud_min' => 1, 'longitud_max' => 10000),
        "uri:$serverURL"
    );
    if($estado_Precio == false){
        $GLOBALS['estado_Peticion'] = false;
        echo "<br>El precio de ".$precio." No puede ser registrado al servicio que solicita";
    }
    //detalles del producto
    $estado_detalles = $cliente->call(
        "comprobar_Vacio",
        array('entrada' => $detalles),
        "uri:$serverURL"
    );
    if($estado_detalles == true){
        $GLOBALS['estado_Peticion'] = false;
        echo "<br>La sección de detalles no puede estar vacio";
    }

    //imagen
    $estado_imagen = $cliente->call(
        "comprobar_Vacio",
        array('entrada' => $nombre_img),
        "uri:$serverURL"
    );
    if($estado_imagen == true){
        $GLOBALS['estado_Peticion'] = false;
        echo "<br>El nombre de la imagen no puede estar en blanco";
    }

    $estado_imagen = $cliente->call(
        "validar_Extencion_Imagen",
        array('entrada' => $tipo),
        "uri:$serverURL"
    );
    if($estado_imagen == false){
        $GLOBALS['estado_Peticion'] = false;
        echo "<br>El formato de la imagen ".$tipo." no es compatible";
    }

    $estado_imagen = $cliente->call(
        "comprobar_Intervalo_De_Valor",
        array('entrada' => $tamano, 'longitud_min' => 100, 'longitud_max' => ($tamaño_Max_Imagen*8*1024*1024)),
        "uri:$serverURL"
    );
    if($estado_imagen == false){
        $GLOBALS['estado_Peticion'] = false;
        echo "<br>La imagen ocupa".($tamano/(8*1024*1024))."MB, supera los ".$tamaño_Max_Imagen."MB establecidos";
    }

    if($estado_Peticion){
        $producto_Abilitado = $cliente->call(
            'habilitar_Producto',
            array('codigo' => $codigo,'nombre' => $nombre,'precio' => $precio, 'detalles' => $detalles, ),
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
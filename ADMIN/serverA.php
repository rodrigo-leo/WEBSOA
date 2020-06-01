<?php
    require_once("../nusoap/lib/nusoap.php"); //path soap

    $miURL = 'http://localhost/dashboard/itqNet/ADMIN/serverA.php';
    $server = new soap_server();
    $server->configureWSDL("WSDLTST", $miURL);
    $server->wsdl->schemaTargetNamespace=$miURL;

    //BD
    $usuario = "root";
    $contraseña = "";
    $servidor = "localhost";
    $basededatos = "servicios";
    $tabla_Clientes = "cliente"; 
    $tabla_Servicios = "servicio";
    $tabla_Carrito = "carrito";

    /**
     * SERVICIO: otener todos los usuarios
     */
    $server->register(
        'listaUsers',
        array('user' => 'xsd:string'),
        array('return' => 'xsd:string'),
        $miURL
    );
    function listaUsers(){
        $link=mysqli_connect($GLOBALS['servidor'], $GLOBALS['usuario'], $GLOBALS['contraseña']);
        mysqli_select_db($link,$GLOBALS['basededatos']);
        $comprobar_user = "select * from cliente";//comprobar que el nombre se usario no este registrado
        $registro = mysqli_query($link, $comprobar_user);
        $varRow = mysqli_fetch_array($registro);
        $rows = array();

        while($r = mysqli_fetch_assoc($registro)) {
            $rows[] = $r;
        }
        $res = json_encode($rows);
        return new soapval('return', 'xsd:string',$res);
        /*
        if(is_array($varRow)){
            return new soapval('return', 'xsd:string',$res);
        }else{
            $res = 'sin registros';
            return new soapval('return', 'xsd:string',$varRow);
        }
        */
    }

    if(!isset($HTTP_RAW_POST_DATA)){
        $HTTP_RAW_POST_DATA = file_get_contents('php://input');
    }

    $server->service($HTTP_RAW_POST_DATA);
 ?>
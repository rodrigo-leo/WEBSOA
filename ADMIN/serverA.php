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

    /**
     * SERVICIO: Detalle de usuario
     * parametro: Id del cliente
     * tabla a consultar -> cliente
     */
    $server->register(
        'detalleUser',
        array('id' => 'xsd:string'),
        array('return' => 'xsd:string'),
        $miURL
    );
    function detalleUser($id){
        $link=mysqli_connect($GLOBALS['servidor'], $GLOBALS['usuario'], $GLOBALS['contraseña']);
        mysqli_select_db($link,$GLOBALS['basededatos']);
        $num = (int) $id;
        $comprobar_Servicio =  "select * from cliente where id_Cliente = $id";
        $registro = mysqli_query($link, $comprobar_Servicio);
        $varRow = mysqli_fetch_array($registro);
        if(is_array($varRow)){
            $res = json_encode($varRow);
            return new soapval('return', 'xsd:string',$res);
        }else{
            return new soapval('return', 'xsd:string','sin datos');
        }
        mysqli_Close($link);
    }

    /**
     * SERVICIO: editar usuario
     * parametros: todos los datos del usuario
     */
    $server->register(
        'editarUser',
        array(
            'id' => 'xsd:string',
            'nombre' => 'xsd:string',
            'clave' => 'xsd:string',
            'correo' => 'xsd:string',
            'telefono' => 'xsd:string',
            'estado' => 'xsd:string'),
        array('return' => 'xsd:boolean'),
        $miURL
    );
    function editarUser($id, $nombre, $clave, $correo, $telefono, $estado){
        $link=mysqli_connect($GLOBALS['servidor'], $GLOBALS['usuario'], $GLOBALS['contraseña']);
        mysqli_select_db($link,$GLOBALS['basededatos']);
        $num = (int) $id;
        $tel = (int) $telefono;
        $editUser = "UPDATE cliente 
                        SET nombre = '$nombre', clave = '$clave', correo = '$correo', numero_Tel = '$tel', estado = '$estado'
                     WHERE id_Cliente = $id";
        $registro = mysqli_query($link,$editUser);
        if($registro){
            return new soapval('return', 'xsd:boolean', true);
        }else{
            return new soapval('return', 'xsd:boolean', false);
        }
        mysqli_Close($link);
    }

    /**
     * SERVICIO: Eliminar usuario
     * parametro: id
     */
    $server->register(
        'eliminarUser',
        array('id' => 'xsd:string'),
        array('return' => 'xsd:boolean'),
        $miURL
    );
    function eliminarUser($id){
        $link=mysqli_connect($GLOBALS['servidor'], $GLOBALS['usuario'], $GLOBALS['contraseña']);
        mysqli_select_db($link,$GLOBALS['basededatos']);
        $num = (int) $id;
        $delUser = "DELETE FROM cliente WHERE id_Cliente = $num";
        $registro = mysqli_query($link,$delUser);
        if($registro){
            return new soapval('return', 'xsd:boolean', true);
        }else{
            return new soapval('return', 'xsd:boolean', false);
        }
        mysqli_Close($link);
    }

    if(!isset($HTTP_RAW_POST_DATA)){
        $HTTP_RAW_POST_DATA = file_get_contents('php://input');
    }

    $server->service($HTTP_RAW_POST_DATA);
 ?>
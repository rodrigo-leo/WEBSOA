<?php
require_once("../nusoap/lib/nusoap.php"); //path soap

 $miURL = 'http://localhost/dashboard/itqNet/php/server2.php';
 $server = new soap_server();
 $server->configureWSDL("WSDLTST", $miURL);
 $server->wsdl->schemaTargetNamespace=$miURL;

 //direcciones
 $ruta_Indexphp = 'C:/xampp/htdocs/dashboard/itqNet';


//BD
$usuario = "root";
$contraseña = "";
$servidor = "localhost";
$basededatos = "servicios";
$tabla_Clientes = "cliente"; 
$tabla_Servicios = "servicio";
$tabla_Carrito = "carrito";

//services
/*
    comentario bloque PHP
    <!-- comentario en HTML  -->
*/

/*comprobar_Longitud_Mayor_Igual
    parametros: string,int,int 
    return: boolean
    funcion: retorna si aceptable si la palabra evaluada es mayor o igual a digitos
*/
$server->register('comprobar_Intervalo_De_Longitud',//comprueba que un string sea mayor o igual a una longitud dada
array('entrada' => 'xsd:string', 'longitud_min' => 'xsd:int', 'longitud_max' => 'xsd:int'),//string,longitud del string
array('return' => 'xsd:boolean'),//parametros de salida
$miURL);

function comprobar_Intervalo_De_Longitud($entrada,$longitud_min,$longitud_max){
    $long_Palabra = strlen($entrada);
    if($long_Palabra >= $longitud_min and $long_Palabra <= $longitud_max)
        return new soapval('return','xsd:boolean',true);
    else
        return new soapval('return','xsd:boolean',false);
}

$server->register('comprobar_Intervalo_De_Valor',//comprueba que un string sea mayor o igual a una longitud dada
array('entrada' => 'xsd:int', 'longitud_min' => 'xsd:int', 'longitud_max' => 'xsd:int'),//string,longitud del string
array('return' => 'xsd:boolean'),//parametros de salida
$miURL);

function comprobar_Intervalo_De_Valor($entrada,$longitud_min,$longitud_max){
    if($entrada >= $longitud_min and $entrada <= $longitud_max)
        return new soapval('return','xsd:boolean',true);
    else
        return new soapval('return','xsd:boolean',false);
}

/*
comprobar_Palabras_Identicas
    parametros: string, string
    return: boolean
    funcion: compara dos strings y valida si son identicos*/

$server->register('comprobar_Palabras_Identicas',//comprueba que dos strings dados sean iguales
    array('password1' => 'xsd:string','password2' => 'sxd:string'),
    array('return' => 'xsd:boolean'),
    $miURL);

function comprobar_Palabras_Identicas($palabra1,$palabra2){
    if($palabra1===$palabra2)
        return new soapval('return','xsd:boolean',true);
    else
        return new soapval('return','xsd:boolean',false);
}

/*comprobar_Integridad_Correo
    parametros: string
    return: boolean
    funcion: comprueba que el correo contenga todas los componentes necesarios de un correo
*/
$server->register('comprobar_Integridad_Correo',//comprueba que el correo contenga todas los componentes necesarios de un correo
    array('correo' => 'xsd:string'),
    array('return' => 'xsd:boolean'),
    $miURL);
    
function comprobar_Integridad_Correo($correo){
    $sintaxis ='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
    if(preg_match($sintaxis,$correo))
        return new soapval('return','xsd:boolean',true);
    else
        return new soapval('return','xsd:boolean',false);
}

/*comprobar_Numero_Existente
    parametros: string
    return: boolean
    funcion: comprueba que la entrada contenga solo numeros
*/
$server->register('comprobar_Numero_Existente',
    array('entrada' => 'xsd:string'),
    array('return' => 'xsd:boolean'),
    $miURL);

function comprobar_Numero_Existente($entrada){
    $longitud_numero = strlen($entrada);
    $sintaxis ='#^([0-9]{'.$longitud_numero.'})$#';
    if(preg_match($sintaxis,$entrada))
        return new soapval('return','xsd:boolean',true);
    else
        return new soapval('return','xsd:boolean',false);
}

/*Comprobar_Un_Numero
    parametros: String
    Return: boolean
    Funcion: valida que la entrada contenga almenos un digito en ella
*/
$server->register('comprobar_Un_Numero',
    array('entrada' => 'xsd:string'),
    array('return' => 'xsd:boolean'),
    $miURL);

function comprobar_Un_Numero($entrada){
    $sintaxis = '#[0-9]#';
    if (preg_match($sintaxis,$entrada))
        return new soapval('return','xsd:boolean',true);
    else
        return new soapval('return','xsd:boolean',false);
}
/*comprobar_Alfanumerico_Minusculas
    parametros: string
    return: boolean
    funcion: comprueba que la entrada contenga almenos una letra minuscula
*/
$server->register('comprobar_Alfanumerico_Minusculas',//comprueba que la en trada contenga letras
    array('entrada' => 'xsd:string'),
    array('return' => 'xsd:boolean'),
    $miURL);

function comprobar_Alfanumerico_Minusculas($entrada){
    $sintaxis = '#[a-z]#';
    if(preg_match($sintaxis,$entrada))
        return new soapval('return','xsd:boolean',true);
    else
        return new soapval('return','xsd:boolean',false);
}

/*comprobar_Alfanumerico_Mayusculas
    parametros: string
    return: boolean
    funcion: comprueba que la entrada contenga almenos una letra minuscula
*/
$server->register('comprobar_Alfanumerico_Mayusculas',//comprueba que la en trada contenga letras
    array('entrada' => 'xsd:string'),
    array('return' => 'xsd:boolean'),
    $miURL);

function comprobar_Alfanumerico_Mayusculas($entrada){
    $sintaxis = '#[A-Z]#';
    if(preg_match($sintaxis,$entrada))
        return new soapval('return','xsd:boolean',true);
    else
        return new soapval('return','xsd:boolean',false);
}

/*comprobar_Caracter_Especial
    parametros: string
    return: boolean
    function: comprueba que la entrada contenga un caracter espececial
*/
$server->register('comprobar_Caracter_Especial',
    array('entrada' => 'xsd:string'),
    array('return' => 'xsd:boolean'),
    $miURL
);
function comprobar_Caracter_Especial($entrada){
    $sintaxis = '#[^a-zA-Z0-9]#';
    if(preg_match($sintaxis,$entrada))
        return new soapval('return','xsd:boolean',true);
    else
        return new soapval('return','xsd:boolean',false);
}

/*comprobar_Vacio
    parametros: string
    return: boolean
*/
$server->register('comprobar_Vacio',
    array('entrada' => 'xsd:string'),
    array('return' => 'xsd:boolean'),
    $miURL
);
function comprobar_Vacio($entrada){
    $sintaxis ='[:space:]';
    if(preg_match($sintaxis,$entrada))
        return new soapval('return','xsd:boolean',true);
    else
        return new soapval('return','xsd:boolean',false);
}

/*validar_Extencion_Imagen
parametros: string
return: boolean
*/
$server->register('validar_Extencion_Imagen',
    array('entrada' => 'xsd:string'),
    array('return' => 'xsd:boolean'),
    $miURL
);
function validar_Extencion_Imagen($entrada){
    if( $entrada === "image/jpg"
    ||  $entrada === "image/png"
    ||  $entrada === "image/jpeg"
    ||  $entrada === $entrada
    ||  $entrada === "image/gif")
        return new soapval('return','xsd:boolean',true);
    else
        return new soapval('return','xsd:boolean',false);
}


$server->register('registrar_Cliente',
    array('nombre' => 'xsd:string', 'correo'=> 'xsd:string', 'clave'=> 'xsd:string', 'numero_Tel' => 'xsd:string'),
    array('return' => 'xsd:int'),
    $miURL
);
function registrar_Cliente($nombre,$correo,$clave,$numero_Tel){
    $estado_registro = 0;
    $link=mysqli_connect($GLOBALS['servidor'], $GLOBALS['usuario'], $GLOBALS['contraseña']);
    mysqli_select_db($link,$GLOBALS['basededatos']);
    $comprobar_Cliente = "select nombre from cliente where nombre = '$nombre'";//comprobar que el nombre se usario no este registrado
    $registro = mysqli_query($link,$comprobar_Cliente);
    $varRow = mysqli_fetch_array($registro);
    if(is_array($varRow)){
        if($varRow[0] == $nombre){
            $estado_registro = -1;
            return new soapval('return', 'xsd:int',$estado_registro);
        }
    }
    $comprobar_Cliente = "select correo from cliente where correo = '$correo'";//comprobar que el correo no este registrado 
    $registro = mysqli_query($link,$comprobar_Cliente);
    $varRow = mysqli_fetch_array($registro);
    if(is_array($varRow)){
        if($varRow[0] == $correo){
            $estado_registro = -2;
            return new soapval('return', 'xsd:int',$estado_registro);
        }
    }
    $cliente_Datos_Insertar = "insert into ".$GLOBALS['tabla_Clientes']." values ('0','$nombre','$correo','$clave','$numero_Tel','disponible')";
    if($registro = mysqli_query($link,$cliente_Datos_Insertar)){
        $estado_registro = 1;
        return new soapval('return', 'xsd:int',$estado_registro);
    }
    mysqli_Close($link);
    return new soapval('return', 'xsd:int',$estado_registro);
}

$server->register('habilitar_Producto',
    array('codigo' => 'xsd:int', 'nombre' => 'xsd:string', 'precio' => 'xsd:string', 'detalles' => 'xsd:string', 'imagen_Dir' => 'xsd:string'),
    array('return' => 'xsd:int'),
    $miURL);

function habilitar_Producto($codigo,$nombre,$precio,$detalles,$imagen_Dir){
    $estado_registro = 0;
    $link=mysqli_connect($GLOBALS['servidor'], $GLOBALS['usuario'], $GLOBALS['contraseña']);
    mysqli_select_db($link,$GLOBALS['basededatos']);
    $confirmar_Existencias = "select codigo from servicio where codigo = '$codigo'";
    $registro = mysqli_query($link,$confirmar_Existencias);
    $varRow = mysqli_fetch_array($registro);
    if(is_array($varRow)){
        foreach($varRow as $codigo_Valor){
            if($codigo_Valor == $codigo){
                $habilitar_Producto = "SELECT estado FROM servicio WHERE codigo = '$codigo'";
                $confirmar_Estado = mysqli_query($link,$habilitar_Producto);
                $varRow = mysqli_fetch_array($confirmar_Estado);
                if($varRow[0] == 'no disponible'){
                    $habilitar_Producto = "UPDATE servicio SET estado = 'disponible' WHERE codigo = '$codigo'";
                    $registro = mysqli_query($link,$habilitar_Producto);
                    if($registro){
                        $estado_registro = 1;
                        return new soapval('return', 'xsd:int',$estado_registro);
                    }
                }
                elseif($varRow[0] =='disponible'){
                    $estado_registro = -1;
                    return new soapval('return', 'xsd:int',$estado_registro);
                }
                else{
                    $estado_registro = -2;
                    return new soapval('return', 'xsd:int',$estado_registro);
                }
            }
        }
    }
    $cliente_Datos_Insertar = "INSERT into ".$GLOBALS['tabla_Servicios']." values ('0','$codigo','$nombre','$precio','disponible','$detalles','$imagen_Dir')";
    if(mysqli_query($link,$cliente_Datos_Insertar)){
        $estado_registro = 2;
        return new soapval('return', 'xsd:int',$estado_registro);
    }
    mysqli_Close($link);
    return new soapval('return', 'xsd:int',$estado_registro);
}

$server->register('loging_Cliente',
    array('nombre' => 'xsd:string', 'clave' => 'xsd:string'),
    array('return' => 'xsd:int'),
    $miURL
);
function loging_Cliente($nombre,$clave){
    $estado_loging = 0;
    $link=mysqli_connect($GLOBALS['servidor'], $GLOBALS['usuario'], $GLOBALS['contraseña']);
    mysqli_select_db($link,$GLOBALS['basededatos']);
    $lista_Clientes = "select nombre from cliente where nombre = '$nombre'";
    $registro = mysqli_query($link,$lista_Clientes);
    $varRow = mysqli_fetch_array($registro);
    if(is_array($varRow)){
        if($varRow[0]==$nombre){
            $lista_Clientes = "SELECT clave FROM cliente WHERE nombre = '$nombre'";
            $registro = mysqli_query($link,$lista_Clientes);
            $varRow = mysqli_fetch_array($registro);
            if($varRow[0] == $clave){
                $estado_loging = 1;
                return new soapval('return', 'xsd:int',$estado_loging);
            }
            else{
                $estado_loging = -1;
                return new soapval('return', 'xsd:int',$estado_loging);
            }
            
        }
    }
    else{
        $estado_loging = -2;
        return new soapval('return', 'xsd:int',$estado_loging);
    }
    mysqli_Close($link);
    return new soapval('return', 'xsd:int',$estado_loging);
}

$server->register('eliminar_Producto',
    array('codigo' => 'xsd:string'),
    array('return' => 'xsd:int'),
    $miURL
);

function eliminar_Producto($codigo){
    $estado_peticion = -2;
    $link=mysqli_connect($GLOBALS['servidor'], $GLOBALS['usuario'], $GLOBALS['contraseña']);
    mysqli_select_db($link,$GLOBALS['basededatos']);
    $confirmar_Existencias = "select codigo from ".$GLOBALS['tabla_Servicios']." where codigo = '$codigo'";
    $registro = mysqli_query($link,$confirmar_Existencias);
    $varRow = mysqli_fetch_array($registro);
    if(is_array($varRow)){
        foreach($varRow as $codigo_Valor){
            if($codigo_Valor == $codigo){
                $desabilitar_Producto = "SELECT estado FROM ".$GLOBALS['tabla_Servicios']." WHERE codigo = '$codigo'";
                $confirmar_Estado = mysqli_query($link,$desabilitar_Producto);
                $varRow = mysqli_fetch_array($confirmar_Estado);
                if($varRow[0] == 'no disponible'){
                    $estado_registro = -1;
                    return new soapval('return', 'xsd:int',$estado_registro);
                }
                elseif($varRow[0] =='disponible'){

                    $desabilitar_Producto = "UPDATE ".$GLOBALS['tabla_Servicios']." SET estado = 'no disponible' WHERE codigo = '$codigo'";
                    $registro = mysqli_query($link,$desabilitar_Producto);
                    if($registro){
                        $estado_registro = 1;
                        return new soapval('return', 'xsd:int',$estado_registro);
                    }
                }
                else{
                    $estado_registro = 0;
                    return new soapval('return', 'xsd:int',$estado_registro);
                }
            }
        }
    }
    mysqli_Close($link);
    return new soapval('return', 'xsd:int',$estado_peticion);
}

/**
 * SERVICIO: otener todos los servicios disponibles
 */
$server->register(
    'listaServicios',
    array('user' => 'xsd:string'),
    array('return' => 'xsd:string'),
    $miURL
);
function listaServicios($user){
    $link=mysqli_connect($GLOBALS['servidor'], $GLOBALS['usuario'], $GLOBALS['contraseña']);
    mysqli_select_db($link,$GLOBALS['basededatos']);
    $comprobar_Servicio =  "select * from servicio where estado = 'disponible' ";
    $registro = mysqli_query($link, $comprobar_Servicio);
    $rows = array();
    while($r = mysqli_fetch_assoc($registro)) {
        $rows[] = $r;
    }
    $res = json_encode($rows);
    mysqli_Close($link);
    return new soapval('return', 'xsd:string',$res);
}

/**
 * SERVICIO: verificar usuario
 * parametros: user
 * respuesta: true / false
 */
$server->register(
    'validarUser',
    array('nombre' => 'xsd:string'),
    array('return' => 'xsd:boolean'),
    $miURL
);
function validarUser($nombre){
    $link=mysqli_connect($GLOBALS['servidor'], $GLOBALS['usuario'], $GLOBALS['contraseña']);
    mysqli_select_db($link,$GLOBALS['basededatos']);
    $comprobar_Cliente = "select nombre from cliente where nombre = '$nombre'";//comprobar que el nombre se usario no este registrado
    $registro = mysqli_query($link,$comprobar_Cliente);
    $varRow = mysqli_fetch_array($registro);
    if(is_array($varRow)){
        if($varRow[0] == $nombre){
            return new soapval('return', 'xsd:boolean',true);
        }else{
            return new soapval('return', 'xsd:boolean',false);
        }
    }
}

/**
 * SERVICIO: verificar correo
 * parametros: correo
 * respuesta: true / false
 */
$server->register(
    'validarCorreo',
    array(
        'nombre' => 'xsd:string',
        'correo' => 'xsd:string'
    ),
    array('return' => 'xsd:boolean'),
    $miURL
);
function validarCorreo($nombre, $correo){
    $link=mysqli_connect($GLOBALS['servidor'], $GLOBALS['usuario'], $GLOBALS['contraseña']);
    mysqli_select_db($link,$GLOBALS['basededatos']);
    $comprobar_Cliente = "select nombre, correo from cliente where nombre = '$nombre'";//comprobar que el nombre se usario no este registrado
    $registro = mysqli_query($link,$comprobar_Cliente);
    $varRow = mysqli_fetch_array($registro);
    if(is_array($varRow)){
        if($varRow[0] == $nombre && $varRow[1] == $correo){
            return new soapval('return', 'xsd:boolean',true);
        }else{
            return new soapval('return', 'xsd:boolean',false);
        }
    }
}

/**
 * requiere verificar si existe usuario y correo en la BD
 * 
 * SERVICIO: envio de correo
 * parametros: emailTo, Asunto, Mensaje, Cabeceras
 * respuesta: true or false
 */
$server->register(
    'enviarCorreo',
    array(
        'to' => 'xsd:string',
        'asunto' => 'xsd:string',
        'mensaje' => 'xsd:string',
        'headers' => 'xsd:string'
    ),
    array('return' => 'xsd:boolean'),
    $miURL
);
function enviarCorreo($to, $asunto, $mensaje, $headers){
    if(mail($to,$asunto,$mensaje,$headers)){
        return new soapval('return', 'xsd:boolean',true);
    }else{
        return new soapval('return', 'xsd:boolean',false);
    }
}

/**
 * SERVICIO: obtener admin user
 */
$server->register(
    'Admin',
    array('user' => 'xsd:string'),
    array('return' => 'xsd:int'),
    $miURL
);
function Admin($user){
    $link=mysqli_connect($GLOBALS['servidor'], $GLOBALS['usuario'], $GLOBALS['contraseña']);
    mysqli_select_db($link,$GLOBALS['basededatos']);
    $comprobar_user = "select id_Cliente from cliente where nombre = '$user'";//comprobar que el nombre se usario no este registrado
    $registro = mysqli_query($link,$comprobar_user);
    $varRow = mysqli_fetch_array($registro);
    if(is_array($varRow)){
        return new soapval('return', 'xsd:int',$varRow[0]);
    }
}

$server->register(
    'activarServicio',
    array('codigo' => 'xsd:int'),
    array('return' => 'xsd:int'),
    $miURL
);
function activarServicio($codigo){
    $estado_peticion = -2;
    $link=mysqli_connect($GLOBALS['servidor'], $GLOBALS['usuario'], $GLOBALS['contraseña']);
    mysqli_select_db($link,$GLOBALS['basededatos']);
    $confirmar_Existencias = "select codigo from ".$GLOBALS['tabla_Servicios']." where codigo = '$codigo'";
    $registro = mysqli_query($link,$confirmar_Existencias);
    $varRow = mysqli_fetch_array($registro);
    if(is_array($varRow)){
        foreach($varRow as $codigo_Valor){
            if($codigo_Valor == $codigo){
                $habilitar_Producto = "SELECT estado FROM servicio WHERE codigo = '$codigo'";
                $confirmar_Estado = mysqli_query($link,$habilitar_Producto);
                $varRow = mysqli_fetch_array($confirmar_Estado);
                if($varRow[0] == 'no disponible'){
                    $habilitar_Producto = "UPDATE servicio SET estado = 'disponible' WHERE codigo = '$codigo'";
                    $registro = mysqli_query($link,$habilitar_Producto);
                    if($registro){
                        $estado_registro = 1;
                        return new soapval('return', 'xsd:int',$estado_registro);
                    }
                }
                elseif($varRow[0] =='disponible'){
                    $estado_registro = -1;
                    return new soapval('return', 'xsd:int',$estado_registro);
                }
                else{
                    $estado_registro = -2;
                    return new soapval('return', 'xsd:int',$estado_registro);
                }
            }
        }
    }
    mysqli_Close($link);
    return new soapval('return', 'xsd:int',$estado_peticion);
}

/**
 * SERVICIO: detalle servicio
 * parametros: id del producto
 */
$server->register(
    'detalleProductoU',
    array('id' => 'xsd:string'),
    array('return' => 'xsd:string'),
    $miURL
);
function detalleProductoU($id){
    $link=mysqli_connect($GLOBALS['servidor'], $GLOBALS['usuario'], $GLOBALS['contraseña']);
    mysqli_select_db($link,$GLOBALS['basededatos']);
    $num = (int) $id;
    $comprobar_Servicio =  "select * from servicio where id_Servicio = $id and estado = 'disponible'";
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

$server->register(
    'comprobarCaptcha',
    array('response' => 'xsd:string'),
    array('return' => 'xsd:boolean'),
    $miURL
);
function comprobarCaptcha($response){
    $response = json_decode($response);
    if($response ->success)
        return new soapval ('return', 'xsd:boolean',true);//verificacion exitosa
    else
        return new soapval ('return', 'xsd:boolean',false);//verificacion exitosa
}

$server->register(
    'agregarServicioCarrito',
    array('user_id' => 'sxd:string', 'servicio_id' => 'xsd:string'),
    array('return' => 'xsd:int'),
    $miURL
);
function agregarServicioCarrito($user_id,$servicio_id){
    $link=mysqli_connect($GLOBALS['servidor'], $GLOBALS['usuario'], $GLOBALS['contraseña']);
    mysqli_select_db($link,$GLOBALS['basededatos']);
    $comprobar_Servicio_Agregado = "select id_user from carrito where id_servicio = '$servicio_id' and id_user = '$user_id' and estado = 'disponible'";
    $registro = mysqli_query($link,$comprobar_Servicio_Agregado);
    $varRow = mysqli_fetch_array($registro);
    if(is_array($varRow)){
        if($varRow[0] == $user_id){
            return new soapval('return', 'xsd:int',-1);
        }
    }
    $comprobar_Servicio_Retirado = "select estado from carrito where id_user = '$user_id' and id_servicio = '$servicio_id'";
    $registro = mysqli_query($link,$comprobar_Servicio_Retirado);
    $varRow = mysqli_fetch_array($registro);
    if(is_array($varRow)){
        if($varRow[0] == 'no disponible'){
            $actualizar_Carrito = "UPDATE carrito SET estado = 'disponible' WHERE  id_servicio = '$servicio_id' and id_user = '$user_id'";
            if(mysqli_query($link,$actualizar_Carrito)){
                return new soapval('return', 'xsd:int',1);//se actualiza el registro del servicio al cliente
            }
        }
    }
    $Subir_Al_Carrito = "insert into carrito values ('0','$user_id','$servicio_id','disponible')";
    if(mysqli_query($link,$Subir_Al_Carrito)){
        return new soapval('return', 'xsd:int',2);//se crea el nuevo registro al cliente
    }
    mysqli_Close($link);
    return new soapval('return', 'xsd:int',0);
}

$server->register(
    'listarCarrito',
    array('id_User' => 'xsd:string'),
    array('return' => 'xsd:string'),
    $miURL
);
function listarCarrito($id_user){    
    $link=mysqli_connect($GLOBALS['servidor'], $GLOBALS['usuario'], $GLOBALS['contraseña']);
    mysqli_select_db($link,$GLOBALS['basededatos']);
    $comprobar_Servicio =  
    "select s.id_Servicio, s.codigo, s.nombre, s.precio, s.detalles, s.imagen from carrito c, servicio s where c.id_servicio = s.id_Servicio and c.estado= 'disponible'and c.id_user ='$id_user'";
    $registro = mysqli_query($link, $comprobar_Servicio);
    $rows = array();
    while($r = mysqli_fetch_assoc($registro)) {
        $rows[] = $r;
    }
    $res = json_encode($rows);
    mysqli_Close($link);
    return new soapval('return', 'xsd:string',$res);

}

$server->register(
    'bajarServicio',
    array('id_User' => 'xsd:int', 'id_Servicio' => 'xsd:int'),
    array('return' => 'xsd:int'),
    $miURL
);
function bajarServicio($id_User,$id_Servicio){
    $link=mysqli_connect($GLOBALS['servidor'], $GLOBALS['usuario'], $GLOBALS['contraseña']);
    mysqli_select_db($link,$GLOBALS['basededatos']);
    $comprobar_Servicio_Cargado = "select estado from carrito where id_user = '$id_User' and id_servicio = '$id_Servicio'";
    $registro = mysqli_query($link,$comprobar_Servicio_Cargado);
    $varRow = mysqli_fetch_array($registro);
    if(is_array($varRow)){
        if($varRow[0] == 'disponible'){
            $bajar_Del_Carrito = "UPDATE carrito SET estado = 'no disponible' WHERE  id_servicio = '$id_Servicio' and id_user = '$id_User'";
            if(mysqli_query($link,$bajar_Del_Carrito)){
                return new soapval('return', 'xsd:int',1);
            }
        }
    }
    mysqli_Close($link);
    return new soapval('return', 'xsd:int',-1);
}

$server->register(
    'comprarCarrito',
    array('id_User' => 'xsd:int', 'id_Servicio' => 'xsd:int'),
    array('return' => 'xsd:int'),
    $miURL
);
function comprarCarrito($id_User,$id_Servicio){
    $link=mysqli_connect($GLOBALS['servidor'], $GLOBALS['usuario'], $GLOBALS['contraseña']);
    mysqli_select_db($link,$GLOBALS['basededatos']);
    $comprobarContenido = "select * from carrito where id_user = '$id_User' and id_servicio = '$id_Servicio' and estado = 'disponible'";
    $registro = mysqli_query($link,$comprobarContenido);
    $varRow = mysqli_fetch_array($registro);
    if(is_array($varRow)){
            $bajar_Del_Carrito = "UPDATE carrito SET estado = 'no disponible' WHERE id_user = '$id_User' and estado = 'disponible'";
            if(mysqli_query($link,$bajar_Del_Carrito)){
                return new soapval('return', 'xsd:int',1);
        }
    }
    return new soapval('return', 'xsd:int',-1);
}

if(!isset($HTTP_RAW_POST_DATA)){
    $HTTP_RAW_POST_DATA = file_get_contents('php://input');
}

$server->service($HTTP_RAW_POST_DATA);
 ?>
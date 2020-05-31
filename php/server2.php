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
    array('nombre' => 'xsd:string', 'correo'=> 'xsd:string', 'clave'=> 'xsd:string', 'numero_Tel' => 'xsd:int'),
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
    $registro = mysqli_query($link,$cliente_Datos_Insertar);
    $estado_registro = 1;
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
    $confirmar_Existencias = "select codigo from servicios where codigo = '$codigo'";
    $registro = mysqli_query($link,$confirmar_Existencias);
    $varRow = mysqli_fetch_array($registro);
    if(is_array($varRow)){
        foreach($varRow as $codigo_Valor){
            if($codigo_Valor == $codigo){
                $desabilitar_Producto = "SELECT estado FROM `servicios` WHERE codigo = '$codigo'";
                $confirmar_Estado = mysqli_query($link,$desabilitar_Producto);
                $varRow = mysqli_fetch_array($confirmar_Estado);
                if($varRow[0] == 'no disponible'){
                    $estado_registro = -1;
                    return new soapval('return', 'xsd:int',$estado_registro);
                }
                elseif($varRow[0] =='disponible'){

                    $desabilitar_Producto = "UPDATE servicios SET estado = 'no disponible' WHERE codigo = '$codigo'";
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

if(!isset($HTTP_RAW_POST_DATA)){
    $HTTP_RAW_POST_DATA = file_get_contents('php://input');
}

$server->service($HTTP_RAW_POST_DATA);
 ?>
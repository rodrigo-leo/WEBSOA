<?php
    require_once("../nusoap/lib/nusoap.php");

    $serverURL = 'http://localhost/dashboard/itqNet/php/server2.php';
    $cliente = new nusoap_client("$serverURL?wsdl", 'wsdl');
    $estado_formulario = true;

    //valores obtenidos del formulario
    $nombre_usuario = htmlentities($_POST['user']);
    $pass1 = htmlentities($_POST['pass1']);
    $pass2 = htmlentities($_POST['pass2']);
    $correo = htmlentities($_POST['correo']);
    $telefono = htmlentities($_POST['telefono']);
    $key = "6LdOS_8UAAAAAJQCv9-rn7vsqUM4gyzmYY9_0zHW";
    $responseKey = $_POST['g-recaptcha-response'];//el valor que envia el recaptcha del formulario
    $userIP = $_SERVER['REMOTE_ADDR'];
    $urlGoogle = "https://www.google.com/recaptcha/api/siteverify?secret=$key&response=$responseKey&remoteip=$userIP";
    $response = file_get_contents($urlGoogle);

    echo $response;

    static $longitud_min_contraseña = 6; //longitud mínima de caracteres que la contraseña debe de tener
    static $longitud_max_contraseña = 16; //longitud máxima de caracteres que la contraseña puede tener
    static $longitud_min_user_name = 5;//
    static $longitud_max_user_name = 20;//
    static $longitud_numero_telefonico = 10;//
    $estado_usuario = 'disponible';


    $estado_Nombre_Usuario = $cliente->call(
        "comprobar_Vacio",
        array('entrada' => $nombre_usuario),
        "uri:$serverURL"
    );
    if($estado_Nombre_Usuario == true){
        $GLOBALS['estado_formulario'] = false;
        echo '<br>El nombre de usuario no puede estar vacío';
    }

    $estado_Nombre_Usuario = $cliente->call(
        "comprobar_Intervalo_De_Longitud",
        array('entrada' => $nombre_usuario, 'longitud_min' => $longitud_min_user_name, 'longitud_max' => $longitud_max_user_name),
        "uri:$serverURL"
    );
    if($estado_Nombre_Usuario == false){
        $GLOBALS['estado_formulario'] = false;
        echo '<br>palabra a evaluar: '.$nombre_usuario.' no cumple con el intervalo de caracteres';
    }

    $estado_Contra = $cliente->call(
        "comprobar_Intervalo_De_Longitud",
        array('entrada' => $pass1, 'longitud_min' => $longitud_min_contraseña, 'longitud_max' => $longitud_max_contraseña),//global $long_contra = 5
        "uri:$serverURL"
    );
    if($estado_Contra == false){
        $GLOBALS['estado_formulario'] = false;
        echo '<br>La contraseña ingresada no cumple con la longitud mínima';
    }

    $estado_Contra = $cliente->call(
        "comprobar_Un_Numero",
        array('entrada' => $pass1),
        "uri:$serverURL"
    );
    if($estado_Contra == false){
        $GLOBALS['estado_formulario'] = false;
        echo '<br>La contraseña debe contener almenos un dígito';
    }

    $estado_Contra = $cliente->call(
        "comprobar_Alfanumerico_Minusculas",
        array('entrada' => $pass1),
        "uri:$serverURL"
    );
    if($estado_Contra == false){
        $GLOBALS['estado_formulario'] = false;
        echo '<br>La contraseña debe contener almenos una letra minúscula';
    }

    $estado_Contra = $cliente->call(
        "comprobar_Alfanumerico_Mayusculas",
        array('entrada' => $pass1),
        "uri:$serverURL"
    );
    if($estado_Contra == false){
        $GLOBALS['estado_formulario'] = false;
        echo '<br>La contraseña debe contener almenos una letra mayúscula';
    }

    $estado_Contra = $cliente->call(
        "comprobar_Caracter_Especial",
        array('entrada' => $pass1),
        "uri:$serverURL"
    );
    if($estado_Contra == false){
        $GLOBALS['estado_formulario'] = false;
        echo '<br>La contraseña debe contener almenos un caracter especial';
    }

    $estado_Contra = $cliente->call(
        'comprobar_Palabras_Identicas',
        array('password1' => $pass1, 'password2' => $pass2),
        "uri:$serverURL"
    );
    if($estado_Contra == false){
        $GLOBALS['estado_formulario'] = false;
        echo '<br>Las contraseñas ingresadas Deben de ser identicas';
    }

    $estado_Correo = $cliente->call(
        'comprobar_Integridad_Correo',
        array('correo' => $correo),
        "uri:$serverURL"
    );
    if(!$estado_Correo){
        $GLOBALS['estado_formulario'] = false;
        echo '<br>Ingrese un correo electrónico válido';
    }

    $estado_Telefono = $cliente->call(
        'comprobar_Numero_Existente',
        array('entrada' => $telefono),
        "uri:$serverURL"
    );
    if($estado_Telefono == false){
        $GLOBALS['estado_formulario'] = false;
        echo '<br>Compruebe el número de telefono ingresado sea el correcto';
    }

    $estado_Telefono = $cliente->call(
        "comprobar_Intervalo_De_Longitud",
        array('entrada' => $telefono, 'longitud_min' => $longitud_numero_telefonico, 'longitud_max' => $longitud_numero_telefonico),
        "uri:$serverURL"
    );
    if($estado_Telefono == false){
        $GLOBALS['estado_formulario'] = false;
        echo '<br>El numero de telefono '.$telefono.' no cumple con la longitud de 10 dígitos';
    }

    if($estado_formulario){
        $registro_Cliente = $cliente->call(
            "registrar_Cliente",
            array('nombre' => $nombre_usuario, 'correo' => $correo, 'clave' => $pass1, 'numero_Tel' => $telefono),
            "uri:$serverURL"
        );
        echo "-".$registro_Cliente."-";
        switch($registro_Cliente){
            case 1:
                header('location: http://localhost/dashboard/itqNet/html/Inicio.php');
            break;
            case -1:
                echo "El nombre de usuario ya se encuentra ocupado";
            break;
            case -2:
                echo "El correo ingresado ya se encuentra registrado por un usuario";
            break;
            default:
                echo "No se puede realizar el registro del usuario";
        }
    }

?>
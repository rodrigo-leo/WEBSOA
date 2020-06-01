<?php
    require_once("../nusoap/lib/nusoap.php");

    $serverURL = 'http://localhost/dashboard/itqNet/php/server2.php';

    $cliente = new nusoap_client("$serverURL?wsdl", 'wsdl');
    $estado_formulario = true;

    //valores obtenidos del formulario
    $nombre_usuario = htmlentities($_POST['user']);
    $pass1 = htmlentities($_POST['pass1']);
    static $longitud_min_contraseña = 6; //longitud mínima de caracteres que la contraseña debe de tener
    static $longitud_max_contraseña = 16; //longitud máxima de caracteres que la contraseña puede tener
    static $longitud_min_user_name = 4;//
    static $longitud_max_user_name = 20;//

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

    if($estado_formulario){
        $registro_Cliente = $cliente->call(
            "loging_Cliente",
            array('nombre' => $nombre_usuario, 'clave' => $pass1),
            "uri:$serverURL"
        );
        echo "-".$registro_Cliente."-";
        switch($registro_Cliente){
            case 1:
                $admin = $cliente->call(
                    'Admin',
                    array('user' => $nombre_usuario),
                    "uri:$serverURL"
                );
                if($admin == true){
                    header('location: http://localhost/dashboard/itqNet/ADMIN/admin.php');
                }else{
                    header('location: http://localhost/dashboard/itqNet/html/Inicio.php');
                }
            break;
            case -1:
                echo "El nombre de usuario o la contraseña es incorrecta";
            break;
            case -2:
                echo "El usuario ingresado no se encuentra registrado";
            break;
            default:
                echo "No se puede realizar el inicio de sesion en este momento";
        }
    }

?>
<?php
    require_once("../nusoap/lib/nusoap.php");
    $serverURL = 'http://localhost/dashboard/itqNet/php/server2.php';
    $cliente = new nusoap_client("$serverURL?wsdl", 'wsdl');

    $userFlag = false;
    $correoFlag = false;

    $name = htmlentities($_POST['fNombre']);
    $from = htmlentities($_POST['fEmail']);
    $to = $from;
    $subject = htmlentities($_POST['fAsunto']);
    $txt = htmlentities($_POST['fMensaje']);
    $headers = "From: ".$name." <$from>"."\r\n" .
               "CC: jonathancggs@gmail.com";
    
    //obtener si el usuario existe
    $user = $cliente->call(
        'validarUser',
        array('nombre' => $name),
        "uri:$serverURL"
    );
    if($user == true){
        $userFlag = true;
    }

    //obtener si el correo existe (user, correo)
    if($userFlag == true){
        $correo = $cliente->call(
            'validarCorreo',
            array(
                'nombre' => $name,
                'correo' => $from
            ),
            "uri:$serverURL"
        );
        if($correo == true){
            $correoFlag = true;
        }
    }

    //llamada al servicio del correo
    if($userFlag == true && $correoFlag == true){
        $correo = $cliente->call(
            'enviarCorreo',
            array(
                'to' => $to,
                'asunto' => $subject,
                'mensaje' => $txt,
                'headers' => $headers
            ),
            "uri:$serverURL"
        );
        if($correo == true){
            echo '<script language="javascript">';
            echo 'alert("Correo Enviado")';
            echo '</script>';
        }else{
            echo 'Hubo un problema con el envio!';
        }
    }

?>
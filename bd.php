<?php
$usuario = "root";
$contraseña = "";
$servidor = "localhost";
$basededatos = "datos_productos";

$conexion = mysqli_connect($servidor, $usuario, "") or die("NO se pudo establecer la conexion al servidor localhost");
$db = mysqli_select_db($conexion, $basededatos) or die("Fallo la conexion a la base de datos");
$cliente_Datos_Insertar = "insert into ".$GLOBALS['tabla_Clientes']." values ('0','$nombre','$correo','$clave','$numero_Tel')";
if($registro = mysql_query($cliente_Datos_Insertar,$link)){
    $estado_registro = true;
}
else{
    print mysql_error();
}
?>
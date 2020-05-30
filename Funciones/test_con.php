<?php try{
    require "./conexion.php";

    $conexion = new Conexion();

    $query = "select * from precios";

    $accion = $conexion->execute($query);
    $res = mysqli_num_rows($accion);
    $row = mysqli_fetch_array($accion);

    print_r('consulta '.$row["precio"]);
}catch(Exception $e){
    print_r($e);
}
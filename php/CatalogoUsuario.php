

<?php
require_once("../nusoap/lib/nusoap.php"); //path soap

$miURL = 'http://localhost/dashboard/itqNet/php/server2.php';
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

//SELECT COUNT (*) FROM empleados WHERE país= 'México'

$link=mysqli_connect($GLOBALS['servidor'], $GLOBALS['usuario'], $GLOBALS['contraseña']);
mysqli_select_db($link,$GLOBALS['basededatos']);
?>


<html>
    <br>
    <div class="row row-cols-1 row-cols-md-3">
    <?php
        $confirmar_Existencias = "select * from ".$GLOBALS['tabla_Servicios']." where estado = 'disponible' order by precio";
        $registro = mysqli_query($link,$confirmar_Existencias);
        while($varRow = mysqli_fetch_array($registro)){
            $imagen_Dir = str_replace("C:/xampp/htdocs/dashboard/itqNet","..",$varRow[6]);
    ?>
        <div class="card border-info mb-3">
            <div class="card">
                <img src= <?php echo $imagen_Dir?> class="card-img-top" alt="<?php echo $imagen_Dir?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $varRow[2]?></h5>
                    <p class="card-text"><?php echo $varRow[5]?></p>
                </div>
            </div >
            <ul class="list-group list-group-flush">
                <li class="list-group-item">$<?php echo $varRow[3]?></li>
            </ul>
            <div class="card-body">
                <a href="#" class="btn btn-info btn-lg">Adquirir</a>
                <a href="#" class="btn btn-info btn-lg">Subir al carrito</a>
            </div>
        </div>
    <?php
        }
    mysqli_Close($link);
    ?>
    </div>
</html>

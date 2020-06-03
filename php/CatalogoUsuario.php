<?php
    require_once("../nusoap/lib/nusoap.php");
    $serverURL = 'http://localhost/dashboard/itqNet/php/server2.php';
    $cliente = new nusoap_client("$serverURL?wsdl", 'wsdl');

    $userCatalog = $cliente->call(
        'listaServicios',
        array('user' => 'normal'),
        "uri:$serverURL"
    );
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Catalogo de servicios para los clientes</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">     
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../CSS/bootstrap.css">
        <script src="../JS/bootstrap.js"></script>
        <script src="../JS/jquery.js"></script>
    </head>
    <body>
        <h5 class="modal-title">Servicios disponibles</h5>
        <div class="text-center">
            <h4>Lista de servicios</h4>
        </div>

        <div class="row row-cols-1 row-cols-md-3">
        <?php
        $res = json_decode($userCatalog, true);
            foreach($res as $val){
        ?>
            <div class="card border-info mb-3">
                <div class="card">
                    <?php
                        $dirImagen = str_replace("C:/xampp/htdocs/dashboard/itqNet","..",$val['imagen'])
                    ?>
                    <img src= "<?php echo $dirImagen?>" class="card-img-top" alt="<?php echo $dirImagen?>"
                        title="<?php echo $val['nombre']?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $val['detalles']?></h5>
                        <p class="card-text"><?php echo $val['nombre']?></p>
                    </div>
                </div >
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">$<?php echo $val['precio']?></li>
                </ul>
                <div class="card-body">
                    <a href="#" class="btn btn-info btn-lg">Adquirir</a>
                    <a href="#" class="btn btn-info btn-lg">Subir al carrito</a>
                </div>
            </div>
        <?php
        }
        ?>
        </div>
    </body>
</html>
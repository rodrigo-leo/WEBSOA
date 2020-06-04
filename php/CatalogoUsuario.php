<?php
    require_once("../nusoap/lib/nusoap.php");
    $serverURL = 'http://localhost/dashboard/itqNet/php/server2.php';
    $cliente = new nusoap_client("$serverURL?wsdl", 'wsdl');

    $id_User = $id_User;
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
        <div class="container">
            <div class="row">
                <div class="col">
                </div>
                <div class="col-9">
                    <div class="row row-cols-1 row-cols-md-3">
                    <?php
                    $res = json_decode($userCatalog, true);
                        foreach($res as $val){
                            $dirImagen = str_replace("C:/xampp/htdocs/dashboard/itqNet","..",$val['imagen']);
                            $nombre = $val['nombre'];
                            $detalles =  $val['detalles'];
                            $id_Servicio = $val['id_Servicio'];
                            $precio = $val['precio']
                    ?>
                        <div class="card border-info mb-3" >
                            <div class="card px-md-1" >
                                <img src= "<?php echo $dirImagen?>" class="card-img-top" alt="<?php echo $dirImagen?>"
                                    title="<?php echo $nombre?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $detalles?></h5>
                                    <p class="card-text"><?php echo $nombre?></p>
                                </div>
                            </div >
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">$<?php echo $precio?></li>
                            </ul>
                            <div class="card-body">
                                <a href="#">Adquirir</a>
                                <a href="../php/carrito.php?id_User=<?php echo $id_User?>&id_Servicio=<?php echo $id_Servicio?>" class="btn btn-info " class="btn btn-info ">Subir al carrito</a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    </div>
                        
                </div>
                <div class="col">
            </div>
        </div>
    </body>
</html>
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
    </head>
    <body>
        <h5 class="modal-title">Servicios disponibles</h5>
        <div class="text-center">
            <h4>Lista de usuarios</h4>
        </div>
        <div>
            <table id="TUsers" class="table table-dark table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scooe="col">ID</th>
                        <th scooe="col">Nombre del servicio</th>
                        <th scooe="col">codigo</th>
                        <th scooe="col">nombre</th>
                        <th scope="col">detalles</th>
                        <th scope="col">imagen</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //echo $userCatalog."<-------" ;
                        $res = json_decode($userCatalog, true);
                        foreach($res as $val){
                            $id = $val['id_Servicio'];
                            echo '<tr>';
                            echo '<td>'.$val['id_Servicio'].'</td>';
                            echo '<td>'.$val['nombre'].'</td>';
                            echo '<td>'.$val['codigo'].'</td>';
                            echo '<td>'.$val['detalles'].'</td>';
                            echo '<td>'.$val['imagen'].'</td>';
                            echo '<td>
                                    <button type="button" class="btn btn-light" onclick="editar('.$id.');">
                                        <span class="fa fa-pencil"></span>
                                    </button>
                                    </td>';
                            echo '<td>
                                    <button type="button" class="btn btn-light" onclick="ver('.$id.');">
                                        <span class="fa fa-eye"></span>
                                    </button>
                                    </td>';
                            echo '<td>
                                    <button type="button" class="btn btn-light" onclick="confDel('.$id.');">
                                        <span class="fa fa-trash"></span>
                                    </button>
                                    </td>';
                            echo '</tr>';
                        } 
                    ?>
                </tbody>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../CSS/bootstrap.css">
        <script src="../JS/jquery.js"></script>
        <script src="../JS/bootstrap.js"></script>
    </body>
</html>
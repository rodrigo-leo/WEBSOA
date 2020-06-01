<?php
require_once("../nusoap/lib/nusoap.php");
$serverURL = 'http://localhost/dashboard/itqNet/ADMIN/serverA.php';
$cliente = new nusoap_client("$serverURL?wsdl", 'wsdl');

    $admin = $cliente->call(
        'listaUsers',
        array('user' => 'admin'),
        "uri:$serverURL"
    );
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../CSS/bootstrap.css">
<script src="../JS/jquery.js"></script>
<script src="../JS/bootstrap.js"></script>
<div class="container-fluid">
    <div class="text-center">
        <h2>Usuarios</h2>
    </div>
    <br>
    <div>
        <div class="text-center">
            <h4>Lista de usuarios</h4>
        </div>
        <div>
            <table id="TUsers" class="table table-dark table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scooe="col">Id</th>
                        <th scooe="col">Nombre</th>
                        <th scooe="col">Correo</th>
                        <th scooe="col">Telefono</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                            $res = json_decode($admin, true);
                            foreach($res as $val){
                                echo '<tr>';
                                echo '<td>'.$val['id_Cliente'].'</td>';
                                echo '<td>'.$val['nombre'].'</td>';
                                echo '<td>'.$val['correo'].'</td>';
                                echo '<td>'.$val['numero_Tel'].'</td>';
                                echo '<td>
                                        <button type="button" class="btn btn-light">
                                            <span class="fa fa-pencil"></span>
                                        </button>
                                      </td>';
                                echo '<td>
                                        <button type="button" class="btn btn-light" onclick="ver();">
                                            <span class="fa fa-eye"></span>
                                        </button>
                                      </td>';
                                echo '</tr>';
                            } 
                        ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL DE VER -->

<script>
    function ver(){

    }
</script>
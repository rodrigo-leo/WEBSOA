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
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                            $res = json_decode($admin, true);
                            foreach($res as $val){
                                $nombre = (String) $val['nombre'];
                                $id = $val['id_Cliente'];
                                echo '<tr>';
                                echo '<td>'.$val['id_Cliente'].'</td>';
                                echo '<td>'.$val['nombre'].'</td>';
                                echo '<td>'.$val['correo'].'</td>';
                                echo '<td>'.$val['numero_Tel'].'</td>';
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
            </table>
        </div>
    </div>
</div>

<!-- MODAL DE CONFIRMACION -->
<div class="modal" tabindex="-1" role="dialog" id="confDel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmar Eliminación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Está seguro que desea realizar la eliminar el usuario?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-success" data-dismiss="modal" onclick="eliminar();">Editar</button>
      </div>
    </div>
  </div>
</div>

<script>
    var id='';
    function ver(id){
        this.id = id;
        window.location = 'http://localhost/dashboard/itqNet/ADMIN/Funciones/VerUsuario.php?id='+id;
    }
    function editar(id){
        this.id = id;
        window.location = 'http://localhost/dashboard/itqNet/ADMIN/Funciones/EditarUsuario.php?id='+id;
    }
    function confDel(id){
        this.id = id;
        $('#confDel').modal('show');
    }
    function eliminar(){
        window.location = 'http://localhost/dashboard/itqNet/ADMIN/Funciones/delUser.php?id='+this.id;
    }
</script>
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
                                echo '</tr>';
                            } 
                        ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL DE VER -->
<div class="modal" tabindex="-1" role="dialog" id="verUsuario">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ver usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <fieldset>
            <div class="form-group">
                <div class="col-md-8">  
                    <label for="fID">ID:*</label>
                    <input type="text" name="fID" id="fID" placeholder="Nombre" class="form-control" disabled>
                </div>
                <div class="col-md-8">  
                    <label for="fNombre">Nombre del usuario:*</label>
                    <input type="text" name="fNombre" id="fNombre" placeholder="Nombre" class="form-control" disabled>
                </div>
                <div class="col-md-8">  
                    <label for="fCorreo">Correo:*</label>
                    <input type="text" name="fCorreo" id="fCorreo" placeholder="Correo" class="form-control" disabled>
                </div>
                <div class="col-md-8">  
                    <label for="fTel">Telefono:*</label>
                    <input type="text" name="fTel" id="fTel" placeholder="Telefono" class="form-control" disabled>
                </div>
            </div>
        </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL DE EDITAR -->
<div class="modal" tabindex="-1" role="dialog" id="editUser">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <fieldset>
            <div class="form-group">
                <div class="col-md-8">  
                    <label for="fID">ID:*</label>
                    <input type="text" name="fID" id="fID" placeholder="ID" class="form-control" disabled>
                </div>
                <div class="col-md-8">  
                    <label for="fNombre">Nombre del usuario:*</label>
                    <input type="text" name="fNombre" id="fNombre" placeholder="Nombre" class="form-control" require>
                </div>
                <div class="col-md-8">  
                    <label for="fCorreo">Correo:*</label>
                    <input type="text" name="fCorreo" id="fCorreo" placeholder="Correo" class="form-control" require>
                </div>
                <div class="col-md-8">  
                    <label for="fTel">Telefono:*</label>
                    <input type="text" name="fTel" id="fTel" placeholder="Telefono" class="form-control" require>
                </div>
            </div>
        </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
    var nombre='';
    function ver(name){
        this.nombre = name;
        
        $('#verUsuario').modal('show');
    }
    function editar(){
        echo 
        $('#editUser').modal('show');
    }
    function save(){

    }
</script>

<?php 
    $prueba = 'palomo';
    function accion(){
        echo '
        <script>
            $(".modal-body #IdP").val('.$prueba.');
        </script>
        ';
    }
?>
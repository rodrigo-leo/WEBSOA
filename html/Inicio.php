<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
<link rel="stylesheet" href="../CSS/bootstrap.css">
<script src="../JS/jquery.js"></script>
<script src="../JS/bootstrap.js"></script>
<?php
    $id_User=intval($_GET['id_User']);
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">itqNet</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="http://localhost/dashboard/itqNet/html/Inicio.php">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="miCarrito.php?id_User=<?php echo $id_User?>">Carrito</a>
      </li>
    </ul>
  </div>
</nav>

<?php
  include "../php/CatalogoUsuario.php";
  include "footer.php";
?>
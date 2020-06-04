<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="container">
  <div class="row">
    <div class="col">
      <h5 class="modal-title">Eliminar de productos</h5>
      <form action="../php/bajarProducto.php" method ="POST">
        <div class="row">
          <div class="col"></div>
          <div class="col">
          <style>
            div {
              background-image: url('/img/fondo registro2.jpg');
            }
          </style>  
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Codigo</label>
            <div class="col-auto">
              <label class="sr-only" for="inlineFormInput">123456</label>
              <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="123456" name="codigo">
            </div>
          </div>
          <div class="mx-auto" style="width: 200px;">
            <div class="form-group row">
                <button type="submit" class="btn btn-primary" value="enviar">Eliminar producto del catalogo</button>
            </div>
          </div>
        </div>
        <div class="col"></div>
      </form>
      </div>
      <div class="col">
      </div>
    </div>
  </div>
</div>
      <?php
        include "../ADMIN/servicios.php";
      ?>
    

<link rel="stylesheet" href="../CSS/bootstrap.css">
<script src="../JS/jquery.js"></script>
  <script src="../JS/bootstrap.js"></script>

<footer style="bottom: 0;">
    <div class="container-fluid">
            <h5>Contacto</h5>
            <!-- Trigger the modal with a button -->
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <form action="../php/envioCorreo.php" method ="POST">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Envianos un correo</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="well well-sm">
                                            <form class="../php/envioCorreo.php" method="POST">
                                                <fieldset>
                                                    <legend class="text-center header">Contact us</legend>

                                                    <div class="form-group">
                                                        <div class="col-md-8">
                                                            <label for="fTo">Para:*</label>
                                                            <input id="fTo" name="fTo" type="email" placeholder="Para" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-8">
                                                            <label for="fAsunto">Asunto:*</label>
                                                            <input id="fAsunto" name="fAsunto" type="text" placeholder="Asunto" class="form-control" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md">
                                                            <label for="fMensaje">Mensaje:*</label>
                                                            <textarea class="form-control" id="fMensaje" name="fMensaje" placeholder="Mensaje para enviar en el correo." rows="7" required></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md-12 text-center">
                                                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
    </div>
</footer>
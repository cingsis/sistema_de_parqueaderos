
<footer id="footer" class="footer">
  <div class="text-center">
    <br/>
    <p>Sistema Administrador de parqueaderos</p>
    <p>&copy; 2019</p>
     <br/>
  </div>
</footer>

<!-- Modal configuración valores -->
<div class="modal fade" id="modalValores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" style="overflow-y: scroll;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Configuración de Tarifas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="javascript: location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="<?= URL; ?>home/configuracionValores" method="post" autocomplete="off" name="formvalores" id="FormConfigValores">
          <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-2 col-lg-2">
              <p>&nbsp;</p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
              <div class="form-group">
                <label for="ValorHora">Valor Hora</label>
              </div>
              <div class="form-group">
                <input type="number" name="valorhora" class="form-control input" id="ValorHora" required="true" value="<?= $tarifas[0]['valor_hora']; ?>" readonly="true">
              </div>
            </div>
            <div class="col-sm-12 col-xs-12 col-md-2 col-lg-2">
              <p>&nbsp;</p>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-2 col-lg-2">
              <p>&nbsp;</p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
              <div class="form-group">
                <label for="ValorAdicional">Valor Adicional (después de la hora)</label>
              </div>
              <div class="form-group">
                <input type="number" name="valoradicional" class="form-control input" id="ValorAdicional" required="true" value="<?= $tarifas[0]['valor_adicional']; ?>" readonly="true">
              </div>
            </div>
            <div class="col-sm-12 col-xs-12 col-md-2 col-lg-2">
              <p>&nbsp;</p>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-2 col-lg-2">
              <p>&nbsp;</p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
              <div class="form-group">
                <label for="ValorHora2">Valor entre 1-6 Horas</label>
              </div>
              <div class="form-group">
                <input type="number" name="valorhora2" class="form-control input" id="ValorHora2" required="true" value="<?= $tarifas[0]['valor_2']; ?>" readonly="true">
              </div>
            </div>
            <div class="col-sm-12 col-xs-12 col-md-2 col-lg-2">
              <p>&nbsp;</p>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-2 col-lg-2">
              <p>&nbsp;</p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
              <div class="form-group">
                <label for="ValorDia">Valor Día (8 horas)</label>
              </div>
              <div class="form-group">
                <input type="number" name="valordia" class="form-control input" id="ValorDia" required="true" value="<?= $tarifas[0]['valor_dia']; ?>" readonly="true">
              </div>
            </div>
            <div class="col-sm-12 col-xs-12 col-md-2 col-lg-2">
              <p>&nbsp;</p>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-2 col-lg-2">
              <p>&nbsp;</p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
              <div class="form-group">
                <label for="ValorMensualidad">Valor Mensualidad</label>
              </div>
              <div class="form-group">
                <input type="number" name="valormensualidad" class="form-control input" id="ValorMensualidad" required="true" value="<?= $tarifas[0]['valor_mensualidad']; ?>" readonly="true">
                <input type="hidden" name="idtarifa" class="form-control input" id="IdTarifa" required="true" value="<?= $tarifas[0]['id']; ?>">
              </div>
            </div>
            <div class="col-sm-12 col-xs-12 col-md-2 col-lg-2">
              <p>&nbsp;</p>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <input type="button" class="btn btn-login" name="editarvalores" id="btnEditarValores" value="Editar" onclick="habilitarEdicion()">
        <input type="submit" class="btn btn-login" name="guardarvalores" id="btnGuardarValores" value="Guardar" disabled="true">
      </div>
    </form>
    </div>
  </div>
</div>


<script src="<?php echo URL; ?>js/jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#table-users').DataTable();
  } );
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $("#ingresosdia").DataTable();
    $("#ingresossemanales").DataTable();
    $("#registrosmensuales").DataTable();
    $("#registrosanuales").DataTable();
  });
</script>

<script>
    var url = "<?php echo URL; ?>";
</script>

    <!-- <script src="<?php echo URL; ?>js/popper.min.js"></script> -->
    <script src="<?php echo URL; ?>js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo URL; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo URL; ?>fonts/font-awesome/js/all.js"></script>
    <script src="<?php echo URL; ?>js/datatables.min.js"></script>
    <script src="<?php echo URL; ?>js/sweetalert.min.js"></script>
    <script src="<?php echo URL; ?>js/usuarios.js"></script>
    <script src="<?php echo URL; ?>js/busqueda.js"></script>
    <script src="<?php echo URL; ?>js/edicionTarifas.js"></script>
    <script src="<?php echo URL; ?>js/perfil.js"></script>
    <script src="<?php echo URL; ?>js/jquery.dataTables.min.js"></script>

</body>
</html>

<div class="menu">
  <div class="row margin">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <?php if ($_SERVER['REQUEST_URI'] == "/ParkingManagementSystem/employee/index"): ?>
          <strong><a class="navbar-brand" href="<?= URL;  ?>admin/index">Inicio</a></strong>
        <?php endif; ?>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link" href="<?= URL; ?>employee/ingresoMotos">Ingreso de Motos</a>
              <a class="nav-item nav-link" href="<?= URL; ?>employee/salidaMotos">Salida de Motos</a>
                <a class="nav-item nav-link" href="<?= URL; ?>employee/reporteDiario">Reporte Diario</a>
            <a class="nav-item nav-link logout" href="<?= URL; ?>home/cerrarSesion">Salir&nbsp;&nbsp;<i class="fas fa-sign-out-alt"></i></a>
          </div>
        </div>
            <?php require APP . 'view/_templates/perfil.php'; ?>
      </nav>
    </div>
  </div>
</div>

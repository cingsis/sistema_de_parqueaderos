
<div class="menu">
  <div class="row margin">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <?php require APP . 'view/_templates/logo.php'; ?>

        <a class="nav-item nav-link color" href="<?= URL;  ?>admin/index">Inicio</a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link" href="<?= URL; ?>admin/newUser">Nuevo Usuario</a>
            <a class="nav-item nav-link" href="<?= URL; ?>admin/ingresoMotos">Ingreso de Motos</a>
            <a class="nav-item nav-link" href="<?= URL; ?>admin/salidaMotos">Salida de Motos</a>
              <?php if ($_SERVER['REQUEST_URI'] == "/ParkingManagementSystem/admin/reporteUsuarios"): ?>
                <strong><a class="nav-item nav-link" href="<?= URL; ?>admin/reporteUsuarios">Reporte Usuarios</a></strong>
              <?php endif; ?>
                <a class="nav-item nav-link" href="<?= URL; ?>admin/ingresosPorFecha">Reporte de ingresos por fecha</a>
          </div>
        </div>

        <div class="dropdown">
          <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user-tie"></i>&nbsp;
             <strong><?= $_SESSION['login']; ?> (<?= ($_SESSION['tipo'] == 1) ? 'Administrador' : 'Usuario Regular' ?>)</strong>&nbsp;
          </a>

          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item logout" href="<?= URL; ?>home/cerrarSesion">Salir&nbsp;&nbsp;<i class="fas fa-sign-out-alt"></i></a>

            <?php if ($_SERVER['REQUEST_URI'] == "/ParkingManagementSystem/admin/index"): ?>
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalValores"><i class="fas fa-cogs"></i>&nbsp;Configurar Tarifas</a>
            <?php else: ?>
            <?php endif;  ?>

            <a class="dropdown-item" href="<?= URL; ?>home/configuracionPerfil"><i class="fas fa-user-cog"></i>&nbsp;Configuración del Perfil</a>
          </div>
        </div>

      </nav>
    </div>
  </div>
</div>

<div class="container body2">
  <div class="row text-center top">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <h2 class="top"><strong>Reporte Usuarios Registrados</strong></h2>
    </div>
  </div>
  <br/>
  <br/>
  <div class="row text-center">
    <div class="col-xs-12 col-sm-12 col-md-1">
      <p>&nbsp;</p>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
      <table class="table table-striped" id="table-users">
        <thead class="thead-dark">
          <tr>
            <th>Login</th>
            <th>Nombres</th>
            <th>Tipo de Usuario</th>
            <th>Fecha y Hora Creación Usuario</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($usuarios as $value): ?>
          <tr>
            <td><?= $value['login']; ?></td>
            <td><?= $value['nombres']; ?></td>
            <td>
              <?php if($value['tipo'] == 1): ?>
                Administrador
              <?php else:  ?>
                Usuario Regular
              <?php endif ?>
            </td>
            <td><?= $value['fecha_creacion']; ?></td>
            <td><?= $value['estado']; ?></td>
            <td>
              <button type="button" class="btn btn-warning btn-circle btn-md" onclick="cambiarestado('<?= $value['id']?>')" title="Cambiar Estado">
                <i class="fas fa-sync"></i>
              </button>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-1">
      <p>&nbsp;</p>
    </div>
  </div>
  <br/>
</div>

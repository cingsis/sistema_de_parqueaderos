
<div class="menu">
  <div class="row margin">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="nav-item nav-link" href="<?= URL;  ?>admin/index">Inicio</a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <?php if ($_SERVER['REQUEST_URI'] == "/ParkingManagementSystem/admin/newUser"): ?>
              <strong><a class="nav-item nav-link" href="<?= URL; ?>admin/newUser">Nuevo Usuario</a></strong>
            <?php endif; ?>
            <a class="nav-item nav-link" href="<?= URL; ?>admin/ingresoMotos">Ingreso de Motos</a>
            <a class="nav-item nav-link" href="<?= URL; ?>admin/salidaMotos">Salida de Motos</a>
            <a class="nav-item nav-link" href="<?= URL; ?>admin/reporteUsuarios">Reporte de Usuarios</a>
            <a class="nav-item nav-link" href="<?= URL; ?>admin/ingresosPorFecha">Reporte de ingresos por fecha</a>
            <a class="nav-item nav-link logout" href="<?= URL; ?>home/cerrarSesion">Salir&nbsp;&nbsp;<i class="fas fa-sign-out-alt"></i></a>
          </div>
        </div>
            <?php require APP . 'view/_templates/perfil.php'; ?>
      </nav>
    </div>
  </div>
</div>

<div class="container body">
  <div class="row text-center top">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <h2 class="top"><strong>Registro de Nuevos Usuarios</strong></h2>
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-3">
      &nbsp;
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
      <?php if (isset($_SESSION['message']) && isset($_SESSION['error']) &&
                $_SESSION['error'] == "danger"): ?>

        <div class="alert alert-<?= $_SESSION['error'] ?>" role="alert">
          <i class="far fa-angry fa-2x"></i>&nbsp;<?= $_SESSION['message']; ?>
        </div>

      <?php unset($_SESSION['message'], $_SESSION['error']); ?>
      <?php endif; ?>

      <?php if (isset($_SESSION['message']) && isset($_SESSION['type']) &&
                $_SESSION['type'] == "success"): ?>

        <div class="alert alert-<?= $_SESSION['type'] ?>" role="alert">
          <i class="far fa-laugh-beam fa-2x"></i></i>&nbsp;<?= $_SESSION['message']; ?>
        </div>

      <?php unset($_SESSION['message'], $_SESSION['type']); ?>
      <?php endif; ?>

      <?php if (isset($_SESSION['messageuser']) && isset($_SESSION['erroruser']) &&
                $_SESSION['erroruser'] == "danger"): ?>

        <div class="alert alert-<?= $_SESSION['erroruser'] ?>" role="alert">
          <i class="far fa-angry fa-2x"></i>&nbsp;<?= $_SESSION['messageuser']; ?>
        </div>

      <?php unset($_SESSION['messageuser'], $_SESSION['erroruser']); ?>
      <?php endif; ?>

      <?php if (isset($_SESSION['messagepass']) && isset($_SESSION['errorpass']) &&
                $_SESSION['errorpass'] == "danger"): ?>

        <div class="alert alert-<?= $_SESSION['errorpass'] ?>" role="alert">
          <i class="far fa-angry fa-2x"></i>&nbsp;<?= $_SESSION['messagepass']; ?>
        </div>

      <?php unset($_SESSION['messagepass'], $_SESSION['errorpass']); ?>
      <?php endif; ?>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3">
      &nbsp;
    </div>
  </div>
  <form class="form-horizontal" action="<?= URL; ?>home/registro" method="post" autocomplete="off" id="formusers" name="form-users">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-4">
        <p>&nbsp;</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
          <label for="User">Usuario</label>
        </div>
        <div class="fom-group">
          <input type="text" name="usuario" id="User" autofocus="true" placeholder="Ingrese un Nombre de Usuario" class="form-control input" required="true">
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4">
        <p>&nbsp;</p>
      </div>
    </div>
    <br/>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-4">
        <p>&nbsp;</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
          <label for="Pass">Contraseña</label>
        </div>
        <div class="fom-group">
          <input type="password" name="password" id="Pass" placeholder="Ingrese una Contraseña" class="form-control input" required="true">
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4">
        <p>&nbsp;</p>
      </div>
    </div>
    <br/>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-4">
        <p>&nbsp;</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
          <label for="RepeatPass">Repetir Contraseña</label>
        </div>
        <div class="fom-group">
          <input type="password" name="repeatpass" id="RepeatPass" placeholder="Ingrese de nuevo la contraseña" class="form-control input" required="true" onkeyup="validarPassRepeat()">
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4">
        <p>&nbsp;</p>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-2">
        <p>&nbsp;</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-8">
        <div class="alert alert-danger alert-dismissible ocultar" id="igualpass" role="alert">
          <p class="centrar">
            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
            <strong>Error!</strong>&nbsp;Las contraseñas no coinciden
          </p>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-2">
        <p>&nbsp;</p>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-4">
        <p>&nbsp;</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
          <label for="name">Nombres Completos</label>
        </div>
        <div class="fom-group">
          <input type="text" name="nombres" id="name" placeholder="Ingrese los nombres" class="form-control input" required="true">
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4">
        <p>&nbsp;</p>
      </div>
    </div>
    <br/>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-4">
        <p>&nbsp;</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
          <label for="type">Tipo de Usuario</label>
        </div>
        <div class="fom-group">
          <select class="form-control input" name="tipo" id="type" required="true">
            <option value="">---</option>
            <option value="1">Administrador</option>
            <option value="2">Usuario Regular</option>
          </select>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4">
        <p>&nbsp;</p>
      </div>
    </div>
    <br/>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-5">
        <p>&nbsp;</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-2">
        <input type="submit" name="guardar" value="Registrar" class="btn btn-login" id="registrar">
      </div>
      <div class="col-xs-12 col-sm-12 col-md-5">
        <p>&nbsp;</p>
      </div>
    </div>
  </form>
  <br/>
  <br/>
</div>


<div class="menu">
  <div class="row margin">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <?php require APP . 'view/_templates/logo.php'; ?>

        <a class="nav-item nav-link color" href="<?= URL;  ?>admin/index">Inicio</a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
              <a class="nav-item nav-link" href="<?= URL; ?>admin/newUser">Nuevo Usuario</a>
              <?php if ($_SERVER['REQUEST_URI'] == "/ParkingManagementSystem/admin/ingresoCascos"): ?>
                <strong><a class="nav-item nav-link" href="<?= URL; ?>admin/ingresoMotos">Ingreso de Motos</a></strong>
              <?php endif; ?>
            <a class="nav-item nav-link" href="<?= URL; ?>admin/salidaMotos">Salida de Motos</a>
            <a class="nav-item nav-link" href="<?= URL; ?>admin/reporteUsuarios">Reporte de Usuarios</a>
            <a class="nav-item nav-link" href="<?= URL; ?>admin/ingresosPorFecha">Reporte de ingresos por fecha</a>
            <a class="nav-item nav-link logout" href="<?= URL; ?>home/cerrarSesion">Salir&nbsp;&nbsp;<i class="fas fa-sign-out-alt"></i></a>
          </div>
        </div>

        <div class="dropdown">
          <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user-tie"></i>&nbsp;
             <strong><?= $_SESSION['login']; ?> (<?= ($_SESSION['tipo'] == 1) ? 'Administrador' : 'Usuario Regular' ?>)</strong>&nbsp;
          </a>

          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item logout" href="<?= URL; ?>home/cerrarSesion">Salir&nbsp;&nbsp;<i class="fas fa-sign-out-alt"></i></a>
            <a class="dropdown-item" href="<?= URL; ?>home/configuracionValores"><i class="fas fa-cogs"></i>&nbsp;Configurar Valores</a>
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
      <h2 class="top"><strong>Ingreso de Cascos</strong></h2>
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-3">
      &nbsp;
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
      <?php if (isset($_SESSION['message']) && isset($_SESSION['type']) &&
                $_SESSION['type'] == "success"): ?>

        <div class="alert alert-<?= $_SESSION['type'] ?>" role="alert">
          <i class="far fa-laugh-beam fa-2x"></i>&nbsp;<?= $_SESSION['message']; ?>
        </div>

      <?php unset($_SESSION['message'], $_SESSION['type']); ?>
      <?php endif; ?>

      <?php if (isset($_SESSION['message']) && isset($_SESSION['error']) &&
                $_SESSION['error'] == "danger"): ?>

        <div class="alert alert-<?= $_SESSION['error'] ?>" role="alert">
          <i class="far fa-angry fa-2x"></i>&nbsp;<?= $_SESSION['message']; ?>
        </div>

      <?php unset($_SESSION['message'], $_SESSION['error']); ?>
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
  <form class="form-horizontal" action="<?= URL; ?>home/ingresoCascos" method="post" autocomplete="off">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-4">
        <p>&nbsp;</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
          <label for="Placa">Número de Placa</label>
        </div>
        <div class="fom-group">
          <input type="text" name="placa" id="Placa" autofocus="true" placeholder="Ingrese un número de placa" class="form-control input" required="true" maxlength="6">
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
          <label for="FechaLlegada">Fecha LLegada</label>
        </div>
        <div class="fom-group">
          <input type="input" name="fechalllegada" id="FechaLlegada" value="<?= date('d-m-Y'); ?>" class="form-control input" readonly="true">
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
          <label for="HoraLlegada">Hora Llegada</label>
        </div>
        <div class="fom-group">
          <input type="input" name="horallegada" id="HoraLlegada" value="<?= date('H:i:s') ?>" class="form-control input" readonly="true" >
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
          <label for="UsuarioLlegada">Usuario de Llegada</label>
        </div>
        <div class="fom-group">
          <input type="text" name="usuariollegada" id="UsuarioLlegada" value="<?= $_SESSION['login']; ?>" class="form-control input" readonly="true">
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
          <label for="NumeroCasillero">Número Casillero</label>
        </div>
        <div class="fom-group">
          <select class="form-control input" name="casillero" id="NumeroCasillero" required="true">
            <option value="">-</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
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


<div class="menu">
  <div class="row margin">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <?php require APP . 'view/_templates/logo.php'; ?>

        <a class="nav-item nav-link color" href="<?= URL;  ?>admin/index">Inicio</a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <?php if ($_SERVER['REQUEST_URI'] == "/ParkingManagementSystem/admin/newUser"): ?>
              <strong><a class="nav-item nav-link" href="<?= URL; ?>admin/newUser">Nuevo Usuario</a></strong>
            <?php endif; ?>
            <a class="nav-item nav-link" href="<?= URL; ?>admin/ingresoMotos">Ingreso de Motos</a>
            <a class="nav-item nav-link" href="<?= URL; ?>admin/salidaMotos">Salida de Motos</a>
            <a class="nav-item nav-link" href="<?= URL; ?>admin/reporteUsuarios">Reporte de Usuarios</a>
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
      <h2 class="top"><strong>Configuración de Perfil</strong></h2>
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

      <?php if (isset($_SESSION['messagepass']) && isset($_SESSION['errorpass']) &&
                $_SESSION['errorpass'] == "danger"): ?>

        <div class="alert alert-<?= $_SESSION['errorpass'] ?>" role="alert">
          <i class="far fa-angry fa-2x"></i></i>&nbsp;<?= $_SESSION['messagepass']; ?>
        </div>

      <?php unset($_SESSION['messagepass'], $_SESSION['errorpass']); ?>
      <?php endif; ?>

      <?php if (isset($_SESSION['messageerror']) && isset($_SESSION['error']) &&
                $_SESSION['error'] == "danger"): ?>

        <div class="alert alert-<?= $_SESSION['error'] ?>" role="alert">
          <i class="far fa-angry fa-2x"></i></i>&nbsp;<?= $_SESSION['messageerror']; ?>
        </div>

      <?php unset($_SESSION['messageerror'], $_SESSION['error']); ?>
      <?php endif; ?>

      <?php if (isset($_SESSION['messageuser']) && isset($_SESSION['typeuser']) &&
                $_SESSION['typeuser'] == "success"): ?>

        <div class="alert alert-<?= $_SESSION['typeuser'] ?>" role="alert">
          <i class="far fa-laugh-beam fa-2x"></i></i>&nbsp;<?= $_SESSION['messageuser']; ?>
        </div>

      <?php unset($_SESSION['messageuser'], $_SESSION['typeuser']); ?>
      <?php endif; ?>

      <?php if (isset($_SESSION['message']) && isset($_SESSION['erroruser']) &&
                $_SESSION['erroruser'] == "danger"): ?>

        <div class="alert alert-<?= $_SESSION['erroruser'] ?>" role="alert">
          <i class="far fa-angry fa-2x"></i></i>&nbsp;<?= $_SESSION['message']; ?>
        </div>

      <?php unset($_SESSION['message'], $_SESSION['erroruser']); ?>
      <?php endif; ?>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3">
      &nbsp;
    </div>
  </div>
  <form class="form-horizontal" action="<?= URL; ?>home/ajustesPerfil" method="post" autocomplete="off" id="FormPerfil" name="formperfil">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-4">
        <p>&nbsp;</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
          <label for="UserName">Usuario</label>
        </div>
        <div class="fom-group">
          <input type="text" name="nombreusuario" id="UserName" autofocus="true" value="<?= $datosUsuario[0]['login']; ?>" class="form-control input" required="true">
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
          <label for="Nombres">Nombres Completos</label>
        </div>
        <div class="fom-group">
          <input type="text" name="nombresperfil" id="Nombres" value="<?= $datosUsuario[0]['nombres']; ?>" class="form-control input" required="true">
          <input type="hidden" name="idusuarioperfil" id="IdUsusarioPerfil" value="<?= $_SESSION['id'] ?>" class="form-control input">
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
          <label for="TypeUser">Tipo de Usuario</label>
        </div>
        <div class="fom-group">
          <select class="form-control input" id="TypeUser" name="tipousuario" disabled="true">
            <?php foreach ($datosUsuario as $value): ?>
              <option value="<?= $value['tipo']; ?>" <?= ($value['tipo'] == 1) ? 'selected=selected' : '' ?>>Administrador</option>
              <option value="<?= $value['tipo']; ?>" <?= ($value['tipo'] == 2) ? 'selected=selected' : '' ?>>Usuario Regular</option>
          <?php endforeach; ?>
          </select>
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
        <a href="#" class="updatePass" data-toggle="modal" data-target="#modalActualizarPass">Actualizar Contraseña</a>
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
        <input type="submit" name="guardarperfil" value="Guardar" class="btn btn-login" id="GuardarPerfil">
      </div>
      <div class="col-xs-12 col-sm-12 col-md-5">
        <p>&nbsp;</p>
      </div>
    </div>
  </form>
  <br/>
  <br/>
</div>


<!-- Modal actualización contraseña -->
<div class="modal fade" id="modalActualizarPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" style="overflow-y: scroll;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualización de Contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="javascript: location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="<?= URL; ?>home/actualizacionPassword" method="post" autocomplete="off" name="formactualizacionpass" id="FormUpdatePass">
          <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-2 col-lg-2">
              <p>&nbsp;</p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
              <div class="form-group">
                <label for="NameUser">Usuario</label>
              </div>
              <div class="form-group">
                <input type="text" name="nameuser" class="form-control input" id="NameUser" required="true" value="<?= $_SESSION['login'] ?>" readonly="true">
                <input type="hidden" name="iduser" id="IDUser" value="<?= $_SESSION['id']; ?>" class="form-control input">
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
                <label for="NewPass">Nueva Contraseña</label>
              </div>
              <div class="form-group">
                <input type="password" name="nuevopass" class="form-control input" id="NewPass" required="true" placeholder="Ingrese su contraseña">
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
                <label for="RepetirPass">Repetir Contraseña</label>
              </div>
              <div class="form-group">
                <input type="password" name="repetirpass" class="form-control input" id="RepetirPass" required="true" placeholder="Ingrese de nuevo la contraseña" onkeyup="validarContrasenia()">
              </div>
            </div>
            <div class="col-sm-12 col-xs-12 col-md-2 col-lg-2">
              <p>&nbsp;</p>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
              <p>&nbsp;</p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
              <div class="alert alert-danger alert-dismissible ocultar" id="errorPass" role="alert">
                <p class="centrar">
                  <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                  <strong>Error!</strong>&nbsp;Las contraseñas no coinciden
                </p>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
              <p>&nbsp;</p>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-login" name="guardarnuevapass" id="btnUpdatePass" value="Actualizar">
      </div>
    </form>
    </div>
  </div>
</div>

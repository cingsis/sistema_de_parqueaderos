
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
                <?php if ($_SERVER['REQUEST_URI'] == "/ParkingManagementSystem/admin/salidaMotos"): ?>
                  <strong><a class="nav-item nav-link" href="<?= URL; ?>admin/salidaMotos">Salida de Motos</a></strong>
                <?php endif; ?>
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
      <h2 class="top"><strong>Salida de Motos</strong></h2>
    </div>
  </div>

  <form class="form-horizontal" method="post" autocomplete="off" id="formSalida" name="formsalida">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-1">
        <p>&nbsp;</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="form-group">
          <h3 class="title-search">Búsqueda por Placa</h3>
        </div>
        <div class="form-group">
          <input type="text" name="buscar" placeholder="Ingrese un número de placa" class="form-control input" id="Placa" onkeydown="llamarFuncionBusqeda(event);">
        </div>
        <div class="form-group">
          <button type="button" name="busqueda" class="btn btn-buscar" id="Busqueda" onclick="busquedaPorFiltro()">Buscar</button>
          <!-- <button type="button" name="listartodos" class="btn btn-buscar right" id="listarTodos" onclick="buscarTodos()">Listar Todos</button> -->
          <button type="button" name="refresh" class="btn btn-buscar right" id="Refresh" onclick="actualizarPagina()">Recargar Página</button>
        </div>
      </div>
      <br/>
      <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-1">
            <p>&nbsp;</p>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-10">
            <br/>
            <div class="auto-scroll">
              <table class="table table-striped ocultar" id="info">
                <thead>
                  <tr>
                    <th>Placa</th>
                    <th>Tipo de Vehículo</th>
                    <th>Fecha Llegada</th>
                    <th>Hora Llegada</th>
                  </tr>
                </thead>
                <tbody id="resultado">

                  <div class="alert alert-info alert-dismissible ocultar" id="carga" role="alert">
                    <p class="centrar">
                      <i class="fa fa-spinner fa-spin fa-2x" aria-hidden="true"></i>&nbsp;<span class="text-format-info">Realizando Búsqueda...
                    </p>
                  </div>

                  <div class="alert alert-danger alert-dismissible ocultar" id="campovacio" role="alert">
                    <p class="centrar">
                      <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                      <strong>Error!</strong>&nbsp;Debes ingresar al menos 1 caracter para poder realizar la búsqueda...
                    </p>
                  </div>

                  <div class="alert alert-danger alert-dismissible ocultar" id="noexiste" role="alert">
                    <p class="centrar">
                      <i class="far fa-sad-cry fa-2x" aria-hidden="true"></i>&nbsp;
                      <strong>Error!</strong>&nbsp;No se encontrarón datos con la información proporcionada, por favor ingrese otra placa...!
                    </p>
                  </div>

                </tbody>
              </table>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-1">
            <p>&nbsp;</p>
          </div>
        </div>
      </div>
    </div>
  </form>

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
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3">
      &nbsp;
    </div>
  </div>

  <form class="form-horizontal" method="post" autocomplete="off" name="registrosalida" id="RegistroSalida">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-2">
        <p>&nbsp;</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <div class="form-group">
          <label for="numeroPlaca">Placa</label>
        </div>
        <div class="form-group">
          <input type="text" name="numeroplaca" value="" id="numeroPlaca" class="form-control input font-white" readonly="true">
          <input type="hidden" name="id" value="" id="Id" class="form-control input font-white">
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-2">
        <p>&nbsp;</p>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-2">
        <p>&nbsp;</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <div class="form-group">
          <label for="TipoVeh">Tipo</label>
        </div>
        <div class="form-group">
          <input type="text" name="tipovehiculo" value="" id="TipoVeh" class="form-control input font-white" readonly="true">
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-2">
        <p>&nbsp;</p>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-2">
        <p>&nbsp;</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <div class="form-group">
          <label for="FechaSalida">Fecha Salida</label>
        </div>
        <div class="form-group">
          <input type="text" name="fechasalida" value="" id="FechaSalida" class="form-control input font-white" readonly="true">
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-2">
        <p>&nbsp;</p>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-2">
        <p>&nbsp;</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <div class="form-group">
          <label for="HoraSalida">Hora Salida</label>
        </div>
        <div class="form-group">
          <input type="text" name="horasalida" value="" id="HoraSalida" class="form-control input font-white" readonly="true">
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-2">
        <p>&nbsp;</p>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-2">
        <p>&nbsp;</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <div class="form-group">
          <label for="DiasTranscurridos">Días Transcurridos</label>
        </div>
        <div class="form-group">
          <input type="text" name="diastranscurridos" value="" id="DiasTranscurridos" class="form-control input font-white" readonly="true">
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-2">
        <p>&nbsp;</p>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-2">
        <p>&nbsp;</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <div class="form-group">
          <label for="Transcurrido">Tiempo Transcurrido</label>
        </div>
        <div class="form-group">
          <input type="text" name="transcurrido" value="" id="Transcurrido" class="form-control input font-white" readonly="true">
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-2">
        <p>&nbsp;</p>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-2">
        <p>&nbsp;</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <div class="form-group">
          <label for="ValorCobro">Valor Cobro</label>
        </div>
        <div class="form-group">
          <input type="text" name="valorcobro" value="" id="ValorCobro" class="form-control input font-white" readonly="true">
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-2">
        <p>&nbsp;</p>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-2">
        <p>&nbsp;</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <div class="form-group">
          <label for="UsuarioSalida">Usuario</label>
        </div>
        <div class="form-group">
          <input type="text" name="usuarioactual" value="<?= ucwords($_SESSION['login']); ?>" id="UsuarioSalida" class="form-control input font-white" readonly="true">
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-2">
        <p>&nbsp;</p>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
        <p>&nbsp;</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
        <div class="alert alert-danger alert-dismissible ocultar" id="errorvacios" role="alert">
          <p class="centrar">
            <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
            <strong>Error!</strong>&nbsp;Debes llenar todos los campos para proceder con el registro...
          </p>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
        <p>&nbsp;</p>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-2">
        <p>&nbsp;</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 text-center">
        <div class="form-group">
          <input type="button" name="guardar" value="Registrar" class="btn btn-login" id="registrarSalida" onclick="guardarSalida()">
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-2">
        <p>&nbsp;</p>
      </div>
    </div>

  </form>
  <br/>
  <br/>
</div>

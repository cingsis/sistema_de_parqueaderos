
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
            <a class="nav-item nav-link logout" href="<?= URL; ?>home/cerrarSesion">Salir&nbsp;&nbsp;<i class="fas fa-sign-out-alt"></i></a>
          </div>
        </div>
          <?php require APP . 'view/_templates/perfil.php'; ?>
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
  <br/>

  <form class="form-horizontal" action="#" method="post" autocomplete="off" id="formSalida" name="formsalida">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-1">
        <p>&nbsp;</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="form-group">
          <h3 class="title-search">Búsqueda por Placa</h3>
        </div>
        <div class="form-group">
          <input type="text" name="buscar" placeholder="Ingrese un número de placa" class="form-control input" id="Placa">
        </div>
        <div class="form-group">
          <button type="button" name="busqueda" class="btn btn-buscar" id="buscar" onclick="busquedaPorFiltro()">Buscar</button>
          <!-- <button type="button" name="listartodos" class="btn btn-buscar right" id="listarTodos" onclick="buscarTodos()">Listar Todos</button> -->
        </div>
      </div>
      <br/>
      <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-1">
            <p>&nbsp;</p>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-10">
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

              </tbody>
            </table>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-1">
            <p>&nbsp;</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
        <p>&nbsp;</p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">

        <div class="alert alert-info alert-dismissible ocultar" id="carga" role="alert">
          <p class="centrar">
            <i class="fa fa-spinner fa-spin fa-2x" aria-hidden="true"></i>&nbsp;
            <strong class="info">&nbsp;<span class="text-format-info">Realizando Búsqueda...
          </p>
        </div>

      </div>
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
        <p>&nbsp;</p>
      </div>
    </div>
  </form>

  <div class="row">
    <form class="form-horizontal" action="" method="post" autocomplete="off">

    </form>
    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-2">
      <p>&nbsp;</p>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
      <div class="form-group">
        <label for="numeroPlaca">Placa</label>
      </div>
      <div class="form-group">
        <input type="text" name="numeroplaca" value="" id="numeroPlaca" class="form-control input">
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-2">
      <p>&nbsp;</p>
    </div>
  </div>
  <br/>
  <br/>
</div>

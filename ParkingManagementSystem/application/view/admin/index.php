<?php
$hoy = date('Y-m-d');
$numeroSemana = date("W");
$año = date('Y');
$mes = date('m');
$numerosemana = date("W");

if ($numerosemana > 0 and $numerosemana < 54)
{
  $numerosemana = $numerosemana;
  $primerdiaS = $numerosemana * 7 - 7;
  $ultimodiaS = $numerosemana * 7 - 1;
  $principioaño = "$año-01-01";
  $principiomes = "$año-$mes-01";
  $primerdia = date('Y-m-d', strtotime("$principioaño + $primerdiaS DAY"));
  $ultimodia = date('Y-m-d', strtotime ("$principioaño + $ultimodiaS DAY"));
  $primerdiames = date('Y-m-d', strtotime("$principiomes"));
    // if ($fecha2 <= date('Y-m-d', strtotime("$año-12-31"))) {$fecha2 = $fecha2;} else {$fecha2 = date('Y-m-d',strtotime("$año-12-31"));}
    //echo 'la semana nº '.$numerosemana.' del año '.$año.', va desde '.$primerdia.' hasta '.$ultimodia.'</br>';} else {echo "este número de semana no es válido";
  }

//hasta aqui

?>

<div class="menu">
  <div class="row margin">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <?php require APP . 'view/_templates/logo.php'; ?>

          <?php if ($_SERVER['REQUEST_URI'] == "/ParkingManagementSystem/admin/index"): ?>
            <strong><a class="nav-item nav-link color" href="<?= URL;  ?>admin/index">Inicio</a></strong>
          <?php endif; ?>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link" href="<?= URL; ?>admin/newUser">Nuevo Usuario</a>
            <a class="nav-item nav-link" href="<?= URL; ?>admin/ingresoMotos">Ingreso de Motos</a>
            <a class="nav-item nav-link" href="<?= URL; ?>admin/salidaMotos">Salida de Motos</a>
            <a class="nav-item nav-link" href="<?= URL; ?>admin/reporteUsuarios">Reporte Usuarios</a>
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

<div class="container body">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-3">
      &nbsp;
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 top">
      <?php if (isset($_SESSION['message']) && isset($_SESSION['type']) &&
                $_SESSION['type'] == "success"): ?>

        <div class="alert alert-<?= $_SESSION['type'] ?>" role="alert">
          <i class="far fa-laugh-beam fa-2x"></i>&nbsp;<?= $_SESSION['message']; ?>
        </div>

      <?php unset($_SESSION['message'], $_SESSION['type']); ?>
      <?php endif; ?>

      <?php if (isset($_SESSION['message']) && isset($_SESSION['type']) &&
                $_SESSION['type'] == "danger"): ?>

        <div class="alert alert-<?= $_SESSION['type'] ?>" role="alert">
          <i class="far fa-angry fa-2x"></i>&nbsp;<?= $_SESSION['message']; ?>
        </div>

      <?php unset($_SESSION['message'], $_SESSION['type']); ?>
      <?php endif; ?>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3">
      &nbsp;
    </div>
  </div>

  <div class="row text-center top">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <h2 class="top"><strong>Reporte Diario</strong></h2>
      <h3><?= date("Y-m-d"); ?></h3>
    </div>
  </div>
  <div class="row text-center">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <table class="table table-striped" id="ingresosdia">
        <thead class="thead-dark">
          <tr>
            <th>Placa</th>
            <th>Tipo de Vehículo</th>
            <th>Fecha Llegada</th>
            <th>Hora Llegada</th>
            <th>Fecha Salida</th>
            <th>Hora Salida</th>
            <th>Tiempo Transcurrido</th>
            <th>Valor</th>
            <th>Tipo de Cobro</th>
            <th>Cliente</th>
            <th>Tiene Casco</th>
            <th>Fecha Registro</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($ingresosDiarios as $value): ?>
          <tr>
            <td><?= $value['placa']; ?></td>
            <td><?= $value['tipo']; ?></td>
            <td><?= $value['fecha_llegada']; ?></td>
            <td><?= $value['hora_llegada']; ?></td>
            <td><?= $value['fecha_salida']; ?></td>
            <td><?= $value['hora_salida']; ?></td>
            <td><?= $value['transcurrido']; ?></td>
            <td><?= $value['valor_cobro']; ?></td>
            <td><?= $value['tipo_cobro']; ?></td>
            <td><?= $value['cliente']; ?></td>
            <td><?= $value['tiene_casco']; ?></td>
            <td><?= $value['fecha_registro']; ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-xs-12-col-sm-12 col-md-12 col-lg-12">
      <strong>Total Día: <?= count($ingresosDiarios); ?></strong>
    </div>
  </div>
  <div class="row text-center top">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <h2 class="top"><strong>Reporte Semanal</strong></h2>
      <h3>Desde <?php echo $primerdia; ?> hasta <?php echo $hoy; ?></strong></h3>
    </div>
  </div>
  <div class="row text-center">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <table class="table table-striped" id="ingresossemanales">
        <thead class="thead-dark">
          <tr>
            <th>Placa</th>
            <th>Tipo de Vehículo</th>
            <th>Fecha Llegada</th>
            <th>Hora Llegada</th>
            <th>Fecha Salida</th>
            <th>Hora Salida</th>
            <th>Tiempo Transcurrido</th>
            <th>Valor</th>
            <th>Tipo de Cobro</th>
            <th>Cliente</th>
            <th>Tiene Casco</th>
            <th>Fecha Registro</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($ingresosSemanales as $val): ?>
            <tr>
              <td><?= $val['placa']; ?></td>
              <td><?= $val['tipo']; ?></td>
              <td><?= $val['fecha_llegada']; ?></td>
              <td><?= $val['hora_llegada']; ?></td>
              <td><?= $val['fecha_salida']; ?></td>
              <td><?= $val['hora_salida']; ?></td>
              <td><?= $val['transcurrido']; ?></td>
              <td><?= $val['valor_cobro']; ?></td>
              <td><?= $val['tipo_cobro']; ?></td>
              <td><?= $val['cliente']; ?></td>
              <td><?= $val['tiene_casco']; ?></td>
              <td><?= $val['fecha_registro']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  </div>
  <br/>
  <div class="row">
    <div class="col-xs-12-cl-sm-12 col-md-5">
      <strong>Total Semana: <?= count($ingresosSemanales); ?></strong>
    </div>
  </div>
  <div class="row text-center top">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <h2 class="top"><strong>Reporte Mensual</strong></h2>
      <h3>Desde <?php echo $primerdiames; ?> hasta <?php echo $hoy; ?></strong></h3>
    </div>
  </div>
  <div class="row text-center">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <table class="table table-striped" id="registrosmensuales">
        <thead class="thead-dark">
          <tr>
            <th>Placa</th>
            <th>Tipo de Vehículo</th>
            <th>Fecha Llegada</th>
            <th>Hora Llegada</th>
            <th>Fecha Salida</th>
            <th>Hora Salida</th>
            <th>Tiempo Transcurrido</th>
            <th>Valor</th>
            <th>Tipo de Cobro</th>
            <th>Cliente</th>
            <th>Tiene Casco</th>
            <th>Fecha Registro</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($registrosMensuales as $mes): ?>
            <tr>
              <td><?= $mes['placa']; ?></td>
              <td><?= $mes['tipo']; ?></td>
              <td><?= $mes['fecha_llegada']; ?></td>
              <td><?= $mes['hora_llegada']; ?></td>
              <td><?= $mes['fecha_salida']; ?></td>
              <td><?= $mes['hora_salida']; ?></td>
              <td><?= $mes['transcurrido']; ?></td>
              <td><?= $mes['valor_cobro']; ?></td>
              <td><?= $mes['tipo_cobro']; ?></td>
              <td><?= $mes['cliente']; ?></td>
              <td><?= $mes['tiene_casco']; ?></td>
              <td><?= $mes['fecha_registro']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-xs-12-cl-sm-12 col-md-5">
      <strong>Total Mes: <?= count($registrosMensuales); ?></strong>
    </div>
  </div>

  <div class="row text-center top">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <h2 class="top"><strong>Reporte Anual</strong></h2>
        <h3>Desde <?php echo $principioaño; ?> hasta <?php echo $hoy; ?></strong></h3>
    </div>
  </div>

  <div class="row text-center">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <table class="table table-striped" id="registrosanuales">
        <thead class="thead-dark">
          <tr>
            <th>Placa</th>
            <th>Tipo de Vehículo</th>
            <th>Fecha Llegada</th>
            <th>Hora Llegada</th>
            <th>Fecha Salida</th>
            <th>Hora Salida</th>
            <th>Tiempo Transcurrido</th>
            <th>Valor</th>
            <th>Tipo de Cobro</th>
            <th>Cliente</th>
            <th>Tiene Casco</th>
            <th>Fecha Registro</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($registrosAnuales as $anio): ?>
            <tr>
              <td><?= $anio['placa']; ?></td>
              <td><?= $anio['tipo']; ?></td>
              <td><?= $anio['fecha_llegada']; ?></td>
              <td><?= $anio['hora_llegada']; ?></td>
              <td><?= $anio['fecha_salida']; ?></td>
              <td><?= $anio['hora_salida']; ?></td>
              <td><?= $anio['transcurrido']; ?></td>
              <td><?= $anio['valor_cobro']; ?></td>
              <td><?= $anio['tipo_cobro']; ?></td>
              <td><?= $anio['cliente']; ?></td>
              <td><?= $anio['tiene_casco']; ?></td>
              <td><?= $anio['fecha_registro']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12-cl-sm-12 col-md-5">
      <strong>Total Año: <?= count($registrosAnuales); ?></strong>
    </div>
  </div>
  <br/>
  <br/>
</div>

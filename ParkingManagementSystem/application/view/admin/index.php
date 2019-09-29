<?php
  $hoy = date('d/m/Y');
  $numeroSemana = date("W");

//		echo $hoy, '   ' ,$numeroSemana;

//aqui meto yo
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
    $primerdia = date('d/m/Y', strtotime("$principioaño + $primerdiaS DAY"));
    $ultimodia = date('d/m/Y', strtotime ("$principioaño + $ultimodiaS DAY"));
    $primerdiames = date('d/m/Y', strtotime("$principiomes"));
    // if ($fecha2 <= date('Y-m-d', strtotime("$año-12-31"))) {$fecha2 = $fecha2;} else {$fecha2 = date('Y-m-d',strtotime("$año-12-31"));}
    //echo 'la semana nº '.$numerosemana.' del año '.$año.', va desde '.$primerdia.' hasta '.$ultimodia.'</br>';} else {echo "este número de semana no es válido";
  }

//hasta aqui

?>

<div class="menu">
  <div class="row margin">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <?php if ($_SERVER['REQUEST_URI'] == "/ParkingManagementSystem/admin/index"): ?>
          <strong><a class="navbar-brand" href="<?= URL;  ?>admin/index">Inicio</a></strong>
        <?php endif; ?>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link" href="<?= URL; ?>admin/newUser">Nuevo Usuario</a>
            <a class="nav-item nav-link" href="<?= URL; ?>admin/ingresoMotos">Ingreso de Motos</a>
            <a class="nav-item nav-link" href="<?= URL; ?>admin/salidaMotos">Salida de Motos</a>
            <a class="nav-item nav-link" href="<?= URL; ?>admin/reporteUsuarios">Reporte Usuarios</a>
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
      <h2 class="top"><strong>Reporte Diario</strong></h2>
      <h3><?= date("d/m/Y"); ?></h3>
    </div>
  </div>
  <br/>
  <br/>
  <div class="row text-center">
    <div class="col-xs-12 col-sm-12 col-md-2">
      <p>&nbsp;</p>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8">
      <table class="table table-striped">
        <thead class="thead-dark">
          <th>Id</th>
          <th>Placa</th>
          <th>Tipo</th>
          <th>Fecha Llegada</th>
          <th>Hora Llegada</th>
          <th>Fecha Salida</th>
          <th>Hora Salida</th>
          <th>Tiempo Transcurrido</th>
          <th>Valor</th>
          <th>Cliente</th>
        </thead>
        <tbody>
          <td>id</td>
          <td>tipo</td>
          <td>placa</td>
          <td>fecha</td>
          <td>hora</td>
          <td>fecha</td>
          <td>hora</td>
          <td>tiempo</td>
          <td>valor</td>
          <td>cliente</td>
        </tbody>
      </table>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-2">
      <p>&nbsp;</p>
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-2">
      <p>&nbsp;</p>
    </div>
    <div class="col-xs-12-cl-sm-12 col-md-5">
      <strong>Total Día: </strong>
    </div>
  </div>
  <div class="row text-center top">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <h2 class="top"><strong>Reporte Semanal</strong></h2>
      <h3>Desde <?php echo $primerdia; ?> hasta <?php echo $hoy; ?></strong></h3>
    </div>
  </div>
  <div class="row text-center">
    <div class="col-xs-12 col-sm-12 col-md-2">
      <p>&nbsp;</p>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8">
      <table class="table table-striped">
        <thead class="thead-dark">
          <th>Id</th>
          <th>Placa</th>
          <th>Tipo</th>
          <th>Fecha Llegada</th>
          <th>Hora Llegada</th>
          <th>Fecha Salida</th>
          <th>Hora Salida</th>
          <th>Tiempo Transcurrido</th>
          <th>Valor</th>
          <th>Cliente</th>
        </thead>
        <tbody>
          <td>id</td>
          <td>tipo</td>
          <td>placa</td>
          <td>fecha</td>
          <td>hora</td>
          <td>fecha</td>
          <td>hora</td>
          <td>tiempo</td>
          <td>valor</td>
          <td>cliente</td>
        </tbody>
      </table>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-2">
      <p>&nbsp;</p>
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-2">
      <p>&nbsp;</p>
    </div>
    <div class="col-xs-12-cl-sm-12 col-md-5">
      <strong>Total Semana: </strong>
    </div>
  </div>
  <div class="row text-center top">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <h2 class="top"><strong>Reporte Mensual</strong></h2>
      <h3>Desde <?php echo $primerdiames; ?> hasta <?php echo $hoy; ?></strong></h3>
    </div>
  </div>
  <div class="row text-center">
    <div class="col-xs-12 col-sm-12 col-md-2">
      <p>&nbsp;</p>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8">
      <table class="table table-striped">
        <thead class="thead-dark">
          <th>Id</th>
          <th>Placa</th>
          <th>Tipo</th>
          <th>Fecha Llegada</th>
          <th>Hora Llegada</th>
          <th>Fecha Salida</th>
          <th>Hora Salida</th>
          <th>Tiempo Transcurrido</th>
          <th>Valor</th>
          <th>Cliente</th>
        </thead>
        <tbody>
          <td>id</td>
          <td>tipo</td>
          <td>placa</td>
          <td>fecha</td>
          <td>hora</td>
          <td>fecha</td>
          <td>hora</td>
          <td>tiempo</td>
          <td>valor</td>
          <td>cliente</td>
        </tbody>
      </table>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-2">
      <p>&nbsp;</p>
    </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-2">
      <p>&nbsp;</p>
    </div>
    <div class="col-xs-12-cl-sm-12 col-md-5">
      <strong>Total Mes: </strong>
    </div>
  </div>
</div>

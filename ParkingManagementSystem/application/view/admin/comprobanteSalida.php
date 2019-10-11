<html>
<head>
<style media="screen">
  table{
    width: 100%;
  }
</style>
  <link href="<?php echo URL?>css/Estilos.css" rel="stylesheet">
  <link href="<?php echo URL?>css/bootstrap.min.css" rel="stylesheet">
  <title>Comprobante de Salida</title>
</head>
<body>

  <h2 style="text-align: center">
    <img src="<?= URL; ?>logo/logo.png" alt="Imagen no encontrada" class="logoComprobante"></img>
  </h2>
  <div id="reciboVenta">
    <p><strong>Nit:</strong> 1.037.623.609-4</p>
    <p><strong>Parqueadero de Motos la 82</strong></p>
    <p><strong>Teléfono:</strong> 342 29 66</p>
    <p>Cra. 82 N° 30A – 26-76, Medellín</p>
    <p>Régimen Simplificado</p>
  </div>
  <div class="center">
    <p>Comprobante de salida número: <strong><?= $value['id'] ?></strong></p>
    <p><strong>Fecha Llegada:</strong> <?= $value['fecha_llegada'];?></p>
    <p><strong>Hora Llegada:</strong> <?= $value['hora_llegada']; ?></p>
    <p>Salida atendida por: <strong><?= ucwords($value['usuario_llegada']);?></strong></p>
  </div>
  </br>
  <hr>
  <center><legend><h4>DETALLES</h4></legend></center>
  <br>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Número de Placa</th>
        <th>Fecha Salida</th>
        <th>Hora Salida</th>
        <th>Tiempo Transcurrido</th>
      </tr>
    </thead>
    <tbody class="background">
      <?= $tabla ?>
    </tbody>
  </table>
  <hr>
  <p>Total a Cobrar: <strong>$ <?= number_format($value['valor_cobro'], "0", ",", "."); ?></strong></p>
  <br>
    <p style="text-align: center"><strong>Gracias por preferirnos</strong></p>
    <script src="<?php echo URL ?>js/bootstrap.min.js"></script>
</body>
</html>

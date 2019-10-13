<html>
<head>
<style media="screen">
  table{
    width: 100%;
  }
</style>
  <link href="<?php echo URL?>css/Estilos.css" rel="stylesheet">
  <link href="<?php echo URL?>css/bootstrap.min.css" rel="stylesheet">
  <title>Comprobante de Ingreso</title>
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
    <p>Comprobante de ingreso número: <strong><?= $value['id'] ?></strong></p>
    <p><strong>Fecha Llegada:</strong> <?= $value['fecha_llegada'];?></p>
    <p><strong>Hora Llegada:</strong> <?= $value['hora_llegada']; ?></p>
    <p>Atendido por: <strong><?= ucwords($value['usuario_llegada']);?></strong></p>
  </div>
  <hr>
  </br>
  <center><legend><h4>DETALLES</h4></legend></center>
  <br>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Número de Placa</th>
        <th>Tiene Casco</th>
        <th>Tipo Cobro</th>
      </tr>
    </thead>
    <tbody class="background">
      <?= $tabla ?>
    </tbody>
  </table>
  <hr>
  <br>
  <h4>Estacionamiento Vehicular por día y noche</h4>
  <p>
    <ol>
      <li>
        <strong>Responsabilidad</strong>
      </li>
      <p align="justify">De conformidad con la facultad que confiere el artículo 1604 del código civil,
        las partes acuerdan que el aparcadero "sólo responderá por los daños producidos por
        destrucción o deterioro del vehículo en caso de culpa grave de los dependientes del aparcadero,
        probado por el usuario".
      </p>
      <li>
        <strong>El aparcadero no es responsable de:</strong>
      </li>
      <p align="justify">
        Objetos, accesorios, contenidos y cargas dejadas en el vehículo.
      </p>
      <li>
        <p>La modalidad de cobro estará de acuerdo con el decreto 227 de Febrero
                  de 1993 de la Alcaldía de Medellín.</p>
      </li>
      <li>
        <strong>El aparcadero podrá:</strong>
      </li>
      <p align="justify">
        <ol type="a">
          <li>
            Retener el vehículo para garantizar el pago  de los daños causados con este a personas, a otros
            hevículos o a bienes del aparcadero.
          </li>
          <li>Movilizar el vehículo cuando las circunstancias así lo exijan o cuando
              el vehículo se encuentre mal estacionado en zonas no pemitidas.
          </li>
          <li>
            Exigir en caso de los literales <b>a</b> y <b>b</b>, que le sean pagadas las expensas
            que el parqueadero haya sufragado, o para la conservación del vehículo sopenza de
            retenerlo, hasta que se le efectue el pago de los mismos.
          </li>
        </ol>
      </p>
      <br/>
      <li>
        <ol type="a">
          <li>
            <p align="justify">Dejar el vehículo en el aparcamiento implica aceptar el presente contrato.</p>
          </li>
          <li>
            Si el usuario no acepta las anteriores condiciones, el aparcadero solicita retirar
            el vehículo y si se negara a hacerlo es claro que el aparcadero se niega a celebrar
            contrato alguno, por lo que los riesgos correrán por cuenta del usuario.
          </li>
        </ol>
      </li>
    </ol>
  </p>
  <p align="justify">
    <strong>El vehículo se entregará solo al portador de este tiquete.</strong>
  </p>
  <br/>
    <p style="text-align: center"><strong>Gracias por preferirnos</strong></p>
    <script src="<?php echo URL ?>js/bootstrap.min.js"></script>
</body>
</html>


<?php

class mdlMovimientos
{
  private $id;
  private $placa;
  private $tipo;
  private $fechaLlegada;
  private $horaLlegada;
  private $usuarioLlegada;
  private $fechaSalida;
  private $horaSalida;
  private $usuarioSalida;
  private $transcurrido;
  private $valorCobro;
  private $tipoCobro;
  private $cliente;
  private $tieneCasco;
  private $fechaRegistro;
  private $estadoSalida;
  private $db;

  public function __SET($attr, $valor)
  {
    $this->$attr = $valor;
  }

  public function __GET($attr)
  {
    return $this->$attr;
  }

  public function __construct($db)
  {
    try {
      $this->db = $db;
    } catch (PDOException $e) {
      exit('Cannot connected DB');
    }
  }

  public function guardarIngreso()
  {
    $sql = "CAll SP_guardarIngreso(?, ?, ?, ?, ?, ?, ?)";
    try {
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $this->placa);
      $stm->bindParam(2, $this->tipo);
      $stm->bindParam(3, $this->fechaLlegada);
      $stm->bindParam(4, $this->horaLlegada);
      $stm->bindParam(5, $this->usuarioLlegada);
      $stm->bindParam(6, $this->tipoCobro);
      $stm->bindParam(7, $this->tieneCasco);
      return $stm->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function listarIngresosDiarios()
  {
    $sql = "CALL  SP_listarIngresosDiarios(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->fechaLlegada);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }

  public function listarIngresosSemanales()
  {
    $sql = "CALL  SP_listarIngresosSemanales(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->fechaLlegada);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }

  public function listarIngresosMensuales()
  {
    $sql = "CALL  SP_listarIngresosMensuales(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->fechaLlegada);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }

  public function buscarPlaca()
  {
    $sql = "CALL  SP_buscarPlaca(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->placa);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }

  public function buscarTodos()
  {
    $sql = "CALL  SP_buscarTodos()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }

  public function ultimoId()
  {
    $sql = "CALL  SP_ultimoId()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }

  public function registrarSalida()
  {
    $sql = "CAll SP_registrarSalida(?, ?, ?, ?, ?, ?, ?, ?)";
    try {
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $this->tipo);
      $stm->bindParam(2, $this->fechaSalida);
      $stm->bindParam(3, $this->horaSalida);
      $stm->bindParam(4, $this->transcurrido);
      $stm->bindParam(5, $this->valorCobro);
      $stm->bindParam(6, $this->usuarioSalida);
      $stm->bindParam(7, $this->estadoSalida);
      $stm->bindParam(8, $this->id);
      return $stm->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function traerDetalleRegistroEntrada()
  {
    $sql = "CAll SP_traerDetalleRegistroEntrada(?)";
    try {
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $this->id);
      $stm->execute();
      return $stm->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function traerDetalleRegistroSalida()
  {
    $sql = "CAll SP_traerDetalleRegistroSalida(?)";
    try {
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $this->id);
      $stm->execute();
      return $stm->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

}
?>

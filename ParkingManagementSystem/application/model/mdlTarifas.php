
<?php

class mdlTarifas
{
  private $id;
  private $tipo;
  private $tiempo;
  private $valorHora;
  private $valorAdicional;
  private $valor2;
  private $valorDia;
  private $valorMensualidad;
  private $descuento;
  private $aplicaDescuento;
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

  public function listarTarifas()
  {
    $sql = "CALL  SP_listarTarifas()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }

  public function actualizarTarifas()
  {
    $sql = "CAll SP_actualizarTarifas(?, ?, ?, ?, ?, ?, ?)";
    try {
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $this->tipo);
      $stm->bindParam(2, $this->valorHora);
      $stm->bindParam(3, $this->valorAdicional);
      $stm->bindParam(4, $this->valor2);
      $stm->bindParam(5, $this->valorDia);
      $stm->bindParam(6, $this->valorMensualidad);
      $stm->bindParam(7, $this->id);
      return $stm->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

}
?>

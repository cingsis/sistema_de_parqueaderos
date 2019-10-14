
<?php

class mdlLogin
{
  private $id;
  private $login;
  private $password;
  private $nombres;
  private $tipo;
  private $estado;
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

  public function consultarUsuarios()
  {
    $sql = "CALL  SP_consultarUsuarios(?, ?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->login);
    $stm->bindParam(2, $this->password);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }

  public function consultarInfoUsuario()
  {
    $sql = "CALL  SP_consultarInfoUsuario(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->id);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }

  public function actualizarContrasenia()
  {
    $sql = "CAll SP_actualizarContrasenia(?, ?)";
    try {
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $this->password);
      $stm->bindParam(2, $this->id);
      return $stm->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function actualizarUsuario()
  {
    $sql = "CAll SP_actualizarUsuario(?, ?, ?)";
    try {
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $this->login);
      $stm->bindParam(2, $this->nombres);
      $stm->bindParam(3, $this->id);
      return $stm->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

}
?>

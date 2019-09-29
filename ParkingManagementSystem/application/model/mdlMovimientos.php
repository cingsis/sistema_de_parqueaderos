
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

}
 ?>

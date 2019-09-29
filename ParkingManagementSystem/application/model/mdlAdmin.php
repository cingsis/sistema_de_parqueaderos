
<?php

    class mdlAdmin
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

      public function guardarUsuario()
      {
        $sql = "CAll SP_guardarUsuario(?, ?, ?, ?, ?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->login);
          $stm->bindParam(2, $this->password);
          $stm->bindParam(3, $this->nombres);
          $stm->bindParam(4, $this->tipo);
          $stm->bindParam(5, $this->estado);
          return $stm->execute();
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
      }

      public function listarUsuarios()
      {
        $sql = "CALL  SP_listarUsuarios()";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
      }

      public function cambiarEstadoUsuario()
      {
        $sql = "CAll SP_cambiarEstadoUsuario(?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->id);
          return $stm->execute();
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
      }
    }
 ?>

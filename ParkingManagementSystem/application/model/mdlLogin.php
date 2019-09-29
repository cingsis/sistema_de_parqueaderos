
<?php

    class mdlLogin
    {
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

    }
 ?>

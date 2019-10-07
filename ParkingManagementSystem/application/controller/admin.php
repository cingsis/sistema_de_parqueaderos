<?php

class Admin extends Controller
{
  private $mdlLogin;
  private $mdlAdmin;
  private $mdlMovimientos;

  public function __construct()
  {
    $this->mdlLogin = $this->LoadModel('mdlLogin');
    $this->mdlAdmin = $this->LoadModel('mdlAdmin');
    $this->mdlMovimientos = $this->LoadModel('mdlMovimientos');
  }

  private function Encrypt($string)
  {
    $sizeof = strlen($string) - 1;
    $result = '';
    for ($x = $sizeof; $x >= 0; $x--)
    {
      $result .= $string[$x];
    }
    $result = sha1($result);
    return $result;
  }

  public function index()
  {
    if (isset($_SESSION['SESION_INICIADA']) && $_SESSION['SESION_INICIADA'] == TRUE)
    {
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
      }

      $this->mdlMovimientos->__SET("fechaLlegada", $hoy);
      $ingresosDiarios =  $this->mdlMovimientos->listarIngresosDiarios();

      $this->mdlMovimientos->__SET("fechaLlegada", $primerdia);
      $ingresosSemanales =  $this->mdlMovimientos->listarIngresosSemanales();

      $this->mdlMovimientos->__SET("fechaLlegada", $primerdiames);
      $registrosMensuales = $this->mdlMovimientos->listarIngresosMensuales();

      require APP . 'view/_templates/header.php';
      require APP . 'view/admin/index.php';
      require APP . 'view/_templates/footer.php';
    }
    else
    {
      header("Location: " . URL . "home/index");
      exit;
    }
  }

  public function newUser()
  {
    if (isset($_SESSION['SESION_INICIADA']) && $_SESSION['SESION_INICIADA'] == TRUE)
    {
      require APP . 'view/_templates/header.php';
      require APP . 'view/admin/newUser.php';
      require APP . 'view/_templates/footer.php';
    }
    else
    {
      header("Location: " . URL . "home/index");
      exit;
    }
  }

  public function ingresosPorFecha()
  {
    if (isset($_SESSION['SESION_INICIADA']) && $_SESSION['SESION_INICIADA'] == TRUE)
    {
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
      }

      $this->mdlMovimientos->__SET("fechaLlegada", $hoy);
      $ingresosDiarios =  $this->mdlMovimientos->listarIngresosDiarios();

      $this->mdlMovimientos->__SET("fechaLlegada", $primerdia);
      $ingresosSemanales =  $this->mdlMovimientos->listarIngresosSemanales();

      $this->mdlMovimientos->__SET("fechaLlegada", $primerdiames);
      $registrosMensuales = $this->mdlMovimientos->listarIngresosMensuales();

      require APP . 'view/_templates/header.php';
      require APP . 'view/admin/ingresosFecha.php';
      require APP . 'view/_templates/footer.php';
    }
    else
    {
      header("Location: " . URL . "home/index");
      exit;
    }
  }

  public function reporteusuarios()
  {
    if (isset($_SESSION['SESION_INICIADA']) && $_SESSION['SESION_INICIADA'] == TRUE)
    {
      $usuarios = $this->mdlAdmin->listarUsuarios();

      require APP . 'view/_templates/header.php';
      require APP . 'view/admin/reporteUsuarios.php';
      require APP . 'view/_templates/footer.php';
    }
    else
    {
      header("Location: " . URL . "home/index");
      exit;
    }
  }

  public function cambiarEstado()
  {
    if (isset($_SESSION['SESION_INICIADA']) && $_SESSION['SESION_INICIADA'] == TRUE)
    {
      $idUser = $_POST['id'];

      $this->mdlAdmin->__SET("id", $idUser);
      $status = $this->mdlAdmin->cambiarEstadoUsuario();

      if ($status)
      {
        echo 1;
      }
    }
    else
    {
      header("Location: " . URL . "home/index");
      exit;
    }
  }

  public function ingresoMotos()
  {
    if (isset($_SESSION['SESION_INICIADA']) && $_SESSION['SESION_INICIADA'] == TRUE)
    {
      require APP . 'view/_templates/header.php';
      require APP . 'view/admin/ingresoMotos.php';
      require APP . 'view/_templates/footer.php';
    }
    else
    {
      header("Location: " . URL . "home/index");
      exit;
    }
  }

  public function ingresoCascos()
  {
    if (isset($_SESSION['SESION_INICIADA']) && $_SESSION['SESION_INICIADA'] == TRUE)
    {
      require APP . 'view/_templates/header.php';
      require APP . 'view/admin/ingresoCascos.php';
      require APP . 'view/_templates/footer.php';
    }
    else
    {
      header("Location: " . URL . "home/index");
      exit;
    }
  }

  public function salidaMotos()
  {
    if (isset($_SESSION['SESION_INICIADA']) && $_SESSION['SESION_INICIADA'] == TRUE)
    {
      require APP . 'view/_templates/header.php';
      require APP . 'view/admin/salidaMotos.php';
      require APP . 'view/_templates/footer.php';
    }
    else
    {
      header("Location: " . URL . "home/index");
      exit;
    }
  }
}

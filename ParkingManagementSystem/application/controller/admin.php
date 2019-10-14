<?php

class Admin extends Controller
{
  private $mdlLogin;
  private $mdlAdmin;
  private $mdlMovimientos;
  private $mdlTarifas;

  public function __construct()
  {
    $this->mdlLogin = $this->LoadModel('mdlLogin');
    $this->mdlAdmin = $this->LoadModel('mdlAdmin');
    $this->mdlMovimientos = $this->LoadModel('mdlMovimientos');
    $this->mdlTarifas = $this->LoadModel('mdlTarifas');
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
      $tarifas =  $this->mdlTarifas->listarTarifas();

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

      $this->mdlMovimientos->__SET("fechaLlegada", $principioaño);
      $registrosAnuales = $this->mdlMovimientos->listarIngresosAnuales();

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

      $this->mdlMovimientos->__SET("fechaLlegada", $principioaño);
      $registrosAnuales = $this->mdlMovimientos->listarIngresosAnuales();

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

  public function registrarSalida()
  {
    if (isset($_SESSION['SESION_INICIADA']) && $_SESSION['SESION_INICIADA'] == TRUE)
    {
        $id = $_POST['id'];
        $placa = $_POST['numeroplaca'];
        $tipo = $_POST['tipovehiculo'];
        $fechaSalida = $_POST['fechasalida'];
        $horaSalida = $_POST['horasalida'];
        $dias = $_POST['diastranscurridos'];

        $horas = $_POST['transcurrido'];
        $hora = strtotime($horas);
        $horaConvertida = date('H', $hora);

        $valor = $_POST['valorcobro'];
        $usuario = $_POST['usuarioactual'];
        $estadoSalida = 1;

        $this->mdlMovimientos->__SET("tipo", $tipo);
        $this->mdlMovimientos->__SET("fechaSalida", $fechaSalida);
        $this->mdlMovimientos->__SET("horaSalida", $horaSalida);
        $this->mdlMovimientos->__SET("transcurrido", $dias . " días / " . $horaConvertida  . " horas");
        $this->mdlMovimientos->__SET("valorCobro", $valor);
        $this->mdlMovimientos->__SET("usuarioSalida", $usuario);
        $this->mdlMovimientos->__SET("estadoSalida", (int)$estadoSalida);
        $this->mdlMovimientos->__SET("id", $id);
        $result = $this->mdlMovimientos->registrarSalida();

        if($result)
        {
          echo 1;
        }
        else
        {
          $_SESSION['error'] = "danger";
          $_SESSION['message'] = "Ha ocurrido un error al intentar guardar los datos, por favor inténtelo de nuevo!";

          header("Location: " . URL . "admin/salidaMotos");
          exit;
        }
    }
  }
}

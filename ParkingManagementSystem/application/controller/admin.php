<?php

class Admin extends Controller
{
  private $mdlLogin;
  private $mdlAdmin;

  public function __construct()
  {
    $this->mdlLogin = $this->LoadModel('mdlLogin');
    $this->mdlAdmin = $this->LoadModel('mdlAdmin');
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
}

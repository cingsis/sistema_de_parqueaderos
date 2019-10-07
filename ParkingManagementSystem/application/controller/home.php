<?php

class Home extends Controller
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

  public function notFound()
  {
    require APP . 'view/_templates/header.php';
    require APP . 'view/_templates/404.php';
    require APP . 'view/_templates/footer.php';
  }

  public function index()
  {
    require APP . 'view/_templates/header.php';
    require APP . 'view/home/Login.php';
    require APP . 'view/_templates/footer.php';
  }

  public function validate()
  {
    if (isset($_POST['usuario']) && !empty($_POST['usuario']) &&
        isset($_POST['contrasenia']) && !empty($_POST['contrasenia']))
    {
      $user = $_POST['usuario'];
      $pass = $_POST['contrasenia'];

      $this->mdlLogin->__SET("login", $user);
      $this->mdlLogin->__SET("password", $this->Encrypt($pass));
      $Query = $this->mdlLogin->consultarUsuarios();

      if(count($Query) != 0)
      {
        foreach ($Query as $value)
        {
          if ($user == $value['login'] && $this->Encrypt($pass) == $value['password']
              && $value['tipo'] == 1)
          {
            $_SESSION['SESION_INICIADA'] = TRUE;
      			$_SESSION['id'] = $value['id'];
      			$_SESSION['tipo'] = $value['tipo'];
      			$_SESSION['login'] = $value['login'];
      			$_SESSION['nombres'] = $value['nombres'];
      			setcookie('id', $value['id'], time() + (60 * 60 * 24));
      			setcookie('tipo', $value['tipo'], time() + (60 * 60 * 24));
      			setcookie('nombres', $value['nombres'], time() + (60 * 60 * 24));
      			setcookie('login', $value['login'], time() + (60 * 60 * 24));
      			$date = date('Y-m-j H:i:s');

            header("Location: " . URL . "admin/index");
            exit;
          }

          if ($user === $value['login'] && $this->Encrypt($pass) === $value['password']
              && $value['tipo'] == 2)
          {
            $_SESSION['SESION_INICIADA'] = TRUE;
            $_SESSION['id'] = $value['id'];
      			$_SESSION['tipo'] = $value['tipo'];
      			$_SESSION['login'] = $value['login'];
      			$_SESSION['nombres'] = $value['nombres'];
      			setcookie('id', $value['id'], time() + (60 * 60 * 24));
      			setcookie('tipo', $value['tipo'], time() + (60 * 60 * 24));
      			setcookie('nombres', $value['nombres'], time() + (60 * 60 * 24));
      			setcookie('login', $value['login'], time() + (60 * 60 * 24));
      			$date = date('Y-m-j H:i:s');

            header("Location: " . URL . "employee/index");
            exit;
          }
        }
      }
      else
      {
        $_SESSION['type'] = "danger";
        $_SESSION['message'] = "Los datos ingresados son incorrectos!";
        header("Location: " . URL . "home/index");
        exit;
      }

    }
    else
    {
      header("Location: " . URL . "home/index");
      exit;
    }
  }

  public function cerrarSesion()
  {
    unset($_SESSION['SESION_INICIADA'],$_SESSION['id'],$_SESSION['tipo'],
      $_SESSION['login'],$_SESSION['nombres']);

    session_unset();
    session_destroy();

    header('Location:' . URL . 'home/index');
    exit;
  }

  public function registro()
  {
    if (isset($_SESSION['SESION_INICIADA']) && $_SESSION['SESION_INICIADA'] == TRUE)
    {
      if (isset($_POST['guardar']) && isset($_POST['usuario']) &&
          !empty($_POST['usuario']) && isset($_POST['password']) &&
          !empty($_POST['password']) && isset($_POST['tipo']) &&
          !empty($_POST['tipo']))
      {
        if ($_POST['password'] == $_POST['repeatpass'])
        {
          $user = $_POST['usuario'];
          $pass = $_POST['password'];
          $fullname = $_POST['nombres'];
          $type = $_POST['tipo'];

          $this->mdlAdmin->__SET("login", $user);
          $this->mdlAdmin->__SET("password", $this->Encrypt($pass));
          $this->mdlAdmin->__SET("nombres", $fullname);
          $this->mdlAdmin->__SET("tipo", (int)$type);
          $this->mdlAdmin->__SET("estado", "Activo");

          $Query = $this->mdlAdmin->guardarUsuario();

          if ($Query)
          {
            $_SESSION['type'] = "success";
            $_SESSION['message'] = "El usuario fue creado correctamente!";

            header("Location: " . URL . "admin/newUser");
            exit;
          }
          else
          {
            $_SESSION['erroruser'] = "danger";
            $_SESSION['messageuser'] = "Ha ocurrido un error al intentar guardar los datos, por favor intentelo de nuevo!";

            header("Location: " . URL . "admin/newUser");
            exit;
          }
        }
        else
        {
          $_SESSION['errorpass'] = "danger";
          $_SESSION['messagepass'] = "Las contraseñas ingresadas son diferentes!";

          header("Location: " . URL . "admin/newUser");
          exit;
        }

      }
      else
      {
        $_SESSION['error'] = "danger";
        $_SESSION['message'] = "Debes llenar todos los campos obligatoriamente!";

        header("Location: " . URL . "admin/newUser");
        exit;
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
      if (isset($_POST['guardar']))
      {
        $placa = $_POST['placa'];
        $tipo = "Moto";
        $fechallegada = $_POST['fechalllegada'];
        $horallegada = $_POST['horallegada'];
        $usuariollegada = $_POST['usuariollegada'];
        $tipoCobro = $_POST['tipocobro'];
        $casco = $_POST['casco'];

        $this->mdlMovimientos->__SET("placa", $placa);
        $this->mdlMovimientos->__SET("tipo", $tipo);
        $this->mdlMovimientos->__SET("fechaLlegada", $fechallegada);
        $this->mdlMovimientos->__SET("horaLlegada", $horallegada);
        $this->mdlMovimientos->__SET("usuarioLlegada", $usuariollegada);
        $this->mdlMovimientos->__SET("tipoCobro", $tipoCobro);
        $this->mdlMovimientos->__SET("tieneCasco", $casco);

        if ($casco == "si")
        {
          $resgistroIngreso = $this->mdlMovimientos->guardarIngreso();

          if ($resgistroIngreso)
          {
            $_SESSION['type'] = "success";
            $_SESSION['message'] = "Registro guardado correctamente!";

            header("Location: " . URL . "admin/ingresoCascos");
            exit;
          }
          else
          {
            $_SESSION['error'] = "danger";
            $_SESSION['message'] = "Ha ocurrido un error al intentar guardar los datos, por favor inténtelo de nuevo!";

            header("Location: " . URL . "admin/ingresoMotos");
            exit;
          }
        }

        if ($casco == "no")
        {
          $resgistroIngreso = $this->mdlMovimientos->guardarIngreso();

          if ($resgistroIngreso)
          {
            $_SESSION['type'] = "success";
            $_SESSION['message'] = "Registro de ingreso guardado correctamente!";

            header("Location: " . URL . "admin/ingresoMotos");
            exit;
          }
          else
          {
            $_SESSION['error'] = "danger";
            $_SESSION['message'] = "Ha ocurrido un error al intentar guardar los datos, por favor inténtelo de nuevo!";

            header("Location: " . URL . "admin/ingresoMotos");
            exit;
          }
        }

      }
      else
      {
        header("Location: " . URL . "admin/ingresoMotos");
        exit;
      }
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
      var_dump($_POST);
      exit;
    }
    else
    {
      header("Location: " . URL . "home/index");
      exit;
    }
  }

  public function buscarPlaca()
  {
    if (isset($_SESSION['SESION_INICIADA']) && $_SESSION['SESION_INICIADA'] == TRUE)
    {
      sleep(2);

      $placa = $_POST['buscar'];

      $this->mdlMovimientos->__SET("placa", $placa);
      $busqueda = $this->mdlMovimientos->buscarPlaca();

      if(count($busqueda) != 0)
      {
        $html = "";
        foreach ($busqueda as $key => $value) {
          $html .= '   <tr>';
          $html .= '    <td><button class="btn btn-primary" onclick="">' . $value['placa'] . '</button></td>';
          $html .= '    <td>' . $value['tipo'] . '</td>';
          $html .= '    <td>' . $value['fecha_llegada'] . '</td>';
          $html .= '    <td>' . $value['hora_llegada'] . '</td>';
          $html .= '   </tr>';
        }
        echo json_encode([
          'html' => $html,
        ]);
      }
    }
    else
    {
      header("Location: " . URL . "home/index");
      exit;
    }
  }

  public function buscarTodos()
  {
    if (isset($_SESSION['SESION_INICIADA']) && $_SESSION['SESION_INICIADA'] == TRUE)
    {
      sleep(2);

      $buscarTodos = $this->mdlMovimientos->buscarTodos();

      if(count($buscarTodos) != 0)
      {
        $html = "";
        foreach ($buscarTodos as $key => $value) {
          $html .= '   <tr>';
          $html .= '    <td><button class="btn btn-primary" onclick="">' . $value['placa'] . '</button></td>';
          $html .= '    <td>' . $value['tipo'] . '</td>';
          $html .= '    <td>' . $value['fecha_llegada'] . '</td>';
          $html .= '    <td>' . $value['hora_llegada'] . '</td>';
          $html .= '   </tr>';
        }
        echo json_encode([
          'html' => $html,
        ]);
      }
      else
      {
        echo 2;
      }
    }
    else
    {
      header("Location: " . URL . "home/index");
      exit;
    }
  }
}

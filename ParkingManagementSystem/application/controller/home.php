<?php

  use Dompdf\Dompdf;

class Home extends Controller
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
    if(isset($_SESSION['SESION_INICIADA']) && $_SESSION['SESION_INICIADA'] == TRUE)
    {
      unset($_SESSION['SESION_INICIADA'],$_SESSION['id'],$_SESSION['tipo'],
      $_SESSION['login'],$_SESSION['nombres']);

      session_unset();
      session_destroy();

      header('Location:' . URL . 'home/index');
      exit;
    }
    else
    {
      header("Location: " . URL . "home/index");
      exit;
    }
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

        $this->mdlMovimientos->__SET("placa", strtoupper($placa));
        $this->mdlMovimientos->__SET("tipo", ucwords($tipo));
        $this->mdlMovimientos->__SET("fechaLlegada", $fechallegada);
        $this->mdlMovimientos->__SET("horaLlegada", $horallegada);
        $this->mdlMovimientos->__SET("usuarioLlegada", ucwords($usuariollegada));
        $this->mdlMovimientos->__SET("tipoCobro", ucwords($tipoCobro));
        $this->mdlMovimientos->__SET("tieneCasco", $casco);

        if ($casco == "si")
        {
          $registroIngreso = $this->mdlMovimientos->guardarIngreso();

            if ($registroIngreso)
            {
              $_SESSION['type'] = "success";
              $_SESSION['message'] = "Registro guardado correctamente!";

              header("Location: " . URL . "home/comprobanteIngreso");
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

            header("Location: " . URL . "home/comprobanteIngreso");
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

  public function comprobanteIngreso()
  {
    $ultimoId = $this->mdlMovimientos->ultimoId();

    $id = $ultimoId[0]['ultimoId'];

      if(isset($id))
      {
        $this->mdlMovimientos->__SET("id", $id);
        $detalles = $this->mdlMovimientos->traerDetalleRegistroEntrada();

        $tabla = "";
        foreach ($detalles as $value)
        {
          $tabla .= '<tr>';
          $tabla .= '<td class="center">' . $value['placa'] . '</td>';
          $tabla .= '<td class="center">' . ucwords($value['tiene_casco']) . '</td>';
          $tabla .= '<td class="center">' . ucwords($value['tipo_cobro']) . '</td>';
          $tabla .= '</tr>';
        }

        require_once APP . 'libs/dompdf/autoload.inc.php';
        ob_start();
        require APP . 'view/admin/comprobanteIngresos.php';

        $html = ob_get_clean();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper([0,0,300,1820], 'portrait');
        $dompdf->render();
        $dompdf->stream("Tiquete de ingreso.pdf", array("Attachment" => false, 'isRemoteEnabled' => true));
      }
  }

  public function comprobanteSalida()
  {
    $id = $_GET['id'];

      if(isset($id))
      {
        $this->mdlMovimientos->__SET("id", $id);
        $detallesSalida = $this->mdlMovimientos->traerDetalleRegistroSalida();

        $tabla = "";
        foreach ($detallesSalida as $value)
        {
          $tabla .= '<tr>';
          $tabla .= '<td class="center">' . $value['placa'] . '</td>';
          $tabla .= '<td class="center">' . $value['fecha_salida'] . '</td>';
          $tabla .= '<td class="center">' . $value['hora_salida'] . '</td>';
          $tabla .= '<td class="center">' . $value['transcurrido'] . '</td>';
          $tabla .= '</tr>';
        }

        require_once APP . 'libs/dompdf/autoload.inc.php';
        ob_start();
        require APP . 'view/admin/comprobanteSalida.php';

        $html = ob_get_clean();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper([0,0,350,770], 'portrait');
        $dompdf->render();
        $dompdf->stream("Tiquete de salida.pdf", array("Attachment" => false, 'isRemoteEnabled' => true));
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
        $tarifas =  $this->mdlTarifas->listarTarifas();

        $fecha_salida = date('Y-m-d');
        $hora_salida = date('H:i:s');

        $fecha_llegada =  $busqueda[0]['fecha_llegada'];
        $hora_llegada =   $busqueda[0]['hora_llegada'];

        $duracion = $hora_llegada - $hora_salida;
        $horas = (int) $duracion/3600;
        $duracion = $duracion - ($horas * 3600);
        $minutos = (int) $duracion/60;
        $segundos = $duracion - ($minutos * 60);

        //desde aqui
        $fechaini = $fecha_llegada;
        $fechafin = $fecha_salida;

      	$anioi = substr($fechaini,0,4);
      	$mesi = substr($fechaini,5,2);
      	$diai = substr($fechaini,8,2);

      	$aniof = substr($fechafin,0,4);
      	$mesf = substr($fechafin,5,2);
      	$diaf = substr($fechafin,8,2);

      	$aini = ($anioi);
      	$afin = ($aniof);

      	$adif = $afin - $aini;

      	$mini = ($mesi);
      	$mfin = ($mesf);

      	$mdif = $mfin - $mini;

      	$dini = ($diai);
      	$dfin = ($diaf);

      	$tddif = $dfin - $dini;

        $diastotal = (($adif*360) + ($mdif*30) + ($tddif));

        //hasta aqui

        $horaini = $hora_llegada;
        $horafin = $hora_salida;

        	$horai = substr($horaini,0,2);
        	$mini = substr($horaini,3,2);
        	$segi = substr($horaini,6,2);

        	$horaf = substr($horafin,0,2);
        	$minf = substr($horafin,3,2);
        	$segf = substr($horafin,6,2);

        	$ini = ((($horai*60)*60) + ($mini*60) + $segi);
        	$fin = ((($horaf*60)*60) + ($minf*60) + $segf);
        	$dif = $fin-$ini;

        	$difh = floor($dif/3600);
        	$difm = floor(($dif-($difh*3600))/60);
        	$difs = $dif-($difm*60) - ($difh*3600);

        	$thdif = date("H:i:s",mktime($difh)) + (24*$diastotal);

        	$transcurrido = date("H:i:s",mktime($difh,$difm,$difs));
        //	echo 'Diferencia : ', $transcurrido;

        	$valor_cobro = $thdif * $tarifas[0]['valor_hora'];

        $html = "";
        foreach ($busqueda as $key => $value)
        {
          $html .= '   <tr>';
          $html .= '    <td id="td-placa"><button class="btn btn-primary" onclick="asociar(event)">' . $value['placa'] . '</button></td>';
          $html .= '    <td id="td-tipo">' . $value['tipo'] . '</td>';
          $html .= '    <td id="td-fecha">' . $value['fecha_llegada'] . '</td>';
          $html .= '    <td id="td-hora">' . $value['hora_llegada'] . '</td>';
          $html .= '   </tr>';
        }

        echo json_encode([
          'html' => $html,
          'id' => $busqueda[0]['id'],
          'transcurrido' => $transcurrido,
          'dias_transcurridos' => $diastotal,
          'fecha_salida' => $fecha_salida,
          'hora_salida' => $hora_salida,
          'valor_cobro' => $valor_cobro,
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

  public function configuracionValores()
  {
    if (isset($_SESSION['SESION_INICIADA']) &&
        $_SESSION['SESION_INICIADA'] == TRUE)
    {
      if (isset($_POST['guardarvalores']))
      {
        $valorHora = $_POST['valorhora'];
        $valorHoraAdic = $_POST['valoradicional'];
        $valorHora2 = $_POST['valorhora2'];
        $valorDia = $_POST['valordia'];
        $valorMes = $_POST['valormensualidad'];
        $tipo = "Tarifas";
        $id = $_POST['idtarifa'];

        $this->mdlTarifas->__SET("tipo", $tipo);
        $this->mdlTarifas->__SET("valorHora", $valorHora);
        $this->mdlTarifas->__SET("valorAdicional", $valorHoraAdic);
        $this->mdlTarifas->__SET("valor2", $valorHora2);
        $this->mdlTarifas->__SET("valorDia", $valorDia);
        $this->mdlTarifas->__SET("valorMensualidad", $valorMes);
        $this->mdlTarifas->__SET("id", (int)$id);
        $tarifas = $this->mdlTarifas->actualizarTarifas();

        if($tarifas)
        {
          $_SESSION['type'] = "success";
          $_SESSION['message'] = "Las tarifas fuerón actualizadas correctamente!";

          header("Location: " . URL . "admin/index");
          exit;
        }
        else
        {
          $_SESSION['type'] = "danger";
          $_SESSION['message'] = "Ha ocurrido un error al intentar actualizar los datos, por favor inténtelo de nuevo!";

          header("Location: " . URL . "admin/index");
          exit;
        }

      }
      else
      {
        header("Location: " . URL . "admin/index");
        exit;
      }
    }
    else
    {
      header("Location: " . URL . "home/index");
      exit;
    }
  }

  public function configuracionPerfil()
  {
    if (isset($_SESSION['SESION_INICIADA']) &&
        $_SESSION['SESION_INICIADA'] == TRUE)
    {
      $id = $_SESSION['id'];

      $this->mdlLogin->__SET('id', (int)$id);
      $datosUsuario = $this->mdlLogin->consultarInfoUsuario();

      require APP . 'view/_templates/header.php';
      require APP . 'view/admin/perfil.php';
      require APP . 'view/_templates/footer.php';
    }
    else
    {
      header("Location: " . URL . "home/index");
      exit;
    }
  }

  public function actualizacionPassword()
  {
    if (isset($_SESSION['SESION_INICIADA']) &&
        $_SESSION['SESION_INICIADA'] == TRUE)
    {
      if(isset($_POST['guardarnuevapass']))
      {
        if ($_POST['repetirpass'] == $_POST['nuevopass'])
        {
          $pass = $_POST['nuevopass'];
          $id = $_POST['iduser'];

          $this->mdlLogin->__SET("password", $this->Encrypt($pass));
          $this->mdlLogin->__SET("id", (int)$id);
          $actualizacion = $this->mdlLogin->actualizarContrasenia();

          if($actualizacion)
          {
            $_SESSION['type'] = "success";
            $_SESSION['message'] = "La contraseña fue actualizada correctamente!";

            header("Location: " . URL . "home/configuracionPerfil");
            exit;
          }
          else
          {
            $_SESSION['error'] = "danger";
            $_SESSION['messageerror'] = "Ha ocurrido un error al intentar actualizar los datos, por favor inténtelo de nuevo!";

            header("Location: " . URL . "home/configuracionPerfil");
            exit;
          }
        }
        else
        {
          $_SESSION['errorpass'] = "danger";
          $_SESSION['messagepass'] = "Las contraseñas ingresadas no coinciden, por favor inténtelo de nuevo!";

          header("Location: " . URL . "home/configuracionPerfil");
          exit;
        }
      }
      else
      {
        header("Location: " . URL . "home/configuracionPerfil");
        exit;
      }
    }
    else
    {
      header("Location: " . URL . "home/index");
      exit;
    }
  }

  public function ajustesPerfil()
  {
    if (isset($_SESSION['SESION_INICIADA']) &&
        $_SESSION['SESION_INICIADA'] == TRUE)
    {
      if (isset($_POST['guardarperfil']))
      {
        $Usuario = $_POST['nombreusuario'];
        $nombres = $_POST['nombresperfil'];
        $id = $_POST['idusuarioperfil'];

        $this->mdlLogin->__SET("login", $Usuario);
        $this->mdlLogin->__SET("nombres", $nombres);
        $this->mdlLogin->__SET("id", (int)$id);
        $actualizacion = $this->mdlLogin->actualizarUsuario();

        if ($actualizacion)
        {
          $_SESSION['typeuser'] = "success";
          $_SESSION['messageuser'] = "La información fue actualizada correctamente!";

          header("Location: " . URL . "home/configuracionPerfil");
          exit;
        }
        else
        {
          $_SESSION['erroruser'] = "danger";
          $_SESSION['message'] = "Ha ocurrido un error, por favor inténtelo de nuevo!";

          header("Location: " . URL . "home/configuracionPerfil");
          exit;
        }
      }
      else
      {
        header("Location: " . URL . "home/configuracionPerfil");
        exit;
      }
    }
    else
    {
      header("Location: " . URL . "home/index");
      exit;
    }
  }
}

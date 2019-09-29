<?php

class Employee extends Controller
{
  private $mdlLogin;


  public function __construct()
  {
    $this->mdlLogin = $this->LoadModel('mdlLogin');
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
    require APP . 'view/_templates/header.php';
    require APP . 'view/employee/index.php';
    require APP . 'view/_templates/footer.php';
  }
}

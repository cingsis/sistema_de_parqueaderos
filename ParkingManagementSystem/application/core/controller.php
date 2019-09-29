<?php

class Controller
{

    public $db = null;

    private function OpenDatabaseConnection()
    {

        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
    }

    public function LoadModel($modelo)
    {
        $this->OpenDatabaseConnection();
        require APP . "model/$modelo.php";
        return new $modelo($this->db);
    }
}

<?php

class DBConnection
{
  private $servername = "localhost";
  private $username = "root";
  private $password = "";
  private $dbname = "BTTH01_CSE485";
  public $conn;

  public function connect()
  {
    $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

    // Kiểm tra kết nối
    if ($this->conn->connect_error) {
      die("Kết nối thất bại: " . $this->conn->connect_error);
    }

    return $this->conn;
  }

  public function close()
  {
    if ($this->conn) {
      $this->conn->close();
    }
  }
}
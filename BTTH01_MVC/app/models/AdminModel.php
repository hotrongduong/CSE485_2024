<?php
class AdminModel
{
  private $conn;

  public function __construct()
  {
    $this->conn = (new DBConnection())->connect();
  }

  public function getCount($table, $column)
  {
    $sql = "SELECT COUNT($column) AS count FROM $table";
    $result = $this->conn->query($sql);
    return $result ? $result->fetch_assoc()['count'] : 0;
  }

  public function closeConnection()
  {
    $this->conn->close();
  }
}

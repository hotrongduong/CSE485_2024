<?php
include("configs/DBConnection.php");
include("app/models/CategoryModel.php");

class CategoryService
{
  public function getAllCategories()
  {
    $dbConn = new DBConnection();
    $conn = $dbConn->connect();

    $sql = "SELECT ma_tloai, ten_tloai FROM theloai";
    $result = $conn->query($sql);

    $categories = [];
    if ($result) {
      while ($row = $result->fetch_assoc()) {
        $category = new CategoryModel($row['ma_tloai'], $row['ten_tloai']);
        array_push($categories, $category);
      }
    } else {
      echo "Error: " . $conn->error;
    }

    $dbConn->close();
    return $categories;
  }

  public function addCategory($tenTloai)
  {
    $dbConn = new DBConnection();
    $conn = $dbConn->connect();

    $sql = "INSERT INTO theloai (ten_tloai) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $tenTloai);

    if ($stmt->execute()) {
      $stmt->close();
      $dbConn->close();
      return true;
    } else {
      echo "Error: " . $stmt->error;
      $stmt->close();
      $dbConn->close();
      return false;
    }
  }

  public function updateCategory($id, $tenTloai)
  {
    $dbConn = new DBConnection();
    $conn = $dbConn->connect();

    $sql = "UPDATE theloai SET ten_tloai = ? WHERE ma_tloai = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $tenTloai, $id);

    if ($stmt->execute()) {
      $stmt->close();
      $dbConn->close();
      return true;
    } else {
      echo "Error: " . $stmt->error;
      $stmt->close();
      $dbConn->close();
      return false;
    }
  }

  public function deleteCategory($id)
  {
    $dbConn = new DBConnection();
    $conn = $dbConn->connect();

    $sql = "DELETE FROM theloai WHERE ma_tloai = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
      $stmt->close();
      $dbConn->close();
      return true;
    } else {
      echo "Error: " . $stmt->error;
      $stmt->close();
      $dbConn->close();
      return false;
    }
  }

  public function getCategoryById($id)
  {
    $dbConn = new DBConnection();
    $conn = $dbConn->connect();

    $sql = "SELECT ma_tloai, ten_tloai FROM theloai WHERE ma_tloai = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return new CategoryModel($row['ma_tloai'], $row['ten_tloai']);
    }

    return null;
  }
}

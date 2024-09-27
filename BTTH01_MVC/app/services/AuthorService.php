<?php
include("configs/DBConnection.php");
include("app/models/AuthorModel.php");

class AuthorService
{
  public function getAllAuthors()
  {
    $dbConn = new DBConnection();
    $conn = $dbConn->connect();

    $sql = "SELECT ma_tgia, ten_tgia FROM tacgia";
    $result = $conn->query($sql);

    $authors = [];
    if ($result) {
      while ($row = $result->fetch_assoc()) {
        $author = new AuthorModel($row['ma_tgia'], $row['ten_tgia']);
        array_push($authors, $author);
      }
    } else {
      echo "Error: " . $conn->error;
    }

    $dbConn->close();
    return $authors;
  }

  public function addAuthor($tenTgia)
  {
    $dbConn = new DBConnection();
    $conn = $dbConn->connect();

    $sql = "INSERT INTO tacgia (ten_tgia) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $tenTgia);

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

  public function updateAuthor($id, $tenTgia)
  {
    $dbConn = new DBConnection();
    $conn = $dbConn->connect();

    $sql = "UPDATE tacgia SET ten_tgia = ? WHERE ma_tgia = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $tenTgia, $id);

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

  public function deleteAuthor($id)
  {
    $dbConn = new DBConnection();
    $conn = $dbConn->connect();

    $sql = "DELETE FROM tacgia WHERE ma_tgia = ?";
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

  public function getAuthorById($id)
  {
    $dbConn = new DBConnection();
    $conn = $dbConn->connect();

    $sql = "SELECT ma_tgia, ten_tgia FROM tacgia WHERE ma_tgia = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return new AuthorModel($row['ma_tgia'], $row['ten_tgia']);
    }

    return null;
  }
}

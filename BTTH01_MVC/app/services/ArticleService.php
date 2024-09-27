<?php
include("configs/DBConnection.php");
include("app/models/ArticleModel.php");

class ArticleService
{
  public function getAllArticles()
  {
    $dbConn = new DBConnection();
    $conn = $dbConn->connect();

    $sql = "SELECT 
                    baiviet.ma_bviet AS id,
                    baiviet.ma_tgia as author_id,
                    baiviet.ma_tloai as category_id,
                    baiviet.ten_bhat AS title, 
                    baiviet.tomtat AS summary, 
                    baiviet.noidung AS content,
                    baiviet.ngayviet AS date_written,
                    theloai.ten_tloai AS cat_name, 
                    tacgia.ten_tgia AS author_name
                FROM 
                    baiviet
                INNER JOIN 
                    theloai ON baiviet.ma_tloai = theloai.ma_tloai
                INNER JOIN 
                    tacgia ON baiviet.ma_tgia = tacgia.ma_tgia";

    $stmt = $conn->query($sql);

    $articles = [];
    while ($row = $stmt->fetch_assoc()) {
      $article = new ArticleModel(
        $row['id'],
        $row['title'],
        $row['summary'],
        $row['cat_name'],
        $row['author_name'],
        $row['date_written'],
        $row['content'],
        $row['author_id'],
        $row['category_id']

      );
      array_push($articles, $article);
    }

    return $articles;
  }

  public function addArticle($tenBaiHat, $tomTat, $maTloai, $maTacGia, $ngayViet, $noidung)
  {
    $dbConn = new DBConnection();
    $conn = $dbConn->connect();

    $sql = "INSERT INTO baiviet (ten_bhat, tomtat, ma_tloai, ma_tgia, ngayviet, noidung) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssiiis", $tenBaiHat, $tomTat, $maTloai, $maTacGia, $ngayViet, $noidung);
    $result = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $result;
  }

  public function deleteArticle($id)
  {
    $dbConn = new DBConnection();
    $conn = $dbConn->connect();

    $sql = "DELETE FROM baiviet WHERE ma_bviet = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    $result = $stmt->execute();

    $stmt->close();
    $dbConn->close();
    return $result;
  }

  public function getArticleById($id)
  {
    $dbConn = new DBConnection();
    $conn = $dbConn->connect();

    $sql = "SELECT * FROM baiviet WHERE ma_bviet = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $article = null;
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $article = new ArticleModel(
        $row['ma_bviet'],
        $row['ten_bhat'],
        $row['tomtat'],
        $row['ma_tloai'],
        $row['ma_tgia'],
        $row['ngayviet'],
        $row['noidung'],
      );
    }

    $stmt->close();
    $dbConn->close();
    return $article;
  }

  public function updateArticle($id, $title, $summary, $category_id, $author_id, $date_written, $content)
  {
    $dbConn = new DBConnection();
    $conn = $dbConn->connect();

    $sql = "UPDATE baiviet SET ten_bhat = ?, tomtat = ?, ma_tloai = ?, ma_tgia = ?, ngayviet = ?, noidung = ? WHERE ma_bviet = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiiisi", $title, $summary, $category_id, $author_id, $date_written, $content, $id);

    if ($stmt->execute()) {
      $result = true;
    } else {
      $result = false;
    }

    $stmt->close();
    $dbConn->close();
    return $result;
  }

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
}

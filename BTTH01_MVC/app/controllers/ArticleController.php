<?php
include("app/services/ArticleService.php");

class ArticleController
{
  private $articleService;
  private $categoryService;

  public function __construct()
  {
    $this->articleService = new ArticleService();
  }

  public function list()
  {
    $articles = $this->articleService->getAllArticles();
    include("./app/views/admin/article/list_article.php");
  }

  public function add()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $title = $_POST['txtSongName'];
      $summary = $_POST['txtSummary'];
      $category_id = $_POST['txtCategory'];
      $author_id = $_POST['txtAuthor'];
      $date_written = $_POST['txtDate'];
      $content = $_POST['txtContent'];

      // Calling the service method to add an article
      if ($this->articleService->addArticle($title, $summary, $category_id, $author_id, $date_written, $content)) {
        echo "<script>alert('Thêm bài viết thành công!'); window.location.href='?controller=article&action=list';</script>";
      } else {
        echo "<script>alert('Có lỗi xảy ra!');</script>";
      }
    } else {
      include($_SERVER['DOCUMENT_ROOT'] . "/app/views/admin/article/add_article.php");
    }
  }

  public function delete()
  {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      if ($this->articleService->deleteArticle($id)) {
        echo "<script>alert('Xóa bài viết thành công!'); window.location.href='?controller=article&action=list';</script>";
      } else {
        echo "<script>alert('Có lỗi xảy ra!');</script>";
      }
    } else {
      echo "<script>alert('ID bài viết không hợp lệ!'); window.location.href='?controller=article&action=list';</script>";
    }
  }

  public function edit()
  {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $article = $this->articleService->getArticleById($id);
      // var_dump($article);

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['txtTitle'];
        $summary = $_POST['txtSummary'];
        $category_id = $_POST['slCategory'];
        $author_id = $_POST['slAuthor'];
        $date_written = $_POST['txtDate'];
        $content = $_POST['txtContent'];

        if ($this->articleService->updateArticle($id, $title, $summary, $category_id, $author_id, $date_written, $content)) {
          echo "<script>alert('Cập nhật bài viết thành công!'); window.location.href='?controller=article&action=list';</script>";
        } else {
          echo "<script>alert('Có lỗi xảy ra!');</script>";
        }
      }

      include($_SERVER['DOCUMENT_ROOT'] . "/app/views/admin/article/edit_article.php");
    } else {
      echo "<script>alert('ID không hợp lệ!');</script>";
    }
  }
}
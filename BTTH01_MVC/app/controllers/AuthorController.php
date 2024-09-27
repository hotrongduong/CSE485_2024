<?php

include($_SERVER['DOCUMENT_ROOT'] . "/app/services/AuthorService.php");

class AuthorController
{
  private $authorService;

  public function __construct()
  {
    $this->authorService = new AuthorService();
  }

  public function list()
  {
    $authors = $this->authorService->getAllAuthors();

    include($_SERVER['DOCUMENT_ROOT'] . "/app/views/admin/author/list_author.php");
  }

  public function add()
  {
    include($_SERVER['DOCUMENT_ROOT'] . "/app/views/admin/author/add_author.php");
  }

  public function store()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_POST['txtCatName'])) {
        $tenTgia = $_POST['txtCatName'];

        if ($this->authorService->addAuthor($tenTgia)) {
          echo "<script>alert('Thêm tác giả thành công!'); window.location.href='?controller=author&action=list';</script>";
        } else {
          echo "<script>alert('Có lỗi xảy ra, không thể thêm tác giả!');</script>";
        }
      } else {
        echo "<script>alert('Vui lòng nhập tên tác giả!');</script>";
      }
    }
  }

  public function edit()
  {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $author = $this->authorService->getAuthorById($id);

      if ($author) {
        include($_SERVER['DOCUMENT_ROOT'] . "/app/views/admin/author/edit_author.php");
      } else {
        echo "<script>alert('Tác giả không tồn tại!'); window.location.href='?controller=author&action=list';</script>";
      }
    } else {
      echo "<script>alert('ID không được cung cấp!'); window.location.href='?controller=author&action=list';</script>";
    }
  }

  public function update()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_POST['txtCatId']) && isset($_POST['txtCatName'])) {
        $id = $_POST['txtCatId'];
        $tenTgia = $_POST['txtCatName'];

        if ($this->authorService->updateAuthor($id, $tenTgia)) {
          echo "<script>alert('Cập nhật tac giả thành công!'); window.location.href='?controller=author&action=list';</script>";
        } else {
          echo "<script>alert('Có lỗi xảy ra, không thể cập nhật tác giả!');</script>";
        }
      } else {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
      }
    }
  }

  public function delete()
  {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      if ($this->authorService->deleteAuthor($id)) {
        echo "<script>alert('Xóa tác giả thành công!'); window.location.href='?controller=author&action=list';</script>";
      } else {
        echo "<script>alert('Có lỗi xảy ra, không thể xóa tác giả!');</script>";
      }
    } else {
      echo "<script>alert('ID không được cung cấp!'); window.location.href='?controller=author&action=list';</script>";
    }
  }
}
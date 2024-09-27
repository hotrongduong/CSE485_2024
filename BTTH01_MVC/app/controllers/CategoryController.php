<?php

include($_SERVER['DOCUMENT_ROOT'] . "/app/services/CategoryService.php");

class CategoryController
{
  private $categoryService;

  public function __construct()
  {
    $this->categoryService = new CategoryService();
  }

  public function list()
  {
    $categories = $this->categoryService->getAllCategories();

    include($_SERVER['DOCUMENT_ROOT'] . "/app/views/admin/category/list_category.php");
  }

  public function add()
  {
    include($_SERVER['DOCUMENT_ROOT'] . "/app/views/admin/category/add_category.php");
  }

  public function store()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_POST['txtCatName'])) {
        $tenTloai = $_POST['txtCatName'];

        if ($this->categoryService->addCategory($tenTloai)) {
          echo "<script>alert('Thêm thể loại thành công!'); window.location.href='?controller=category&action=list';</script>";
        } else {
          echo "<script>alert('Có lỗi xảy ra, không thể thêm thể loại!');</script>";
        }
      } else {
        echo "<script>alert('Vui lòng nhập tên thể loại!');</script>";
      }
    }
  }

  public function edit()
  {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $category = $this->categoryService->getCategoryById($id);

      if ($category) {
        include($_SERVER['DOCUMENT_ROOT'] . "/app/views/admin/category/edit_category.php");
      } else {
        echo "<script>alert('Thể loại không tồn tại!'); window.location.href='?controller=category&action=list';</script>";
      }
    } else {
      echo "<script>alert('ID không được cung cấp!'); window.location.href='?controller=category&action=list';</script>";
    }
  }

  public function update()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_POST['txtCatId']) && isset($_POST['txtCatName'])) {
        $id = $_POST['txtCatId'];
        $tenTloai = $_POST['txtCatName'];

        if ($this->categoryService->updateCategory($id, $tenTloai)) {
          echo "<script>alert('Cập nhật thể loại thành công!'); window.location.href='?controller=category&action=list';</script>";
        } else {
          echo "<script>alert('Có lỗi xảy ra, không thể cập nhật thể loại!');</script>";
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
      if ($this->categoryService->deleteCategory($id)) {
        echo "<script>alert('Xóa thể loại thành công!'); window.location.href='?controller=category&action=list';</script>";
      } else {
        echo "<script>alert('Có lỗi xảy ra, không thể xóa thể loại!');</script>";
      }
    } else {
      echo "<script>alert('ID không được cung cấp!'); window.location.href='?controller=category&action=list';</script>";
    }
  }
}
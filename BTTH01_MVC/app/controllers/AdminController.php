<?php
require_once realpath(__DIR__ . '/../../configs/DBConnection.php');
require_once realpath(__DIR__ . '/../models/AdminModel.php');

class AdminController
{
  private $model;

  public function __construct()
  {
    $this->model = new AdminModel();
  }

  public function index()
  {
    $count_theloai = $this->model->getCount('theloai', 'ma_tloai');
    $count_tacgia = $this->model->getCount('tacgia', 'ma_tgia');
    $count_baiviet = $this->model->getCount('baiviet', 'ma_bviet');
    // $count_users = $this->model->getCount('users', 'MaNguoiDung');
    include realpath(__DIR__ . '/../views/admin/index.php');
  }

  public function __destruct()
  {
    $this->model->closeConnection();
  }
}

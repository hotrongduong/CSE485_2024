<?php $title = "Chỉnh sửa tác giả"; ?>
<?php include 'app/views/admin/layout/header_admin.php'; ?>
<?php
if (!isset($author)) {
  echo "<script>alert('Tác giả không tồn tại!'); window.location.href='?controller=author&action=list';</script>";
  exit();
}
?>

<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col-sm">
      <h3 class="text-center text-uppercase fw-bold">Sửa thông tin tác giả</h3>
      <form action="?controller=author&action=update" method="post">
        <div class="input-group mt-3 mb-3">
          <span class="input-group-text" id="lblCatId">ID tác giả</span>
          <input type="text" class="form-control" name="txtCatId" readonly value="<?php echo $author->getId(); ?>">
        </div>
        <div class="input-group mt-3 mb-3">
          <span class="input-group-text" id="lblCatName">Tên tác giả</span>
          <input type="text" class="form-control" name="txtCatName" value="<?php echo htmlspecialchars($author->getName()); ?>" required>
        </div>
        <div class="form-group float-end">
          <input type="submit" value="Lưu lại" class="btn btn-success">
          <a href="?controller=author&action=list" class="btn btn-warning">Quay lại</a>
        </div>
      </form>
    </div>
  </div>
</div>


<?php include 'app/views/admin/layout/footer_admin.php'; ?>
<?php $title = "Chỉnh sửa thể loại"; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/app/views/admin/layout/header_admin.php'; ?>
<?php
if (!isset($category)) {
  echo "<script>alert('Thể loại không tồn tại!'); window.location.href='?controller=category&action=list';</script>";
  exit();
}
?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <h3 class="text-center text-uppercase fw-bold">Sửa thông tin thể loại</h3>
            <form action="?controller=category&action=update" method="post">
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatId">ID thể loại</span>
                    <input type="text" class="form-control" name="txtCatId" readonly
                        value="<?php echo $category->getId(); ?>">
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatName">Tên thể loại</span>
                    <input type="text" class="form-control" name="txtCatName"
                        value="<?php echo htmlspecialchars($category->getName()); ?>" required>
                </div>
                <div class="form-group float-end">
                    <input type="submit" value="Lưu lại" class="btn btn-success">
                    <a href="?controller=category&action=list" class="btn btn-warning">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include $_SERVER['DOCUMENT_ROOT'] . '/app/views/admin/layout/footer_admin.php'; ?>
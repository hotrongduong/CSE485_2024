<?php $title = "Thêm thể loại mới"; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/app/views/admin/layout/header_admin.php'; ?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <h3 class="text-center text-uppercase fw-bold">Thêm mới thể loại</h3>
            <form action="?controller=category&action=store" method="post">
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatName">Tên thể loại</span>
                    <input type="text" class="form-control" name="txtCatName" required>
                </div>
                <div class="form-group float-end">
                    <input type="submit" value="Thêm" class="btn btn-success">
                    <a href="?controller=category&action=list" class="btn btn-warning">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/app/views/admin/layout/footer_admin.php'; ?>
<?php $title = "Thêm bài viết"; ?>
<?php include  $_SERVER['DOCUMENT_ROOT'] . '/app/views/admin/layout/header_admin.php'; ?>

<main class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <h3 class="text-center text-uppercase fw-bold">Thêm mới bài viết</h3>
            <form action="index.php?controller=article&action=add" method="post">
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblSongName">Tên bài hát</span>
                    <input type="text" class="form-control" name="txtSongName" required>
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblSummary">Tóm tắt</span>
                    <input type="text" class="form-control" name="txtSummary" required>
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCategory">Thể loại</span>
                    <input type="number" class="form-control" name="txtCategory" required placeholder="ID thể loại">
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblAuthor">Tác giả</span>
                    <input type="number" class="form-control" name="txtAuthor" required placeholder="ID tác giả">
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblDate">Ngày viết</span>
                    <input type="date" class="form-control" name="txtDate" required>
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblContent">Nội dung</span>
                    <textarea class="form-control" name="txtContent" required></textarea>
                </div>
                <div class="form-group float-end">
                    <input type="submit" value="Thêm" class="btn btn-success">
                    <a href="article.php" class="btn btn-warning">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/app/views/admin/layout/footer_admin.php'; ?>
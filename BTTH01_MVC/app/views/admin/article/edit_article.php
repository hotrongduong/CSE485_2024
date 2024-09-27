<?php $title = "Cập nhật bài viết"; ?>
<?php include  $_SERVER['DOCUMENT_ROOT'] . '/app/views/admin/layout/header_admin.php'; ?>


<main class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <h3 class="text-center text-uppercase fw-bold">Sửa thông tin bài viết</h3>
            <form action="?controller=article&action=edit&id=<?php echo $article->getId(); ?>" method="post">
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblArticleId">ID bài viết</span>
                    <input type="text" class="form-control" name="txtArticleId" readonly
                        value="<?php echo $article->getId(); ?>">
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblTitle">Tên bài hát</span>
                    <input type="text" class="form-control" name="txtTitle" value="<?php echo $article->getTitle(); ?>"
                        required>
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblSummary">Tóm tắt</span>
                    <input type="text" class="form-control" name="txtSummary"
                        value="<?php echo $article->getSummary(); ?>" required>
                </div>

                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCategory">Thể loại</span>
                    <select class="form-select" name="slCategory" required>
                        <option value="">Chọn thể loại</option>
                        <?php
            foreach ($categories as $category) {
              $selected = ($category->getId() == $article->getDateWritten()) ? 'selected' : '';
              echo "<option value='{$category->getId()}' $selected>{$category->getName()}</option>";
            }
            ?>
                    </select>
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblAuthor">Tác giả</span>
                    <select class="form-select" name="slAuthor" required>
                        <option value="">Chọn tác giả</option>
                        <?php
            foreach ($authors as $author) {
              $selected = ($author->getId() == $article->getContent()) ? 'selected' : '';
              echo "<option value='{$author->getId()}' $selected>{$author->getName()}</option>";
            }
            ?>
                    </select>
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblContent">Nội dung</span>
                    <textarea class="form-control" name="txtContent"
                        required><?php echo $article->getAuthorName(); ?></textarea>
                </div>
                <div class="form-group float-end">
                    <input type="submit" value="Lưu lại" class="btn btn-success">
                    <a href="?controller=article&action=list" class="btn btn-warning">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/app/views/admin/layout/footer_admin.php'; ?>
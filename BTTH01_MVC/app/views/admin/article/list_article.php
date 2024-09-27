<?php $title = "Danh sách bài hát"; ?>
<?php include  $_SERVER['DOCUMENT_ROOT'] . '/app/views/admin/layout/header_admin.php'; ?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <a href="?controller=article&action=add" class="btn btn-success">Thêm mới</a>
        </div>
    </div>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên bài hát</th>
                <th>Tóm tắt</th>
                <th>Thể loại</th>
                <th>Tác giả</th>
                <th>Ngày viết</th>
                <th>Nội dung</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= $article->getId() ?></td>
                <td><?= $article->getTitle() ?></td>
                <td><?= $article->getSummary() ?></td>
                <td><?= $article->getDateWritten() ?></td>
                <td><?= $article->getContent() ?></td>
                <td><?= $article->getCategoryName() ?></td>
                <td><?= $article->getAuthorName() ?></td>
                <td>
                    <a href="?controller=article&action=edit&id=<?php echo $article->getId(); ?>"><i
                            class="fa-solid fa-pen-to-square"></i></a>
                </td>
                <td>
                    <a onclick="return confirm('Bạn có muốn xóa bài viết này không ?');"
                        href="?controller=article&action=delete&id=<?php echo $article->getId(); ?>"><i
                            class="fa-solid fa-trash"></i></a>
                </td>
                <!-- <td>
            <a href="edit_article.php?id=<?= $article->getId() ?>" class="btn btn-warning">Edit</a>
            <a href="delete_article.php?id=<?= $article->getId() ?>" class="btn btn-danger">Delete</a>
          </td> -->
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/app/views/admin/layout/footer_admin.php'; ?>
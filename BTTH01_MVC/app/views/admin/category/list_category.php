<?php $title = "Danh sách thể loại"; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/app/views/admin/layout/header_admin.php'; ?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <a href="?controller=category&action=add" class="btn btn-success">Thêm mới</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên thể loại</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
          if (!empty($categories)) {
            foreach ($categories as $category) {
          ?>
                    <tr>
                        <th scope="row"><?php echo $category->getId(); ?></th>
                        <td><?php echo $category->getName(); ?></td>
                        <td>
                            <a href="?controller=category&action=edit&id=<?php echo $category->getId(); ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td>
                            <a onclick="return confirm('Bạn có muốn xóa thể loại này không ?');"
                                href="?controller=category&action=delete&id=<?php echo $category->getId(); ?>">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
            }
          } else {
            echo "<tr><td colspan='4'>Không có thể loại nào.</td></tr>";
          }
          ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/app/views/admin/layout/footer_admin.php'; ?>
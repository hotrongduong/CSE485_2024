<?php $title = "Danh sách tác giả"; ?>
<?php include 'app/views/admin/layout/header_admin.php'; ?>

<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col-sm">
      <a href="?controller=author&action=add" class="btn btn-success">Thêm mới</a>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Tên tác giả</th>
            <th>Sửa</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (!empty($authors)) {
            foreach ($authors as $author) {
          ?>
              <tr>
                <th scope="row"><?php echo $author->getId(); ?></th>
                <td><?php echo $author->getName(); ?></td>
                <td>
                  <a href="?controller=author&action=edit&id=<?php echo $author->getId(); ?>">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>
                </td>
                <td>
                  <a onclick="return confirm('Bạn có muốn xóa tác giả này không ?');"
                    href="?controller=author&action=delete&id=<?php echo $author->getId(); ?>">
                    <i class="fa-solid fa-trash"></i>
                  </a>
                </td>
              </tr>
          <?php
            }
          } else {
            echo "<tr><td colspan='4'>Không có tác giả nào.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include 'app/views/admin/layout/footer_admin.php'; ?>
<?php
include '../db.php'; // Kết nối CSDL

// Lấy id từ query string
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy thông tin bài viết từ CSDL
    $sql = "SELECT * FROM baiviet WHERE ma_bviet = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $baiViet = $result->fetch_assoc();
        $tenBaiHat = $baiViet['ten_bhat'];
        $tomTat = $baiViet['tomtat'];
        $maTloai = $baiViet['ma_tloai'];
        $maTacGia = $baiViet['ma_tgia'];
        // Định dạng ngày
        $ngayViet = date('Y-m-d', strtotime($baiViet['ngayviet']));
        $noidung = $baiViet['noidung'];
    } else {
        echo "<script>alert('Bài viết không tồn tại!'); window.location.href='article.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID không được cung cấp!'); window.location.href='article.php';</script>";
    exit();
}

// Xử lý form cập nhật bài viết
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['txtArticleId']) && isset($_POST['txtTitle']) && isset($_POST['txtSummary']) && isset($_POST['txtContent']) && isset($_POST['txtDate']) && isset($_POST['slCategory']) && isset($_POST['slAuthor'])) {
        $id = $_POST['txtArticleId'];
        $tenBaiHat = $_POST['txtTitle'];
        $tomTat = $_POST['txtSummary'];
        $ngayViet = $_POST['txtDate'];
        $maTloai = $_POST['slCategory'];
        $maTacGia = $_POST['slAuthor'];
        $noidung = $_POST['txtContent'];

        // Truy vấn để cập nhật bài viết
        $sql = "UPDATE baiviet SET ten_bhat = ?, tomtat = ?, ngayviet = ?, ma_tloai = ?, ma_tgia = ?, noidung = ? WHERE ma_bviet = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiiisi", $tenBaiHat, $tomTat, $ngayViet, $maTloai, $maTacGia, $noidung, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Cập nhật bài viết thành công!'); window.location.href='article.php';</script>";
        } else {
            echo "<script>alert('Có lỗi xảy ra, không thể cập nhật bài viết!');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa bài viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <link rel="stylesheet" href="css/style_login.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="h3">
                    <a class="navbar-brand" href="#">Administration</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="./">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">Trang ngoài</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="article.php">Bài viết</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="author.php">Tác giả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="category.php">Thể loại</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Sửa thông tin bài viết</h3>
                <form action="edit_article.php?id=<?php echo $id; ?>" method="post">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblArticleId">ID bài viết</span>
                        <input type="text" class="form-control" name="txtArticleId" readonly value="<?php echo $id; ?>">
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblTitle">Tên bài hát</span>
                        <input type="text" class="form-control" name="txtTitle" value="<?php echo $tenBaiHat; ?>"
                            required>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblSummary">Tóm tắt</span>
                        <input type="text" class="form-control" name="txtSummary" value="<?php echo $tomTat; ?>"
                            required>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblDate">Ngày viết</span>
                        <input type="date" class="form-control" name="txtDate" value="<?php echo $ngayViet; ?>"
                            required>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCategory">Thể loại</span>
                        <select class="form-select" name="slCategory" required>
                            <option value="">Chọn thể loại</option>
                            <?php
                            // Lấy danh sách thể loại
                            $sql = "SELECT * FROM theloai";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                $selected = $row['ma_tloai'] == $maTloai ? 'selected' : '';
                                echo "<option value='{$row['ma_tloai']}' $selected>{$row['ten_tloai']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblAuthor">Tác giả</span>
                        <select class="form-select" name="slAuthor" required>
                            <option value="">Chọn tác giả</option>
                            <?php
                            // Lấy danh sách tác giả
                            $sql = "SELECT * FROM tacgia";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                $selected = $row['ma_tgia'] == $maTacGia ? 'selected' : '';
                                echo "<option value='{$row['ma_tgia']}' $selected>{$row['ten_tgia']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblContent">Nội dung</span>
                        <textarea class="form-control" name="txtContent" required><?php echo $noidung; ?></textarea>
                    </div>

                    <div class="form-group float-end">
                        <input type="submit" value="Lưu lại" class="btn btn-success">
                        <a href="article.php" class="btn btn-warning">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary border-2"
        style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
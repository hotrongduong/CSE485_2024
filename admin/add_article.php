<?php
include '../db.php'; // Kết nối CSDL

// Xử lý form thêm bài viết
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['txtSongName']) && isset($_POST['txtSummary']) && isset($_POST['txtCategory']) && isset($_POST['txtAuthor']) && isset($_POST['txtDate']) && isset($_POST['txtContent'])) {
        $tenBaiHat = $_POST['txtSongName'];
        $tomTat = $_POST['txtSummary'];
        $maTloai = $_POST['txtCategory'];
        $maTacGia = $_POST['txtAuthor'];
        $ngayViet = $_POST['txtDate'];
        $noidung = $_POST['txtContent'];

        // Truy vấn để thêm bài viết mới
        $sql = "INSERT INTO baiviet (ten_bhat, tomtat, ma_tloai, ma_tgia, ngayviet, noidung) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiiis", $tenBaiHat, $tomTat, $maTloai, $maTacGia, $ngayViet, $noidung);

        if ($stmt->execute()) {
            echo "<script>alert('Thêm bài viết thành công!'); window.location.href='article.php';</script>";
        } else {
            echo "<script>alert('Có lỗi xảy ra, không thể thêm bài viết!');</script>";
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
    <title>Thêm Bài Viết Mới</title>
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
                            <a class="nav-link" href="category.php">Thể loại</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="author.php">Tác giả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="article.php">Bài viết</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Thêm mới bài viết</h3>
                <form action="add_article.php" method="post">
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

    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary border-2"
        style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
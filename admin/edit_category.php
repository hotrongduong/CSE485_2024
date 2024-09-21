<?php
include '../db.php'; // Kết nối CSDL

// Lấy id từ query string
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy thông tin thể loại từ CSDL
    $sql = "SELECT * FROM theloai WHERE ma_tloai = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $theLoai = $result->fetch_assoc();
        $tenTheLoai = $theLoai['ten_tloai'];
    } else {
        echo "<script>alert('Thể loại không tồn tại!'); window.location.href='category.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID không được cung cấp!'); window.location.href='category.php';</script>";
    exit();
}

// Xử lý form cập nhật thể loại
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['txtCatId']) && isset($_POST['txtCatName'])) {
        $id = $_POST['txtCatId'];
        $tenTheLoai = $_POST['txtCatName'];

        // Truy vấn để cập nhật thể loại
        $sql = "UPDATE theloai SET ten_tloai = ? WHERE ma_tloai = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $tenTheLoai, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Cập nhật thể loại thành công!'); window.location.href='category.php';</script>";
        } else {
            echo "<script>alert('Có lỗi xảy ra, không thể cập nhật thể loại!');</script>";
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
    <title>Chỉnh sửa thể loại</title>
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
                            <a class="nav-link active fw-bold" href="category.php">Thể loại</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="author.php">Tác giả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="article.php">Bài viết</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Sửa thông tin thể loại</h3>
                <form action="edit_category.php?id=<?php echo $id; ?>" method="post">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatId">ID thể loại</span>
                        <input type="text" class="form-control" name="txtCatId" readonly value="<?php echo $id; ?>">
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tên thể loại</span>
                        <input type="text" class="form-control" name="txtCatName" value="<?php echo $tenTheLoai; ?>"
                            required>
                    </div>

                    <div class="form-group float-end">
                        <input type="submit" value="Lưu lại" class="btn btn-success">
                        <a href="category.php" class="btn btn-warning">Quay lại</a>
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
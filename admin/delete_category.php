<?php
include '../db.php'; // Kết nối CSDL

// Lấy ID từ query string
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Truy vấn để xóa thể loại
    $sql = "DELETE FROM theloai WHERE ma_tloai = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Xóa thể loại thành công!'); window.location.href='category.php';</script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra, không thể xóa thể loại!'); window.location.href='category.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('ID không được cung cấp!'); window.location.href='category.php';</script>";
}

$conn->close();
?>
<?php
include '../db.php'; // Kết nối CSDL

// Lấy id từ query string
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Truy vấn xóa tác giả
    $sql = "DELETE FROM tacgia WHERE ma_tgia = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Xóa tác giả thành công!'); window.location.href='author.php';</script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra, không thể xóa tác giả!');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
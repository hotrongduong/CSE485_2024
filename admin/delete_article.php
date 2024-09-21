<?php
include '../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Xóa bài viết
    $sql = "DELETE FROM baiviet WHERE ma_bviet = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Xóa bài viết thành công!'); window.location.href='article.php';</script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra!'); window.location.href='article.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('ID bài viết không hợp lệ!'); window.location.href='article.php';</script>";
}

$conn->close();
?>
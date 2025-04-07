<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location:list_monan.php");
    exit();
}

include("../include/db.php");

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]); // Chuyển ID về số nguyên để tránh lỗi SQL Injection

    // Kiểm tra xem món ăn có tồn tại không
    $check_sql = "SELECT * FROM monan WHERE id_monan = $id";
    $check_result = mysqli_query($connection, $check_sql);
    
    if (mysqli_num_rows($check_result) > 0) {
        // Xóa món ăn
        $sql = "DELETE FROM monan WHERE id_monan = $id";
        $rs = mysqli_query($connection, $sql);

        if ($rs) {
            echo "Xóa thành công!";
            header("location:list_monan.php?success=deleted");
            exit();
        } else {
            die("Lỗi khi xóa món ăn: " . mysqli_error($connection)); // Hiển thị lỗi SQL nếu có
        }
    } else {
        die("Món ăn không tồn tại!");
    }
} else {
    die("ID không hợp lệ!");
}
?>

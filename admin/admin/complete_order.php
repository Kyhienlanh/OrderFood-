<?php
include '../include/db.php';

if (isset($_GET['id'])) {
    $id_donhang = intval($_GET['id']);
    
    // Cập nhật trạng thái đơn hàng thành 'Hoàn tất'
    $sql = "UPDATE donhang SET trangthai = 'hoan_tat' WHERE id_donhang = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_donhang);
    
    if (mysqli_stmt_execute($stmt)) {
        // Thành công, chuyển hướng về trang danh sách đơn hàng
        header('Location: order_confirm.php');
        exit;
    } else {
        // Thông báo lỗi nếu có vấn đề trong việc cập nhật
        echo "Lỗi khi cập nhật trạng thái đơn hàng!";
    }
}
?>

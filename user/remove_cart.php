<?php
include("../db.php");
session_start();

if (isset($_POST['id_monan'])) {
    $id_monan = $_POST['id_monan'];
    $id_user = $_SESSION['user_id'];

    // Xóa sản phẩm khỏi giỏ hàng
    $query = "DELETE FROM giohang WHERE id_monan = $id_monan AND id_nguoidung = $id_user";
    if (!mysqli_query($connection, $query)) {
        echo json_encode(["status" => "error", "message" => "Lỗi SQL: " . mysqli_error($connection)]);
        exit();
    }

    // Tính lại tổng giỏ hàng
    $query_total = "SELECT SUM(g.soluong * m.gia) AS tong_gio_hang FROM giohang g 
                    JOIN monan m ON g.id_monan = m.id_monan WHERE g.id_nguoidung = $id_user";
    $result_total = mysqli_query($connection, $query_total);
    
    if ($result_total) {
        $row_total = mysqli_fetch_assoc($result_total);
        $tong_gio_hang = $row_total['tong_gio_hang'] ?? 0;
        echo json_encode(["status" => "success", "cart_total" => $tong_gio_hang]);
    } else {
        echo json_encode(["status" => "error", "message" => "Lỗi khi tính tổng giỏ hàng"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Dữ liệu không hợp lệ!"]);
}
?>

<?php
header('Content-Type: application/json');
include("../db.php");
session_start();

$id_nguoidung = $_SESSION['user_id'];

if (!isset($_POST['address'])) {
    echo json_encode(["status" => "error", "message" => "Không nhận được địa chỉ!"]);
    exit();
}

$diachi = mysqli_real_escape_string($connection, $_POST['address']); // Lấy địa chỉ từ request

// Kiểm tra dữ liệu nhận được
error_log("Địa chỉ nhận được: " . $diachi);

$query = "SELECT g.id_monan, g.soluong, m.gia 
          FROM giohang g 
          JOIN monan m ON g.id_monan = m.id_monan 
          WHERE g.id_nguoidung = $id_nguoidung";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    $tong_tien = 0;
    $items = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        $tong_tien += $row['soluong'] * $row['gia'];
        $items[] = $row;
    }

    $query_insert_donhang = "INSERT INTO donhang (id_nguoidung, tongtien, diachi) 
                             VALUES ($id_nguoidung, $tong_tien, '$diachi')";

    if (mysqli_query($connection, $query_insert_donhang)) {
        $id_donhang = mysqli_insert_id($connection); 

        foreach ($items as $item) {
            $id_monan = $item['id_monan'];
            $soluong = $item['soluong'];
            $gia = $item['gia'];
            $query_insert_chitiet = "INSERT INTO chitietdonhang (id_donhang, id_monan, soluong, gia) 
                                     VALUES ($id_donhang, $id_monan, $soluong, $gia)";
            mysqli_query($connection, $query_insert_chitiet);
        }

        $query_delete_cart = "DELETE FROM giohang WHERE id_nguoidung = $id_nguoidung";
        mysqli_query($connection, $query_delete_cart);

        echo json_encode(["status" => "success", "message" => "Đặt hàng thành công!", "id_donhang" => $id_donhang]);
    } else {
        echo json_encode(["status" => "error", "message" => "Lỗi khi tạo đơn hàng!"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Giỏ hàng của bạn đang trống!"]);
}


?>

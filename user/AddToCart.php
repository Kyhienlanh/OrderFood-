
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Kết nối Database
include("../db.php");
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Vui lòng đăng nhập để thêm vào giỏ hàng."]);
    exit;
}

// Kiểm tra dữ liệu gửi lên
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_monan = $_POST['id'] ?? 0;
    $id_nguoidung = $_SESSION['user_id'] ?? 0; // Kiểm tra người dùng đăng nhập

    if ($id_monan == 0 || $id_nguoidung == 0) {
        echo json_encode(["status" => "error", "message" => "Thiếu thông tin"]);
        exit;
    }

    // Kiểm tra sản phẩm đã có trong giỏ chưa
    $query = "SELECT * FROM giohang WHERE id_nguoidung = ? AND id_monan = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ii", $id_nguoidung, $id_monan);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Nếu đã có thì tăng số lượng
        $updateQuery = "UPDATE giohang SET soluong = soluong + 1 WHERE id_nguoidung = ? AND id_monan = ?";
        $stmt = $connection->prepare($updateQuery);
        $stmt->bind_param("ii", $id_nguoidung, $id_monan);
        $stmt->execute();
    } else {
        // Nếu chưa có thì thêm mới
        $insertQuery = "INSERT INTO giohang (id_nguoidung, id_monan, soluong, ngaythem) VALUES (?, ?, 1, NOW())";
        $stmt = $connection->prepare($insertQuery);
        $stmt->bind_param("ii", $id_nguoidung, $id_monan);
        $stmt->execute();
    }

    // Trả về JSON hợp lệ
    echo json_encode(["status" => "success"]);
    exit;
}
?>

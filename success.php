<?php
require 'config.php';
include("db.php");
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION['user_id'])) {
    die('Lỗi: Người dùng chưa đăng nhập.');
}

$id_nguoidung = intval($_SESSION['user_id']); // Ép kiểu an toàn


if (!isset($_GET['paymentId'], $_GET['PayerID'])) {
    die('Thanh toán không hợp lệ');
}

$paymentId = $_GET['paymentId'];
$payerId = $_GET['PayerID'];
$diachi = mysqli_real_escape_string($connection, $_GET['address']); 

try {
    
    $payment = Payment::get($paymentId, $apiContext);
    $execution = new PaymentExecution();
    $execution->setPayerId($payerId);
    $result = $payment->execute($execution, $apiContext);

 
    $query = "SELECT g.id_monan, g.soluong, m.gia 
              FROM giohang g 
              JOIN monan m ON g.id_monan = m.id_monan 
              WHERE g.id_nguoidung = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_nguoidung);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $tong_tien = 0;
        $items = [];
        
        while ($row = mysqli_fetch_assoc($result)) {
            $tong_tien += $row['soluong'] * $row['gia'];
            $items[] = $row;
        }

      
        $query_insert_donhang = "INSERT INTO donhang (id_nguoidung, tongtien, diachi) 
                                 VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($connection, $query_insert_donhang);
        mysqli_stmt_bind_param($stmt, "ids", $id_nguoidung, $tong_tien, $diachi);
        
        if (mysqli_stmt_execute($stmt)) {
            $id_donhang = mysqli_insert_id($connection);

           
            foreach ($items as $item) {
                $query_insert_chitiet = "INSERT INTO chitietdonhang (id_donhang, id_monan, soluong, gia) 
                                         VALUES (?, ?, ?, ?)";
                $stmt = mysqli_prepare($connection, $query_insert_chitiet);
                mysqli_stmt_bind_param($stmt, "iiid", $id_donhang, $item['id_monan'], $item['soluong'], $item['gia']);
                mysqli_stmt_execute($stmt);
            }

           
            $query_delete_cart = "DELETE FROM giohang WHERE id_nguoidung = ?";
            $stmt = mysqli_prepare($connection, $query_delete_cart);
            mysqli_stmt_bind_param($stmt, "i", $id_nguoidung);
            mysqli_stmt_execute($stmt);

           
            $query_payment = "INSERT INTO thanhtoan (id_donhang, phuongthuc, trangthai_thanhtoan, ngaythanhtoan)  
                              VALUES (?, 'paypal', 'da_thanh_toan', NOW())";
            $stmt = mysqli_prepare($connection, $query_payment);
            mysqli_stmt_bind_param($stmt, "i", $id_donhang);
            mysqli_stmt_execute($stmt);

            echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        title: "Thanh toán thành công!",
                        text: "Cảm ơn bạn đã mua hàng. Nhấn OK để quay lại giỏ hàng.",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "../ProjectPHP/user/donhang.php";
                        }
                    });
                });
            </script>';

            exit();
        } else {
            echo "Lỗi khi thêm đơn hàng: " . mysqli_error($connection);
        }
    } else {
        echo "Giỏ hàng trống.";
    }
} catch (Exception $e) {
    echo "Lỗi xử lý thanh toán: " . $e->getMessage();
}
?>

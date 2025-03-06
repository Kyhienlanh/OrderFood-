<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tennguoidung = isset($_POST['username']) ? trim($_POST['username']) : ''; 
    $matkhau = isset($_POST['pass']) ? trim($_POST['pass']) : ''; 

    if (!empty($tennguoidung) && !empty($matkhau)) {
        // Sử dụng Prepared Statement để tránh SQL Injection
        $query = "SELECT * FROM nguoidung WHERE tennguoidung = ? AND matkhau = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "ss", $tennguoidung, $matkhau);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
          
            $_SESSION['user_id'] = $row['id_nguoidung'];
            $_SESSION['username'] = $row['tennguoidung'];

            echo "Đăng nhập thành công! Chào mừng, " . $_SESSION['username'];

            if($row['vaitro']=="quanly"){
                header("Location: admin/trangchuAdmin.php");
                exit();
            }
            else{
                header("Location: user/trangchuNguoiDung.php");
                exit();
            }
          
        } else {
            echo "Sai tài khoản hoặc mật khẩu!";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Vui lòng nhập đầy đủ thông tin!";
    }
}
?>



<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>
<body>
    <h2>Đăng nhập</h2>
    <form action="login.php" method="post">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" name="username" required>
        <br>
        <label for="pass">Mật khẩu:</label>
        <input type="password" name="pass" required>
        <br>
        <button type="submit">Đăng nhập</button>
    </form>
</body>
</html>

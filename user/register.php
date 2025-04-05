<?php
session_start();
include("../db.php");

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tennguoidung = trim($_POST["tennguoidung"]);
    $email = trim($_POST["email"]);
    $matkhau = trim($_POST["matkhau"]);
    $confirm_matkhau = trim($_POST["confirm_matkhau"]);
    $hovaten = trim($_POST["hovaten"]);
    $sodienthoai = trim($_POST["sodienthoai"]);
    $diachi = trim($_POST["diachi"]);

    // Kiểm tra input
    if (empty($tennguoidung) || empty($email) || empty($matkhau) || empty($confirm_matkhau)) {
        $errors[] = "Vui lòng điền đầy đủ thông tin!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email không hợp lệ!";
    } elseif ($matkhau !== $confirm_matkhau) {
        $errors[] = "Mật khẩu nhập lại không khớp!";
    } elseif (strlen($matkhau) < 6) {
        $errors[] = "Mật khẩu phải có ít nhất 6 ký tự!";
    }

    if (empty($errors)) {
        // Kiểm tra email đã tồn tại chưa
        $stmt = $connection->prepare("SELECT id_nguoidung FROM nguoidung WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors[] = "Email này đã được sử dụng!";
        } else {
            // Mã hóa mật khẩu
            $hashed_password = password_hash($matkhau, PASSWORD_DEFAULT);

            // Lưu vào database
            $stmt = $connection->prepare("INSERT INTO nguoidung (tennguoidung, email, matkhau, hovaten, sodienthoai, diachi, vaitro) 
                                    VALUES (?, ?, ?, ?, ?, ?, 'khach')");
            $stmt->bind_param("ssssss", $tennguoidung, $email, $hashed_password, $hovaten, $sodienthoai, $diachi);

            if ($stmt->execute()) {
                $_SESSION["success"] = "Đăng ký thành công! Hãy đăng nhập.";
                header("Location: /login.php");
                exit();
            } else {
                $errors[] = "Đăng ký thất bại! Vui lòng thử lại.";
            }
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
    background: linear-gradient(to right, #6a11cb, #2575fc);
    font-family: 'Poppins', sans-serif;
}

.register-container {
    max-width: 450px;
    margin: 60px auto;
    background: #ffffff;
    padding: 35px;
    border-radius: 12px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
    animation: fadeIn 0.8s ease-in-out;
}

h2 {
    text-align: center;
    font-weight: 600;
    margin-bottom: 25px;
    color: #333;
}

.form-label {
    font-weight: 500;
    color: #444;
}

.form-control {
    border-radius: 8px;
    border: 1px solid #ccc;
    padding: 10px;
    transition: 0.3s;
}

.form-control:focus {
    border-color: #2575fc;
    box-shadow: 0px 0px 5px rgba(37, 117, 252, 0.5);
}

button {
    border-radius: 8px;
    padding: 12px;
    font-size: 16px;
    font-weight: 600;
    background: linear-gradient(to right, #6a11cb, #2575fc);
    border: none;
    transition: 0.3s;
}

button:hover {
    background: linear-gradient(to right, #5e10c1, #1e6bee);
}

.alert {
    border-radius: 8px;
    padding: 12px;
    font-size: 14px;
    text-align: center;
}

p {
    font-size: 14px;
    color: #555;
}

p a {
    color: #2575fc;
    font-weight: 600;
    text-decoration: none;
}

p a:hover {
    text-decoration: underline;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

    </style>
</head>
<body>

<div class="register-container">
    <h2 class="text-center">Đăng Ký Tài Khoản</h2>
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <?php echo implode("<br>", $errors); ?>
        </div>
    <?php endif; ?>
    
    <form action="register.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Tên người dùng</label>
            <input type="text" name="tennguoidung" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mật khẩu</label>
            <input type="password" name="matkhau" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nhập lại mật khẩu</label>
            <input type="password" name="confirm_matkhau" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Họ và tên</label>
            <input type="text" name="hovaten" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Số điện thoại</label>
            <input type="text" name="sodienthoai" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Địa chỉ</label>
            <textarea name="diachi" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-register w-100">Đăng Ký</button>
    </form>

    <p class="text-center mt-3">Đã có tài khoản? <a href="../login.php">Đăng nhập</a></p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

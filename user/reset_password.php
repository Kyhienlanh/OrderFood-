<?php
session_start();
include("../db.php");

$errors = [];
$success = "";

if (!isset($_SESSION["verified_email"])) {
    die("Bạn chưa xác nhận email!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = trim($_POST["new_password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    if ($new_password !== $confirm_password) {
        $errors[] = "Mật khẩu không khớp!";
    } elseif (strlen($new_password) < 6) {
        $errors[] = "Mật khẩu phải có ít nhất 6 ký tự!";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $email = $_SESSION["verified_email"];

        $stmt = $connection->prepare("UPDATE nguoidung SET matkhau = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashed_password, $email);
        $stmt->execute();

        unset($_SESSION["verified_email"]);
        $success = "Đặt lại mật khẩu thành công! Bạn có thể đăng nhập ngay.";
        header("Location: /PROJECTPHP/login.php"); 
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Đặt Lại Mật Khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Đặt Lại Mật Khẩu</h2>
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger"><?php echo implode("<br>", $errors); ?></div>
    <?php endif; ?>
    <?php if ($success) : ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>

    <form action="reset_password.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Mật khẩu mới</label>
            <input type="password" name="new_password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Xác nhận mật khẩu</label>
            <input type="password" name="confirm_password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Đặt Lại</button>
    </form>
</div>

</body>
</html>

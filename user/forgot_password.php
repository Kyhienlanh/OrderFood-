<?php
session_start();
include("../db.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Import PHPMailer
require '../vendor/autoload.php'; 

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Vui lòng nhập email hợp lệ!";
    } else {
        $stmt = $connection->prepare("SELECT id_nguoidung FROM nguoidung WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 0) {
            $errors[] = "Email không tồn tại!";
        } else {
            // Tạo mã OTP
            $otp_code = rand(100000, 999999);
            $_SESSION["otp_code"] = $otp_code;
            $_SESSION["otp_email"] = $email;
            $_SESSION["otp_expire"] = time() + 300; // OTP hết hạn sau 5 phút

            // Gửi email bằng PHPMailer
            $mail = new PHPMailer(true);
            try {
                // Cấu hình SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = '2124802010739@student.tdmu.edu.vn'; // Thay bằng email của bạn
                $mail->Password = 'mspx rpwp osmx oomq'; // Thay bằng mật khẩu ứng dụng Gmail
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Cài đặt email gửi
                $mail->setFrom('2124802010739@student.tdmu.edu.vn', 'Ho tro khach hang');
                $mail->addAddress($email);
                $mail->Subject = "OTP HKL FOOD";
                $mail->Body = "Mã OTP của bạn là: $otp_code. Mã này có hiệu lực trong 5 phút.";

                // Gửi email
                $mail->send();

                $success = "Mã OTP đã được gửi đến email của bạn!";
                header("Location: verify_otp.php");
                exit();
            } catch (Exception $e) {
                $errors[] = "Gửi email thất bại: {$mail->ErrorInfo}";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Quên Mật Khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Quên Mật Khẩu</h2>
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger"><?php echo implode("<br>", $errors); ?></div>
    <?php endif; ?>
    <?php if ($success) : ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>

    <form action="forgot_password.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Nhập Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Gửi Mã OTP</button>
    </form>
</div>

</body>
</html>

<?php
session_start();
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp = trim($_POST["otp"]);

    if (!isset($_SESSION["otp_code"]) || time() > $_SESSION["otp_expire"]) {
        $errors[] = "Mã OTP đã hết hạn! Vui lòng yêu cầu lại.";
    } elseif ($otp != $_SESSION["otp_code"]) {
        $errors[] = "Mã OTP không chính xác!";
    } else {
        $_SESSION["verified_email"] = $_SESSION["otp_email"];
        header("Location: reset_password.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Xác Nhận OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .otp-container {
            max-width: 400px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .otp-input {
            font-size: 1.2rem;
            text-align: center;
            letter-spacing: 4px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="otp-container text-center">
        <h3 class="mb-3">🔑 Xác Nhận OTP</h3>

        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger"><?php echo implode("<br>", $errors); ?></div>
        <?php endif; ?>

        <form action="verify_otp.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Nhập mã OTP</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                    <input type="text" name="otp" class="form-control otp-input" required maxlength="6">
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">✅ Xác Nhận</button>
        </form>

        <div class="mt-3">
            <small class="text-muted">Chưa nhận được mã? <a href="forgot_password.php" class="text-decoration-none">Gửi lại OTP</a></small>
        </div>
    </div>
</div>

</body>
</html>

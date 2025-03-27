<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'errors.log');
header('Content-Type: application/json'); // Đảm bảo trả về JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['token']) || $_POST['token'] != 'FsWga4&@f6aw') {
        echo json_encode(["status" => "error", "message" => "Invalid token"]);
        exit;
    }

    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['phone']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = nl2br(htmlspecialchars($_POST['message']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Email không hợp lệ!"]);
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = '2124802010739@student.tdmu.edu.vn'; // Thay bằng email của bạn
        $mail->Password = 'mspx rpwp osmx oomq'; // Thay bằng mật khẩu ứng dụng
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';

        $mail->setFrom('2124802010739@student.tdmu.edu.vn', 'GIA KỲ'); // Dùng email của bạn
        $mail->addReplyTo($email, $name); // Người nhận có thể trả lời email
        $mail->addAddress('atulakalihihi@gmail.com'); // Thay bằng email người nhận

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = "
            <h3>Thông tin liên hệ</h3>
            <p><strong>Tên:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Điện thoại:</strong> $phone</p>
            <p><strong>Nội dung:</strong></p>
            <p>$message</p>
        ";

        $mail->send();
        echo json_encode(["status" => "success", "message" => "✅ Email đã gửi thành công!"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "❌ Gửi thất bại! Lỗi: " . $mail->ErrorInfo]);
    }
}

?>

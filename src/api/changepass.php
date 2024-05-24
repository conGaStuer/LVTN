<?php
require "./config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require "D:\PHPMailer-PHPMailer-2128d99\src\Exception.php";
require "D:\PHPMailer-PHPMailer-2128d99\src\PHPMailer.php";
require "D:\PHPMailer-PHPMailer-2128d99\src\SMTP.php";

// Lấy email từ yêu cầu POST
$data = json_decode(file_get_contents("php://input"));
$email = $data->email;

// Tạo mật khẩu mới ngẫu nhiên
$newPassword = generateRandomPassword();

// Gửi email chứa mật khẩu mới
$mail = new PHPMailer(true);

try {
    // Cấu hình máy chủ SMTP
    $mail->isSMTP();
    $mail->Host = 'localhost'; // Thay đổi thành máy chủ SMTP của bạn
    $mail->SMTPAuth = true;
    $mail->Username = 'khuongtranxuan9@gmail.com'; // Thay đổi thành địa chỉ email của bạn
    $mail->Password = '0854219725Bb'; // Thay đổi thành mật khẩu email của bạn
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Cấu hình email
    $mail->addAddress($email);
    $mail->Subject = 'New Password';
    $mail->Body = 'Your new password: ' . $newPassword;

    // Gửi email
    $mail->send();

    // Trả về phản hồi cho trang Vue.js
    echo json_encode(['message' => 'Mật khẩu mới đã được gửi qua email.']);
} catch (Exception $e) {
    // Xử lý lỗi nếu có
    echo json_encode(['error' => $mail->ErrorInfo]);
}

// Hàm sinh mật khẩu ngẫu nhiên
function generateRandomPassword($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $password .= $characters[$index];
    }
    return $password;
}
?>
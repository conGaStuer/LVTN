<?php

include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $taikhoan = $data['taikhoan'];
    $email = $data['email'];
    $tenKH = $data['tenKH'];
    $sdt = $data['sdt'];
    $diachi = $data['diachi'];

    $sql = "UPDATE nguoi_dung SET email = '$email', tenKH = '$tenKH', sdt = '$sdt', diachi = '$diachi' WHERE taikhoan = '$taikhoan'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Failed']);
    }
}
?>
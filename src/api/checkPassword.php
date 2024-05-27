<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $maND = $data['maND'];
    $currentPassword = $data['currentPassword'];

    // Fetch the stored hashed password for the user
    $sql = "SELECT matkhau FROM nguoi_dung WHERE maND = '$maND'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['matkhau'];

        // Verify the current password with the stored hashed password
        if (password_verify($currentPassword, $storedPassword)) {
            echo json_encode(['isPasswordCorrect' => true]);
        } else {
            echo json_encode(['isPasswordCorrect' => false]);
        }
    } else {
        echo json_encode(['isPasswordCorrect' => false]);
    }
}
?>
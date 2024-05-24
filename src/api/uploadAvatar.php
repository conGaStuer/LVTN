<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["hinh"])) {
    $defaultDir = "user_uploads/"; // Specify the default directory for user-uploaded images
    $targetDir = __DIR__ . '/' . $defaultDir; // Get the full path to the default directory
    $fileName = uniqid() . "_" . basename($_FILES["hinh"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $targetFilePath)) {
        echo json_encode(["url" => $defaultDir . $fileName]);
    } else {
        echo json_encode(["error" => "Failed to upload file"]);
    }
}
?>
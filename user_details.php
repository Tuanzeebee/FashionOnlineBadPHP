<?php
include_once "api/app/Config.php";
include_once "head.php";


if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    die("Bạn không có quyền truy cập chức năng này.");
}

// Kết nối cơ sở dữ liệu
$db = new Config();
$conn = $db->connect();

// Lấy ID người dùng từ URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID người dùng không hợp lệ.");
}

$user_id = intval($_GET['id']);

// Lấy thông tin người dùng
$query = "SELECT user_id, fname,lname, email,birthday,gender,is_admin FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Không tìm thấy người dùng.");
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết người dùng</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Chi tiết người dùng</h2>
    <p><strong>ID:</strong> <?= $user['user_id']; ?></p>
    <p><strong>Tên người dùng:</strong> <?= htmlspecialchars($user['fname']); ?></p>
    <p><strong>Tên người dùng:</strong> <?= htmlspecialchars($user['lname']); ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']); ?></p>
    <p><strong>Quyền Admin:</strong> <?= $user['is_admin'] == 1 ? 'Có' : 'Không'; ?></p>
    <p><strong>Ngày sinh:</strong> <?= $user['birthday']; ?></p>
    <p><strong>Giới Tính:</strong> <?= $user['gender']; ?></p>

<?php
include_once "api/app/Config.php";

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['is_stylist'] != 1) {
    die("Bạn không có quyền truy cập.");
}

$request_id = intval($_POST['request_id']);
$action = $_POST['action'];

if (!in_array($action, ['accept', 'reject'])) {
    die("Hành động không hợp lệ.");
}

$status = $action === 'accept' ? 'accepted' : 'rejected';

// Kết nối database
$config = new Config();
$conn = $config->connect();

// Cập nhật trạng thái yêu cầu
$sql = "UPDATE chat_requests SET status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $status, $request_id);

if ($stmt->execute()) {
    header("Location: stylist_requests.php?message=Cập nhật trạng thái thành công.");
    exit();
} else {
    echo "Lỗi khi cập nhật trạng thái.";
}

$stmt->close();
$conn->close();
?>

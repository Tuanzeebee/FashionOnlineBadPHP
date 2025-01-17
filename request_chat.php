<?php
include_once "api/app/controller/AuthController.php";
include_once "api/app/Config.php";
include_once "api/app/controller/UserController.php";

$auth = new AuthController();
$auth->checkAuth();

$user = new UserController();
$row = $user->getUserById($_SESSION['unique_id']);
include_once "head.php";

// Kiểm tra người dùng đã đăng nhập chưa
if (!isset($_SESSION['unique_id'])) {
    die("Bạn cần đăng nhập để thực hiện chức năng này.");
}

$user_id = $_SESSION['unique_id']; // Lấy user_id từ session
$stylist_id = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 0; // Get stylist_id from the URL parameter

// Kết nối database
$config = new Config();
$conn = $config->connect();

// Kiểm tra nếu stylist_id hợp lệ
if ($stylist_id <= 0) {
    die("Stylist không hợp lệ.");
}

// Check if the stylist exists with is_stylist = 1
$sql = "SELECT user_id FROM users WHERE user_id = ? AND is_stylist = 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $stylist_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows <= 0) {
    die("Stylist không tồn tại hoặc không phải là stylist.");
}

// Insert a request into the chat_requests table
$sql = "INSERT INTO chat_requests (user_id, stylist_id, status, created_at) 
        VALUES (?, ?, 'pending', NOW())";

// Prepare the statement
$stmt = $conn->prepare($sql);
if ($stmt) {
    // Bind parameters
    $stmt->bind_param("ii", $user_id, $stylist_id);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "<p>Yêu cầu đã được gửi đến stylist.</p>";
    } else {
        echo "<p>Không thể gửi yêu cầu. Vui lòng thử lại.</p>";
    }
    $stmt->close();
} else {
    echo "<p>Không thể chuẩn bị câu lệnh SQL. Vui lòng thử lại sau.</p>";
}

// Close the connection
$conn->close();
?>

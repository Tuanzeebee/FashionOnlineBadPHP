<?php
include_once "api/app/controller/AuthController.php";
include_once "api/app/Config.php";
include_once "api/app/controller/UserController.php";

// Kiểm tra quyền admin
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    die("Bạn không có quyền truy cập chức năng này.");
}

$db = new Config();
$conn = $db->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $table_name = $_POST['table_name'];
    $product_id = intval($_POST['product_id']);

    // Xác thực dữ liệu
    $valid_tables = ['hangnew', 'products', 'donu', 'phukien', 'dosale', 'hanghot'];
    if (!in_array($table_name, $valid_tables)) {
        die("Bảng không hợp lệ.");
    }

    // Xóa sản phẩm
    $query = "DELETE FROM `$table_name` WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        echo "Sản phẩm đã được xóa thành công.";
    } else {
        echo "Lỗi khi xóa sản phẩm: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

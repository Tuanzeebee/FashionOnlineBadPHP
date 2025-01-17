<?php
session_start();
include_once "head.php";
include_once "api/app/Config.php"; // Đảm bảo đường dẫn đúng

// Tính tổng số lượng và tổng giá trị giỏ hàng
$totalQuantity = 0;
$totalPrice = 0;

// Kiểm tra giỏ hàng trong session
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $totalQuantity += $item['quantity'];
        $totalPrice += $item['price'] * $item['quantity'];
    }
}

// Chuyển đổi giá trị tổng giá trị giỏ hàng sang định dạng tiền tệ (VND)
$totalPriceFormatted = number_format($totalPrice, 0, ',', '.') . ' VND';

// Kiểm tra xem tham số `id` và `type` có được truyền qua URL không
if (isset($_GET['id']) && is_numeric($_GET['id']) && isset($_GET['type'])) {
    $id = intval($_GET['id']); // Đảm bảo ID là số nguyên
    $type = $_GET['type']; // Lấy loại sản phẩm

    // Xác định bảng cần truy vấn dựa trên tham số `type`
    $allowedTables = ['products', 'phukien', 'donu', 'dosale', 'hangnew', 'hanghot']; // Các bảng được phép truy vấn
    if (in_array($type, $allowedTables)) {
        $sql = "SELECT * FROM $type WHERE id = ?"; // Chèn tên bảng một cách an toàn
    } else {
        die("<p>Loại sản phẩm không hợp lệ.</p>");
    }

    // Kết nối cơ sở dữ liệu và thực hiện truy vấn
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "<p>Sản phẩm không tồn tại.</p>";
        }

        $stmt->close();
    } else {
        echo "<p>Không thể chuẩn bị truy vấn.</p>";
    }
} else {
    echo "<p>ID sản phẩm hoặc loại sản phẩm không hợp lệ.</p>";
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>

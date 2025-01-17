<?php
session_start(); // Bắt đầu session để truy cập giỏ hàng

// Kiểm tra nếu dữ liệu POST tồn tại
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy thông tin từ form
    $itemId = isset($_POST['item_id']) ? $_POST['item_id'] : null;

    // Kiểm tra nếu thông tin hợp lệ
    if ($itemId) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] == $itemId) {
                unset($_SESSION['cart'][$key]); // Xóa sản phẩm khỏi giỏ hàng
                $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex lại mảng giỏ hàng
                break; 
            }
        }
    }
}

// Chuyển hướng về trang giỏ hàng sau khi xử lý
header('Location: test.php');
exit();
?>

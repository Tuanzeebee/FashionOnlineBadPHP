<?php
session_start();
require 'connect.php'; // Kết nối cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    // Lưu thông tin đơn hàng
    $sql = "INSERT INTO orders (name, address, phone, total_price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $address, $phone, $totalPrice);

    $totalPrice = 0;
    foreach ($_SESSION['cart'] as $item) {
        $totalPrice += $item['price'] * $item['quantity'];
    }

    if ($stmt->execute()) {
        $orderId = $stmt->insert_id;

        // Lưu chi tiết đơn hàng
        foreach ($_SESSION['cart'] as $item) {
            $sql = "INSERT INTO order_details (order_id, product_id, size, quantity, price) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iisid", $orderId, $item['id'], $item['size'], $item['quantity'], $item['price']);
            $stmt->execute();
        }

        // Xóa giỏ hàng sau khi thanh toán
        unset($_SESSION['cart']);
        echo "<p>Thanh toán thành công! Đơn hàng của bạn đang được xử lý.</p>";
    } else {
        echo "<p>Đã xảy ra lỗi khi xử lý đơn hàng.</p>";
    }
}
?>

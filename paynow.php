<?php
include("head.php");

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<p>Không có sản phẩm nào trong giỏ hàng. Vui lòng thêm sản phẩm trước.</p>";
    exit();
}

// Hiển thị thông tin giỏ hàng
$totalPrice = 0;
foreach ($_SESSION['cart'] as $item) {
    echo "<div class='cart-item'>";
    echo "<p>Tên: " . $item['name'] . "</p>";
    echo "<p>Giá: " . $item['price'] . " VND</p>";
    echo "<p>Kích cỡ: " . $item['size'] . "</p>";
    echo "<p>Số lượng: " . $item['quantity'] . "</p>";
    echo "<hr>";
    $totalPrice += $item['price'] * $item['quantity'];
}
echo "<p>Tổng tiền: $totalPrice VND</p>";
?>

<form action="process_payment.php" method="post">
    <label for="name">Họ và tên:</label>
    <input type="text" name="name" required>
    <label for="address">Địa chỉ giao hàng:</label>
    <input type="text" name="address" required>
    <label for="phone">Số điện thoại:</label>
    <input type="text" name="phone" required>
    <button type="submit">Xác nhận thanh toán</button>
</form>

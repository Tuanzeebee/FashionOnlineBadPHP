<?php
include('head.php');
include_once "api/app/Config.php";

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $quantity = isset($_GET['quantity']) ? (int) $_GET['quantity'] : 1;

    // Kết nối cơ sở dữ liệu
    $config = new Config();
    $conn = $config->connect();

    // Kiểm tra và lấy giá trị của type
    $type = isset($_GET['type']) ? $_GET['type'] : '';  // Nếu không có 'type', gán là chuỗi rỗng

    // Xác định bảng cần truy vấn dựa trên tham số `type`
    $allowedTables = ['products', 'phukien', 'donu', 'dosale', 'hangnew', 'hanghot']; // Các bảng được phép truy vấn
    if (in_array($type, $allowedTables)) {
        $sql = "SELECT * FROM $type WHERE id = ?"; // Tạo câu truy vấn an toàn
    } else {
        // Nếu type không hợp lệ, trả về thông báo lỗi
        echo "<script>alert('Loại sản phẩm không hợp lệ'); window.history.back();</script>";
        exit;
    }

    // Tiến hành chuẩn bị câu truy vấn và thực thi
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Kiểm tra nếu có kết quả
        if ($result->num_rows > 0) {
            // Lấy thông tin sản phẩm
            $product = $result->fetch_assoc();
            $productName = $product['name'];    // Tên sản phẩm
            $productImage = $product['image'];  // Hình ảnh sản phẩm
            $productPrice = $product['price'];  // Giá sản phẩm từ cơ sở dữ liệu

            // Nếu giỏ hàng chưa được khởi tạo
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId]['quantity'] += $quantity; // Tăng số lượng nếu sản phẩm đã có trong giỏ
            } else {
                // Thêm sản phẩm mới vào giỏ hàng
                $_SESSION['cart'][$productId] = [
                    'id' => $productId,
                    'name' => $productName,
                    'image' => $productImage,
                    'price' => $productPrice,
                    'quantity' => $quantity
                ];
            }

            echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng'); window.history.back();</script>";
        } else {
            echo "<script>alert('Sản phẩm không tồn tại'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Không thể truy vấn cơ sở dữ liệu'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Không tìm thấy sản phẩm'); window.history.back();</script>";
}
?>

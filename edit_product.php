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
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = isset($_POST['price']) ? floatval($_POST['price']) : null;
    $category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : null;

    // Xác thực dữ liệu
    $valid_tables = ['hangnew', 'products', 'donu', 'phukien', 'dosale', 'hanghot'];
    if (!in_array($table_name, $valid_tables)) {
        die("Bảng không hợp lệ.");
    }

    // Tạo câu truy vấn cập nhật
    $fields = [];
    $params = [];
    $types = "";

    if (!empty($name)) {
        $fields[] = "name = ?";
        $params[] = $name;
        $types .= "s";
    }
    if (!empty($description)) {
        $fields[] = "description = ?";
        $params[] = $description;
        $types .= "s";
    }
    if (!is_null($price)) {
        $fields[] = "price = ?";
        $params[] = $price;
        $types .= "d";
    }
    if (!is_null($category_id)) {
        $fields[] = "category_id = ?";
        $params[] = $category_id;
        $types .= "i";
    }

    // Kiểm tra và xử lý ảnh nếu có file được upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "api/images/$table_name/";
        $img_name = $_FILES['image']['name'];
        $img_type = $_FILES['image']['type'];
        $tmp_name = $_FILES['image']['tmp_name'];

        // Phân tích phần mở rộng file
        $img_explode = explode('.', $img_name);
        $img_ext = strtolower(end($img_explode));

        // Các loại file được phép
        $allowed_extensions = ["jpeg", "png", "jpg"];
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];

        // Kiểm tra file upload
        if (!in_array($img_ext, $allowed_extensions) || !in_array($img_type, $allowed_types)) {
            die("Vui lòng chỉ upload file ảnh có định dạng jpeg, png, jpg.");
        }

        // Đặt đường dẫn file
        $target_file = $target_dir . basename($img_name);

        // Tạo thư mục nếu chưa tồn tại
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Upload file
        if (move_uploaded_file($tmp_name, $target_file)) {
            $fields[] = "image = ?";
            $params[] = $target_file; // Lưu đường dẫn file ảnh vào database
            $types .= "s";
        } else {
            die("Có lỗi khi upload hình ảnh.");
        }
    }

    // Thực hiện cập nhật nếu có thông tin cần sửa
    if (count($fields) > 0) {
        $query = "UPDATE `$table_name` SET " . implode(", ", $fields) . " WHERE id = ?";
        $params[] = $product_id;
        $types .= "i";

        $stmt = $conn->prepare($query);
        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            // Chuyển hướng về admin.php sau khi thành công
            header("Location: admin.php?message=Sản phẩm đã được cập nhật thành công");
            exit();
        } else {
            echo "Lỗi khi cập nhật sản phẩm: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Không có thông tin nào để cập nhật.";
    }

    $conn->close();
}
?>

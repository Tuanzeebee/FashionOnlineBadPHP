<?php
include_once "api/app/controller/AuthController.php";
include_once "api/app/Config.php";
include_once "api/app/controller/UserController.php";

// Kết nối cơ sở dữ liệu
$config = new Config();  // Giả sử bạn đã khai báo Config trong file Config.php
$conn = $config->connect();  // Kết nối cơ sở dữ liệu

// Kiểm tra xác thực
$auth = new AuthController();
$auth->checkAuth();

$user = new UserController();
$row = $user->getUserById($_SESSION['unique_id']);

// Kiểm tra quyền admin
if ($row && $row['is_admin'] == 1) {
    $_SESSION['is_admin'] = 1;
} else {
    $_SESSION['is_admin'] = 0;
}
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    die("Bạn không có quyền thêm sản phẩm.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $table_name = $_POST['table_name']; // Bảng được chọn từ dropdown
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $created_at = date('Y-m-d H:i:s');

    // Kiểm tra giá trị của table_name
    $allowed_tables = ['products', 'donu', 'phukien', 'dosale','hangnew','hanghot'];
    if (!in_array($table_name, $allowed_tables)) {
        die("Bảng không hợp lệ.");
    }

    // Kiểm tra bảng tồn tại
    $sql_check_table = "SHOW TABLES LIKE '$table_name'";
    $result = $conn->query($sql_check_table);
    if ($result->num_rows == 0) {
        die("Bảng $table_name không tồn tại trong cơ sở dữ liệu.");
    }

    // Xử lý upload hình ảnh
    if (isset($_FILES['image'])) {
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
            echo "Upload hình ảnh thành công: " . htmlspecialchars($target_file);
        } else {
            die("Có lỗi khi upload hình ảnh.");
        }
    } else {
        die("Không có file nào được upload.");
    }

    // Chèn dữ liệu vào bảng được chọn
    $sql = "INSERT INTO $table_name (name, description, price, category_id, image, created_at) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisss", $name, $description, $price, $category_id, $img_name, $created_at);

    if ($stmt->execute()) {
        echo "Thêm sản phẩm thành công!";
        header("Location: admin.php"); // Chuyển hướng về trang admin
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}


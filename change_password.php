<?php
session_start();
include_once "api/app/controller/AuthController.php";
include_once "api/app/Config.php";
include_once "api/app/controller/UserController.php";
include_once "head.php";
// Khởi tạo đối tượng AuthController
$auth = new AuthController();

// Kiểm tra người dùng đã đăng nhập
// Kiểm tra nếu form được gửi và các trường tồn tại
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['old_password']) && isset($_POST['new_password'])) {
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];

        // Tiếp tục xử lý logic đổi mật khẩu
        $user_id = $_SESSION['unique_id']; // Lấy ID người dùng từ session
        $auth->changePassword($user_id, $old_password, $new_password);
    } else {
        echo "Vui lòng nhập đầy đủ mật khẩu cũ và mật khẩu mới.";
    }
} else {
    echo "Không thể xử lý yêu cầu. Phương thức không hợp lệ.";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body class="other-page">   
    <h2>Change Password</h2>
    <form action="change_password.php" method="POST">
    <label for="old_password">Mật khẩu cũ:</label>
    <input type="password" name="old_password" id="old_password" required>

    <label for="new_password">Mật khẩu mới:</label>
    <input type="password" name="new_password" id="new_password" required>

    <button type="submit">Đổi mật khẩu</button>
</form>

</form>


</body>

</html>
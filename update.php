<?php
include('head.php');
include_once "part/header.php";

// Giả sử bạn đã kết nối CSDL thông qua đối tượng $this->conn
// Nếu chưa kết nối CSDL, hãy thêm một đoạn mã kết nối CSDL ở đây

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kết nối cơ sở dữ liệu chỉ một lần
    $con = $this->conn->connect(); 

    // Sử dụng mysqli_real_escape_string để bảo vệ các tham số đầu vào
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $birthday = mysqli_real_escape_string($con, $_POST['birthday']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);

    // Cập nhật thông tin người dùng
    $query = "UPDATE users SET fname = '$fname', lname = '$lname', email = '$email', phone = '$phone', birthday = '$birthday', gender = '$gender' WHERE id = '$user_id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<script>alert('Account updated successfully!');</script>";
        echo "<script>window.open('account_settings.php', '_self');</script>";
    } else {
        echo "<script>alert('Error updating account. Please try again.');</script>";
    }
}
?>

<?php
include('head.php');
include_once "part/header.php";

// Khởi tạo các biến
$fname = isset($row['fname']) ? $row['fname'] : '';
$lname = isset($row['lname']) ? $row['lname'] : '';
$email = isset($row['email']) ? $row['email'] : '';
$phone = isset($row['phone']) ? $row['phone'] : '';
$birthday = isset($row['birthday']) ? $row['birthday'] : '';
$gender = isset($row['gender']) ? $row['gender'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Account</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <table class="table table-bordered table-hover">
                <tr align="center">
                    <td colspan="6" class="active">
                        <h2>Profile Account</h2>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Họ</td>
                    <td>
                        <p><?php echo $fname; ?></p>
                    </td>
                </tr>

                <!-- Last Name -->
                <tr>
                    <td style="font-weight: bold;">Tên</td>
                    <td>
                        <p><?php echo $lname; ?></p>
                    </td>
                </tr>

                <!-- Profile Picture -->
                <tr>
                    <td style="font-weight: bold;">Hình Ảnh</td>
                    <td>
                        <img src="api/images/<?php echo $row['img']; ?>" alt="Profile Picture" style=" center width: 100px; height: 100px; border-radius: 100%;">
                    </td>
                </tr>

                <!-- Email -->
                <tr>
                    <td style="font-weight: bold;">Email</td>
                    <td>
                        <p><?php echo $email; ?></p>
                    </td>
                </tr>

                <!-- Birthday -->
                <tr>
                    <td style="font-weight: bold;">Ngày Sinh</td>
                    <td>
                        <p><?php echo $birthday; ?></p>
                    </td>
                </tr>

                <!-- Phone -->
                <tr>
                    <td style="font-weight: bold;">Số Điện Thoại</td>
                    <td>
                        <p><?php echo $phone; ?></p>
                    </td>
                </tr>

                <!-- Gender -->
                <tr>
                    <td style="font-weight: bold;">Giới Tính</td>
                    <td>
                        <p><?php echo ucfirst($gender); ?></p>
                    </td>
                </tr>

                <!-- Change Password -->
                <tr>
                    <td style="font-weight: bold;">Đổi Mật Khẩu</td>
                    <td>
                        <a class="btn btn-default" style="text-decoration: none; font-size: 15px;" href="change_password1.php">
                            <i class="fa fa-key fa-fw" aria-hidden="true"></i> Change Password
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>

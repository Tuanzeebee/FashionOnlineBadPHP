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
    <title>Account Settings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <form action="update.php" method="post" enctype="multipart/form-data">
                <table class="table table-bordered table-hover">
                    <tr align="center">
                        <td colspan="6" class="active">
                            <h2>Change Account Settings</h2>
                        </td>
                    </tr>

                    <!-- First Name -->
                    <tr>
                        <td style="font-weight: bold;">Change Your First Name</td>
                        <td>
                            <input type="text" name="fname" class="form-control" required value="<?php echo $fname; ?>" />
                        </td>
                    </tr>

                    <!-- Last Name -->
                    <tr>
                        <td style="font-weight: bold;">Change Your Last Name</td>
                        <td>
                            <input type="text" name="lname" class="form-control" required value="<?php echo $lname; ?>" />
                        </td>
                    </tr>

                    <!-- Profile Picture -->
                    <tr>
                        <td></td>
                        <td>
                            <a class="btn btn-default" style="text-decoration: none; font-size: 15px;" href="upload.php">
                                <i class="fa fa-user" aria-hidden="true"></i> Change Profile Picture
                            </a>
                        </td>
                    </tr>

                    <!-- Email -->
                    <tr>
                        <td style="font-weight: bold;">Change Your Email</td>
                        <td>
                            <input type="email" name="email" class="form-control" required value="<?php echo $email; ?>" />
                        </td>
                    </tr>

                    <!-- Birthday -->
                    <tr>
                        <td style="font-weight: bold;">Change Your Birthday</td>
                        <td>
                            <input type="date" name="birthday" class="form-control" required value="<?php echo $birthday; ?>" />
                        </td>
                    </tr>

                    <!-- Phone -->
                    <tr>
                        <td style="font-weight: bold;">Change Your Phone Number</td>
                        <td>
                            <input type="tel" name="phone" class="form-control" required value="<?php echo $phone; ?>" />
                        </td>
                    </tr>

                    <!-- Gender -->
                    <tr>
                        <td style="font-weight: bold;">Gender</td>
                        <td>
                            <select class="form-control" name="gender">
                                <option selected><?php echo ucfirst($gender); ?></option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </td>
                    </tr>

                    <!-- Change Password -->
                    <tr>
                        <td></td>
                        <td>
                            <a class="btn btn-default" style="text-decoration: none; font-size: 15px;" href="change_password.php">
                                <i class="fa fa-key fa-fw" aria-hidden="true"></i> Change Password
                            </a>
                        </td>
                    </tr>

                    <!-- Update Button -->
                    <tr align="center">
                        <td colspan="6">
                            <input type="submit" value="Update" name="update" class="btn btn-info">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>

</html>

<?php
include_once "head.php";


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
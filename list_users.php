<?php
include_once "api/app/Config.php";
include_once "head.php";
// Kiểm tra quyền admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    die("Bạn không có quyền truy cập chức năng này.");
}

// Kết nối cơ sở dữ liệu
$db = new Config();
$conn = $db->connect();

// Lấy danh sách user
$query = "SELECT user_id, fname,lname, email,password,birthday,gender, is_admin FROM users";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách người dùng</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Danh sách người dùng</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên người dùng</th>
                <th>Email</th>
                <!-- <th>Password</th> -->
                <th>Birthday</th>
                <th>Gender</th>
                <th>Quyền Admin</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['user_id']; ?></td>
                    <td>
                        <a href="user_details.php?id=<?= $row['user_id']; ?>">
                            <?= htmlspecialchars($row['fname']); ?>
                            <?= htmlspecialchars($row['lname']); ?>
                        </a>
                    </td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <!-- <td><?= htmlspecialchars($row['password']); ?></td> -->
                    <td><?= htmlspecialchars($row['birthday']); ?></td>
                    <td><?= htmlspecialchars($row['gender']); ?></td>
                    <td><?= $row['is_admin'] == 1 ? 'Có' : 'Không'; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

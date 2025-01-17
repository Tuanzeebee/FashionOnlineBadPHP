<?php
include_once "api/app/Config.php";

session_start();

// Kiểm tra stylist đã đăng nhập
if (!isset($_SESSION['user_id']) || $_SESSION['is_stylist'] != 1) {
    die("Bạn không có quyền truy cập chức năng này.");
}

$stylist_id = $_SESSION['user_id'];

// Kết nối database
$config = new Config();
$conn = $config->connect();

// Lấy danh sách yêu cầu chat
$sql = "SELECT cr.id, u.name AS user_name, cr.status, cr.created_at 
        FROM chat_requests cr 
        JOIN users u ON cr.user_id = u.id 
        WHERE cr.stylist_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $stylist_id);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yêu cầu chat</title>
</head>
<body>
    <h2>Danh sách yêu cầu chat</h2>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Người dùng</th>
                <th>Trạng thái</th>
                <th>Thời gian gửi</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    <td>
                        <?php if ($row['status'] === 'pending'): ?>
                            <form action="handle_request.php" method="POST" style="display: inline;">
                                <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="action" value="accept">
                                <button type="submit">Chấp nhận</button>
                            </form>
                            <form action="handle_request.php" method="POST" style="display: inline;">
                                <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="action" value="reject">
                                <button type="submit">Từ chối</button>
                            </form>
                        <?php else: ?>
                            <?php echo $row['status'] === 'accepted' ? 'Đã chấp nhận' : 'Đã từ chối'; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>

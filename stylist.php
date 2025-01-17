<?php
include('head.php');
include_once "api/app/Config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="referrer" content="no-referrer">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylist Banners</title>
    <style>
        .banner-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            padding: 10px;
            max-width: 95%;
            margin: 0 auto;
            justify-items: center;

        }

        .banner a {
            display: inline-block;
            margin: 5px 0;
            padding: 10px 15px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .banner a:hover {
            background-color: #777;
        }

        .banner-item {
            max-width: 100%;
            overflow: hidden;
            position: relative;
            padding: 15px;
            text-align: center;
            background-color: #f9f9f9;
            border-radius: 8px;
            width: 100%;
            max-width: 300px;
        }

        /* Ảnh */
        /* .banner-img {
            width: 100%;
            height: 200px;
            /* Cố định chiều cao cho tất cả ảnh */
        /* object-fit: cover; */
        /* Đảm bảo ảnh không bị biến dạng, cắt để lấp đầy không gian */
        /* border-radius: 5px; */
        /* Bo góc ảnh */
        /* transition: transform 0.3s ease; */
        /* Hiệu ứng chuyển động */
        /* } */

        /* Hiệu ứng hover */
        /* .banner-img:hover { */
        /* transform: scale(1.05); */
        /* Zoom ảnh khi hover */
        /* } */
        /* Ảnh */
        .banner-img {
            width: 100%;
            height: 50%;
            /* Đảm bảo ảnh không bị cắt */
            object-fit: cover;
            border-radius: 5px;
            /* Bo góc ảnh */
            transition: transform 0.3s ease;
        }

        /* Hiệu ứng hover */
        .banner-img:hover {
            transform: scale(1.05);
            /* Zoom ảnh khi hover */
        }

        @media (max-width: 768px) {
            .banner-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>

<body>
    <?php include 'backtotop.html'; ?>
    <div class="banner-grid">
        <?php
        // Sử dụng lớp Config để kết nối với cơ sở dữ liệu
        $config = new Config();
        $conn = $config->connect();

        // Lấy danh sách stylist từ cơ sở dữ liệu
        $sql = "SELECT * FROM users WHERE is_stylist = 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Duyệt qua từng stylist
            while ($row = $result->fetch_assoc()) {
        ?>
                <div class="banner-item">
                    <a href="chat.php?user_id=<?php echo htmlspecialchars($row['unique_id']); ?>"
                        title="<?php echo htmlspecialchars($row['fname']); ?>">
                        <img src="api/images/<?php echo htmlspecialchars($row['img']); ?>"
                            alt="<?php echo htmlspecialchars($row['fname']); ?>" class="banner-img" />
                    </a>
                    <h1><?php echo htmlspecialchars($row['fname']); ?> <?php echo htmlspecialchars($row['lname']); ?></h1>
                    <div class="banner">
                        <a href="chat.php?user_id=<?php echo htmlspecialchars($row['unique_id']); ?>">
                            Chat Với Stylist
                        </a>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<p>Không có stylist nào được tìm thấy.</p>";
        }

        // Đóng kết nối
        $conn->close();
        ?>
    </div>

</body>

</html>
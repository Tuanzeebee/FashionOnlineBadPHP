<?php
include('head.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChonSize</title>
    <link rel="stylesheet" href="css/csschonsize.css">
    <link rel="stylesheet" href="css/cssindex.css">
</head>

<body>
    <?php include 'backtotop.html'; ?>
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [{
                "@type": "ListItem",
                "position": 1,
                "item": {
                    "@id": "",
                    "name": "Thời trang"
                }
            }, {
                "@type": "ListItem",
                "position": 2,
                "item": {
                    "@id": "chonsize.php",
                    "name": "Hướng dẫn chọn size"
                }
            }]
        }
    </script>

    <div class="bcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="test1">
                        <li><a href="" title="Thời trang">Thời trang /</a></li>
                        <li><a href="hangnew.php" title="Hướng dẫn chọn size">Hàng Mới</a></li>
                    </ul>
                    <div class="clf"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="text text-dark text-left mt-2">
        <h1 class="ml-2 text-center">Hàng Mới</h1>
    </div>
    <div class="text text-dark p-2">
        <div class="">
            <?php
            // Use the Config class to connect to the database
            $config = new Config();
            $conn = $config->connect();

            // Fetch products from the database
            $sql = "SELECT * FROM hangnew";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<div class='product-container'>";
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product'>";
                    echo "<a href='information.php?type=hangnew&id=" . htmlspecialchars($row['id']) . "' title='" . htmlspecialchars($row['name']) . "'>";
                    echo "<img src='api/images/hangnew/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "' />";
                    echo "<h2>" . htmlspecialchars(string: $row['name']) . "</h2>";
                    echo "</a>";
                    $price = $row['price'];
                    if (floor($price) == $price) {
                        echo "<p>Giá: " . number_format($price, 0, ',', '.') . " VND</p>";
                    } else {
                        echo "<p>Giá: " . number_format($price, 2, ',', '.') . " VND</p>";
                    }
                    echo "<a href='add_to_cart.php?type=hangnew&id=" . htmlspecialchars($row['id']) . "' class='button'>Thêm vào giỏ hàng</a>";
                    echo "<a href='pay.php?id=" . htmlspecialchars($row['id']) . "' class='button'>Thanh Toán Ngay</a>";
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "Không có sản phẩm nào.";
            }
            ?>
        </div>
    </div>
    <?php include('part/footer.php'); ?>
</body>

</html>
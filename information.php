<?php
// Kết nối với cơ sở dữ liệu
include_once "api/app/controller/AuthController.php";
include_once "api/app/Config.php";
include_once "head.php";
// Khởi tạo đối tượng Config và kết nối database
$config = new Config();
$conn = $config->connect();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Carousel with Text Overlay</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css">
    <style>
        /* CSS cho layout sản phẩm */
        .product-single {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .product-image {
            width: 100%;
            max-width: 600px;
        }

        .product-image img {
            width: 90%;
            height: auto;
        }

        .product-info {
            width: 100%;
            max-width: 500px;
        }

        /* Sử dụng Flexbox để chia đôi thông tin sản phẩm */
        .ps-header {
            margin-bottom: 20px;
        }

        .ps-header .badge {
            position: absolute;
            top: 5px;
            left: 200px;
            background-color: red;
            color: white;
            padding: 5px;
        }

        .ps-price {
            margin-top: 15px;
        }

        .select-wraps {
            margin-top: 20px;
        }

        .select-wraps .col-md-6 {
            margin-bottom: 10px;
        }

        /* Điều chỉnh kích thước font và padding cho các phần tử */
        h1 {
            font-size: 28px;
            font-weight: bold;
        }

        .product-price {
            font-size: 20px;
            font-weight: bold;
            color: #e74c3c;
        }

        .shop-detail-color img {
            max-width: 100px;
            margin: 5px;
        }

        a:hover {
            background-color: #2980b9;
        }

        .article-content img {
            max-width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
            margin: 0 auto;
        }

        .bcrumbs {
            background-color: #fff;
            padding: 10px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .bcrumbs ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        .bcrumbs li {
            margin-right: 10px;
        }

        .bcrumbs a {
            text-decoration: none;
            color: #007bff;
        }

        .space10 {
            height: 10px;
            /* Khoảng cách theo chiều cao */
        }

        ul.test1 {
            color: black;
        }

        ul.test1 a {
            color: black;
            text-decoration: none;
        }

        ul.test1 a:hover {
            text-decoration: none;
        }

        .addtobag {
            border: 0px;
            height: 40px;
            line-height: 40px;
            background: #b31f2a;
            padding: 0 15px;
            display: inline-block;
            font-size: 14px;
            border-radius: 3px;
            color: #fff;
            text-transform: uppercase;
            margin: 8px 8px 0 0;
            /* Cách nhau một chút */
            width: auto;
            /* Chiều rộng tự động để vừa với nội dung */
            text-align: center;
        }

        .addtobag:hover {
            background: #a1181f;
            /* Đổi màu khi hover */
        }

        .button-group {
            display: flex;
            justify-content: flex-start;
            /* Căn chỉnh các nút ở đầu dòng */
            gap: 10px;
            /* Khoảng cách giữa các nút */
        }

        a,
        a:hover,
        button,
        button:hover {
            transition: .4s;
        }

        input,
        button,
        select,
        textarea {
            font-family: inherit;
            font-size: inherit;
            line-height: inherit;
        }

        button,
        html input[type="button"],
        input[type="reset"],
        input[type="submit"] {
            cursor: pointer;
        }

        button,
        select {
            text-transform: none;
        }

        button {
            overflow: visible;
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            margin: 0;
            font: inherit;
            color: inherit;
        }

        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto Condensed', sans-serif, Arial, sans-serif;
            font-size: 14px;
            color: #333;
            background: #FFF;
        }

        /* Cải thiện giao diện của các ô select */
        .selectBoxIt {
            width: 100%;
            /* Giữ chiều rộng 100% nhưng không thay đổi vị trí */
            height: 40px;
            /* Chiều cao của ô select */
            background-color: #f0f0f0;
            /* Màu nền xám nhẹ gần trắng */
            border: 1px solid #ccc;
            /* Đường viền nhẹ */
            border-radius: 5px;
            /* Bo góc nhẹ để ô select trở nên mịn màng */
            font-size: 14px;
            /* Kích thước chữ */
            padding: 0 10px;
            /* Padding để nội dung không chạm viền */
            box-sizing: border-box;
            /* Đảm bảo padding và border không ảnh hưởng đến kích thước tổng thể */
            transition: background-color 0.3s ease, border-color 0.3s ease;
            /* Hiệu ứng khi hover */
        }

        /* Khi hover vào ô select */
        .selectBoxIt:hover {
            background-color: #e0e0e0;
            /* Đổi màu nền khi hover */
            border-color: #b3b3b3;
            /* Đổi màu viền khi hover */
        }

        /* Đảm bảo giữ nguyên vị trí của các phần tử trong các col-md-6 */
        .select-wraps .col-md-6 {
            padding: 10px;
            /* Khoảng cách giữa các ô */
        }

        .row.select-wraps {
            display: flex;
            /* Căn chỉnh theo hàng ngang */
            gap: 10px;
            /* Khoảng cách giữa các ô */
        }
    </style>
</head>

<body>
    <?php include 'backtotop.html'; ?>
    <?php
    // Kiểm tra xem tham số `id` và `type` có được truyền qua URL không
    if (isset($_GET['id']) && is_numeric($_GET['id']) && isset($_GET['type'])) {
        $id = intval($_GET['id']); // Đảm bảo ID là số nguyên
        $type = $_GET['type']; // Lấy loại sản phẩm

        // Xác định bảng cần truy vấn dựa trên tham số `type`
        $allowedTables = ['products', 'phukien', 'donu', 'dosale', 'hangnew', 'hanghot']; // Các bảng được phép truy vấn
        if (in_array($type, $allowedTables)) {
            $sql = "SELECT * FROM $type WHERE id = ?"; // Chèn tên bảng một cách an toàn
        } else {
            die("<p>Loại sản phẩm không hợp lệ.</p>");
        }

        // Kết nối cơ sở dữ liệu và thực hiện truy vấn
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            } else {
                echo "<p>Sản phẩm không tồn tại.</p>";
            }

            $stmt->close();
        } else {
            echo "<p>Không thể chuẩn bị truy vấn.</p>";
        }
    } else {
        echo "<p>ID sản phẩm hoặc loại sản phẩm không hợp lệ.</p>";
    }

    // Đóng kết nối cơ sở dữ liệu
    $conn->close();
    ?>
    <div class="bcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="test1">
                        <li><a href="" title="Thời trang">Thời trang /</a></li>
                        <li><a href="#" title="Thời trang"><?php echo htmlspecialchars($row['name']); ?></a></li>
                    </ul>
                    <div class="clf"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="space10"></div>
    <div class="product-single">
        <div class="container">
            <div class="row">
                <!-- Phần Hình ảnh Sản phẩm -->
                <div class="col-md-6">
                    <div class="product-image">
                        <div class="product-image">
                            <img src="api/images/<?php echo htmlspecialchars($type); ?>/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" />
                        </div>
                    </div>
                </div>

                <!-- Phần Thông tin sản phẩm -->
                <div class="col-md-6">
                    <div class="product-info">
                        <div class="ps-header">
                            <h1><?php echo htmlspecialchars($row['name']); ?> <span class="badge offer"> -37% </span></h1>
                            <div class="ratings-wrap">
                                <div class="ratings">
                                    <span class="act fa fa-star" aria-hidden="true"></span>
                                    <span class="act fa fa-star-half-o" aria-hidden="true"></span>
                                    <em> (73 đánh giá / 153 lượt mua)</em>
                                </div>
                            </div>
                            <p><?php echo "Mô tả: " . htmlspecialchars($row['description']); ?></p>

                            <div class="ps-price product-attr">
                                <span>Giá bán: </span>
                                <span class="product-price"><?php $price = $row['price'];
                                                            if (floor($price) == $price) {
                                                                echo "<p>Giá: " . number_format($price, 0, ',', '.') . " VND</p>";
                                                            } else {
                                                                echo "<p>Giá: " . number_format($price, 2, ',', '.') . " VND</p>";
                                                            } ?></span>
                            </div>
                        </div>

                        <div class="sep"></div>

                        <div class="row select-wraps">
                            <div class="col-md-6">
                                <p>SIZE<span>*</span></p>
                                <select class="selectBoxIt" name="sizeSelect" id="sizeSelect">
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <p>SỐ LƯỢNG <span>*</span></p>
                                <select class="selectBoxIt" id="quantityBuy">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                                </select>
                            </div>
                        </div>
                        <div class="button-group">
                            <button type="button" id="buyNow" class="addtobag" onclick="window.location.href='pay.php?id=<?php echo htmlspecialchars($row['id']); ?>'">
                                <i class="fa fa-shopping-cart"></i> Đăng ký mua
                            </button>

                            <button type="button" class="addtobag"
                                onclick="window.location.href='add_to_cart.php?type=<?php echo htmlspecialchars($type); ?>&id=<?php echo $row['id']; ?>&size=' + document.getElementById('sizeSelect').value + '&quantity=' + document.getElementById('quantityBuy').value;">
                                Thêm vào giỏ hàng
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-order">
                        <p id="systemNotifyCartContent">
                            Giỏ hàng của bạn hiện có: <strong><?php echo $totalQuantity; ?></strong> sản phẩm. <br>
                            Tổng giá trị giỏ hàng là: <strong><?php echo $totalPriceFormatted; ?></strong><br>
                            Bạn có muốn tiến hành gửi đơn hàng hay không?<br>
                            <em>Tại bước tiến hành gửi đơn hàng bạn có thể chỉnh sửa hoặc xem giỏ hàng của mình hiện có.</em>
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="myBtn blue btn-continue-buy hidden-xs" data-dismiss="modal" style="float:left;">
                        <i class="fa fa-angle-double-right" aria-hidden="true"></i> Tiếp tục mua sắm
                    </button>
                    <button class="myBtn red btn-order-now" id="btn-order-now">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Đặt hàng ngay
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Khi click vào "Add to Cart", hiển thị modal
        document.getElementById('addToCartButton').addEventListener('click', function() {
            $('#cartModal').modal('show');
        });
    </script>
    <!-- Include jQuery and Owl Carousel scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".product-carousel").owlCarousel({
                items: 1,
                navigation: true,
                slideSpeed: 300,
                paginationSpeed: 400,
                singleItem: true,
                autoPlay: true,
                navigationText: ["<", ">"]
            });
        });
    </script>
</body>

</html>
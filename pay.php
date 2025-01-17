<?php
include("head.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/csschonsize.css">
    <title>Giỏ hàng</title>
    <style>
        /* Đặt font chữ chung */


        /* Định dạng tiêu đề legend */
        legend {
            font-size: 18px;
            font-weight: bold;
            color: #b31f2a;
            margin-bottom: 10px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
        }

        /* Định dạng bảng */
        table.table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table.table th,
        table.table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table.table th {
            background: #f2f2f2;
            color: #333;
            font-weight: bold;
        }

        /* Các cột định dạng text và số */
        table.table td {
            vertical-align: middle;
        }

        table.table td a {
            text-decoration: none;
            color: #007bff;
        }

        table.table td a:hover {
            text-decoration: underline;
        }

        /* Định dạng form */
        .form-horizontal .form-group {
            margin-bottom: 15px;
        }

        .form-horizontal label {
            font-weight: bold;
        }

        .form-horizontal .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-horizontal .form-control:focus {
            border-color: #b31f2a;
            outline: none;
        }

        /* Định dạng các nút bấm */
        button,
        input[type="button"],
        input[type="submit"] {
            background: #b31f2a;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 14px;
            text-transform: uppercase;
        }

        button:hover,
        input[type="button"]:hover,
        input[type="submit"]:hover {
            background: #991821;
        }

        /* Định dạng radio button */
        .payment_method_label {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .payment_method_label img {
            margin-right: 10px;
            border-radius: 4px;
        }

        /* Định dạng tổng tiền */
        #sumTotalBill {
            font-size: 18px;
            color: #b31f2a;
            font-weight: bold;
        }

        /* Định dạng cột */
        #cart_column_left,
        #cart_column_right {
            padding: 10px;
        }

        .column {
            display: flex;
            flex-direction: column;
        }

        /* Định dạng khoảng cách trên mobile */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            #cart_column_left,
            #cart_column_right {
                padding: 0;
            }

            .form-horizontal label {
                font-size: 13px;
            }

            legend {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <div class="bcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="test1">
                        <li><a href="" title="Thời trang">Thời trang /</a></li>
                        <li><a href="#" title="Thời trang">Đơn Đăt Hàng</a></li>
                    </ul>
                    <div class="clf"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="shop-content">
        <div class="container">
            <div class="row">
                <div id="left_column" class="column">
                    <form id="shipping-zip-form" class="form-horizontal" action="" method="post">
                        <div class="col-sm-6 col-md-6" id="cart_column_left">
                            <div class="space50 hidden visible-xs"></div>
                            <div class="detail_ct" style="height: auto; min-height: inherit;">
                                <legend>Giỏ hàng của bạn</legend>

                                <?php
                                function findImage($baseDir, $imageName)
                                {
                                    $dirs = glob($baseDir . '/*', GLOB_ONLYDIR); // Lấy tất cả thư mục con
                                    foreach ($dirs as $dir) {
                                        $filePath = $dir . '/' . $imageName;
                                        if (file_exists($filePath)) {
                                            return $filePath;
                                        }
                                    }
                                    return $baseDir . '/default/' . $imageName; // Trả về hình mặc định nếu không tìm thấy
                                }
                                $totalQuantity = 0;
                                $totalPrice = 0;

                                // Kiểm tra nếu giỏ hàng trống
                                if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                                    echo "<p>Không có sản phẩm nào trong giỏ hàng. Vui lòng thêm sản phẩm trước.</p>";
                                } else {
                                    // Xử lý yêu cầu xóa sản phẩm
                                    if (isset($_GET['remove_id'])) {
                                        $removeId = $_GET['remove_id'];
                                        foreach ($_SESSION['cart'] as $key => $product) {
                                            if ($product['id'] == $removeId) {
                                                unset($_SESSION['cart'][$key]);
                                                $_SESSION['cart'] = array_values($_SESSION['cart']);
                                                break;
                                            }
                                        }
                                    }
                                ?>

                                    <table class="table" style="background: #FFF; font-size: 12px; width: 100%; table-layout: fixed;">
                                        <thead>
                                            <tr>
                                                <th style="width: 100px;">Hình</th>
                                                <th>Thông tin sản phẩm</th>
                                                <th style="width: 50px;">SL</th>
                                                <th style="width: 80px;">Đơn giá</th>
                                                <th style="width: 80px;">Tổng</th>
                                                <th style="width: 50px;">Xóa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($_SESSION['cart'] as $product) {
                                                $itemTotal = $product['price'] * $product['quantity'];
                                                $totalQuantity += $product['quantity'];
                                                $totalPrice += $itemTotal;
                                                if (isset($product['category'])) {
                                                    $imagePath = 'api/images/' . $product['category'] . '/' . $product['image'];
                                                    if (!file_exists($imagePath)) {
                                                        $imagePath = findImage('api/images', $product['image']);
                                                    }
                                                } else {
                                                    $imagePath = findImage('api/images', $product['image']);
                                                }
                                            ?>
                                                <tr>
                                                    <td style="text-align: center;">
                                                    <a href="<?php echo htmlspecialchars($imagePath); ?>">
                                                            <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="Product Image" width="60" style="display: block; margin: 0 auto;">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <strong><?php echo htmlspecialchars($product['name']); ?></strong>
                                                    </td>
                                                    <td align="right">
                                                        <span><?php echo $product['quantity']; ?></span>
                                                    </td>
                                                    <td align="right"><?php echo number_format($product['price'], 0, ',', '.'); ?> VND</td>
                                                    <td align="right"><?php echo number_format($itemTotal, 0, ',', '.'); ?> VND</td>
                                                    <td align="center">
                                                        <!-- Liên kết xóa sản phẩm -->
                                                        <a href="?remove_id=<?php echo $product['id']; ?>" class="remove-link">Xóa</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                    <fieldset style="margin-bottom: 10px;">
                                        <legend style="margin-bottom: 0px;">Tổng:</legend>
                                        <div style="border-bottom: 1px solid #ccc;">
                                            <div class="col-md-9 col-sm-9 col-xs-9" style="padding: 5px;">
                                                <strong>Tổng tiền thanh toán</strong>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-3 text-right" style="padding: 5px;">
                                                <span style="font-weight: bold; color: #b31f2a;" id="sumTotalBill"><?php echo number_format($totalPrice, 0, ',', '.'); ?> VND</span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <small>Có <em class='highlight'><span class='cartTopRightQuantity'><?php echo $totalQuantity; ?></span> sản phẩm</em> trong giỏ hàng</small><br>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6" id="cart_column_right">
                            <div class="detail_ct">
                                <legend>Thông tin liên hệ giao hàng</legend>
                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Họ và tên *</label>
                                    <div class="col-lg-8">
                                        <input type="text" placeholder="Nhập Họ Và Tên" name="fullname" id="fullname" class="form-control field" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Email</label>
                                    <div class="col-lg-8">
                                        <input type="text" placeholder="Nhập Email" class="form-control field" name="email" id="email" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Số điện thoại *</label>
                                    <div class="col-lg-8">
                                        <input type="text"placeholder="Nhập Số Điện Thoại" class="form-control field" data-field="phone" data-field-valid="phone" id="phone" name="phone" value="">
                                        <span data-message-for="phone"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-lg-4 control-label" for="province">Tỉnh/Thành phố</label>
                                        <div class="col-lg-8">
                                            <select class="form-control field" id="province" onchange="updateDistricts()">
                                                <option value="">-- Chọn tỉnh/thành phố --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label" for="district">Huyện/Quận</label>
                                        <div class="col-lg-8">
                                            <select class="form-control field" id="district">
                                                <option value="">-- Chọn huyện/quận --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label">Địa Chỉ Cụ Thể*</label>
                                        <div class="col-lg-8">
                                            <input type="text" placeholder="Nhập Địa Chỉ" class="form-control field" data-field="address" data-field-valid="address" id="address" name="address" value="">
                                            <span data-message-for="address"></span>
                                        </div>
                                    </div>
                                    <script>
                                        // Dữ liệu tỉnh/thành phố và huyện/quận
                                        const locationData = {
                                            "Hà Nội": [
                                                "Ba Đình", "Hoàn Kiếm", "Tây Hồ", "Long Biên", "Cầu Giấy",
                                                "Đống Đa", "Hai Bà Trưng", "Hoàng Mai", "Thanh Xuân", "Nam Từ Liêm",
                                                "Bắc Từ Liêm", "Hoài Đức", "Đan Phượng", "Sóc Sơn", "Mê Linh",
                                                "Chương Mỹ", "Thanh Oai", "Thường Tín", "Phú Xuyên", "Ứng Hòa",
                                                "Mỹ Đức"
                                            ],
                                            "Hồ Chí Minh": [
                                                "Quận 1", "Quận 2", "Quận 3", "Quận 4", "Quận 5",
                                                "Quận 6", "Quận 7", "Quận 8", "Quận 9", "Quận 10",
                                                "Quận 11", "Quận 12", "Bình Thạnh", "Tân Bình", "Gò Vấp",
                                                "Phú Nhuận", "Bình Tân", "Thủ Đức", "Củ Chi", "Hóc Môn",
                                                "Bình Chánh", "Nhà Bè", "Cần Giờ"
                                            ],
                                            "Đà Nẵng": [
                                                "Hải Châu", "Cẩm Lệ", "Ngũ Hành Sơn", "Liên Chiểu", "Thanh Khê",
                                                "Hòa Vang", "Sơn Trà"
                                            ],
                                            "Bạc Liêu": [
                                                "Bạc Liêu", "Hồng Dân", "Phước Long", "Vĩnh Lợi", "Hoà Bình",
                                                "Đông Hải", "Giá Rai"
                                            ],
                                            "Bắc Giang": [
                                                "Bắc Giang", "Yên Thế", "Lạng Giang", "Tân Yên", "Hiệp Hòa",
                                                "Việt Yên", "Lục Nam", "Lục Ngạn", "Sơn Động", "Yên Dũng"
                                            ],
                                            "Bắc Kạn": [
                                                "Bắc Kạn", "Chợ Mới", "Bạch Thông", "Pác Nặm", "Ngân Sơn",
                                                "Ba Bể", "Chợ Đồn", "Na Rì"
                                            ],
                                            "Bắc Ninh": [
                                                "Bắc Ninh", "Yên Phong", "Tiên Du", "Từ Sơn", "Thuận Thành",
                                                "Quế Võ", "Lương Tài", "Gia Bình"
                                            ],
                                            "Bến Tre": [
                                                "Bến Tre", "Châu Thành", "Chợ Lách", "Giồng Trôm", "Mỏ Cày Bắc",
                                                "Mỏ Cày Nam", "Ba Tri", "Thạnh Phú", "Bình Đại"
                                            ],
                                            "Bình Định": [
                                                "Quy Nhơn", "An Nhơn", "Hoài Nhơn", "Phù Cát", "Phù Mỹ",
                                                "Tây Sơn", "Vân Canh", "An Lão", "Hoài Ân", "Tuy Phước"
                                            ],
                                            "Bình Dương": [
                                                "Thủ Dầu Một", "Dĩ An", "Thuận An", "Tân Uyên", "Bến Cát",
                                                "Bàu Bàng", "Phú Giáo", "Dầu Tiếng"
                                            ],
                                            "Bình Phước": [
                                                "Đồng Xoài", "Bình Long", "Phước Long", "Chơn Thành",
                                                "Bù Đăng", "Bù Gia Mập", "Lộc Ninh", "Hớn Quản", "Phú Riềng"
                                            ],
                                            "Bình Thuận": [
                                                "Phan Thiết", "La Gi", "Tánh Linh", "Hàm Tân", "Hàm Thuận Bắc",
                                                "Hàm Thuận Nam", "Phú Quý", "Tuy Phong", "Đức Linh", "Bắc Bình"
                                            ],
                                            "Cà Mau": [
                                                "Cà Mau", "Thới Bình", "Trần Văn Thời", "Cái Nước", "Đầm Dơi",
                                                "Năm Căn", "U Minh", "Phú Tân", "Ngọc Hiển"
                                            ],
                                            "Cao Bằng": [
                                                "Cao Bằng", "Bảo Lạc", "Bảo Lâm", "Hòa An", "Quảng Hòa",
                                                "Trùng Khánh", "Nguyên Bình", "Thạch An", "Hà Quảng"
                                            ],
                                            "Cần Thơ": [
                                                "Ninh Kiều", "Cái Răng", "Bình Thủy", "Ô Môn", "Thốt Nốt",
                                                "Cờ Đỏ", "Phong Điền", "Thới Lai", "Vĩnh Thạnh"
                                            ],
                                            "Đắk Lắk": [
                                                "Buôn Ma Thuột", "Ea H'leo", "Buôn Đôn", "Krông Ana",
                                                "Krông Búk", "Krông Pắk", "Cư M'gar", "M'Drắk", "Lắk", "Ea Súp"
                                            ],
                                            "Đắk Nông": [
                                                "Gia Nghĩa", "Cư Jút", "Đắk Mil", "Đắk R'lấp", "Đắk Song",
                                                "Krông Nô", "Tuy Đức"
                                            ],
                                            "Điện Biên": [
                                                "Điện Biên Phủ", "Mường Lay", "Mường Nhé", "Tủa Chùa",
                                                "Mường Ảng", "Điện Biên Đông", "Tuần Giáo", "Mường Chà",
                                                "Nậm Pồ"
                                            ],
                                            "Đồng Nai": [
                                                "Biên Hòa", "Long Khánh", "Vĩnh Cửu", "Định Quán", "Tân Phú",
                                                "Trảng Bom", "Nhơn Trạch", "Thống Nhất", "Cẩm Mỹ", "Long Thành"
                                            ],
                                            "Đồng Tháp": [
                                                "Cao Lãnh", "Sa Đéc", "Hồng Ngự", "Tân Hồng", "Lấp Vò",
                                                "Châu Thành", "Tam Nông", "Thanh Bình", "Tháp Mười"
                                            ],
                                            "Gia Lai": [
                                                "Pleiku", "An Khê", "Ayun Pa", "Kông Chro", "K'bang",
                                                "Chư Păh", "Chư Sê", "Chư Prông", "Ia Grai", "Đắk Đoa", "Ia Pa"
                                            ],
                                            "Hà Giang": [
                                                "Hà Giang", "Quản Bạ", "Yên Minh", "Vị Xuyên", "Bắc Mê",
                                                "Hoàng Su Phì", "Xín Mần", "Mèo Vạc", "Đồng Văn"
                                            ],
                                            "Hà Nam": [
                                                "Phủ Lý", "Duy Tiên", "Lý Nhân", "Thanh Liêm", "Kim Bảng", "Bình Lục"
                                            ],
                                            "Hà Tĩnh": [
                                                "Hà Tĩnh", "Hương Sơn", "Cẩm Xuyên", "Kỳ Anh", "Lộc Hà",
                                                "Nghi Xuân", "Can Lộc", "Thạch Hà", "Đức Thọ", "Vũ Quang", "Hồng Lĩnh"
                                            ],
                                            "Hải Dương": [
                                                "Hải Dương", "Chí Linh", "Kinh Môn", "Nam Sách", "Ninh Giang",
                                                "Thanh Miện", "Tứ Kỳ", "Kim Thành", "Cẩm Giàng", "Gia Lộc", "Bình Giang"
                                            ],
                                            "Hải Phòng": [
                                                "Hồng Bàng", "Lê Chân", "Ngô Quyền", "Kiến An", "Đồ Sơn",
                                                "Dương Kinh", "Cát Hải", "Tiên Lãng", "An Dương", "An Lão",
                                                "Thủy Nguyên", "Vĩnh Bảo", "Kiến Thụy"
                                            ],
                                            "Hậu Giang": [
                                                "Vị Thanh", "Ngã Bảy", "Châu Thành", "Châu Thành A", "Phụng Hiệp",
                                                "Vị Thủy", "Long Mỹ"
                                            ],
                                            "Hòa Bình": [
                                                "Hòa Bình", "Mai Châu", "Lương Sơn", "Kim Bôi", "Cao Phong",
                                                "Tân Lạc", "Đà Bắc", "Lạc Sơn", "Lạc Thủy", "Yên Thủy"
                                            ],
                                            "Hưng Yên": [
                                                "Hưng Yên", "Phù Cừ", "Khoái Châu", "Ân Thi", "Mỹ Hào",
                                                "Tiên Lữ", "Kim Động", "Văn Lâm", "Văn Giang", "Yên Mỹ"
                                            ],
                                            "Khánh Hòa": [
                                                "Nha Trang", "Cam Ranh", "Ninh Hòa", "Vạn Ninh", "Khánh Vĩnh",
                                                "Diên Khánh", "Khánh Sơn", "Cam Lâm", "Trường Sa"
                                            ],
                                            "Kiên Giang": [
                                                "Rạch Giá", "Phú Quốc", "Hà Tiên", "Kiên Lương", "Giồng Riềng",
                                                "Châu Thành", "Tân Hiệp", "An Biên", "An Minh", "Vĩnh Thuận", "Gò Quao", "U Minh Thượng"
                                            ],
                                            "Kon Tum": [
                                                "Kon Tum", "Đăk Glei", "Đăk Hà", "Đăk Tô", "Sa Thầy",
                                                "Ngọc Hồi", "Tu Mơ Rông", "Ia H'la"
                                            ],
                                            "Lai Châu": [
                                                "Lai Châu", "Mường Tè", "Sìn Hồ", "Tam Đường", "Phong Thổ",
                                                "Tân Uyên", "Nậm Nhùn"
                                            ],
                                            "Lâm Đồng": [
                                                "Đà Lạt", "Bảo Lộc", "Lâm Hà", "Di Linh", "Đức Trọng",
                                                "Đạ Huoai", "Đạ Tẻh", "Cát Tiên", "Lạc Dương", "Đam Rông"
                                            ],
                                            "Lạng Sơn": [
                                                "Lạng Sơn", "Cao Lộc", "Văn Quan", "Bắc Sơn", "Đình Lập",
                                                "Hữu Lũng", "Chi Lăng", "Tràng Định", "Lộc Bình", "Bình Gia"
                                            ],
                                            "Lào Cai": [
                                                "Lào Cai", "Bát Xát", "Bảo Thắng", "Bảo Yên", "Mường Khương",
                                                "Si Ma Cai", "Sa Pa", "Văn Bàn"
                                            ],
                                            "Long An": [
                                                "Tân An", "Bến Lức", "Thủ Thừa", "Tân Trụ", "Cần Giuộc",
                                                "Cần Đước", "Đức Hòa", "Đức Huệ", "Vĩnh Hưng", "Mộc Hóa", "Tân Hưng", "Châu Thành"
                                            ],
                                            "Nam Định": [
                                                "Nam Định", "Mỹ Lộc", "Vụ Bản", "Ý Yên", "Nam Trực",
                                                "Trực Ninh", "Nghĩa Hưng", "Hải Hậu", "Xuân Trường", "Giao Thủy"
                                            ],
                                            "Nghệ An": [
                                                "Vinh", "Cửa Lò", "Thái Hòa", "Hoàng Mai", "Quế Phong",
                                                "Quỳ Châu", "Kỳ Sơn", "Tương Dương", "Nghĩa Đàn", "Quỳ Hợp",
                                                "Quỳnh Lưu", "Thanh Chương", "Diễn Châu", "Nghi Lộc", "Nam Đàn", "Hưng Nguyên"
                                            ],
                                            "Ninh Bình": [
                                                "Ninh Bình", "Tam Điệp", "Gia Viễn", "Hoa Lư", "Nho Quan",
                                                "Yên Khánh", "Kim Sơn", "Yên Mô"
                                            ],
                                            "Ninh Thuận": [
                                                "Phan Rang - Tháp Chàm", "Ninh Phước", "Ninh Sơn", "Ninh Hải",
                                                "Thuận Bắc", "Thuận Nam", "Bác Ái"
                                            ],
                                            "Phú Thọ": [
                                                "Việt Trì", "Phú Thọ", "Lâm Thao", "Thanh Ba", "Thanh Sơn",
                                                "Thanh Thủy", "Cẩm Khê", "Đoan Hùng", "Hạ Hòa", "Tân Sơn", "Yên Lập"
                                            ],
                                            "Phú Yên": [
                                                "Tuy Hòa", "Sông Cầu", "Đồng Xuân", "Tuy An", "Sơn Hòa",
                                                "Phú Hòa", "Tây Hòa", "Đông Hòa"
                                            ],
                                            "Quảng Bình": [
                                                "Đồng Hới", "Ba Đồn", "Bố Trạch", "Quảng Trạch", "Tuyên Hóa",
                                                "Minh Hóa", "Quảng Ninh", "Lệ Thủy"
                                            ],
                                            "Quảng Nam": [
                                                "Tam Kỳ", "Hội An", "Điện Bàn", "Duy Xuyên", "Đại Lộc",
                                                "Quế Sơn", "Thăng Bình", "Núi Thành", "Tiên Phước", "Phước Sơn",
                                                "Nam Trà My", "Bắc Trà My", "Đông Giang", "Tây Giang", "Nam Giang"
                                            ],
                                            "Quảng Ngãi": [
                                                "Quảng Ngãi", "Đức Phổ", "Bình Sơn", "Sơn Tịnh", "Tư Nghĩa",
                                                "Mộ Đức", "Nghĩa Hành", "Trà Bồng", "Sơn Hà", "Sơn Tây", "Minh Long", "Ba Tơ", "Lý Sơn"
                                            ],
                                            "Quảng Ninh": [
                                                "Hạ Long", "Cẩm Phả", "Uông Bí", "Móng Cái", "Quảng Yên",
                                                "Đông Triều", "Vân Đồn", "Tiên Yên", "Bình Liêu", "Ba Chẽ", "Cô Tô", "Hải Hà", "Đầm Hà"
                                            ],
                                            "Quảng Trị": [
                                                "Đông Hà", "Quảng Trị", "Hải Lăng", "Triệu Phong", "Cam Lộ",
                                                "Gio Linh", "Hướng Hóa", "Đakrông", "Vĩnh Linh", "Cồn Cỏ"
                                            ],
                                            "Sóc Trăng": [
                                                "Sóc Trăng", "Vĩnh Châu", "Ngã Năm", "Mỹ Xuyên", "Thạnh Trị",
                                                "Long Phú", "Cù Lao Dung", "Kế Sách", "Châu Thành", "Mỹ Tú", "Trần Đề"
                                            ],
                                            "Sơn La": [
                                                "Sơn La", "Mộc Châu", "Mai Sơn", "Quỳnh Nhai", "Thuận Châu",
                                                "Phù Yên", "Bắc Yên", "Mường La", "Sông Mã", "Sốp Cộp", "Vân Hồ", "Yên Châu"
                                            ],
                                            "Tây Ninh": [
                                                "Tây Ninh", "Hòa Thành", "Gò Dầu", "Châu Thành", "Bến Cầu",
                                                "Dương Minh Châu", "Tân Châu", "Tân Biên", "Trảng Bàng"
                                            ],
                                            "Thái Bình": [
                                                "Thái Bình", "Kiến Xương", "Tiền Hải", "Vũ Thư", "Đông Hưng",
                                                "Hưng Hà", "Quỳnh Phụ", "Thái Thụy"
                                            ],
                                            "Thái Nguyên": [
                                                "Thái Nguyên", "Sông Công", "Phổ Yên", "Đại Từ", "Phú Lương",
                                                "Đồng Hỷ", "Võ Nhai", "Phú Bình"
                                            ],
                                            "Thanh Hóa": [
                                                "Thanh Hóa", "Bỉm Sơn", "Sầm Sơn", "Hà Trung", "Hậu Lộc",
                                                "Hoằng Hóa", "Nga Sơn", "Nông Cống", "Như Thanh", "Như Xuân",
                                                "Quảng Xương", "Thiệu Hóa", "Thọ Xuân", "Thạch Thành", "Tĩnh Gia", "Triệu Sơn", "Vĩnh Lộc",
                                                "Yên Định", "Cẩm Thủy", "Bá Thước", "Lang Chánh", "Quan Sơn", "Quan Hóa", "Mường Lát"
                                            ],
                                            "Thừa Thiên Huế": [
                                                "Huế", "Hương Trà", "Hương Thủy", "Phong Điền", "Quảng Điền",
                                                "Phú Vang", "Phú Lộc", "Nam Đông", "A Lưới"
                                            ],
                                            "Tiền Giang": [
                                                "Mỹ Tho", "Cai Lậy", "Gò Công", "Gò Công Tây", "Gò Công Đông",
                                                "Chợ Gạo", "Tân Phú Đông", "Cái Bè", "Tân Phước"
                                            ],
                                            "Trà Vinh": [
                                                "Trà Vinh", "Duyên Hải", "Cầu Ngang", "Cầu Kè", "Châu Thành",
                                                "Tiểu Cần", "Trà Cú", "Duyên Hải"
                                            ],
                                            "Tuyên Quang": [
                                                "Tuyên Quang", "Chiêm Hóa", "Hàm Yên", "Lâm Bình", "Na Hang",
                                                "Sơn Dương", "Yên Sơn"
                                            ],
                                            "Vĩnh Long": [
                                                "Vĩnh Long", "Long Hồ", "Mang Thít", "Bình Minh", "Bình Tân",
                                                "Tam Bình", "Trà Ôn", "Vũng Liêm"
                                            ],
                                            "Vĩnh Phúc": [
                                                "Vĩnh Yên", "Phúc Yên", "Vĩnh Tường", "Yên Lạc", "Tam Đảo",
                                                "Lập Thạch", "Sông Lô", "Bình Xuyên"
                                            ],
                                            "Yên Bái": [
                                                "Yên Bái", "Nghĩa Lộ", "Văn Chấn", "Mù Căng Chải", "Lục Yên",
                                                "Trấn Yên", "Văn Yên", "Yên Bình"
                                            ]
                                        };

                                        // Hàm load danh sách tỉnh/thành phố
                                        function loadProvinces() {
                                            const provinceSelect = document.getElementById("province");
                                            for (const province in locationData) {
                                                const option = document.createElement("option");
                                                option.value = province;
                                                option.textContent = province;
                                                provinceSelect.appendChild(option);
                                            }
                                        }

                                        // Hàm cập nhật danh sách huyện/quận
                                        function updateDistricts() {
                                            const provinceSelect = document.getElementById("province");
                                            const districtSelect = document.getElementById("district");
                                            const selectedProvince = provinceSelect.value;

                                            // Xóa các huyện/quận hiện tại
                                            districtSelect.innerHTML = '<option value="">-- Chọn huyện/quận --</option>';

                                            // Nếu chưa chọn tỉnh/thành phố, thoát hàm
                                            if (!selectedProvince) return;

                                            // Thêm các huyện/quận tương ứng
                                            const districts = locationData[selectedProvince];
                                            for (const district of districts) {
                                                const option = document.createElement("option");
                                                option.value = district;
                                                option.textContent = district;
                                                districtSelect.appendChild(option);
                                            }
                                        }

                                        // Gọi hàm loadProvinces khi trang được tải
                                        loadProvinces();
                                    </script>
                                <input type="hidden" name="ship_type" id="ship_type" value="2">
                                <fieldset>
                                    <legend>Hình thức thanh toán</legend>
                                    <label class="col-md-4 control-label"></label>
                                    <div class="col-md-8">
                                        <label class="row payment_method_label" for="payment_method_cod">
                                            <input type="radio" id="payment_method_cod" checked="checked" name="payment_method" value="cod" class="field">
                                            <span style="width: 40px; position: absolute; left: 40px; padding-top: 5px;">
                                                <img height="30" src="api/support/money.png">
                                            </span>
                                            <span style="float: left; margin-left: 100px;">
                                            COD(Tiền Mặt)<br>
                                                <em style="font-size: 12px; font-weight: normal">Thanh toán khi nhận hàng</em>
                                            </span>
                                        </label>
                                        <label class="row payment_method_label" for="payment_method_money">
                                            <input type="radio" id="payment_method_money" name="payment_method" value="money" class="field">
                                            <span style="width: 40px; position: absolute; left: 40px; padding-top: 5px;">
                                                <img height="30" src="api/support/money.png">
                                            </span>
                                            <span style="float: left; margin-left: 100px;">
                                                InternetBanking<br>
                                                <em style="font-size: 12px; font-weight: normal"></em>
                                            </span>
                                        </label>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <label class="col-md-4 control-label"></label>
                                    <div class="col-md-8">
                                        <?php
                                        if (isset($_POST['submit_step1'])) {
                                            // Khai báo mảng lỗi
                                            $errors = [];

                                            // Kiểm tra các trường bắt buộc
                                            if (empty($_POST["fullname"])) {
                                                $errors[] = "Họ và tên không được bỏ trống.";
                                            }
                                            if (empty($_POST["phone"])) {
                                                $errors[] = "Số điện thoại không được bỏ trống.";
                                            }
                                            
                                            if (empty($_POST["address"])) {
                                                $errors[] = "Địa chỉ không được bỏ trống.";
                                            }

                                            // Nếu có lỗi, hiển thị thông báo lỗi
                                            if (!empty($errors)) {
                                                echo "<script>alert('Vui lòng điền đầy đủ thông tin: " . implode(", ", $errors) . "');</script>";
                                            } else {
                                                // Xử lý thanh toán thành công nếu không có lỗi
                                                echo "<script>alert('Yêu Cầu Đang Được Xử Lý');</script>";
                                                // Bạn có thể thêm mã xử lý thanh toán thực tế ở đây như lưu vào cơ sở dữ liệu, chuyển hướng trang, v.v.
                                                // Ví dụ:
                                                // header("Location: success_page.php");
                                                // exit();
                                            }
                                        }
                                        ?>

                                        <div class="form-group">
                                            <div style="text-align: center;">
                                                <form action="" method="POST">
                                                    <input type="submit" name="submit_step1" id="submit_step1" style="min-width: 300px;" class="addtobag" value="Thanh toán <?php echo number_format($totalPrice, 0, ',', '.'); ?> VND">
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
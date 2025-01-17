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
    <title>Index</title>
    <link rel="stylesheet" href="css/cssindex.css">
</head>

<body>
    <?php include 'backtotop.html'; ?>
    <div class="slider-wrap space20"">
    <div class=" tp-banner-container" style="overflow: visible;">
        <div class="tp-banner revslider-initialised tp-simpleresponsive" id="revslider-288" style="max-height: 1200px; height: 700px;">
            <ul class="tp-revslider-mainul" style="display: block; overflow: hidden; width: 100%; height: 100%; max-height: none;">
                <li data-transition="fade" data-slotamount="2" data-masterspeed="500" data-saveperformance="on" data-title="4MEN Intro Slide" data-link="" class="tp-revslider-slidesli">
                    <div class="slotholder" style="width:100%;height:100%;">
                    <div class="tp-bgimg defaultimg" style="background-image: url('image/test.png'); background-size: cover; background-position: center top; width: 100%; height: 100%;"></div>

                    </div>
                </li>
                <li data-transition="fade" data-slotamount="2" data-masterspeed="500" data-saveperformance="on" data-title="4MEN Intro Slide" data-link="" class="tp-revslider-slidesli">
                    <div class="slotholder" style="width:100%;height:100%;">
                    <div class="tp-bgimg defaultimg" style="background-image: url('image/test1cc.png'); background-size: cover; background-position: center top; width: 100%; height: 100%;"></div>
                    </div>
                </li>
                <li data-transition="fade" data-slotamount="2" data-masterspeed="500" data-saveperformance="on" data-title="4MEN Intro Slide" data-link="" class="tp-revslider-slidesli">
                    <div class="slotholder" style="width:100%;height:100%;">
                    <div class="tp-bgimg defaultimg" style="background-image: url('image/test1ccc.png'); background-size: cover; background-position: center top; width: 100%; height: 100%;"></div>
                    </div>
                </li>
            </ul>
            <div class="slider-arrow left-arrow" onclick="prevSlide()">&#10094;</div>
            <div class="slider-arrow right-arrow" onclick="nextSlide()">&#10095;</div>
        </div>
    </div>
    </div>


    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.tp-revslider-slidesli');
        const totalSlides = slides.length;

        slides.forEach((slide, index) => {
            slide.style.opacity = index === 0 ? 1 : 0;
            slide.style.zIndex = index === 0 ? 2 : 1;
            slide.style.transition = 'opacity 1s ease-in-out';
            slide.style.position = 'absolute';
            slide.style.top = 0;
            slide.style.left = 0;
            slide.style.width = '100%';
            slide.style.height = '100%';
        });

        function goToSlide(index) {
            slides.forEach((slide, i) => {
                if (i === index) {
                    slide.style.opacity = 1;
                    slide.style.zIndex = 2;
                } else {
                    slide.style.opacity = 0;
                    slide.style.zIndex = 1;
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            goToSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            goToSlide(currentSlide);
        }

        goToSlide(currentSlide);

        setInterval(nextSlide, 7000);
    </script>

    <style>
        slider-wrap {
            position: relative;
            width: 100%;
            height: 60vh;
        }

        .tp-revslider-mainul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            overflow: hidden;
            position: relative;
            width: 100%;
            height: 100%;

        }

        .tp-revslider-slidesli {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            /* Slide ẩn */
            z-index: 1;
            /* Slide nền */
            transition: opacity 1s ease-in-out;
            /* Mờ dần */
        }

        /* Slide hiển thị */
        .tp-revslider-slidesli:first-child {
            opacity: 1;
            z-index: 2;
            /* Đặt slide đầu tiên ở trên */
        }

        .tp-bgimg {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center center;
        }

        .tp-revslider-mainul {
            transition: all 0.5s ease-in-out;
            /* Tạo hiệu ứng chuyển mượt mà */
        }

        .tp-caption {
            position: absolute;
            top: 70%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 24px;
            text-align: center;
        }

        .slider-arrow {
            background-color: rgba(0, 0, 0, 0.5);
            /* Màu nền của mũi tên */
            color: white;
            /* Màu chữ của mũi tên */
            padding: 10px;
            border-radius: 50%;
            /* Viền bo tròn */
            font-size: 24px;
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
        }

        .slider-arrow {
            position: absolute;
            top: 70%;
            transform: translateY(-50%);
            font-size: 30px;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px;
            cursor: pointer;
            z-index: 10;
        }

        .left-arrow {
            left: 10px;
        }

        .right-arrow {
            right: 10px;
        }

        @media (max-width: 768px) {
            slider-wrap {
                height: 40vh;
            }

            .tp-bgimg {
                background-position: center center;
            }
        }

        @media (max-width: 480px) {
            slider-wrap {
                height: 40vh;
            }

            .tp-bgimg {
                background-position: center center;
            }
        }
    </style>
    <div class="col">
        <div class="text text-dark text-left mt-2">
            <h1 class="ml-2 text-center">Thời Trang Hot Nhất</h1>
        </div>
        <div class="text text-dark p-2">
            <div class="">
                <?php
                // Kết nối với cơ sở dữ liệu
                $config = new Config();
                $conn = $config->connect();

                // Lấy danh sách sản phẩm từ cơ sở dữ liệu
                $sql = "SELECT * FROM hanghot";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<div class='product-container'>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='product'>";
                        echo "<a href='information.php?type=hanghot&id=" . htmlspecialchars($row['id']) . "' title='" . htmlspecialchars($row['name']) . "'>";
                        echo "<img src='api/images/hanghot/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "' />";
                        echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
                        echo "</a>";
                        $price = $row['price'];
                        if (floor($price) == $price) {
                            echo "<p>Giá: " . number_format($price, 0, ',', '.') . " VND</p>";
                        } else {
                            echo "<p>Giá: " . number_format($price, 2, ',', '.') . " VND</p>";
                        }
                        echo "<a href='add_to_cart.php?type=hanghot&id=" . htmlspecialchars($row['id']) . "' class='button'>Thêm vào giỏ hàng</a>";
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
        <div class="banner-index">
            <div class="row">
                <!-- Banner 1 -->
                <div class="col-md-3 col-sm-3">
                    <div class="block-content">
                        <a href="#" title="banner index 1">
                            <img src="https://4menshop.com/images/thumbs/slides/slide-1-trang-chu-slide-1.png?t=1728066350" class="img-responsive zoom-image" alt="banner index 1">
                        </a>
                    </div>
                </div>

                <!-- Banner 2 -->
                <div class="col-md-6 col-sm-6">
                    <div class="block-content block-content-c">
                        <a href="#" title="banner index 2">
                            <img src="https://4menshop.com/images/thumbs/slides/slide-2-trang-chu-slide-2.jpg?t=1728104947" class="img-responsive zoom-image" alt="banner index 2">
                        </a>
                    </div>
                </div>

                <!-- Banner 3 -->
                <div class="col-md-3 col-sm-3">
                    <div class="block-content">
                        <a href="#" title="banner index 4">
                            <img src="https://4menshop.com/images/thumbs/slides/slide-4-trang-chu-slide-3.png?t=1728066463" class="img-responsive zoom-image" alt="banner index 4">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- CSS for zoom effect and hiding banners on small screens -->
        <style>
            .zoom-image {
                transition: transform 0.3s ease;
                /* Smooth transition */
            }

            .zoom-image:hover {
                transform: scale(1.05);
                /* Zoom in effect */
            }

            .banner-index {
                max-width: 95%;
                /* Reduce width */
                margin: 0 auto;
                /* Center the container */
                padding: 10px;
                /* Add some padding around */
            }

            /* Media query to hide .banner-index on small screens (max-width: 768px) */
            @media (max-width: 768px) {
                .banner-index {
                    display: none;
                    /* Hide the banner on screens smaller than 768px */
                }
            }
        </style>
        <div class="text text-dark text-left mt-2">
            <h1 class="ml-2 text-center">Thời Trang Nữ</h1>
        </div>
        <div class="text text-dark p-2">
            <div class="">
                <?php
                // Use the Config class to connect to the database
                $config = new Config();
                $conn = $config->connect();

                // Fetch products from the database
                $sql = "SELECT * FROM donu";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<div class='product-container'>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='product'>";
                        echo "<a href='information.php?type=donu&id=" . htmlspecialchars($row['id']) . "' title='" . htmlspecialchars($row['name']) . "'>";
                        echo "<img src='api/images/donu/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "' />";
                        echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
                        echo "</a>";
                        $price = $row['price'];
                        if (floor($price) == $price) {
                            echo "<p>Giá: " . number_format($price, 0, ',', '.') . " VND</p>";
                        } else {
                            echo "<p>Giá: " . number_format($price, 2, ',', '.') . " VND</p>";
                        }
                        echo "<a href='add_to_cart.php?type=donu&id=" . htmlspecialchars($row['id']) . "' class='button'>Thêm vào giỏ hàng</a>";
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
        <div class="policy-item" id="policy2">
            <div class="container">
                <div class="row">
                    <!-- Thanh Toán & Giao Hàng -->
                    <div class="col-md-3 col-sm-3">
                        <div class="pi-wrap">
                            <i class="fa fa-plane" aria-hidden="true"></i>
                            <h4>THANH TOÁN &amp; GIAO HÀNG</h4>
                            <p>
                                Miễn phí vận chuyển cho đơn hàng trên 399.000 VNĐ<br>
                                - Giao hàng và thu tiền tận nơi<br>
                                - Chuyển khoản và giao hàng<br>
                                - Mua hàng tại shop
                            </p>
                        </div>
                    </div>

                    <!-- Thẻ Thành Viên -->
                    <div class="col-md-3 col-sm-3">
                        <div class="pi-wrap">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                            <h4>THẺ THÀNH VIÊN</h4>
                            <p>
                                Chế độ ưu đãi thành viên VIP:<br>
                                - 5% cho thành viên Bạc<br>
                                - 10% cho thành viên Vàng<br>
                                - 15% cho thành viên Kim cương
                            </p>
                        </div>
                    </div>

                    <!-- Giờ Mở Cửa -->
                    <div class="col-md-3 col-sm-3">
                        <div class="pi-wrap">
                            <i class="fa fa-clock" aria-hidden="true"></i>
                            <h4>GIỜ MỞ CỬA</h4>
                            <p>
                                <strong>8h30 đến 22:00</strong><br>
                                - Tất cả các ngày trong tuần<br>
                                - Áp dụng cho tất cả các chi nhánh hệ thống cửa hàng
                            </p>
                        </div>
                    </div>

                    <!-- Hỗ Trợ 24/7 -->
                    <div class="col-md-3 col-sm-3">
                        <div class="pi-wrap">
                            <i class="fa fa-headphones" aria-hidden="true"></i>
                            <h4>Hỗ trợ 24/7</h4>
                            <p>
                                Gọi ngay cho chúng tôi khi bạn có thắc mắc<br>
                                - 0999.444.666
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- end load view -->
    </div>
    <?php include_once 'part/footer.php'; ?>
    </div>
    </div>
    </div>
    </div>
    </main>
    </section>
</body>

</html>
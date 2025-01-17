<?php
include_once "api/app/controller/AuthController.php";
include_once "api/app/Config.php";
include_once "api/app/controller/UserController.php";

// Kiểm tra xác thực
$auth = new AuthController();
$auth->checkAuth();

// Lấy thông tin người dùng
$user = new UserController();
$row = $user->getUserById($_SESSION['unique_id']);

// Kiểm tra quyền admin
if ($row && $row['is_admin'] == 1) {
    $_SESSION['is_admin'] = 1;
} else {
    $_SESSION['is_admin'] = 0;
}
include_once "head.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="referrer" content="no-referrer">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="css/cssindex.css">
    <script>
        let currentSection = null; // Biến để lưu phần đang hiển thị

        function toggleSection(sectionId) {
            // Nếu phần đã có nội dung hiển thị, ẩn nó đi
            if (currentSection && currentSection !== sectionId) {
                document.getElementById(currentSection).classList.add('hidden');
            }

            // Toggle (ẩn/hiện) phần mới
            const section = document.getElementById(sectionId);
            section.classList.toggle('hidden');

            // Cập nhật phần đang hiển thị
            if (section.classList.contains('hidden')) {
                currentSection = null;
            } else {
                currentSection = sectionId;
            }
        }
    </script>

</head>


<body>
    <style>
        /* Basic form styling */
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        /* Style the labels */
        form label {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #333;
        }

        /* Style the input fields */
        form input[type="text"],
        form input[type="number"],
        form textarea,
        form select,
        form input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        /* Add focus style to input fields */
        form input[type="text"]:focus,
        form input[type="number"]:focus,
        form textarea:focus,
        form select:focus,
        form input[type="file"]:focus {
            border-color: #007BFF;
            outline: none;
        }

        /* Style the submit button */
        form button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        /* Button hover effect */
        form button:hover {
            background-color: #218838;
        }

        /* Style for the select box */
        form select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        /* Additional space between form fields */
        form textarea {
            height: 150px;
        }

        /* Chỉnh sửa CSS cho nút */
        .action-button {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.2s;
            /* Đảm bảo nút không bị đẩy ra ngoài */
            display: inline-block;
            position: relative;
            z-index: 1;
        }

        /* Hiệu ứng hover */
        .action-button:hover {
            background-color: #0056b3;
        }

        /* Hiệu ứng khi nhấn nút (giảm kích thước nút nhẹ) */
        .action-button:active {
            transform: scale(0.98);
            /* Thu nhỏ nút khi bấm */
        }

        /* CSS cho phần nội dung */
        .hidden {
            display: none;
        }

        /* Responsive design */
        @media (max-width: 600px) {
            form {
                padding: 15px;
            }

            form label {
                font-size: 14px;
            }

            form input[type="text"],
            form input[type="number"],
            form textarea,
            form select,
            form input[type="file"] {
                font-size: 14px;
            }

            form button {
                padding: 8px 15px;
                font-size: 14px;
            }
        }
    </style>
    <?php include 'backtotop.html'; ?>
    <h2 style="text-align: center;">Danh sách sản phẩm</h2>
    <form action="" method="GET">
        <label for="view_table">Chọn bảng để xem sản phẩm:</label>
        <select name="view_table" id="view_table" required>
            <option value="hangnew">Đồ Mới</option>
            <option value="products">Đồ Nam</option>
            <option value="donu">Đồ Nữ</option>
            <option value="phukien">Phụ Kiện</option>
            <option value="dosale">Đồ Sale</option>
            <option value="hanghot">Hàng Hot</option>
        </select>
        <button type="submit">Xem</button>
    </form>

    <?php
    if (isset($_GET['view_table'])) {
        $table_name = $_GET['view_table'];

        // Kết nối cơ sở dữ liệu
        $db = new Config();
        $conn = $db->connect();

        $query = "SELECT id, name, price FROM `$table_name`";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<table border='1' style='margin: 20px auto; width: 80%;'>";
            echo "<tr><th>ID</th><th>Tên sản phẩm</th><th>Giá</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['price']}</td></tr>";
            }
            echo "</table>";
        } else {
            echo "Không có sản phẩm nào trong bảng $table_name.";
        }

        $conn->close();
    }
    ?>
    <button onclick="toggleSection('addProductSection')" class="action-button">Thêm sản phẩm mới</button>
    <div id="addProductSection" class="hidden">
        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>

            <h2 style="text-align: center;">Thêm sản phẩm mới</h2>
            <form action="add_product.php" method="POST" enctype="multipart/form-data">
                <label for="name">Tên Bảng:</label>
                <select name="table_name" id="quantityBuy">
                    <option value="hangnew">Đồ Mới</option>
                    <option value="products">Đồ Nam</option>
                    <option value="donu">Đồ Nữ</option>
                    <option value="phukien">Phụ Kiện</option>
                    <option value="dosale">Đồ Sale</option>
                    <option value="hanghot">Hàng Hot</option>
                </select>

                <label for="name">Tên sản phẩm:</label>
                <input type="text" name="name" required>

                <label for="description">Mô tả:</label>
                <textarea name="description" required></textarea>

                <label for="price">Giá:</label>
                <input type="number" name="price" required>

                <label for="category_id">Số Lượng Sản Phẩm:</label>
                <input type="number" name="category_id" required>

                <label for="image">Hình ảnh:</label>
                <input type="file" name="image" accept="image/*" required>

                <button type="submit">Thêm sản phẩm</button>
            </form>
    </div>
<?php else: ?>
    <p>Bạn không có quyền truy cập chức năng này.</p>
<?php endif; ?>
<button onclick="toggleSection('DeleteProductSection')" class="action-button">Xóa Sản Phẩm</button>
<div id="DeleteProductSection" class="hidden">
    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
        <h2 style="text-align: center;">Xóa sản phẩm</h2>
        <form action="delete_product.php" method="POST">
            <label for="table_name">Chọn bảng:</label>
            <select name="table_name" id="table_name" required>
                <option value="hangnew">Đồ Mới</option>
                <option value="products">Đồ Nam</option>
                <option value="donu">Đồ Nữ</option>
                <option value="phukien">Phụ Kiện</option>
                <option value="dosale">Đồ Sale</option>
                <option value="hanghot">Hàng Hot</option>
            </select>

            <label for="product_id">ID sản phẩm:</label>
            <input type="number" name="product_id" placeholder="Nhập ID sản phẩm cần xóa" required>

            <button type="submit">Xóa sản phẩm</button>
        </form>
</div>
<?php endif; ?>

<button onclick="toggleSection('ChangeProductSection')" class="action-button">Chỉnh Sửa Sản Phẩm</button>
<div id="ChangeProductSection" class="hidden">
    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
        <h2 style="text-align: center;">Chỉnh sửa sản phẩm</h2>
        <form action="edit_product.php" method="POST">
            <label for="table_name">Chọn bảng:</label>
            <select name="table_name" id="table_name" required>
                <option value="hangnew">Đồ Mới</option>
                <option value="products">Đồ Nam</option>
                <option value="donu">Đồ Nữ</option>
                <option value="phukien">Phụ Kiện</option>
                <option value="dosale">Đồ Sale</option>
                <option value="hanghot">Hàng Hot</option>
            </select>

            <label for="product_id">ID sản phẩm:</label>
            <input type="number" name="product_id" placeholder="Nhập ID sản phẩm cần chỉnh sửa" required>

            <label for="name">Tên sản phẩm:</label>
            <input type="text" name="name" placeholder="Tên sản phẩm mới">

            <label for="description">Mô tả sản phẩm:</label>
            <textarea name="description" placeholder="Mô tả sản phẩm mới"></textarea>

            <label for="price">Giá sản phẩm:</label>
            <input type="number" name="price" placeholder="Giá sản phẩm mới">

            <label for="quantity">Số lượng sản phẩm:</label>
            <input type="number" name="quantity" placeholder="Số lượng sản phẩm mới">

            <label for="image">Hình ảnh (nếu có):</label>
            <input type="file" name="image" accept="image/*">
            <button type="submit">Cập nhật sản phẩm</button>
        </form>
</div>
<?php endif; ?>
<style>
    /* Tạo vùng khung liên kết */
    .link-container-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
        /* Giảm khoảng cách giữa tiêu đề và khung */
    }

    .link-container {
        text-align: center;
        padding: 20px;
        border: 2px solid #007BFF;
        border-radius: 10px;
        background-color: #ffffff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Thiết kế liên kết */
    .link-container a {
        text-decoration: none;
        color: #007BFF;
        font-size: 18px;
        font-weight: bold;
        display: inline-block;
        padding: 10px 20px;
        border: 1px solid #007BFF;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
    }

    /* Hiệu ứng hover */
    .link-container a:hover {
        background-color: #007BFF;
        color: #ffffff;
    }

    /* Căn chỉnh tiêu đề */
    h2 {
        text-align: center;
        margin-bottom: 10px;
        /* Giảm khoảng cách bên dưới tiêu đề */
        font-size: 24px;
        color: #333;
    }
</style>
<h2>Xem Tất Cả User</h2>

<div class="link-container-wrapper">
    <div class="link-container">
        <a href="list_users.php">Xem danh sách người dùng</a>
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
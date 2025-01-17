<?php
include_once "api/app/controller/AuthController.php";
include_once "api/app/Config.php";
include_once "api/app/controller/UserController.php";
$user = new UserController();
if (!isset($_SESSION['unique_id'])) {
  // header("Location: login.php");
  // exit();
} else {
  $user = new UserController();
  $row = $user->getUserById($_SESSION['unique_id']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Fashion</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/csshead.css">
</head>

<body>
  <div class="custom-top-bar hidden-xs">
    <div class="custom-container">
      <div class="custom-center pull-left">
        <ul>
          <li class="custom-phone">
            <i class="fas fa-phone"></i>&nbsp; Hotline:
            <a href="tel:0868444644" title="Hotline" rel="nofollow">0999.444.666</a>
          </li>
        </ul>
      </div>
      <div class="custom-right pull-right">
        <ul>
          <li>
            <div class="custom-info">
              <a href="chonsize.php" title="cach chon size quan ao">Cách chọn Size</a>
            </div>
          </li>
          <li>
            <div class="custom-info">
              <a href="khachvip.php" title="chinh sach khach vip">Chính sách khách vip</a>
            </div>
          </li>
          <li class="hidden-xs">
            <div class="custom-info">
              <a href="gioithieu.php" title="gioi thieu">Giới thiệu</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <header>
    <!-- Logo -->
    <a class="Logo" href="index.php" title="TEAM10™">
      <img src="../image/logo.png" class="img-responsive" alt="TEAM10™ Logo">
    </a>

    <!-- Nút Hamburger (Mobile) -->
    <button class="hamburger-menu" id="hamburger" aria-label="Toggle navigation">
      <span></span>
      <span></span>
      <span></span>
    </button>

    <!-- Menu -->
    <nav class="menu">
      <ul>
        <li><a href="hangnew.php" title="Hàng mới về">Hàng mới về <span class="nav-badge">Hot</span></a></li>
        <li class="dropdown">
          <a href="donam.php">Đồ Nam</a>
          <ul class="submenu">
            <li><a href="donam.php">Áo</a></li>
            <li><a href="donam.php">Quần</a></li>
            <li><a href="donam.php">Giày</a></li>
            <li><a href="donam.php">Dép</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="donu.php">Đồ Nữ</a>
          <ul class="submenu">
            <li><a href="donu.php">Áo</a></li>
            <li><a href="donu.php">Quần</a></li>
            <li><a href="donu.php">Giày</a></li>
            <li><a href="donu.php">Dép</a></li>
          </ul>
        </li>
        <li><a href="phukien.php">Phụ Kiện</a></li>
        <li> <a href="dosale.php" title="OUTLET SALE">OUTLET SALE <span class="nav-badge">Hot</span></a></li>
        <li><a href="stylist.php" title="Stylist">Stylist <span class="nav-badge">Hot</span></a></li>
        <?php if (!isset($_SESSION['unique_id'])) { ?>
          <li><a href="/login.php" style="color: white;" class="btn" >Đăng nhập</a></li>
        <?php } else { ?>
          <a href="profile.php" class="s-fa s-fa-user-color" title="Account">
            <i class="fas fa-user"></i> <?php echo htmlspecialchars($row['email']); ?>
          </a>
          <a href="api/logout.php?logout_id=<?php echo htmlspecialchars($row['unique_id']); ?>" style="color: white;" class="btn">Đăng xuất</a>
        <?php } ?>
        <?php
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (isset($_SESSION['unique_id'])) {
          // Lấy thông tin người dùng từ cơ sở dữ liệu nếu đã đăng nhập
          $user = new UserController();
          $row = $user->getUserById($_SESSION['unique_id']);

          // Kiểm tra quyền admin
          if ($row && $row['is_admin'] == 1):
        ?>
            <li>
              <a href="admin.php" title="ADMIN">ADMIN<span class="nav-badge">Hot</span></a>
            </li>
        <?php
          endif;
        }
        ?>
      </ul>

    </nav>
  </header>
  <script>
    const hamburger = document.getElementById('hamburger');
    const menu = document.querySelector('.menu');
    hamburger.addEventListener('click', () => {
      menu.classList.toggle('active');
    });
  </script>
</body>

</html>
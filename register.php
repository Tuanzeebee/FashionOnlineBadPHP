<?php
include('head.php');
include_once "part/header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" defer></script>
  <link rel="stylesheet" href="assets/style.css">
</head>

<body>
  <div class="main-wrapper">
    <div class="wrapper">
      <section class="form signup">
        <h1>Register</h1>
        <form action="#">
          <div class="error-text"></div>
          <div class="name-details">
            <div class="field input">
              <label for="">Tên</label>
              <input type="text" name="fname" placeholder="Tên" required>
            </div>
            <div class="field input">
              <label for="">Họ</label>
              <input type="text" name="lname" placeholder="Họ" required>
            </div>
          </div>

          <div class="field input">
            <label for="">Email</label>
            <input type="text" name="email" placeholder="Nhập Email" required>
          </div>

          <div class="field input">
            <label for="">Mật khẩu</label>
            <input type="password" name="password" placeholder="Nhập mật khẩu" required>
            <i class="fas fa-eye"></i>
          </div>
          <div class="field input">
            <label for="phone">Số điện thoại</label>
            <input type="tel" id="phone" name="phone" placeholder="Nhập Số Điện Thoại" pattern="[0-9]{10,11}" required>
          </div>
          <div class="field input">
            <label for="gender">Giới tính</label>
            <select class="from-control" name="gender" required>
              <option disabled=" ">Chọn giới tính</option>
              <option value="Nam">Nam</option>
              <option value="Nữ">Nữ</option>
              <option value="Khác">Khác</option>
            </select>
          </div>
          <div class="field image">
            <label for="">Ảnh đại diện</label>
            <input type="file" name="image" accept="image/x-png,image/jpeg,image/jpg" required>
          </div>
          <div class="field button">
            <input type="submit" value="Register">
          </div>

        </form>
        <div class="link">Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></div>
      </section>
    </div>

    <script src="assets/password-event.js"></script>
    <script src="assets/signup.js"></script>
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
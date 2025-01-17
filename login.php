<?php
include_once "head.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" defer></script>
  <link rel="stylesheet" href="assets/style.css">
</head>

<body>
  <div class="main-wrapper">
    <div class="wrapper">
      <section class="form login">
        <h1>Login</h1>
        <form action="#">
          <div class="error-text"></div>
          <div class="field input">
            <label>Email</label>
            <input type="text" name="email" placeholder="Nhập Email" required>
          </div>
          <div class="field input">
            <label>Mật khẩu</label>
            <input type="password" name="password" placeholder="Nhập mật khẩu" required>
            <i class="fas fa-eye"></i>
          </div>
          <div class="cf-turnstile"
            data-sitekey="0x4AAAAAAAzHYf8oRGQ5--z7"
            data-theme="light"
            data-action="login"
            data-execution="render">
          </div>
    <div class="field button">
      <input type="submit" value="Login">
    </div>
    </form>
    <div class="link">Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></div>
    </section>
  </div>
  <script src="assets/password-event.js"></script>
  <script src="assets/login.js"></script>
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
<?php

<?php
include_once "api/app/controller/AuthController.php";
include_once "api/app/Config.php";
include_once "api/app/controller/UserController.php";

$auth = new AuthController();
$auth->checkAuth();

$user = new UserController();
$row = $user->getUserById($_SESSION['unique_id']);
include_once "head.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ChatUser</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="assets/style.css">
</head>

<body>
  <div class="main-wrapper">
    <div class="wrapper">
      <section class="users">
        <h1>
          <div class="content">
            <img src="api/images/<?php echo $row['img']; ?>" alt="">
            <div class="details">
              <span><?php echo $row['lname'] . ' ' . $row['fname']; ?></span>
              <div class="user-status"><?php echo $row['status']; ?></div>
            </div>
          </div>
        </h1>
        <div class="search">
          <span class="text">Lựa chọn stylist để trò chuyện</span>
          <input class="" type="text" name="search" id="" placeholder="Nhập tên để tìm kiếm">
          <button class=""><i class="fas fa-search"></i></button>
        </div>
        <div class="users-list">
        </div>
      </section>
    </div>
  </div>

  <script src="assets/users-event.js"></script>
</body>

</html>
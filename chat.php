<?php
include_once "api/app/controller/AuthController.php";
include_once "api/app/Config.php";
include_once "api/app/controller/UserController.php";
$auth = new AuthController();
$auth->checkAuth();

$user = new UserController();
$row = $user->getUserById($_GET['user_id']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="assets/style.css">
</head>

<body>
  <div class="main-wrapper">
    <div class="wrapper">
      <section class="chat-area">
        <h1>
          <a href="users.php" class="back-icon">
            <i class="fas fa-arrow-left"></i>
          </a>
          <img src="api/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['lname'] . ' ' . $row['fname']; ?></span>
            <div class="user-status"><?php echo $row['status']; ?></div>
          </div>
        </h1>
        <div class="chat-box"></div>
        <form action="#" class="typing-area" enctype="multipart/form-data">
          <input type="text" name="incoming_id" class="incoming_id" value="<?php echo $_GET['user_id']; ?>" id="" hidden>
          <input type="text" name="message" class="input-field" placeholder="Nhập nội dung ở đây..." autocomplete="off">
          <button>
            <i class="fab fa-telegram-plane"></i>
          </button>
        </form>
      </section>
    </div>
    <script src="assets/chat-event.js"></script>
</body>

</html>
<?php
class AuthController
{
    private Config $conn;

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->conn = new Config();
    }

    public function checkAuth()
    {
        if (!isset($_SESSION['unique_id'])) {
            header("location: login.php");
        }
    }

    public function signUp()
    {
        $fname = mysqli_real_escape_string($this->conn->connect(), $_POST['fname']);
        $lname = mysqli_real_escape_string($this->conn->connect(), $_POST['lname']);
        $email = mysqli_real_escape_string($this->conn->connect(), $_POST['email']);
        $password = mysqli_real_escape_string($this->conn->connect(), $_POST['password']);
        $phone = mysqli_real_escape_string($this->conn->connect(), $_POST['phone']);
        $gender = mysqli_real_escape_string($this->conn->connect(), $_POST['gender']);

        if (empty($fname) or empty($lname) or empty($email) or empty($password) or empty($phone) or empty($gender)) {
            echo "Vui Lòng Nhập Đầy Đủ Thông Tin";
            return;
        }
        if (!preg_match("/^[a-zA-ZÀ-ỹ\s]+$/u", $fname)) {
            echo "Tên không được chứa ký tự đặc biệt.";
            return;
        }
    
        if (!preg_match("/^[a-zA-ZÀ-ỹ\s]+$/u", $lname)) {
            echo "Họ không được chứa ký tự đặc biệt.";
            return;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "$email không là email hợp lệ!";
            return;
        }

        if ($this->checkIssetEmail($email)) {
            return;
        }
        if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@#]{8,}$/", $password)) {
            echo "Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ, số và chỉ được chứa ký tự đặc biệt @ hoặc #.";
            return;
        }        
        if (!preg_match("/^[0-9]{10,}$/", $phone)) {
            echo "Số điện thoại phải là số và có ít nhất 10 chữ số.";
            return;
        }

        if (isset($_FILES['image'])) {
            $img_name = $_FILES['image']['name'];
            $img_type = $_FILES['image']['type'];
            $tmp_name = $_FILES['image']['tmp_name'];

            $img_explode = explode('.', $img_name);
            $img_ext = end($img_explode);

            $extensions = ["jpeg", "png", "jpg"];
            if (!in_array($img_ext, $extensions)) {
                echo "Vui lòng đăng file ảnh - jpeg, png, jpg";
                return;
            }

            $types = ['image/jpeg', 'image/jpg', 'image/png'];
            if (!in_array($img_type, $types)) {
                echo "Vui lòng đăng file ảnh - jpeg, png, jpg";
                return;
            }

            $time = time();
            $new_img_name = $time . $img_name;
            if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                $ran_id = rand(time(), 1000000000);
                $status = "Đang hoạt động";

                // Mã hóa mật khẩu bằng password_hash()
                $encrypt_pass = password_hash($password, PASSWORD_BCRYPT);

                // Thực hiện truy vấn chèn người dùng vào cơ sở dữ liệu
                $insert_query = mysqli_query(
                    $this->conn->connect(),
                    "INSERT INTO users (unique_id, fname, lname, email, password, img, phone, gender, status)
                     VALUES ({$ran_id}, '${fname}', '${lname}', '${email}', '${encrypt_pass}', '${new_img_name}', '${phone}', '${gender}', '${status}')"
                );

                if (!$insert_query) {
                    echo "Có lỗi xảy ra. Vui lòng thử lại!";
                    return;
                }

                // Kiểm tra sự tồn tại của người dùng qua email
                $select_sql2 = mysqli_query($this->conn->connect(), "SELECT * FROM users WHERE email = '${email}'");
                if (!mysqli_num_rows($select_sql2) > 0) {
                    echo "Email này không tồn tại!";
                    return;
                }

                $result = mysqli_fetch_assoc($select_sql2);
                $_SESSION['unique_id'] = $result['unique_id'];
                echo "success";
            }
        }
    }

    public function logIn()
    {
        $email = mysqli_real_escape_string($this->conn->connect(), $_POST['email']);
        $password = mysqli_real_escape_string($this->conn->connect(), $_POST['password']);
        $turnstileResponse = $_POST['cf_turnstile'] ?? '';

        // Kiểm tra trường bắt buộc
        if (empty($email) || empty($password)) {
            echo "Mọi trường đều bắt buộc";
            return;
        }

        // 1. Kiểm tra email và mật khẩu trước
        $sql = mysqli_query($this->conn->connect(), "SELECT * FROM users WHERE email = '${email}'");
        if (!mysqli_num_rows($sql) > 0) {
            echo "Email này không tồn tại!";
            return;
        }

        $row = mysqli_fetch_assoc($sql);
        $enc_pass = $row['password']; // Mật khẩu đã mã hóa trong cơ sở dữ liệu

        // 2. So sánh mật khẩu sử dụng password_verify
        if (!password_verify($password, $enc_pass)) {
            echo "Email hoặc Mật khẩu không chính xác";
            return;
        }

        // 3. Kiểm tra CAPTCHA nếu thông tin đăng nhập hợp lệ
        if (empty($turnstileResponse)) {
            echo "Vui lòng tích CAPTCHA.";
            return;
        }

        $turnstileSecret = '0x4AAAAAAAzHYZRXZ11S8LojqPw1nbWoeSg'; // Thay bằng Turnstile Secret Key của bạn
        $turnstileVerify = file_get_contents("https://challenges.cloudflare.com/turnstile/v0/siteverify", false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query([
                    'secret' => $turnstileSecret,
                    'response' => $turnstileResponse,
                ])
            ]
        ]));
        $turnstileResult = json_decode($turnstileVerify, true);

        if (!$turnstileResult['success']) {
            echo "CAPTCHA không hợp lệ.";
            return;
        }

        // 4. Đăng nhập thành công
        $status = "Đang hoạt động";
        $sql2 = mysqli_query(
            $this->conn->connect(),
            "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}"
        );
        if ($sql2) {
            $_SESSION['unique_id'] = $row['unique_id'];
            echo "success";
        } else {
            echo "Có lỗi xảy ra. Vui lòng thử lại!";
        }
    }

    public function logOut()
    {
        $this->checkAuth();

        $logout_id = mysqli_real_escape_string($this->conn->connect(), $_GET['logout_id']);
        if (isset($logout_id)) {
            $status = "Không hoạt động";
            $sql = mysqli_query(
                $this->conn->connect(),
                "UPDATE users SET status = '{$status}' WHERE unique_id={$logout_id}"
            );
            if ($sql) {
                session_unset();
                session_destroy();
                header("location: ../login.php");
            } else {
                header("location: ../users.php");
            }
        }
    }

    private function checkIssetEmail($email)
    {
        $sql = mysqli_query($this->conn->connect(), "SELECT * FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            echo "$email - Email này đã tồn tại!";
            return true;
        }
        return false;
    }
    public function changePassword($user_id, $old_password, $new_password)
{
    // Kết nối cơ sở dữ liệu
    $conn = $this->conn->connect();

    // Lấy thông tin người dùng từ cơ sở dữ liệu
    $query = mysqli_query($conn, "SELECT password FROM users WHERE unique_id = '{$user_id}'");
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $hashed_password = $row['password'];

        // Kiểm tra mật khẩu cũ có đúng không
        if (!password_verify($old_password, $hashed_password)) {
            echo "Mật khẩu cũ không chính xác.";
            return;
        }

        // Kiểm tra độ mạnh của mật khẩu mới
        if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@#]{8,}$/", $new_password)) {
            echo "Mật khẩu mới phải có ít nhất 8 ký tự, bao gồm chữ, số và chỉ được chứa ký tự đặc biệt @ hoặc #.";
            return;
        }

        // Mã hóa mật khẩu mới
        $new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Cập nhật mật khẩu trong cơ sở dữ liệu
        $update_query = mysqli_query($conn, "UPDATE users SET password = '{$new_hashed_password}' WHERE unique_id = '{$user_id}'");

        if ($update_query) {
            echo "Mật khẩu đã được đổi thành công!";
        } else {
            echo "Có lỗi xảy ra khi cập nhật mật khẩu. Vui lòng thử lại.";
        }
    } else {
        echo "Không tìm thấy người dùng.";
    }
}
public function updatePassword($user_id, $old_password, $new_password)
{
    // Kết nối cơ sở dữ liệu
    $conn = $this->conn->connect();

    // Lấy mật khẩu hiện tại từ cơ sở dữ liệu
    $query = mysqli_query($conn, "SELECT password FROM users WHERE unique_id = '{$user_id}'");
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $hashed_password = $row['password'];

        // Kiểm tra mật khẩu cũ có đúng không
        if (!password_verify($old_password, $hashed_password)) {
            echo "Mật khẩu cũ không chính xác.";
            return;
        }

        // Kiểm tra độ mạnh của mật khẩu mới
        if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@#]{8,}$/", $new_password)) {
            echo "Mật khẩu mới phải có ít nhất 8 ký tự, bao gồm chữ, số và chỉ được chứa ký tự đặc biệt @ hoặc #.";
            return;
        }

        // Mã hóa mật khẩu mới
        $new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Cập nhật mật khẩu mới trong cơ sở dữ liệu
        $update_query = mysqli_query($conn, "UPDATE users SET password = '{$new_hashed_password}' WHERE unique_id = '{$user_id}'");

        if ($update_query) {
            echo "Mật khẩu đã được đổi thành công!";
        } else {
            echo "Có lỗi xảy ra khi cập nhật mật khẩu. Vui lòng thử lại.";
        }
    } else {
        echo "Không tìm thấy người dùng.";
    }
}

}

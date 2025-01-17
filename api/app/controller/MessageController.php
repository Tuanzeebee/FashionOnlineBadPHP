<?php

class MessageController
{
    private Config $conn;

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->conn = new Config();
    }
    public function insertChat()
    {
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($this->conn->connect(), $_POST['incoming_id']);
        $message = mysqli_real_escape_string($this->conn->connect(), $_POST['message']);
        if (file_exists("uploads/")) {
            echo "Thư mục uploads tồn tại.";
        } else {
            echo "Thư mục uploads không tồn tại.";
        }

        // Xử lý hình ảnh nếu có
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image = $_FILES['image'];
            $image_name = $image['name'];
            $image_tmp_name = $image['tmp_name'];
            $image_size = $image['size'];
            $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
            $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

            // Kiểm tra loại ảnh
            if (in_array(strtolower($image_ext), $allowed_ext)) {
                // Đổi tên ảnh để không trùng lặp
                $new_image_name = time() . '_' . rand(1000, 9999) . '.' . $image_ext;
                $image_path = 'uploads/' . $new_image_name;

                // Di chuyển ảnh vào thư mục uploads
                move_uploaded_file($image_tmp_name, $image_path);

                // Lưu vào cơ sở dữ liệu
                $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, image)
                    VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$image_path}')";
                mysqli_query($this->conn->connect(), $sql) or die();
            }
        } else {
            // Nếu không có ảnh, chỉ lưu tin nhắn
            if (!empty($message)) {
                $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                    VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')";
                mysqli_query($this->conn->connect(), $sql) or die();
            }
        }
    }


    public function getChat()
    {
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($this->conn->connect(), $_POST['incoming_id']);
        $output = "";
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($this->conn->connect(), $sql);
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                if ($row['outgoing_msg_id'] === $outgoing_id) {
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                <p>' . $row['msg'] . '</p>';
                    if (!empty($row['image'])) {
                        $output .= '<img src="uploads/' . $row['image'] . '" alt="image" class="chat-image" />';
                    }
                    $output .= '</div></div>';
                } else {
                    $output .= '<div class="chat incoming">
                                <div class="details">
                                <p>' . $row['msg'] . '</p>';
                    if (!empty($row['image'])) {
                        $output .= '<img src="uploads/' . $row['image'] . '" alt="image" class="chat-image" />';
                    }
                    $output .= '</div></div>';
                }
            }
        } else {
            $output .= "<div class='text'>Không có tin nhắn. Khi bạn có, tin nhắn sẽ hiện tại đây.</div>";
        }
        echo $output;
    }
}

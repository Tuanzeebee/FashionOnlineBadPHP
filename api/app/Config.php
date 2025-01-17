<?php

class Config
{
    public function connect()
    {
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $dbname = "chatapp";
        $_domain = "";
        //GMT +7
        date_default_timezone_set('Asia/Ho_Chi_Minh');


        $conn = mysqli_connect($hostname, $username, $password, $dbname);
        if (!$conn) {
            echo "Lỗi kết nối Database" . mysqli_connect_error();
        }
        return $conn;
    }
}

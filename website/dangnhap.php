<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<?php
session_start();
//Gọi file connection.php ở bài trước
require_once("../includes/connection.php");
require_once("../functions/redirect.php");
if (isset($_SESSION['user_id'])) {
    redirectUrl("index.php");
}
// Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
if (isset($_POST["btn_submit"])) {
    // lấy thông tin người dùng
    $username = $_POST["username"];
    $password = $_POST["password"];
    //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt
    //mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
    $username = strip_tags($username);
    $username = addslashes($username);
    $password = strip_tags($password);
    $password = addslashes($password);
    if ($username == "" || $password == "") {
        echo "username hoặc password bạn không được để trống!";
    } else {
        $sql = "select * from users where username = '$username' and password = '$password' ";
        $query = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($query);
        if ($num_rows === 0) {
            echo "tên đăng nhập hoặc mật khẩu không đúng !";
        } else {
            //Lấy ra thông tin người dùng và lưu vào session
            while ($data = mysqli_fetch_array($query)) {
                $_SESSION["user_id"] = $data["id"];
                $_SESSION['username'] = $data["username"];
                $_SESSION["email"] = $data["email"];
            }
            redirectUrl("index.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/css2/style.css">
    <title>Đăng nhập Cổng phản ánh</title>
</head>

<body>
<div class="content">
    <div class="content-left"style="background-image: url("../style/img/Subtraction5.png");background-repeat: no-repeat;
    background-position: left bottom;
    background-size: 25%;">
        <h3>Cổng phản ánh</h3>
    </div>
    <div class="content-right">
        <div class="box-dang-nhap">
            <h4>Đăng nhập</h4>
            <div class="input">
                <div class="input-box">
                    <img src="../style/img/user.svg" class="icon" alt="">
                    <input class="email" type="text" placeholder="Email hoặc số điện thoại" name="username" onfocus="this.value = '';" />
                </div>
                <div class="input-box">
                    <span><img src="../style/img/locked.svg" class="icon" alt=""></span>
                    <input class="password" type="password" placeholder="Mật khẩu" name="password" onfocus="this.value = '';" />
                </div>

                <input class="submit-button" type="submit" name="btn_submit" value="Đăng nhập">
            </div>
        </div>
    </div>

</div>
</body>

</html>
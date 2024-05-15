<?php
session_start();

if (isset($_POST['email'])) {

    $user_email = $_POST['email'];

} else {
    header('location: /doan2.0/admin/acount/login.php');
    die();
}
if (isset($_POST['password'])) {
    $user_password = $_POST['password'];

} else {
    header('location: /doan2.0/admin/acount/login.php');
    die();
}
#In dữ liệu
//kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$sql= "SELECT * FROM admins WHERE email='$user_email' AND password='$user_password' LIMIT 1";

// Thuc thi cau lenh
$rs = mysqli_query($conn, $sql);
if(mysqli_num_rows($rs) ==0){
    // Sai email hoac password
    header("Location: /doan2.0/admin/account/login.php");
    die();
}
else{
    $user = mysqli_fetch_assoc($rs);
    // Đăng nhập thành công
    $_SESSION['auth']['admin'] = $user['name'];
    $_SESSION['auth']['email'] = $user['email'];
    
    
    //chuyen huong:
    header("Location: /doan2.0/admin/home.php");

}
?>
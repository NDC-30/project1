<?php
#tất cả trang admin đều yêu cầu đăng nhập thì mới vào được
session_start();
if (!isset($_SESSION['auth']['admin'])) {
  header("location: /doan2.0/admin/account/login.php");
  die();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";

$result = mysqli_query($conn, $sql);

if (isset($_GET["search"])) {
  $search = $_GET["search"];
  $sql = "SELECT * FROM products WHERE name like '%$search%' or product_code like '%$search%'";
} else {
  $sql = "SELECT * from products";
}

$result = mysqli_query($conn, $sql);
?>
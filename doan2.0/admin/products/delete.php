<?php 

$product_id = $_POST['product_id'];

# Ket noi db
# Lưu vào db
// Ket noi CSDL
$servername = "localhost";
$username = "root";
$password = ""; // Mo tiếng lên nhé, XAMPP ko có password
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Kết nối thất bại: " . $conn->connect_error);
}

// Buoc 2: chuan bi cau lenh

$sql = "DELETE FROM products WHERE id='$product_id'";

// Thuc thi lenh
mysqli_query($conn, $sql);

// Chuyen huong ve 
header("Location:/doan2.0/admin/home.php");


?>
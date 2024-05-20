<?php 

# Không có giao diện, xử lý thêm sản phẩm

# B1: lấy dữ liệu
$product_code = $_POST['product_code'];
$name = $_POST['name'];
$buy_price = $_POST['price'];
$description = $_POST['description'] ?? ''; // Neu khong co mac dinh rong

# Lấy hình ảnh và lưu lại
$target_dir = "../../public/uploads/";
$target_file = $target_dir . basename($_FILES["image_file"]["name"]);

# Lưu ảnh tạm thời vào đường dẫn target_file
move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file);

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

$sql = "INSERT INTO products VALUES (NULL,'$product_code','$name','$buy_price',NULL,'$description','$target_file')";

$result = mysqli_query($conn, $sql);
// Chuyen huong ve trang chu: home san pham
header("Location: /doan2.0/admin/products/index.php");



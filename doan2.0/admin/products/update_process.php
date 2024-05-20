<?php 
$id = $_POST['product_id'];
$product_code = $_POST['product_code'];
$name = str_replace("'","\'",$_POST['name']);
$buy_price = $_POST['price'];
$description = $_POST['description'] ?? ''; // Neu khong co mac dinh rong

// Kiem tra them xem co cap nhat hinh hay ko
if(isset($_FILE['image_file'])){
   // Thuc hien update file
   $target_dir = "../../public/uploads/";
   $target_file = $target_dir . basename($_FILES["image_file"]["name"]);

    # Lưu ảnh tạm thời vào đường dẫn target_file
   move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file);

   $sql = "UPDATE products SET product_code = '$product_code', name='$name', buy_price='$buy_price', description='$description', image='$target_file'  WHERE id = '$id'";
}
else{
    $sql = "UPDATE products SET product_code = '$product_code', name='$name', buy_price='$buy_price', description='$description'  WHERE id = '$id'";
}

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

// echo $sql;

$result = mysqli_query($conn, $sql);
// Chuyen huong ve trang chu: home san pham
header("Location: /doan2.0/admin/products/index.php");



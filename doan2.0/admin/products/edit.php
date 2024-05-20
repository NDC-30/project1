<?php 

$product_id = $_GET["id"];


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
$sql = "SELECT id, product_code, name, image, buy_price FROM products WHERE id = $product_id";

// Buoc 3: thuc thi va xem ket qua
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_array($result);
}
else{
    header("Location: /doan2.0/admin/products/index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="d-flex vh-100">
        <!-- Sidebar -->
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <svg class="bi pe-none me-2" width="40" height="32">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                <span class="fs-4">LEGO</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="/doan2.0/admin/home.php" class="nav-link text-white" aria-current="page">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#home"></use>
                        </svg>
                        Trang chủ
                    </a>
                </li>
                <li>
                    <a href="/doan2.0/admin/products/index.php" class="nav-link active text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#speedometer2"></use>
                        </svg>
                        Quản lý sản phẩm
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#table"></use>
                        </svg>
                        Quản lý đơn hàng
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#grid"></use>
                        </svg>
                        Thống kê doanh thu
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>mdo</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>
        <!-- CONTENT -->
        <div class="container">
            <h1>Cập nhật thông tin sản phẩm </h1>
            <form class="my-3" id='form_update' method='POST' action="update_process.php" enctype="multipart/form-data">
                <input value="<?php echo $product_id ?>" name='product_id' hidden/>
                <input value="<?php echo $product['product_code'] ?>" class="form-control mt-2" name='product_code' placeholder="Nhập mã sản phẩm" required />
                <input value="<?php echo $product['name'] ?>"  class="form-control mt-2" name='name' placeholder="Nhập tên sản phẩm" required />
                <input value="<?php echo $product['buy_price'] ?>"  type="number" step="1" min="0" class="form-control mt-2" name='price' placeholder="Nhập giá sản phẩm" required />
                <img width='300px' src="<?php echo $product['image'] ?>" />
                <input type="file" name="image_file" class="form-control mt-2"/>
                <textarea value="<?php echo $product['description'] ?>"  class="form-control mt-2" row="5" name="description"></textarea>
                <button type="submit" class="btn btn-primary mt-2">Cập nhật sản phẩm </button>
            </form>
        </div>
    </div>


</body>

</html>
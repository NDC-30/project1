<?php
# tất cả trang admin đều yêu cầu đăng nhập thì mới vào được
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

$feedback = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $product_code = $_POST['product_code'];
    $buy_price = $_POST['buy_price'];
    $image = $_POST['image'];

    $sql = "INSERT INTO products (name, product_code, buy_price, image) VALUES ('$name', '$product_code', '$buy_price', '$image')";

    if (mysqli_query($conn, $sql)) {
        $feedback = "Product added successfully!";
    } else {
        $feedback = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM products";

if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $sql = "SELECT * FROM products WHERE name LIKE '%$search%' OR product_code LIKE '%$search%'";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
  
  <div class='d-flex vh-100'>
    <div class="fixed-top d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="height: 100%; width: 280px;">
      <a href="/doan2.0/admin/home.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
          <use xlink:href="#index"></use>
        </svg>
        <span class="fs-4">BEE HIVE</span>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="/doan2.0/admin/home.php" class="nav-link" aria-current="page">
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#home"></use>
            </svg>
            Trang chủ
          </a>
        </li>
        <li>
          <a href="/doan2.0/admin/home.php" class="nav-link active text-white">
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#speedometer2"></use>
            </svg>
            Quản lý sản phẩm
          </a>
        </li>
        <li>
          <a href="#" class="nav-link text-white">
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#table"></use>
            </svg>
            Quản lý đơn hàng
          </a>
        </li>
        <li>
          <a href="#" class="nav-link text-white">
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#grid"></use>
            </svg>
            Thống kê
          </a>
        </li>
        <li>
          <a href="#" class="nav-link text-white">
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#people-circle"></use>
            </svg>
            Doanh Thu
          </a>
        </li>
      </ul>
      <hr>
      <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
          <strong>mdo</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
          <li><a class="dropdown-item" href="#">New project...</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <form method="POST" action="/doan2.0/admin/account/logout.php">
              <button type="submit" class="dropdown-item" name="submit">Đăng suất</button>
            </form>
          </li>
        </ul>
      </div>
    </div>
    
    <div class="container mt-5">
      
      <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" data-sider-select-id="f9e21ea4-2da0-4795-b9a7-3d2b5694b947" data-sider-insert-id="766dae21-5f82-46bc-ac66-0cb3e0148c72">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Ảnh</th>
            <th>Giá bán</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while($row = mysqli_fetch_assoc($result)){
              echo "<tr>";
              echo "<td>".$row['id']."</td>";
              echo "<td>".$row['name']."</td>";
              echo "<td><img style='width:200px' class='img-fluid' src='".$row['image']."'/></td>";
              echo "<td>".$row['buy_price']."$</td>";
              echo "<td>";
              
              $product_id = $row['id'];
              echo '<a href="/doan2.0/admin/products/edit.php?id=' . $product_id . '">';
              echo '<button class="btn btn-info mx-2 my-2">Sửa</button>';
              echo '</a>';
              echo '<form onsubmit="return confirm(\'Xác nhận xóa\')" method="POST" action="delete.php" style="display:inline-block;">';
              echo '<input name="product_id" value="' . $product_id . '" hidden />';
              echo '<button type="submit" class="btn btn-danger mx-2">Xóa</button>';
              echo '</form>';
              
              echo "</td>";
              echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

</body>
<script>
  let table = new DataTable('#myTable');
</script>

</html>

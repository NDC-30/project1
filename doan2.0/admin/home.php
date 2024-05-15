
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


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</head>

<body>
  <div class='d-flex vh-100'>
    <div class=" fixed-top d-flex flex-column flex-shrink-0 p-3 text-white bg-dark " style="height: 100%; width: 280px;">
      <a href="/doan2.0/admin/index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
          <use xlink:href="#index"></use>
        </svg>
        <span class="fs-4">BEE HIVE</span>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="/doan2.0/admin/prosucts/home.php" class="nav-link"  aria-current="page">
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#index"></use>
            </svg>
            Trang chủ
          </a>
        </li>
        <li>
          <a href="/doan2.0/admin/products/home.php" class="nav-link active text-white">
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
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle " id="dropdownUser1"
          data-bs-toggle="dropdown" aria-expanded="false">
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
    Content
    <div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
            <th>mã sản Phẩm</th>
            <th>Tên sản Phẩm</th>
            <th>ảnh</th>
            <th>Giá bán</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while($row = mysqli_fetch_assoc($result)){
                echo"<tr>";
                     echo "<td>".$row['id']."</td>";
                     echo "<td>".$row['name']."</td>";
                     echo "<td>";
                          echo "<img style='width:200px' class='img-fluid' src='".$row['image']."'/>";
                    echo"</td>";
                    echo "<td>".$row['buy_price']."$</td>";
                echo"</tr>";
            }
        ?>
        </tbody>
    </table>
    </div>

</body>
<style>
  th{
    text-align: center;
  }
  .container{
    margin-left: 220px;
  }
</style>
<script>let table = new DataTable('#myTable');</script>

</html>
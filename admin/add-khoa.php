<?php include('partials/header.php'); ?>
<!-- Start main -->
<div class="main-content">
    <div class="wrapper">
        <h1 style="color:#a83232">Thêm mới khoa</h1>
        <br><br>
        <div class="container">
            <form method="POST" action="add-khoa.php" enctype="multipart/form-data">
                Mã khoa: <input class="form-control" type="text" name="ma_khoa"/><br>
                Tên khoa: <input class="form-control" type="text" name="ten_khoa"/><br>
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End main -->
<?php include('partials/footer.php'); ?>

<?php
//kiểm tra dữ liệu người dùng nhậP
if (isset($_REQUEST['ma_khoa']) && isset($_REQUEST['ten_khoa'])) {
    
    //kết nối sql
    include "../config/config.php";
    //câu lệnh sql
    $query = "INSERT INTO `db_khoa` (`ma_khoa`,`ten_khoa`) VALUES (?,?);";
    // Tạo đối tượng repared
    $stmt = $conn->prepare($query);
    //gán dữ liệu vào biến và lấy dữ liệu từ form
    $ma_khoa = $_POST['ma_khoa'];
    $ten_khoa = $_POST['ten_khoa'];
    // Gán giá trị vào các tham số ẩn ('?')
    $stmt->bind_param('ss', $ma_khoa, $ten_khoa);
    //thực thi câu truy vấn
    $stmt->execute();
    //đóng kết nối cơ sở dữ liệu
    $conn->close();
    //chuyển về trang user
    header("Location: khoa.php");
}
?>
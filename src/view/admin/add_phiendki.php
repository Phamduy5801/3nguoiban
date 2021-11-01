<?php 
    session_start();
    if(!isset($_SESSION['admin'])){
        header("Location: ../../../login.php");
    }
?>
<?php include('partials/header.php'); ?>
<!-- Start main -->
<div class="main-content">
    <div class="wrapper">
        <h1 style="color:#a83232">Thêm mới phiên đăng kí học</h1>
        <br><br>
        <div class="container">
            <form method="POST" action="">
                Thời gian bắt đầu: <input class="form-control" type="datetime-local" name="tg_batdau" /><br>
                Thời gian kết thúc: <input class="form-control" type="datetime-local" name="tg_ketthuc" /><br>
                Học kì: <input class="form-control" type="text" name="hocki" /><br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End main -->

<?php
if (isset($_REQUEST['tg_batdau']) && isset($_REQUEST['tg_ketthuc']) && isset($_REQUEST['hocki'])) {
    include_once ("../../config/config.php");
    //câu lệnh sql
    $query = "INSERT INTO `phien_dkihoc` (`thoigian_batdau`, `thoigian_ketthuc`, `hoc_ki`) VALUES (?,?,?);";
    // Tạo đối tượng repare
    $stmt = $conn->prepare($query);

    ///gán dữ liệu vào biến và lấy dữ liệu từ form
    
    $tg_bd = $_POST['tg_batdau'];
    $tg_kt = $_POST['tg_ketthuc'];
    $hocki = $_POST['hocki'];
    // Gán giá trị vào các tham số ẩn ('?')
    $stmt->bind_param('ssd', $tg_bd, $tg_kt, $hocki);
    //thực thi câu truy vấn
    $stmt->execute();
    //đóng kết nối cơ sở dữ liệu
    $conn->close();
    //chuyển về trang user
    header("Location:phien_dki.php");
}
?>
<?php include_once ('partials/footer.php'); ?>
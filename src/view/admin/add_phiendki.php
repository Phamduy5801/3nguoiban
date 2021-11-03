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
                Học kì:  <!-- tạo ra 1 seclect box cho người dùng lựa chọn danh sách kì học -->
                 <select class="form-select form-control" name="hoc_ki" aria-label="Default select example">
                    <?php
                    //kết nối csdl
                    include_once ("../../config/config.php");

                    //câu lệnh sql
                    $query = "Select id, hoc_ki from semester_study";
                    //thực thi câu lệnh sql
                    $result = $conn->query($query);
                    //nếU không thực thi đc thì hiển thị lỗi
                    if (!$result) {
                        die($conn->error);
                    }
                    //gán biến $hocki vào 1 mảng
                    $hocki = array();
                    //chạy vòng lặp để lấy dữ liệu theo từng hàng 
                    while ($r = $result->fetch_array(MYSQLI_BOTH)) {
                        $hocki[] = $r;
                    }

                    // sử dụng vòng lặp foreach để duyệt dữ liệu trong mảng và gán vào biến $hk
                    foreach ($hocki as $hk) {
                    ?>
                        <!-- cho admin lựa chọn option với value là id và hiển thị trên web là học kì tương ứng với hoc_ki đÓ -->
                        <option value="<?php echo $hk['id'] ?>"><?php echo $hk['hoc_ki'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End main -->

<?php
if (isset($_REQUEST['tg_batdau']) && isset($_REQUEST['tg_ketthuc']) && isset($_REQUEST['hoc_ki'])) {
    include_once ("../../config/config.php");
    //câu lệnh sql
    $query = "INSERT INTO `phien_dkihoc` (`thoigian_batdau`, `thoigian_ketthuc`, `hoc_ki`) VALUES (?,?,?);";
    // Tạo đối tượng repare
    $stmt = $conn->prepare($query);

    ///gán dữ liệu vào biến và lấy dữ liệu từ form
    
    $tg_bd = $_POST['tg_batdau'];
    $tg_kt = $_POST['tg_ketthuc'];
    $hocki = $_POST['hoc_ki'];
    
    // Gán giá trị vào các tham số ẩn ('?')
    $stmt->bind_param('ssd', $tg_bd, $tg_kt, $hocki);
    //thực thi câu truy vấn
    $stmt->execute();
    //đóng kết nối cơ sở dữ liệu
    $conn->close();
    //chuyển về trang phien_dki.php
    header("Location: phien_dki.php");
}
?>
<?php include_once ('partials/footer.php'); ?>
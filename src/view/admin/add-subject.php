<?php 
    session_start();
    if(!isset($_SESSION['done'])){
        header("Location: ../../../login.php");
    }
?>
<?php include('partials/header.php'); ?>
<!-- Start main -->
<div class="main-content">
    <div class="wrapper">
        <h1 style="color:#a83232">Thêm mới sinh viên</h1>
        <br><br>
        <div class="container">
            <form method="POST" action="add-subject.php">
                ID: <input class="form-control" type="text" name="id"/><br>
                Khoa: 
                <!-- tạo ra 1 seclect box cho người dùng lựa chọn danh sách tên khoa -->
                <select class="form-select form-control" name="khoa" aria-label="Default select example">
                    <?php
                    //kết nối csdl
                    include_once ("../../config/config.php");

                    //câu lệnh sql
                    $query = "Select ma_khoa, ten_khoa from db_khoa";
                    //thực thi câu lệnh sql
                    $result = $conn->query($query);
                    //nếU không thực thi đc thì hiển thị lỗi
                    if (!$result) {
                        die($conn->error);
                    }
                    //gán biến $khoa vào 1 mảng
                    $khoa = array();
                    //chạy vòng lặp để lấy dữ liệu theo từng hàng 
                    while ($r = $result->fetch_array(MYSQLI_BOTH)) {
                        $khoa[] = $r;
                    }

                    // sử dụng vòng lặp foreach để duyệt dữ liệu trong mảng và gán vào biến $kh
                    foreach ($khoa as $kh) {
                    ?>
                        <!-- cho admin lựa chọn option với value là role_id và hiển thị trên web là tên của cái role tương ứng với role_id đÓ -->
                        <option value="<?php echo $kh['ma_khoa'] ?>"><?php echo $kh['ten_khoa'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <br>
                Tên: <input class="form-control" type="text" name="ten"/><br>
                Ngày bắt đầu: <input class="form-control" type="date" name="ngay_batdau"/><br>
                Ngày kết thúc: <input class="form-control" type="date" name="ngay_ketthuc"><br>
                Thời gian học: <input class="form-control" type="text" name="thoigian_hoc"/><br>
                Giảng viên: <input class="form-control" type="text" name="giang_vien"/><br>
                Số tín chỉ: <input class="form-control" type="text" name="so_tc"/><br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End main -->


<?php
//kiểm tra dữ liệu người dùng nhậP
if (isset($_REQUEST['id']) && isset($_REQUEST['khoa']) && isset($_REQUEST['ten']) && isset($_REQUEST['ngay_batdau']) && isset($_REQUEST['ngay_ketthuc']) && isset($_REQUEST['thoigian_hoc'])  && isset($_REQUEST['giang_vien']) && isset($_REQUEST['so_tc'])) {

    //kết nối sql
    include_once ("../../config/config.php");
    //câu lệnh sql
    $query = "INSERT INTO `db_subject` (`sb_id`,`ma_khoa`,`sb_ten`,`ngay_batdau`,`ngay_ketthuc`,`thoigian_hoc`,`giang_vien`,`sb_tinchi`) VALUES (?,?,?,?,?,?,?,?);";
    // Tạo đối tượng repare
    $stmt = $conn->prepare($query);
    //gán dữ liệu vào biến và lấy dữ liệu từ form

    $id = $_POST['id'];
    $khoa = $_POST['khoa'];
    $ten = $_POST['ten'];
    $ngay_bd = $_POST['ngay_batdau'];
    $ngay_kt = $_POST['ngay_ketthuc'];
    $thoigian_hoc = $_POST['thoigian_hoc'];
    $giangvien = $_POST['giang_vien'];
    $so_tc = $_POST['so_tc'];

    // Gán giá trị vào các tham số ẩn ('?')
    $stmt->bind_param('sssssssd', $id, $khoa, $ten, $ngay_bd, $ngay_kt, $thoigian_hoc, $giangvien, $so_tc);
    //thực thi câu truy vấn
    $stmt->execute();
    //đóng kết nối cơ sở dữ liệu
    $conn->close();
    //chuyển về trang student
    header("Location: subject.php");
}
?> 
<?php include('partials/footer.php'); ?>
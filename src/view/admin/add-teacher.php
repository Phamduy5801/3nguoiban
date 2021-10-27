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
        <h1 style="color:#a83232">Thêm mới giảng viên</h1>
        <br><br>
        <div class="container">
            <form method="POST" action="add-teacher.php">
                ID: <input class="form-control" type="text" name="id"/><br>
                Tên: <input class="form-control" type="text" name="ten"/><br>
                Số điện thoại: <input class="form-control" type="text" name="sdt"/><br>
                Email: <input class="form-control" type="text" name="email"/><br>
                Địa chỉ: <input class="form-control" type="text" name="diachi"/><br>
                Khoa:
                <!-- tạo ra 1 select box cho người dùng lựa chọn -->
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
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End main -->


<?php
//kiểm tra dữ liệu người dùng nhậP
if (isset($_REQUEST['id']) && isset($_REQUEST['ten']) && isset($_REQUEST['khoa'])) {

    //kết nối sql
    include_once ("../../config/config.php");
    //câu lệnh sql
    $query = "INSERT INTO `db_teacher` (`tea_id`,`tea_ten`,`tea_sdt`,`tea_email`,`tea_diachi`,`ma_khoa`) VALUES (?,?,?,?,?,?);";
    // Tạo đối tượng repared
    $stmt = $conn->prepare($query);
    //gán dữ liệu vào biến và lấy dữ liệu từ form
    $id = $_POST['id'];
    $ten = $_POST['ten'];
    $sdt = $_POST['sdt'];
    $email = $_POST['email'];
    $diachi = $_POST['diachi'];
    $khoa = $_POST['khoa'];

    // Gán giá trị vào các tham số ẩn ('?')
    $stmt->bind_param('ssssss', $id, $ten, $sdt, $email, $diachi, $khoa);
    //thực thi câu truy vấn
    $stmt->execute();
    //đóng kết nối cơ sở dữ liệu
    $conn->close();
    //chuyển về trang teacher
    header("Location: teacher.php");
}
?> 
<?php include('partials/footer.php'); ?>
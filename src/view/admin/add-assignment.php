<?php 
 ob_start();
    session_start();
    if(!isset($_SESSION['admin'])){
        header("Location: ../../../login.php");
    }
?>
<?php include('partials/header.php'); ?>
<!-- Start main -->
<div class="main-content">
    <div class="wrapper">
        <h1 style="color:#a83232">Thêm mới</h1>
        <br><br>
        <div class="container">

            <form method="POST" action="add-assignment.php">

                Tên giảng viên:   
                <!-- tạo ra 1 seclect box cho quản trị viên dùng lựa chọn danh sách tên giảng viên -->
                <select class="form-select form-control" name="ten" aria-label="Default select example">
                    <?php
                    //kết nối csdl
                    include_once ("../../config/config.php");
                    //câu lệnh sql
                    $query = "Select tea_id, tea_ten from db_teacher";
                    //thực thi câu lệnh sql
                    $result = $conn->query($query);
                    //nếU không thực thi đc thì hiển thị lỗi
                    if (!$result) {
                        die($conn->error);
                    }
                    //gán biến $teacher vào 1 mảng
                    $teacher = array();
                    //chạy vòng lặp để lấy dữ liệu theo từng hàng 
                    while ($r = $result->fetch_array(MYSQLI_BOTH)) {
                        $teacher[] = $r;
                    }
                    // sử dụng vòng lặp foreach để duyệt dữ liệu trong mảng và gán vào biến $tea
                    foreach ($teacher as $tea) {
                    ?>
                        <!-- cho admin lựa chọn option với value là tea_id và hiển thị trên web là tên giảng viên tương ứng với tea_id đÓ -->
                        <option value="<?php echo $tea['tea_id'] ?>"><?php echo $tea['tea_ten'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <br> 
                Tên môn học:   
                <!-- tạo ra 1 seclect box cho quản trị viên dùng lựa chọn danh sách tên môn học -->
                <select class="form-select form-control" name="monhoc" aria-label="Default select example">
                    <?php
                    //kết nối csdl
                    include_once ("../../config/config.php");
                    //câu lệnh sql
                    $query = "Select sb_id, sb_ten from db_subject";
                    //thực thi câu lệnh sql
                    $result = $conn->query($query);
                    //nếU không thực thi đc thì hiển thị lỗi
                    if (!$result) {
                        die($conn->error);
                    }
                    //gán biến $subject vào 1 mảng
                    $subject = array();
                    //chạy vòng lặp để lấy dữ liệu theo từng hàng 
                    while ($r = $result->fetch_array(MYSQLI_BOTH)) {
                        $subject[] = $r;
                    }
                    // sử dụng vòng lặp foreach để duyệt dữ liệu trong mảng và gán vào biến $sub
                    foreach ($subject as $sub) {
                    ?>
                        <!-- cho admin lựa chọn option với value là sb_id và hiển thị trên web là tên môn học tương ứng với sb_id đÓ -->
                        <option value="<?php echo $sub['sb_id'] ?>"><?php echo $sub['sb_ten'] ?></option>
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
<?php include('partials/footer.php'); ?>

<?php
//kiểm tra dữ liệu người dùng nhậP
if (isset($_REQUEST['ten']) && isset($_REQUEST['monhoc'])) {

    //kết nối sql
    include_once ("../../config/config.php");

    //câu lệnh sql
    $query = "INSERT INTO `teacher_subject` (`tea_id`,`sb_id`) VALUES (?,?);";
    // Tạo đối tượng repare
    $stmt = $conn->prepare($query);
    //gán dữ liệu vào biến và lấy dữ liệu từ form với name tương ứng
    
    $ten = $_POST['ten'];
    $monhoc = $_POST['monhoc'];
    // Gán giá trị vào các tham số ẩn ('?')
    $stmt->bind_param('ss',$ten, $monhoc);
    //thực thi câu truy vấn
    $stmt->execute();
    //đóng kết nối cơ sở dữ liệu
    $conn->close();
    //chuyển về trang tea_sub.php
    header("Location: tea_sub.php");
    ob_end_flush ();
}
?> 
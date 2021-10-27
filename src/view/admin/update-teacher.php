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
        <h1 style="color:#a83232">Cập nhật thông tin sinh viên</h1>
        <br>
        <?php
        //kiểm tra khởi tạo của biếN tea_id
        if (isset($_GET['tea_id'])) {
            //gán $id = dữ liệu của tea_id
            $id = $_GET['tea_id'];
        } else {
            //quay trở lại trang teacher.php
            header("Location: teacher.php");
        }
        //kết nối cơ sở dữ liệu
        include_once ("../../config/config.php");
        //câu lệnh sql
        $caulenh = "Select * from db_teacher where tea_id=?";
        //khởi tạo đối tượng prepare
        $stmt = $conn->prepare($caulenh);
        // Gán giá trị vào các tham số ẩn ('?')
        $stmt->bind_param("d", $id);
        //thực thi câu lệnh sql
        $stmt->execute();
        //tạo biến $result lấy dữ liệU của $stmt
        $result = $stmt->get_result();
        //kiểm tra $result
        if (!$result) {
            //nếU sai thì die tại đây và hiển thị lỗi
            die($conn->error);
        }
        //tạo biến $st và gán dữ liệu theo từng hàng 
        $tea = $result->fetch_array(MYSQLI_BOTH);
        ?>
        <div class="container">
            <form method="POST" action="update-teacher.php?tea_id=<?php echo $id ?>">
                Tên: <input class="form-control" type="text" name="ten" value="<?php echo $tea['tea_ten'] ?>" /><br>
                Số điện thoại: <input class="form-control" type="text" name="sdt" value="<?php echo $tea['tea_sdt'] ?>" /><br>
                Email: <input class="form-control" type="text" name="email" value="<?php echo $tea['tea_email'] ?>" /><br>
                Địa chỉ: <input class="form-control" type="text" name="diachi" value="<?php echo $tea['tea_diachi'] ?>" /><br>
                <br>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End main -->
<?php include('partials/footer.php'); ?>
<?php
//kiểm tra ten đã tồn tại hay chưa
if (isset($_REQUEST['ten'])) {
    //gán $id = dữ liệu của st_id
    $id = $_GET['tea_id'];
    //kết nối cơ sở dữ liệu
    include_once "../config/config.php";
    //câu lệnH sql
    $query = "update db_teacher set tea_ten = ?, tea_sdt = ?, tea_email = ?, tea_diachi = ? where tea_id = ?";
    //khởI tạo đố itượng prepare
    $stmt = $conn->prepare($query);
    //gán biến = dữ liệu lấy từ trong form
    $ten = $_POST['ten'];
    $sdt = $_POST['sdt'];
    $email = $_POST['email'];
    $diachi = $_POST['diachi'];
    // Gán giá trị vào các tham số ẩn ('?')
    $stmt->bind_param("sssss", $ten, $sdt, $email, $diachi, $id);
    //thực thi câu lệnh sql
    $stmt->execute();
    //đóng kết nối 
    $conn->close();
    //quay lại trang teacher.php
    header("Location: teacher.php");
}
?>
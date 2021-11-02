<?php 
    session_start();
    if(!isset($_SESSION['teacher'])){
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
        //kiểm tra khởi tạo của biến st_id
        if (isset($_GET['st_id'])) {
            //gán $id = dữ liệu của st_id
            $id = $_GET['st_id'];
        } else {
            //nếu thất bại thì về trang index
            header("Location: index.php");
        }
        //kết nối csdl 
        include_once ("config/config.php");
        //câu lệnh sql
        $caulenh = "Select * from db_student where st_id=?";
        //tạo đỐi tượng prepare
        $stmt = $conn->prepare($caulenh);
        // Gán giá trị vào các tham số ẩn ('?')
        $stmt->bind_param("s", $id);
        //thực thi câu lệnh sql
        $stmt->execute();
        //tạo biến $result lấy dữ liệU của $stmt
        $result = $stmt->get_result();
        //kieẻm tra $result
        if (!$result) {
            //nếU sai thì die tại đây và hiển thị lỗi
            die($conn->error);
        }
        //tạo biến $st và lấy dữ liệu theo từng hàng 
        $st = $result->fetch_array(MYSQLI_BOTH);
        
        
        ?>
        <div class="container">
            <form method="POST" action="dexuat-sua-student.php?st_id=<?php echo $id ?>">
                Tên: <input class="form-control" readonly type="text" name="ten" value="<?php echo $st['st_ten'] ?>" /><br>
                Số điện thoại: <input class="form-control" type="text" name="sdt" value="<?php echo $st['st_sdt'] ?>" /><br>
                Email: <input class="form-control" type="text" readonly name="email" value="<?php echo $st['st_email'] ?>" /><br>
                Địa chỉ: <input class="form-control" readonly type="text" name="diachi" value="<?php echo $st['st_diachi'] ?>" /><br>
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
    $id = $_GET['st_id'];
    //kết nối cơ sở dữ liệu
    include_once ("config/config.php");
    //câu lệnH sql
    $query = "update db_student set st_ten = ?, st_sdt = ?, st_email = ?, st_diachi = ? where st_id = ?";
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
    //đóng kếT nối
    $conn->close();
    //trở lại trang dexuat-list-student
    header("Location: dexuat-list-student.php");
}
?>
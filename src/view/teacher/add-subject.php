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
        <h1 style="color:#a83232">Cập nhật thông tin môn học</h1>
        <br>
        <?php
        //kiểm tra khởi tạo của biến sb_id
        if (isset($_GET['sb_id'])) {
            //gán $id = dữ liệu của sb_id
            $id = $_GET['sb_id'];
        } else {
            //nếu khgông đưuọc thì quay về trang subject.php
            header("Location: update-subject.php");
        }
        //kết nối csdl 
        include_once ("config/config.php");
        //câu lệnh sql
        $caulenh = "Select * from db_subject where sb_id=?";
        //tạo đỐi tượng prepare
        $stmt = $conn->prepare($caulenh);
        // Gán giá trị vào các tham số ẩn ('?')
        $stmt->bind_param("s", $id);
        //thực thi câu lệnh sql
        $stmt->execute();
        //tạo biến $result lấy dữ liệU của $stmt
        $result = $stmt->get_result();
        //kiểm tra $result
        if (!$result) {
            //nếU sai thì die tại đây và hiển thị lỗi
            die($conn->error);
        }
        //tạo biến $sb và lấy dữ liệu theo từng hàng 
        $sb = $result->fetch_array(MYSQLI_BOTH);
        
        
        ?>
        <div class="container">
            <form method="POST" action="add-subject.php?sb_id=<?php echo $id ?>">
                Tên: <input class="form-control" type="text" readonly name="ten" value="<?php echo $sb['sb_ten'] ?>" /><br>
                Ngày bắt đầu: <input class="form-control" readonly type="date" name="ngay_bd" value="<?php echo $sb['ngay_batdau'] ?>" /><br>
                Ngày kết thúc: <input class="form-control" readonly type="date" name="ngay_kt" value="<?php echo $sb['ngay_ketthuc'] ?>" /><br>
                Thời gian học: <input class="form-control" type="text" name="thoigian_hoc" value="<?php echo $sb['thoigian_hoc'] ?>" /><br>
                Thông báo: <input class="form-control" type="text" name="sb_tb" value="<?php echo $sb['sb_tb'] ?>" /><br>
                <br>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End main -->

<?php
//kiểm tra ten đã tồn tại hay chưa
if (isset($_REQUEST['ten']) && isset($_REQUEST['ngay_bd']) && isset($_REQUEST['ngay_kt'])  && isset($_REQUEST['thoigian_hoc']) && isset($_REQUEST['sb_tb']) ) {
    //gán $id = dữ liệu của sb_id
    $id = $_GET['sb_id'];
    //kết nối cơ sở dữ liệu
    include_once ("config/config.php");
    //câu lệnh sql
    $query = "UPDATE `db_subject` SET `sb_ten` = ?, `ngay_batdau` = ?, `ngay_ketthuc` = ? ,`thoigian_hoc` = ?,`sb_tb` = ?   WHERE `db_subject`.`sb_id` = ?";
    
    //khởI tạo đố itượng prepare
    $stmt = $conn->prepare($query);
    //gán biến = dữ liệu lấy từ trong form
    $ten = $_POST['ten'];
    $ngay_bd = $_POST['ngay_bd'];
    $ngay_kt = $_POST['ngay_kt'];
    $thoigian = $_POST['thoigian_hoc'];
    $sb_tb = $_POST['sb_tb'];
    // Gán giá trị vào các tham số ẩn ('?')
    $stmt->bind_param("ssssss", $ten, $ngay_bd, $ngay_kt, $thoigian, $sb_tb, $id);
    //thực thi câu lệnh sql
    $stmt->execute();
    //đóng kếT nối
    $conn->close();
    //trở lại trang subject.php
    header("Location: update-subject.php");
}
?>
<?php include('partials/footer.php'); ?>
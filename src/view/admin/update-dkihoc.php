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
        <h1 style="color:#a83232">Cập nhật lịch học</h1>
        <br>
        <?php
        //kiểm tra khởi tạo của biếN st_id
        if (isset($_GET['id'])) {
            //gán $id = dữ liệu của st_id
            $id = $_GET['id'];
        } else {
            //nếu khgông đưuọc thì quay về trang dkihoc.php
            header("Location: dkihoc.php");
        }
        //kết nối csdl 
        include_once ("../../config/config.php");
        //câu lệnh sql
        $caulenh = "Select * from db_dkihoc where id=?";
        //tạo đỐi tượng prepare
        $stmt = $conn->prepare($caulenh);
        // Gán giá trị vào các tham số ẩn ('?')
        $stmt->bind_param("d", $id);
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
        $dki = $result->fetch_array(MYSQLI_BOTH);
        
        
        ?>
        <div class="container">
            <form method="POST" action="">

                Tên giảng viên: 
                <select class="form-select form-control" name="ten_gv" aria-label="Default select example">
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
                        <!-- cho admin lựa chọn option với value là role_id và hiển thị trên web là tên của cái role tương ứng với role_id đÓ -->
                        <option value="<?php echo $tea['tea_id'] ?>"><?php echo $tea['tea_ten'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                Lớp học: <input class="form-control" type="text" name="lop_hoc" value="<?php echo $dki['phong_hoc'] ?>" /><br>
              
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
if (isset($_REQUEST['ten_gv']) && isset($_REQUEST['lop_hoc'])) {
    //gán $id = dữ liệu của st_id
    $id = $_GET['id'];
    //kết nối cơ sở dữ liệu
    include_once ("../../config/config.php");
    //câu lệnH sql
    $query = "update db_dkihoc set tea_id = ?, phong_hoc = ? where id = ?";
    //khởI tạo đố itượng prepare
    $stmt = $conn->prepare($query);
    //gán biến = dữ liệu lấy từ trong form
    $ten_gv = $_POST['ten_gv'];
    $lophoc = $_POST['lop_hoc'];
    
    // Gán giá trị vào các tham số ẩn ('?')
    $stmt->bind_param("dsd", $ten_gv, $lophoc,  $id);
    //thực thi câu lệnh sql
    $stmt->execute();
    //đóng kếT nối
    $conn->close();
    //trở lại trang student.php
    header("Location: dkihoc.php");
}
?>
<?php include('partials/footer.php'); ?>
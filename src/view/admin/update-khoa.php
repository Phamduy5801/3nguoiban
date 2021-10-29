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
        <h1 style="color:#a83232">Cập nhật khoa</h1>
        <br>
        <?php
        //kiểm tra khởi tạo của biếN ma_khoa
        if (isset($_GET['ma_khoa'])) {
            //gán $id = dữ liệu của ma_khoa
            $id = $_GET['ma_khoa'];
        } else {
            //quay trở lại trang khoa.php
            header("Location: khoa.php");
        }
        //kết nối cơ sở dữ liệu mysql
        include_once ("../../config/config.php");
        //câu lệnh sql
        $caulenh = "Select * from db_khoa where ma_khoa=?";
        //khởi tao đối tượng prepare và thực thi  câu lênh sql
        $stmt = $conn->prepare($caulenh);
        // Gán giá trị vào các tham số ẩn ('?')
        $stmt->bind_param("s", $id);
        //thực thi $stmt
        $stmt->execute();
        //tạo biến $result lấy dữ liệU của $stmt
        $result = $stmt->get_result();
        //kiểm tra biến $result
        if (!$result) {
            //nếu không tồn tại thì die tại đây và hiển thị lỗi
            die($conn->error);
        }
        //khởI tạo biến $khoa và lấy dữ liệu theo từng hàng 
        $khoa = $result->fetch_array(MYSQLI_BOTH);
        $result->close();
        ?>

        <div class="container">

            <form method="POST" action="update-khoa.php?ma_khoa=<?php echo $id ?>">

                Mã khoa: <input class="form-control" type="text" name="ma_khoa" value="<?php echo $khoa['ma_khoa'] ?>" /><br>
                Tên khoa: <input class="form-control" type="text" name="ten_khoa" value="<?php echo $khoa['ten_khoa'] ?>" /><br>
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
//kiểm tra ma_khoa và ten_khoa đã tồn tại hay chưa
if (isset($_REQUEST['ma_khoa']) && isset($_REQUEST['ten_khoa'])) {
    //gán $id = dữ liệu ma_khoa
    $id = $_GET['ma_khoa'];
    //kết nối cơ sở dữ liệu
    include_once ("../../config/config.php");
    //câu lệnh sql
    $query = "update db_khoa set ma_khoa = ?, ten_khoa = ? where ma_khoa = ?";
    //thực thi câu truy vấn
    $stmt = $conn->prepare($query);
    //khởI tạo biếN và gán dữ liệu lấy được từ trong form
    $ma_khoa = $_POST['ma_khoa'];
    $ten_khoa = $_POST['ten_khoa'];
    // Gán giá trị vào các tham số ẩn ('?')
    $stmt->bind_param("sss", $ma_khoa, $ten_khoa, $ma_khoa);
    //thực thi câu truy vấn
    $stmt->execute();
    //đóng kết nối
    $conn->close();
    //quay về trang khoa.php
    header("Location: khoa.php");
}
?> 
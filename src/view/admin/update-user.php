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
        <h1 style="color:#a83232">Cập nhật thông tin</h1>
        <br>
        <?php
        //kiểm tra khởi tạo của biếN user_id
        if (isset($_GET['user_id'])) {
            //gán $id = dữ liệu của user_id
            $id = $_GET['user_id'];
        } else {
            //quay trở lại trang user.php
            header("Location: user.php");
        }
        //kết nối cơ sở dữ liệu
        include_once ("../../config/config.php");
        //câu lệnh sql
        $caulenh = "Select * from db_user where user_id=?";
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
        //tạo biến $user và gán dữ liệu theo từng hàng 
        $user = $result->fetch_array(MYSQLI_BOTH);
        ?>
        <div class="container">
            <form method="POST" action="update-user.php?user_id=<?php echo $id ?>">
                Username: <input class="form-control" type="text" name="username" value="<?php echo $user['username'] ?>" /><br>
                Email: <input class="form-control" type="text" name="email" value="<?php echo $user['email'] ?>" /><br>
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
//kiểm tra ussername va email đã tồn tại hay chưa
if (isset($_REQUEST['username']) && isset($_REQUEST['email'])) {
    //gán $id = dữ liệu của user_id
    $id = $_GET['user_id'];
    //kết nối cơ sở dữ liệu
    include_once ("../../config/config.php");
    //câu lệnH sql
    $query = "update db_user set username = ?, email = ? where user_id = ?";
    //khởI tạo đố itượng prepare
    $stmt = $conn->prepare($query);
    //gán biến = dữ liệu lấy từ trong form
    $username = $_POST['username'];
    $email = $_POST['email'];
    // Gán giá trị vào các tham số ẩn ('?')
    $stmt->bind_param("ssd", $username, $email, $id);
    //thực thi câu lệnh sql
    $stmt->execute();
    //đóng kết nối 
    $conn->close();
    //quay lại trang user.php
    header("Location: user.php");
}
?>
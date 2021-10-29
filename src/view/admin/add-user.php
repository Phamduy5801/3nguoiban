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
        <h1 style="color:#a83232">Thêm mới người sử dụng</h1>
        <br><br>
        <div class="container">
            <form method="POST" action="add-user.php">
                Username: <input class="form-control" type="text" name="username" /><br>
                Password: <input class="form-control" type="password" name="password" /><br>
                Email: <input class="form-control" type="text" name="email" /><br>
                Role:
                <select class="form-select form-control" name="role_id" aria-label="Default select example">
                    <?php
                    //kết nối csdl
                    include_once ("../../config/config.php");

                    //câu lệnh sql
                    $query = "Select role_id, role_name from role";
                    //thực thi câu lệnh sql
                    $result = $conn->query("$query");
                    //nếU không thực thi đc thì hiển thị lỗi
                    if (!$result) {
                        die($conn->error);
                    }
                    //gán biến $role vào 1 mảng
                    $role = array();
                    //chạy vòng lặp để lấy dữ liệu theo từng hàng 
                    while ($r = $result->fetch_array(MYSQLI_BOTH)) {
                        $role[] = $r;
                    }
                    // sử dụng vòng lặp foreach để duyệt dữ liệu trong mảng và gán vào biến $ro
                    foreach ($role as $ro) {
                    ?>
                        <!-- cho admin lựa chọn option với value là role_id và hiển thị trên web là tên của cái role tương ứng với role_id đÓ -->
                        <option value="<?php echo $ro['role_id'] ?>"><?php echo $ro['role_name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <br></br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End main -->

<?php
if (isset($_REQUEST['username']) && isset($_REQUEST['password']) && isset($_REQUEST['email']) && isset($_REQUEST['role_id'])) {
    include_once ("../../config/config.php");

    //kiểm tra và lấy dữ liệu của user_id
    if(isset($_GET['user_id'])) {
        $id = $_GET['user_id']; 
    }
   

    //câu lệnh sql
    $query = "INSERT INTO `db_user` (`username`, `password`, `email`, `role_id`) VALUES (?,?,?,?);";
    // Tạo đối tượng repare
    $stmt = $conn->prepare($query);

    ///gán dữ liệu vào biến và lấy dữ liệu từ form
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = $_POST['role_id'];

    //băm pass
    $pass_hash = password_hash($password, PASSWORD_DEFAULT);
    // Gán giá trị vào các tham số ẩn ('?')
    $stmt->bind_param('ssss', $username, $pass_hash, $email, $role);
    //thực thi câu truy vấn
    $stmt->execute();
    //đóng kết nối cơ sở dữ liệu
    $conn->close();
    //chuyển về trang user
    header("Location:user.php");
}
?>
<?php include_once ('partials/footer.php'); ?>